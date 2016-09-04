(function () {
    'use strict';

    angular
        .module('app')
        .controller('LoginController', LoginController);

    LoginController.$inject = ['$location', 'AuthenticationService'];

    function LoginController($location, AuthenticationService) {
        var vm = this;
        vm.login = login;
        vm.message = '';

        (function initController() {
            // reset login status
            AuthenticationService.ClearCredentials();
        })();

        function login() {
            vm.dataLoading = true;
            AuthenticationService.Login(vm.email, vm.password, function (response) {

                if(!response.data.error) {
                    AuthenticationService.SetCredentials(response.data.response);
                    $location.path('/');

                } else {
                    vm.message = response.data.message;
                    vm.dataLoading = false;
                }
            });
        };
    }

})();
