(function () {
    'use strict';

    angular
        .module('app')
        .controller('EntregueController', EntregueController);

    EntregueController.$inject = ['DataService', '$rootScope', '$interval', '$scope'];

    function EntregueController(DataService, $rootScope, $interval, $scope) {
        var vm = this;
        vm.results = '';
        vm.message = '';
        vm.image = '';
        vm.name = '';
        vm.loading = true;

        vm.delivered = function (){
            DataService.getPedidos(2).then(function(data) {
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

        vm.delivered();

        var intervalPromise = $interval(vm.delivered, 15000);

        $scope.$on('$destroy',function(){
            $interval.cancel(intervalPromise);
        });

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