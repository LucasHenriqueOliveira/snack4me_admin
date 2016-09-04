(function () {
    'use strict';

    angular
        .module('app')
        .controller('TrucksController', TrucksController);

    TrucksController.$inject = ['$location', 'DataService', '$localstorage'];

    function TrucksController($location, DataService, $localstorage) {
        var vm = this;

        vm.getProducts = function() {
            DataService.getProducts().then(function (data) {
                vm.produtos = data.response;
            });
        };

        vm.getProducts();

        vm.getProduct = function(product) {
            DataService.setCurrentProduct(product);
            $location.path('/product/' + product.product_id);
        };

        vm.editProduct = function(product) {
            DataService.setCurrentProduct(product);
            $location.path('/edit-product/' + product.product_id);
        };

        vm.removeProduct = function(product) {
            DataService.removeProduct(product.product_id).then(function (data) {
                if(data.error) {
                    toastr.error(data.message, 'Produto', {timeOut: 3000});
                } else {
                    toastr.success(data.message, 'Produto', {timeOut: 3000});
                }
                vm.getProducts();
            });
        };

        vm.activeProduct = function(truck) {
            var truckActive = {
                id: $localstorage.getObject('id')
            };
            TruckService.activeTruck(truck.carro_id, truckActive).then(function (data) {
                if(data.error) {
                    toastr.error(data.message, 'Produto', {timeOut: 3000});
                } else {
                    toastr.success(data.message, 'Produto', {timeOut: 3000});
                }
                vm.getTrucks();
            });
        };

    }

})();

