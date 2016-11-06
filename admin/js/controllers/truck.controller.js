(function () {
    'use strict';

    angular
        .module('app')
        .controller('TruckController', TruckController);

    TruckController.$inject = ['$location', '$window', 'DataService', '$routeParams'];

    function TruckController($location, $window, DataService, $routeParams) {
        var vm = this;
        vm.truck = {};

        vm.back = function(){
            $window.history.back();
        };

        vm.produto = DataService.getCurrentProduct();
        vm.produto.thumb = "http://snack4me.com/hotel/events/" + vm.produto.product_event_id + "/products/thumb/" + vm.produto.product_image;
        vm.produto.sistema = "http://snack4me.com/hotel/events/" + vm.produto.product_event_id + "/products/full/" + vm.produto.product_image;

        vm.editProduct = function(product) {
            DataService.setCurrentProduct(product);
            $location.path('/edit-product/' + product.product_id);
        };
    }

})();