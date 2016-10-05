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
                "userDesactivationId": 2

            };


            if(confirm("Deseja remover o usuário " + user.name.toUpperCase() + " ?")){
                DataService.removeUser(postData).then(function (data) {
                    if(data.error) {
                        toastr.error(data.message, 'Usuário', {timeOut: 3000});
                    } else {
                        toastr.success(data.message, 'Usuário', {timeOut: 3000});
                    }

                    $location.path('/users');
                });
            }
            return false;

        };

        vm.submitAddUser = function(form){

            var postData = {
                "profileId": form.profileSelect.id,
                "username": form.username,
                "zone": jstz.determine().name(),
                "company": 1,
                "userActivationId": 2

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