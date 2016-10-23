/* jstz  */
(function () {
    'use strict';

    angular
        .module('app')
        .controller('AddTruckController', AddTruckController);

    AddTruckController.$inject = ['DataService', '$localstorage', '$location', '$scope', '$filter', '$rootScope'];

    function AddTruckController(DataService, $localstorage, $location, $scope, $filter, $rootScope) {
        var vm = this;
        vm.message_part = '';
        vm.message_part_edit = '';
        vm.part = {};
        vm.parts = {};
        vm.truck = {};
        vm.partEdit = {};
        vm.complement = {};


        vm.back = function(){
            $location.path('/products');
        };

        DataService.clearComplementos();

        vm.getComplementos = function() {
            vm.complementos = DataService.getComplementos();
        };

        vm.getComplementos();

        DataService.getCategory().then(function(data){

            vm.categorias = data.response;
        });


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

        vm.submitProduct = function(form) {




            var postData = {
                "categoria": form.categoriaSelected.id,
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
                "qtd_complemento" : form.complementos.length,
                "company" : $localstorage.get('company'),
                "zone" : jstz.determine().name(),
                "imageFull" : form.product.imageFull.src,
                "imageThumbnails" :  form.product.imageThumbnails.src,
            };



            var idx = 0;

            Object.keys(form.complementos).forEach(function(partId) {
                postData['complemento_pt_' + idx] = form.complementos[partId].name_pt;
                postData['complemento_en_' + idx] = form.complementos[partId].name_en;
                postData['complemento_es_' + idx] = form.complementos[partId].name_es;
                idx++;
            });

            DataService.createProduct(postData).then(function (data) {
                if(data.error) {
                    toastr.error(data.message, 'Produto', {timeOut: 3000});
                } else {
                    toastr.success(data.message, 'Produto', {timeOut: 3000});
                    $localstorage.remove('complementos');
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
    }






})();

