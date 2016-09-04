(function () {
    'use strict';

    angular
        .module('app')
        .controller('PreparoController', PreparoController);

    PreparoController.$inject = ['DataService', '$rootScope', '$interval', '$scope', 'ngToast'];

    function PreparoController(DataService, $rootScope, $interval, $scope, ngToast) {
        var vm = this;
        vm.results = '';
        vm.message = '';
        vm.image = '';
        vm.name = '';
        vm.loading = true;

        vm.prepare = function (){
            DataService.getPedidos(3).then(function(data) {
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

        vm.prepare();

        var intervalPromise = $interval(vm.prepare, 15000);

        $scope.$on('$destroy',function(){
            $interval.cancel(intervalPromise);
        });

        vm.ready = function(id) {
            DataService.getRefresh(id, 5).then(function(data) {
                if(data.error === false) {
                    vm.prepare();
                    ngToast.create({
                        content: 'Pronto para entrega.'
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