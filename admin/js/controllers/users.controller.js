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

        vm.profiles = UserService.getPerfis();

        vm.editUser = function(user) {

            DataService.setCurrentUser(user);
            $location.path('/edit-user/' + user.id);
        };

        vm.removeUser = function(user) {

            var postData = {
                "id": user.id,
                "zone": jstz.determine().name(),
                "userDesactivationId": $localstorage.get("id")

            };


            if(confirm("Deseja remover o usuário " + user.name.toUpperCase() + " ?")){
                DataService.removeUser(postData).then(function (data) {
                    if(data.error === false) {
                        toastr.error('Removido com sucesso', 'Usuário', {timeOut: 3000});
                    } else {
                        toastr.success(data.message, 'Usuário', {timeOut: 3000});
                    }
                    vm.getUsers();

                });
            }
            return false;

        };

        vm.submitAddUser = function(form){

            var postData = {
                "profileId": form.profileSelect.id,
                "username": form.username,
                "zone": jstz.determine().name(),
                "company": $localstorage.get("company"),
                "userActivationId": $localstorage.get("id")

            };

            DataService.submitAddUser(postData).then(function(response) {

                if(response.error === false) {

                    toastr.success("Cadastro Efetuado com Sucesso",'Cadastro de usuário', {timeOut: 3000});


                } else {
                    toastr.error(response.message, 'Cadastro de usuário', {timeOut: 3000});

                }

                $location.path('/users');
            });
        };




    }

})();