(function () {
    'use strict';

    angular
        .module('app')
        .controller('ProntoController', ProntoController);

    ProntoController.$inject = ['DataService', '$rootScope', '$interval', '$scope', 'ngToast'];

    function ProntoController(DataService, $rootScope, $interval, $scope, ngToast) {
        var vm = this;
        vm.results = '';
        vm.message = '';
        vm.image = '';
        vm.name = '';
        vm.loading = true;

        vm.ready = function (){
            DataService.getPedidos(5).then(function(data) {
                if(data.error === false) {
                    vm.results = data.response;
                    $rootScope.numResults = data.response.length;
                } else {
                    vm.message = data.response;
                    $rootScope.numResults = 0;
                }
                vm.loading = false;
            });
        };

        vm.ready();

        var intervalPromise = $interval(vm.ready, 15000);

        $scope.$on('$destroy',function(){
            $interval.cancel(intervalPromise);
        });

        vm.outDelivery = function(id) {
            DataService.getRefresh(id, 4).then(function(data) {
                if(data.error === false) {
                    vm.ready();
                    ngToast.create({
                        content: 'Saiu para entrega.'
                    });
                } else {
                    ngToast.create({
                        className: 'warning',
                        content: data.message
                    });
                }
            });
        };

        vm.getImage = function(image, name) {
            vm.image = image;
            vm.name = name;
        };

        vm.getImageUrl = function() {
            return 'http://www.snack4me.com/hotel/events/1/products/full/' + vm.image;
        };

        vm.getStatus = function(id) {
            vm.order_id = id;
        };

        vm.changeStatus = function(id, option) {
            DataService.getRefresh(id, option).then(function(data) {
                if(data.error === false) {
                    ngToast.create({
                        content: 'Alteração do status do pedido.'
                    });
                } else {
                    ngToast.create({
                        className: 'warning',
                        content: data.message
                    });
                }
            });

            jQuery(document).ready(function(){
                jQuery("#myModalId").modal("hide");
            });
        };
    }

})();