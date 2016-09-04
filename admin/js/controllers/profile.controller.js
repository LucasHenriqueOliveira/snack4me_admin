(function () {
    'use strict';

    angular
        .module('app')
        .controller('ProfileController', ProfileController);

    ProfileController.$inject = ['$location', 'AuthenticationService', '$localstorage'];

    function ProfileController($location, AuthenticationService, $localstorage) {
        var vm = this;
        vm.user = {};
        vm.user.email = AuthenticationService.GetEmail();
        vm.user.perfil = AuthenticationService.GetRolesName();

        vm.changePassword = function() {
            $location.path("/change-password");
        };
    }

})();