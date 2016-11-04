(function () {
    'use strict';

    angular
        .module('app')
        .controller('EditTruckController', EditTruckController);

    EditTruckController.$inject = ['DataService', '$localstorage', '$location', '$scope', '$filter', '$rootScope', 'TruckService'];

    function EditTruckController(DataService, $localstorage, $location, $scope, $filter, $rootScope, TruckService) {
        var vm = this;
        vm.part = {};
        vm.complement = {};

        vm.back = function(){
            $location.path('/products');
        };

         vm.product = DataService.getCurrentProduct();

        if(!vm.product) {
            toastr.warning("Necessário selecionar o produto da lista", {timeOut: 3000});
            $location.path('/products');
        }

        vm.product.numero = vm.product.product_number;
        vm.product.name_pt = vm.product.product_name_pt;
        vm.product.name_en = vm.product.product_name_en;
        vm.product.name_es = vm.product.product_name_es;
        vm.product.desc_pt = vm.product.product_desc_pt;
        vm.product.desc_en = vm.product.product_desc_en;
        vm.product.desc_es = vm.product.product_desc_es;
        vm.product.price = vm.product.product_price;
        vm.product.hour_initial = vm.product.product_hour_initial;
        vm.product.hour_final = vm.product.product_hour_final;
        vm.product.fast = vm.product.product_fast;
        vm.categorySelectId = vm.product.product_category_id;
        vm.product.inventory_qtd = vm.product.product_inventory_qtd;
        vm.product.inventory_current = vm.product.product_inventory_current;
        vm.product.inventory_minimum = vm.product.product_inventory_minimum;
        vm.product.inventory_maximum = vm.product.product_inventory_maximum;
        vm.admin = false;

        if($localstorage.get('roles_id') == 3){
            vm.admin = true;
        }

        vm.getComplementos = function() {
            vm.complementos = DataService.getComplementos();
        };

        vm.getComplementos();

        DataService.getCategory().then(function(data){

            vm.categorias = data.response;
        });



        vm.dadosSelect = {

            categoriaSelected: { categoriaId: { id: vm.categorySelectId}}
        };



        vm.removeComplemento = function(complemento) {
            var complementos = $localstorage.getObject('complementos');

            var found = $filter('filter')(complementos, complemento, true);

            if (found.length) {
                for(var i = 0; i < complementos.length; i++) {
                    var obj = complementos[i];

                    if(found.indexOf(obj) !== -1) {
                        complementos.splice(i, 1);
                        i--;
                    }
                }
                $localstorage.setObject('complementos', complementos);
                vm.getComplementos();
            } else {
                toastr.error('Erro ao excluir o complemento', 'Exclusão de complemento', {timeOut: 3000});
            }
        };
        vm.submitComplement = function(complement) {
            vm.complementos = $localstorage.getObject('complementos');

            if(JSON.stringify(vm.complementos) === '{}'){
                $localstorage.setObject('complementos', [{
                    name_pt : complement.name_pt,
                    name_en : complement.name_en,
                    name_es : complement.name_es
                }]);
            } else{
                vm.complementos.push({
                    name_pt : complement.name_pt,
                    name_en : complement.name_en,
                    name_es : complement.name_es
                });
                $localstorage.setObject('complementos', vm.complementos);
            }

            vm.complementos = DataService.getComplementos();
            vm.complement = {};
            $scope.formComplement.$setPristine();

            jQuery(document).ready(function(){
                jQuery("#myComplement").modal("hide");
            });
        };
        vm.submitEditProduct = function(form) {

            var postData = {
                id: form.truck.carro_id,
                frota: form.truck.carro_frota,
                nome: form.truck.carro_nome,
                placa: form.truck.carro_placa,
                placa_semi_reboque: form.truck.carro_placa_semi_reboque,
                km: form.truck.carro_km,
                qtd_part: form.parts_truck.length,
                usuario_ativacao: $localstorage.getObject('id'),
                empresa: $localstorage.getObject('company')
            };

            var idx = 0;

            Object.keys(form.parts_truck).forEach(function(partId) {
                postData['id_car_item_' + idx] = form.parts_truck[partId].carro_item_id;
                postData['id_part_' + idx] = form.parts_truck[partId].carro_item_item_id;
                postData['time_part_' + idx] = form.parts_truck[partId].carro_item_vida_util;
                postData['last_part_' + idx] = form.parts_truck[partId].carro_item_ultima_km;
                postData['stock_' + idx] = form.parts_truck[partId].estoque_id;
                idx++;
            });

            TruckService.update(postData).then(function (data) {
                if(data.error) {
                    toastr.error(data.message, 'Caminhão', {timeOut: 3000});
                } else {
                    toastr.success(data.message, 'Caminhão', {timeOut: 3000});
                    $localstorage.remove('truck_parts');
                    vm.truck = {};
                    $scope.formTruck.$setPristine();
                    $rootScope.$broadcast("login-done");
                    $location.path('/trucks');
                }
            });
        };

        jQuery(document).ready(function(){
            jQuery('.popovers').popover();

            jQuery('.default-date-picker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                language: 'pt-BR'
            });
        });
    };

})();