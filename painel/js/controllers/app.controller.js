(function () {
    'use strict';

    angular
        .module('app')
        .controller('AppController', AppController);

    AppController.$inject = ['DataService', '$routeParams', '$scope', '$localstorage'];

    function AppController(DataService, $routeParams, $scope, $localstorage) {
        $scope.id_event = $routeParams;
        $scope.logged = true;

        if(!$localstorage.get('email') && !$localstorage.get('token') && !$localstorage.get('id')){
            $scope.logged = false;
        }
    }

})();