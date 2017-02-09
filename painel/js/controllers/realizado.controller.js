(function () {
    'use strict';

    angular
        .module('app')
        .controller('RealizadoController', RealizadoController);

    RealizadoController.$inject = ['DataService', '$interval', '$rootScope', '$scope', 'ngToast'];

    function RealizadoController(DataService, $interval, $rootScope, $scope, ngToast) {
        var vm = this;
        vm.results = '';
        vm.message = '';
        vm.image = '';
        vm.name = '';
        vm.loading = true;

        vm.done = function (){
            DataService.getPedidos(1).then(function(data) {
                if(data.error === false) {
                    vm.results = data.response;
                    $rootScope.numResults = data.response.length;
                } else {
                    vm.message = data.response;
                    $rootScope.numResults = 0;
                }
                vm.loading = false;
            });
        };

        vm.done();

        var intervalPromise = $interval(vm.done, 15000);

        $scope.$on('$destroy',function(){
            $interval.cancel(intervalPromise);
        });

        vm.prepare = function(order) {
            if(!order.local){
                order.local = order.apartamento;
            }

            var products = '';
            for(var i = 0; i < order.produtos.length; i++) {
                products += order.produtos[i].name + ': ' + order.produtos[i].qtd + ' unid.(s)<br />';

                for(var m = 0; m < order.produtos[i].type.length; m++) {
                    if(order.produtos[i].type[m].name) {
                        products += '&nbsp;&nbsp; - ' + order.produtos[i].type[m].name + '<br />';
                    }

                    if(order.produtos[i].type[m].comment){
                        products += '&nbsp;&nbsp; obs.: ' + order.produtos[i].type[m].comment + '<br />';
                    }
                }
            }

            var agendado = '';
            if(order.schedule == 1) {
                agendado = 'Horário: ' + order.time;
            }

            var win = window.open('', 'Print', 'width=500,height=300');
            win.document.write('<html><head><title></title><style>body{ font-size: 20px; line-height: 40px } @page {margin: 0.5cm;}</style>' +
                '</head><body><div style="width: 100%;text-align: center"><img src="images/maxsavassi.png" width="100px"></div># '+order.numero_pedido+'<br />Hora: '+order.time_order+'<br /> Apt: '+order.apartamento+'<br />Ent: '+order.local+'' +
                '<br />'+products + agendado+'<br/>------------------------<br/><div style="font-size: 14px;line-height: 20px">Snack4me<br/>www.snack4me.com<br/>(31)98553-0222</div>' +
                '<br /><br /><br />---------------------------------<br /><br /><br /><div style="width: 100%;text-align: center"><img src="images/maxsavassi.png" width="100px"></div># '+order.numero_pedido+'<br />Hora: '+order.time_order+'<br /> Apt: '+order.apartamento+'<br />Ent: '+order.local+'' +
                '<br />'+products + agendado+'<br/>------------------------<br/><div style="font-size: 14px;line-height: 20px">Snack4me<br/>www.snack4me.com<br/>(31)98553-0222</div></body></html>');
            win.document.close();
            win.print();
            win.close();

            DataService.getRefresh(order.order_id, 3).then(function(data) {
                if(data.error === false) {
                    vm.done();
                    ngToast.create({
                        content: 'Iniciando o preparo do pedido.'
                    });
                } else {
                    ngToast.create({
                        className: 'warning',
                        content: data.message
                    });
                }
            });
        };

        vm.getImage = function(image, name) {
            vm.image = image;
            vm.name = name;
        };

        vm.getImageUrl = function() {
            return 'http://www.snack4me.com/hotel/events/1/products/full/' + vm.image;
        };

        vm.getStatus = function(id) {
            vm.order_id = id;
        };

        vm.changeStatus = function(id, option) {
            DataService.getRefresh(id, option).then(function(data) {
                if(data.error === false) {
                    ngToast.create({
                        content: 'Alteração do status do pedido.'
                    });
                } else {
                    ngToast.create({
                        className: 'warning',
                        content: data.message
                    });
                }
            });

            jQuery(document).ready(function(){
                jQuery("#myModalId").modal("hide");
            });
        };
    }

})();