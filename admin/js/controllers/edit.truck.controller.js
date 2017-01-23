/* jstz  */
(function () {
    'use strict';

    angular
        .module('app')
        .controller('EditTruckController', EditTruckController);

    EditTruckController.$inject = ['DataService', '$localstorage', '$location', '$scope', '$filter', '$rootScope'];

    function EditTruckController(DataService, $localstorage, $location, $scope, $filter, $rootScope) {
        var vm = this;
        vm.part = {};
        vm.complement = {};
        DataService.clearComplementos();

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
        vm.product.complemento = vm.product.type_product;

        if($localstorage.get('roles_id') == 3){
            vm.admin = true;
        }

        vm.getComplementos = function() {
            vm.complementos = DataService.getComplementos();
        };


        DataService.getCategory().then(function(data){

            vm.categorias = data.response;
        });

        vm.loadComplementos = function () {
            if(vm.product.complemento){
                for(var i=0; i<vm.product.complemento.length; i++){
                    vm.complementos = $localstorage.getObject('complementos');
                    if(JSON.stringify(vm.complementos) === '{}'){
                        $localstorage.setObject('complementos', [{
                            name_pt: vm.product.complemento[i].type_product_name_pt,
                            name_en: vm.product.complemento[i].type_product_name_en,
                            name_es: vm.product.complemento[i].type_product_name_es
                        }]);
                    } else {
                        vm.complementos.push({
                            name_pt: vm.product.complemento[i].type_product_name_pt,
                            name_en: vm.product.complemento[i].type_product_name_en,
                            name_es: vm.product.complemento[i].type_product_name_es
                        });
                        $localstorage.setObject('complementos', vm.complementos);
                    }

                }
                vm.complementos = DataService.getComplementos();
            }
        };


        vm.loadComplementos();

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
                "id": vm.product.product_id,
                "categoria": vm.dadosSelect.categoriaSelected.categoriaId.id,
                "numero": form.product.numero,
                "hora_fim": form.product.hour_final,
                "hora_inicio": form.product.hour_initial,
                "price": form.product.price,
                "nome_en": form.product.name_en,
                "nome_es": form.product.name_es,
                "nome_pt": form.product.name_pt,
                "desc_en": form.product.desc_en,
                "desc_es": form.product.desc_es,
                "desc_pt": form.product.desc_pt,
                "fast": form.product.fast,
                "qtd_complemento": form.complementos ? form.complementos.length: null,
                "zone": jstz.determine().name(),
                "roles_id": $localstorage.get('roles_id'),
                "company" : $localstorage.get('company'),
            };

            if($localstorage.get('roles_id') == 3) {
                postData["inventory_qtd"]  =  form.product.inventory_qtd;
                postData["inventory_current"] = form.product.inventory_current;
                postData["inventory_minimum"] = form.product.inventory_minimum;
                postData["inventory_maximum"] =  form.product.inventory_maximum;
            }


            var idx = 0;

            Object.keys(form.complementos).forEach(function(partId) {
                postData['complemento_pt_' + idx] = form.complementos[partId].name_pt;
                postData['complemento_en_' + idx] = form.complementos[partId].name_en;
                postData['complemento_es_' + idx] = form.complementos[partId].name_es;
                idx++;
            });



            DataService.updateProduct(postData).then(function (data) {
                if(data.error) {
                    toastr.error(data.message, 'Produto', {timeOut: 3000});
                } else {
                    toastr.success(data.message, 'Produto', {timeOut: 3000});
                    vm.complement = {};
                    DataService.clearComplementos();
                    $scope.formProduct.$setPristine();
                    $location.path('/products');
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