(function () {
    'use strict';

    angular
        .module('app', ['ngRoute', 'ngToast'])
        .config(config)
        .run(run);

    config.$inject = ['$routeProvider', 'ngToastProvider'];
    function config($routeProvider, ngToastProvider) {

        ngToastProvider.configure({
            animation: 'slide',
            verticalPosition: 'top',
            horizontalPosition: 'right',
            timeout: 3000
        });

        $routeProvider

            .when('/realizado/:id', {
                controller: 'RealizadoController',
                templateUrl: 'templates/realizado.html',
                controllerAs: 'vm',
                cache: false
            })

            .when('/preparo/:id', {
                controller: 'PreparoController',
                templateUrl: 'templates/preparo.html',
                controllerAs: 'vm',
                cache: false
            })

            .when('/pronto/:id', {
                controller: 'ProntoController',
                templateUrl: 'templates/pronto.html',
                controllerAs: 'vm',
                cache: false
            })

            .when('/saiu-entrega/:id', {
                controller: 'SaiuEntregaController',
                templateUrl: 'templates/saiu-entrega.html',
                controllerAs: 'vm',
                cache: false
            })

            .when('/entregue/:id', {
                controller: 'EntregueController',
                templateUrl: 'templates/entregue.html',
                controllerAs: 'vm',
                cache: false
            })

            .otherwise({ redirectTo: '/realizado/1' });
    }

    run.$inject = ['$rootScope', '$location'];
    function run($rootScope, $location) {

        $rootScope.$on('$locationChangeStart', function (event, nextRoute, currentRoute) {
            $rootScope.url = ($location.path().substring(1).split("/"))[0];

        });
    }

})();