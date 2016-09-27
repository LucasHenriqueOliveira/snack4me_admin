(function () {
    'use strict';

    angular
        .module('app')
        .controller('UsersController', UsersController);

    UsersController.$inject = ['$location', 'UserService', '$localstorage','DataService'];

    function UsersController($location, UserService, $localstorage, DataService) {
        var vm = this;

        vm.getUsers = function() {
            DataService.getUsers().then(function (data) {
                vm.users = data.response;
            });
        };

        vm.getUsers();



    }

})();