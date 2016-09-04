(function () {
    'use strict';

    angular
        .module('app')
        .controller('DashboardController', DashboardController);

    DashboardController.$inject = ['DataService'];

    function DashboardController(DataService) {
        var vm = this;

        DataService.getDataDashboard().then(function (data) {
            vm.dash = data.response;
        });
    }

})();
