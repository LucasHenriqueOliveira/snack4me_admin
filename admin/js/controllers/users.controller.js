/* jstz*/
(function () {
    'use strict';

    angular
        .module('app')
        .controller('UsersController', UsersController);

    UsersController.$inject = ['$location', 'UserService', '$localstorage','DataService','$scope' ];

    function UsersController($location, UserService, $localstorage, DataService,$scope) {
        var vm = this;

        vm.getUsers = function() {
            DataService.getUsers().then(function (data) {
                vm.users = data.response;
            });
        };

        vm.getUsers();
        vm.username = ''

        vm.profiles = [
            { id : 1, name:'Entregador'},
            { id : 2, name:'Administrativo'},
            { id : 3, name:'Administrador Geral'},
            { id : 4, name:'Gerente'},
        ];


        vm.submitAddUser = function(form){

            var postData = {
                "profileId": form.profileSelect.id,
                "username": form.username,
                "zone": jstz.determine().name(),
                "company": 1

            };

            DataService.submitAddUser(postData).then(function(response) {

                if(response.error === false) {
                    $location.path('/users');
                    toastr.success("Cadastro Efetuado com Sucesso",'Cadastro de usuário', {timeOut: 3000});


                } else {
                    toastr.error(response.message, 'Cadastro de usuário', {timeOut: 3000});
                }
            });
        };



    }

})();