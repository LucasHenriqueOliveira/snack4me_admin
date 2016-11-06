/* jstz  */
(function () {
    'use strict';

    angular
        .module('app')
        .controller('EditImageTruckController', EditImageTruckController);

    EditImageTruckController.$inject = ['DataService', '$localstorage', '$location', '$scope'];

    function EditImageTruckController(DataService, $localstorage, $location, $scope) {
        var vm = this;

        vm.back = function(){
            $location.path('/products');
        };

        vm.produto = DataService.getCurrentProduct();

        if(!vm.produto) {
            toastr.warning("Necessário selecionar o produto da lista", {timeOut: 3000});
            $location.path('/products');
        }

        vm.produto.thumb = "http://snack4me.com/hotel/events/" + vm.produto.product_event_id + "/products/thumb/" + vm.produto.product_image;
        vm.produto.full = "http://snack4me.com/hotel/events/" + vm.produto.product_event_id + "/products/full/" + vm.produto.product_image;



        vm.submitEditImageProduct = function(form) {


            var postData = {
                "imageFull" : form.produto.imageFull.src,
                "imageThumbnails" :  form.produto.imageThumbnails.src,
                "zone": jstz.determine().name(),
                "company" : $localstorage.get('company'),
                "id": vm.produto.product_id,
                "numero": vm.produto.product_number,
                "nome_pt": vm.produto.product_name_pt
            };




            DataService.updateImageProduct(postData).then(function (data) {
                if(data.error) {
                    toastr.error(data.message, 'Produto', {timeOut: 3000});
                } else {
                    toastr.success(data.message, 'Produto', {timeOut: 3000});
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