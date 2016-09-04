(function () {
    'use strict';

    angular
        .module('app')
        .controller('AppController', AppController);

    AppController.$inject = ['$location', '$scope', 'AuthenticationService'];

    function AppController($location, $scope, AuthenticationService) {

        if(AuthenticationService.IsLogged()) {
            $location.path('/');
        } else {
            $location.path('/login');
        }

        $scope.logout = function() {
            AuthenticationService.ClearCredentials();
            $location.path('/login');
        };

    }

})();