/* jstz*/
(function () {
    'use strict';

    angular
        .module('app')
        .controller('EditUsersController', EditUsersController);

    EditUsersController.$inject = ['$location', 'UserService', '$localstorage','DataService','$scope' ];

    function EditUsersController($location, UserService, $localstorage, DataService,$scope) {
        var vm = this;

        vm.users = DataService.getCurrentUser();
        vm.profiles = UserService.getPerfis();



        vm.username = vm.users.name;
        vm.profileSelectId = vm.users.profile_id;

        vm.dadosSelect = {
            profiles: vm.profiles,
            profileSelected: { profileId: { id: vm.profileSelectId}}
        };



        vm.submitEditUser = function(form){

            var id= form.dadosSelect.profileSelected.profileId.id;

            var postData = {
                "profileId": id,
                "username": form.username,
                "zone": jstz.determine().name(),
                "company": $localstorage.get("company")

            };


            DataService.submitEditUser(postData,vm.users.id).then(function(response) {

                if(response.error === false) {

                    toastr.success("Cadastro Editado com Sucesso",'Edição de usuário', {timeOut: 3000});

                } else {
                    toastr.error(response.message, 'Edição de usuário', {timeOut: 3000});
                }
                $location.path('/users');
            });
        };


    }

})();