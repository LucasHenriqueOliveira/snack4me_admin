(function () {
    'use strict';

    angular
        .module('app')
        .factory('AuthenticationService', AuthenticationService);

    AuthenticationService.$inject = ['$http', '$localstorage', 'CONFIG'];
    function AuthenticationService($http, $localstorage, CONFIG) {
        var service = {};

        service.Login = Login;
        service.SetCredentials = SetCredentials;
        service.ClearCredentials = ClearCredentials;
        service.IsLogged = IsLogged;
        service.GetEmail = GetEmail;
        service.GetRoles = GetRoles;
        service.GetRolesName = GetRolesName;
        service.IsLoginDefault = IsLoginDefault;

        return service;

        function Login(email, password, callback) {

            /* Use this for real authentication
             ----------------------------------------------*/
            $http.post(CONFIG.url + 'login.php', { email: email, password: password })
                .then(function(response) {
                        callback(response);
                    }, function(error) {
                        console.log(error);
                    });
        }

        function SetCredentials(data) {

            $localstorage.set('id', data.id);
            $localstorage.set('email', data.email);
            $localstorage.set('token', data.token);
            $localstorage.set('roles_id', data.profile_id);
            $localstorage.set('roles_name', data.profile_name);
            $localstorage.set('login_default', data.login_default);

        }

        function ClearCredentials() {
            $localstorage.remove('id');
            $localstorage.remove('email');
            $localstorage.remove('token');
            $localstorage.remove('roles_id');
            $localstorage.remove('roles_name');
            $localstorage.remove('login_default');
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
    }

})();
