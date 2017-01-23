(function () {
    'use strict';

    angular
        .module('app')
        .controller('AppController', AppController);

    AppController.$inject = ['DataService', '$routeParams', '$scope', '$localstorage'];

    function AppController(DataService, $routeParams, $scope, $localstorage) {
        $scope.id_event = $routeParams;
        $scope.logged = true;

        $scope.user = false;
        if($localstorage.get('roles_id') == 3){
            $scope.user = true;
        }


        if(!$localstorage.get('email') && !$localstorage.get('token') && !$localstorage.get('id')){
            $scope.logged = false;
        }

        $scope.logout = function() {
            $localstorage.remove('id');
            $localstorage.remove('email');
            $localstorage.remove('token');
            $localstorage.remove('roles_id');
            $localstorage.remove('roles_name');
            $localstorage.remove('login_default');
            $localstorage.remove('company');

            window.location.href = 'http://www.snack4me.com/hotel/admin/';
        };
    }

})();