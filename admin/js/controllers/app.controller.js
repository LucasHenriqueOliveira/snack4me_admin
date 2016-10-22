(function () {
    'use strict';

    angular
        .module('app')
        .controller('AppController', AppController);

    AppController.$inject = ['$location', '$scope', 'AuthenticationService','$localstorage'];

    function AppController($location, $scope, AuthenticationService,$localstorage) {

        $scope.user = false;


        if($localstorage.get('roles_id') == 3){
            $scope.user = true;
        }

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