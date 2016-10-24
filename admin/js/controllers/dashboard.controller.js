/* jstz*/
(function () {
    'use strict';

    angular
        .module('app')
        .controller('DashboardController', DashboardController);

    DashboardController.$inject = ['DataService'];

    function DashboardController(DataService) {
        var vm = this;
        var zone =  jstz.determine().name();
        DataService.getDataDashboard(zone).then(function (data) {
            vm.dash = data.response;
        });
    }

})();
