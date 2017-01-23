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

                    if(response.data.response.profile_id == 5){
                        window.location.href = 'http://www.snack4me.com/hotel/painel/#/realizado/' + response.data.response.event;
                    } else {
                        $location.path('/');
                    }

                } else {
                    vm.message = response.data.message;
                    vm.dataLoading = false;
                }
            });
        };
    }

})();
