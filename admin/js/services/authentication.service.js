(function () {
    'use strict';

    angular
        .module('app')
        .factory('AuthenticationService', AuthenticationService);

    AuthenticationService.$inject = ['$http', '$localstorage', 'CONFIG','DOCTRINE'];
    function AuthenticationService($http, $localstorage, CONFIG,DOCTRINE) {
        var service = {};

        service.Login = Login;
        service.SetCredentials = SetCredentials;
        service.ClearCredentials = ClearCredentials;
        service.IsLogged = IsLogged;
        service.GetEmail = GetEmail;
        service.GetRoles = GetRoles;
        service.GetRolesName = GetRolesName;
        service.IsLoginDefault = IsLoginDefault;
        service.GetCompany = GetCompany;
        service.GetId = GetId;

        return service;

        function Login(email, password, callback) {

            /* Use this for real authentication
             ----------------------------------------------*/
            $http.post(DOCTRINE.url + 'login', { email: email, password: password })
                .then(function(response) {
                    callback(response);
                }, function(error) {
                    console.log(error);
                });
        }

        function SetCredentials(data) {

            $localstorage.set('id', data.id);
            $localstorage.set('email', data.name);
            $localstorage.set('token', data.token);
            $localstorage.set('roles_id', data.profile_id);
            $localstorage.set('roles_name', data.profile);
            $localstorage.set('login_default', data.login_default);
            $localstorage.set('company', data.event);


        }

        function ClearCredentials() {
            $localstorage.remove('id');
            $localstorage.remove('email');
            $localstorage.remove('token');
            $localstorage.remove('roles_id');
            $localstorage.remove('roles_name');
            $localstorage.remove('login_default');
            $localstorage.remove('company');
        }

        function IsLogged() {
            return ($localstorage.get('email') && $localstorage.get('token') && $localstorage.get('id'));
        }

        function GetEmail() {
            return $localstorage.get('email');
        }

        function GetRoles() {
            return $localstorage.get('roles_id');
        }

        function GetRolesName() {
            return $localstorage.get('roles_name');
        }

        function IsLoginDefault() {
            return ($localstorage.get('login_default') == 1) ? true : false;
        }

        function GetCompany() {
            return $localstorage.get('company');
        }

        function GetId() {
            return $localstorage.get('id');
        }

    }

})();
