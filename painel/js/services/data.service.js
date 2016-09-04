(function () {
    'use strict';

    angular
        .module('app')
        .factory('DataService', DataService);

    DataService.$inject = ['$http', '$q', '$routeParams'];

    function DataService($http, $q, $routeParams){

        return {
            getPedidos: function(id) {
                var baseUrl = "http://www.snack4me.com/hotel/painel/pedidos.php?id_event=";
                var id_event = $routeParams.id;
                var status = '&status=' + id;
                var date = "&d=" + Date.now();

                var deferred = $q.defer();

                $http({
                    method: 'GET',
                    url: baseUrl + id_event + status + date
                })
                    .then(function(response) {

                        deferred.resolve(response.data);


                    }, function(error) {
                        console.log(error);
                    });

                return deferred.promise;
            },

            getRefresh: function(id, status_id) {
                var baseUrl = "http://www.snack4me.com/hotel/painel/status.php?id_event=";
                var id_event = $routeParams.id;
                var order = '&order=' + id;
                var status = '&status=' + status_id;
                var date = "&d=" + Date.now();

                var deferred = $q.defer();

                $http({
                    method: 'GET',
                    url: baseUrl + id_event + order + status + date
                })
                    .then(function(response) {

                        deferred.resolve(response.data);


                    }, function(error) {
                        console.log(error);
                    });

                return deferred.promise;
            }
        }
    }
})();