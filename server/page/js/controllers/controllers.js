app.controller('Snack4meCtrl',['$scope', '$location', '$log', '$anchorScroll', function($scope, $location, $log, $anchorScroll) {

    $scope.go = function(path) {
    	$location.path( path );
    };

    $scope.scrollTo = function(id) {
        $location.hash(id);
        $anchorScroll();
    };

    $scope.goBack = function() {
        window.history.back();
    };

}]);

app.controller('EventsCtrl',['$scope', '$window', '$location', '$rootScope', 'AuthenticationService', '$http', '$log', '$timeout', function($scope, $window, $location, $rootScope, AuthenticationService, $http, $log, $timeout) {

	if($rootScope.globals.currentUser){
		if($rootScope.globals.currentUser.id == 1){
			AuthenticationService.ClearCredentials();
		}
	}

    $scope.latitude = null;
    $scope.longitude = null;
    $scope.supportsGeo = $window.navigator;
    $scope.eventos = [];
    $scope.loading = true;

	$scope.showlocation = function() {
		if($scope.supportsGeo){
			window.navigator.geolocation.getCurrentPosition(function(position) {
	            $scope.$apply(function() {
	            	$scope.latitude = position.coords.latitude;
	            	$scope.longitude = position.coords.longitude;

	            	$timeout(function() {
		            	var thisData = 'lat='+$scope.latitude+'&lon='+$scope.longitude;

		            	$http({
							method: 'POST',
							url: 'event.php',
							data: thisData,
							headers:{'Content-type': 'application/x-www-form-urlencoded'}
						})
						.success(function(data){
							if(data.error){
								$log.info(data);
							} else{
								if(data.response){
									$scope.eventos = data.response;
								}
							}
							$scope.loading = false;
						})
						.error(function(data, status, headers, config){
							throw new Error('Algo deu errado.');
						});
	            	}, 2000);
	            });
	        }, function() {
	        	$scope.loading = false;
	        });
		}
	};

	$scope.showlocation();
}]);

app.controller('EventsCityCtrl',['$scope', '$window', '$location', '$http', '$log', '$timeout', function($scope, $window, $location, $http, $log, $timeout) {
	$scope.cities = [];

	$scope.showCities = function() {

		$http.get('cities.php').success(function(data) {
			$scope.cities = data.response;
		})
		.error(function(data, status, headers, config){
			throw new Error('Algo deu errado.');
		});
	};

	$scope.submitEventCity = function(){

		if(!$scope.event_city){
			alert('Selecione o evento.');
			return false;
		}

		var event = $scope.event_city;
		var retorno = event.split("|");
		var id = retorno[0];
		var name = retorno[1];
		var date = retorno[2];

		for(var i = 0; i < date.length; i++){
			date = date.replace("/", "-");
		}

		$location.path("/location/" + id + "/" + name + "/" + date);

	};

	$scope.showCities();
}]);

app.controller('LocationCtrl', ['$scope', '$log', '$http', '$rootScope', 'AuthenticationService', '$routeParams', '$location', function($scope, $log, $http, $rootScope, AuthenticationService, $routeParams, $location) {

	if($rootScope.globals.currentUser){
		if($rootScope.globals.currentUser.id == 1){
			AuthenticationService.ClearCredentials();
		}
	}

	$scope.params = $routeParams;
    $scope.id_event = localStorage.getItem("id_event");
    $scope.floors = [];
    $scope.isfloor = false;
    $scope.isSector = false;
    $scope.isRow = false;
    $scope.sectors = [];
    $scope.rows = [];
    $scope.seats = [];
    $scope.defaultFloor = 'Selecione o nível';
    $scope.defaultSector = 'Selecione o setor';
    $scope.defaultRow = 'Selecione a fileira';
    $scope.defaultSeat = 'Selecione a cadeira';

    if($scope.id_event != $routeParams.id){
    	localStorage.removeItem("products");
    	localStorage.removeItem("num_products");
	}

    localStorage.setItem("id_event", $routeParams.id);

    var thisData = 'id_event=' + $routeParams.id;

	$http({
		method: 'POST',
		url: 'location.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded'}
	})
	.success(function(data){
		if(data.error){
			$log.info(data);
		} else{
			$scope.isfloor = data.conf.floor;
			$scope.isSector = data.conf.sector;
			$scope.isRow = data.conf.row;

			if($scope.isfloor){
				$scope.getFloor();
			} else if($scope.isSector){
				$scope.getSector();
			} else if($scope.isRow){
				$scope.getRow();
			}
		}
	})
	.error(function(data, status, headers, config){
		throw new Error('Algo deu errado.');
	});

	$scope.getFloor = function(){

		var thisData = 'id_event=' + $routeParams.id;
		$scope.defaultFloor = 'Carregando...';
		$http({
			method: 'POST',
			url: 'location_floor.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$log.info(data);
			} else{
				$scope.floors = data.floors;
			}
			$scope.defaultFloor = 'Selecione o nível';
		})
		.error(function(data, status, headers, config){
			throw new Error('Algo deu errado.');
		});
	};

	$scope.getSector = function(){
		if($scope.isfloor && !$scope.floor){
			alert('Selecione o nível');
			return false;
		}
		var number_floor = 0;

		if($scope.floor){
			number_floor = $scope.floor.id_floor;
		}

		var thisData = 'id_event=' + $routeParams.id + '&id_floor=' + number_floor;
		$scope.defaultSector = 'Carregando...';
		$http({
			method: 'POST',
			url: 'location_sector.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$log.info(data);
			} else{
				$scope.sectors = data.sectors;
			}
			$scope.defaultSector = 'Selecione o setor';
		})
		.error(function(data, status, headers, config){
			throw new Error('Algo deu errado.');
		});
	};

	$scope.getRow = function(){
		if($scope.isSector && !$scope.sector){
			alert('Selecione o setor');
			return false;
		}
		var number_sector = 0;

		if($scope.sector){
			number_sector = $scope.sector.id_sector;
		}

		var thisData = 'id_event=' + $routeParams.id + '&id_sector=' + number_sector;
		$scope.defaultRow = 'Carregando...';
		$http({
			method: 'POST',
			url: 'location_row.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$log.info(data);
			} else{
				$scope.rows = data.rows;
			}
			$scope.defaultRow = 'Selecione a fileira';
		})
		.error(function(data, status, headers, config){
			throw new Error('Algo deu errado.');
		});
	};

	$scope.getSeat = function(){
		if($scope.isRow && !$scope.row){
			alert('Selecione a fileira');
			return false;
		}

		var thisData = 'id_event=' + $routeParams.id + '&id_row=' + $scope.row.id_row;
		$scope.defaultSeat = 'Carregando...';
		$http({
			method: 'POST',
			url: 'location_seat.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$log.info(data);
			} else{
				$scope.seats = data.seats;
			}
			$scope.defaultSeat = 'Selecione a cadeira';
		})
		.error(function(data, status, headers, config){
			throw new Error('Algo deu errado.');
		});
	};

	$scope.submitLocation = function(){

		if($scope.floors.length > 0 && !$scope.floor){
			alert('Selecione um nível.');
			return false;
		}

		if($scope.sectors.length > 0 && !$scope.sector){
			alert('Selecione um setor.');
			return false;
		}

		if($scope.rows.length > 0 && !$scope.row){
			alert('Selecione uma fileira.');
			return false;
		}

		if($scope.seats.length > 0 && !$scope.seat){
			alert('Selecione a sua cadeira.');
			return false;
		}

		if($scope.floors.length > 0){
			localStorage.setItem("floor", $scope.floor.id_floor);
		} else{
			localStorage.removeItem("floor");
		}

		if($scope.sectors.length > 0){
			localStorage.setItem("sector", $scope.sector.id_sector);
		} else{
			localStorage.removeItem("sector");
		}

		if($scope.rows.length > 0 && $scope.seats.length > 0){
			var seat = $scope.seat.name_seat + $scope.row.name_row;
			localStorage.setItem("seat", seat);
		} else{
			if($scope.seats){
    			localStorage.setItem("seat", $scope.seat.id_seat);
    		}
		}

		$location.path("/product");
	};


}]);

app.controller('ProductsCtrl', ['$scope', '$log', '$http', '$rootScope', 'AuthenticationService', '$location', function($scope, $log, $http, $rootScope, AuthenticationService, $location) {

	$('#tip').priceFormat({
	    prefix: '',
	    centsSeparator: '.',
	    thousandsSeparator: ','
	});

	if($rootScope.globals.currentUser){
		if($rootScope.globals.currentUser.id == 1){
			AuthenticationService.ClearCredentials();
		}
	}

	$scope.dinheiro = 'R$ ';
	$scope.produtos = [];
	$scope.concessions = [];
	$scope.quantidade = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	$scope.myCoupon = '';
	$scope.mySubtotal = 'R$ 0.00';
	$scope.myDiscount = 'R$ 0.00';
	$scope.myTaxService = '';
	$scope.myTotal = 'R$ 0.00';
	$scope.total = 0;
	$scope.subtotal = 0;
	$scope.discount = 0;
	$scope.per_tax_service = 0;
	var id_event = localStorage.getItem("id_event");
	var thisData = 'id_event=' + id_event;
	$scope.tip = '';

	if(!id_event){
		alert('Evento não encontrado.');
		$location.path('/event');
		return false;
	}

	$http({
		method: 'POST',
		url: 'product.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded'}
	})
	.success(function(data){
		if(data.error){
			$log.info(data);
		} else{
			if(data.concessions){
				$scope.concessions = data.concessions;
				$scope.per_tax_service = data.tax_service;
			} else if(data.products){
				$scope.produtos = data.products;
				$scope.per_tax_service = data.tax_service;
			}
		}
	})
	.error(function(data, status, headers, config) {
		throw new Error('Algo deu errado.');
	});

	$scope.atualizaProducts = function(id_concession){

		$scope.concession = id_concession;

		$scope.mySubtotal = $scope.dinheiro + "0.00";
		$scope.myTaxService = '<strong>Taxa de Serviço: </strong>R$ 0.00';
		$scope.myDiscount = $scope.dinheiro + '0.00';
		var total = 0 + Number($scope.tip);
		$scope.total = total.toFixed(2);
		$scope.myTotal = $scope.dinheiro + total.toFixed(2);

		for(var i = 0; i < $scope.concessions.length; i++){
			if($scope.concessions[i].id == $scope.concession){
				$scope.produtos = $scope.concessions[i].products;
			}
		}
	}

	$scope.setSubtotal = function() {

		var subtotal = 0;

		for(var i = 0; i < this.produtos.length; i++){
			if(this.produtos[i].selectedOption){
				subtotal += this.produtos[i].selectedOption * this.produtos[i].price;
			}
		}

		var tax_service = subtotal * $scope.per_tax_service;
		var total = subtotal + tax_service;
		$scope.subtotal = subtotal.toFixed(2);
		$scope.total = total.toFixed(2);
		$scope.mySubtotal = $scope.dinheiro + subtotal.toFixed(2);
		$scope.myTaxService = '<strong>Taxa de Serviço: </strong>R$ ' + tax_service.toFixed(2);
		$scope.myDiscount = $scope.dinheiro + '0.00';
		total = total + Number($scope.tip);
		$scope.myTotal = $scope.dinheiro + total.toFixed(2);

	};

	$scope.checkCoupon = function() {

		if(!$scope.coupon){
			alert('Informe o número do coupon.');
			return false;
		}

		var id_event = localStorage.getItem("id_event");
		var thisData = 'coupon='+ $scope.coupon + '&id_event=' + id_event;
		$scope.myCoupon = "<img src='images/loading_pequeno.gif' title='Aguarde' alt='Aguarde' border='0'/>";

		$http({
			method: 'POST',
			url: 'coupon.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$log.info(data);
				$scope.myCoupon = '';
			} else{
				if(data.status == 1){
					$scope.myCoupon = data.message;
					$scope.colorMessage = 'font-color-red';
				} else{
					var desconto = $scope.subtotal * data.response;
					var total = $scope.total - desconto.toFixed(2);
					$scope.total = total.toFixed(2);
					$scope.discount = desconto.toFixed(2);
					total = total + Number($scope.tip);
					$scope.myTotal = $scope.dinheiro + total.toFixed(2);
					$scope.myDiscount = $scope.dinheiro + desconto.toFixed(2);

					var tax_desconto = data.response * 100;
					$scope.myCoupon = $scope.coupon + ' com ' + tax_desconto + '% de desconto.';
					$scope.colorMessage = 'font-color-normal';

				}
			}
		})
		.error(function(data, status, headers, config) {
			$scope.myCoupon = '';
			throw new Error('Algo deu errado.');
		});
	};

	$scope.submitProducts = function(){

		if(this.produtos.length == 0){
			alert('Selecione um produto.');
			return false;
		}

		var Products = new Array();
		var qtd = false;
		for(var i = 0; i < this.produtos.length; i++){
			if(this.produtos[i].selectedOption > 0){
				qtd = true;
			}
			Products.push({ "id":this.produtos[i].id,
							"name":this.produtos[i].name,
							"quantity":this.produtos[i].selectedOption,
							"price":this.produtos[i].price
						});
		}

		if(!qtd){
			alert('Selecione um produto.');
			return false;
		}

		localStorage.setItem("num_products", this.produtos.length);
		if($scope.coupon){
			localStorage.setItem("coupon", $scope.coupon);
		} else{
			localStorage.removeItem("coupon");
		}

		if($scope.tip == ''){
			$scope.tip = 0;
		}
		localStorage.setItem('tip', $scope.tip);
		localStorage.setItem('products',JSON.stringify(Products));
		$location.path('/checkout');
	};

	$scope.update = function(){
		var tip = $scope.tip;
		var total = Number($scope.total) + Number(tip);

		$scope.myTotal = $scope.dinheiro + total.toFixed(2);
	};

}]);

app.controller('LoginCtrl', ['$scope', '$rootScope', '$log', '$http', '$location', 'AuthenticationService', '$routeParams', '$facebook', function ($scope, $rootScope, $log, $http, $location, AuthenticationService, $routeParams, $facebook) {

	$scope.optionBuy = true;
	if($routeParams.option){
		$scope.optionBuy = false;
	}

	$scope.$on('fb.auth.authResponseChange', function() {
	$scope.status = $facebook.isConnected();
    	if($scope.status) {
    		$facebook.api('/me').then(function(user) {

    			AuthenticationService.LoginSocial(user.email, user.name, 3)
                 .success(function (data) {
                 	if(data.error){
                 		$scope.error = data.message;
         			} else{
 	                    AuthenticationService.SetCredentials(data.response.email, data.response.XSRF, data.response.id, data.response.name);
 	                    if($routeParams.option){
 	                    	$location.path('/page-personal');
 	                    } else{
 	                    	$location.path('/checkout');
 	                    }
         			}
                 })
                 .error(function (data) {
                     $scope.error = data.message;
                 });
    		});
    	}
    });

    $scope.loginFacebook = function() {
    	if($scope.status) {
    		$facebook.logout();
    	} else {
    		$facebook.login();
    	}
    };

    $scope.$on('event:google-plus-signin-success', function (event, authResult) {

    	gapi.client.load('oauth2', 'v2', function() {
    		var request = gapi.client.oauth2.userinfo.get();
    		request.execute(getEmailCallback);
    	});

    	function getEmailCallback(obj){
    		AuthenticationService.LoginSocial(obj.email, obj.name, 4)
            .success(function (data) {
            	if(data.error){
            		$scope.error = data.message;
    			} else{
                    AuthenticationService.SetCredentials(data.response.email, data.response.XSRF, data.response.id, data.response.name);
                    if($routeParams.option){
                    	$location.path('/page-personal');
                    } else{
                    	$location.path('/checkout');
                    }
    			}
            })
            .error(function (data) {
                $scope.error = data.message;
            });
    	}
    });
    //$scope.$on('event:google-plus-signin-failure', function (event, authResult) {
    // alert('Usuário não autorizado a conectar com Google+.');
    //  return false;
    //});
	//AuthenticationService.ClearCredentials();

        $scope.loginCustomer = function () {
            $scope.dataLoading = true;
            AuthenticationService.Login($scope.email, $scope.password)
                .success(function (data) {
                	if(data.error){
                		$scope.error = data.message;
                        $scope.dataLoading = false;
        			} else{
	                    AuthenticationService.SetCredentials($scope.email, data.response.XSRF, data.response.id, data.response.name);
	                    if($routeParams.option){
	                    	$location.path('/page-personal');
                    } else{
                    	$location.path('/checkout');
                    }
    			}
            })
            .error(function (data) {
                $scope.error = data.message;
                $scope.dataLoading = false;
            });
    };

    $scope.registerCustomer = function(){

    	if(!$scope.use_terms){
    		alert('Aceite os termos de uso.');
    		return false;
    	}

    	if($scope.sign_password !== $scope.sign_confirm_password){
    		$scope.messageRegister = "Senha e confirmação de senha diferentes.";
    		return false;
    	}

    	$scope.dataLoadingRegister = true;
    	var thisData = 'name='+ $scope.sign_name + '&email=' + $scope.sign_email + '&password=' + $scope.sign_password;

		$http({
			method: 'POST',
			url: 'customer-register.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$scope.messageRegister = data.message;
				$scope.dataLoadingRegister = false;
			} else{
				$scope.dataLoadingRegister = false;
				$scope.messageRegister = "Cadastro realizado com sucesso. Foi enviado um email para " + $scope.sign_email +
										". Verifique se o mesmo foi classificado como SPAM.";
			}
		})
		.error(function(data, status, headers, config) {
			throw new Error('Algo deu errado.');
		});
    };
}]);

app.controller('CheckoutCtrl', ['$scope', '$log', '$rootScope', '$cookieStore', '$http', '$location', 'AuthenticationService', function($scope, $log, $rootScope, $cookieStore, $http, $location, AuthenticationService) {
	$scope.name = '';
	$scope.event_date = '';
	$scope.floor = '';
	$scope.sector = '';
	$scope.seat = '';
	$scope.products = [];
	$scope.subtotal = '';
	$scope.discount = '';
	$scope.tax_service = '';
	$scope.total = '';
	$scope.coupon_number = '';
	$scope.coupon_tax = 0;
	$scope.initial_time = '';
	$scope.final_time = '';
	$scope.event_today = true;
	$scope.date_now = true;
	$scope.checkout_id = '';
	$scope.bdaytime = '';
	$scope.schedule = '';
	$scope.tip = '';

	if(!$rootScope.globals.currentUser){
		$location.path('/login/1');
		return false;
	}

	if(!$rootScope.checkout){
		var id_event = localStorage.getItem("id_event");
		var floor = localStorage.getItem("floor");
		var sector = localStorage.getItem("sector");
		var num_products = localStorage.getItem("num_products");
		var seat = localStorage.getItem("seat");
		var coupon = localStorage.getItem("coupon");
		var room = localStorage.getItem("room");
		var table = localStorage.getItem("table");
		var tip = localStorage.getItem("tip");

		var products = JSON.parse(localStorage.getItem("products"));

		if(!products){
			$location.path('/login/1');
			return false;
		}

		var string_products = '';
		for (var i = 0; i < products.length; i++) {
			string_products += "&id_product_" + i + "=" + products[i]['id'] + "&qtd_product_" + i + "=" + products[i]['quantity'];
		}

		var thisData = 'id_user=' + $rootScope.globals.currentUser.id + '&id_event=' + id_event + '&floor=' + floor + '&sector=' + sector;
		thisData += '&num_products=' + num_products + '&seat=' + seat + '&coupon=' + coupon + '&room=' + room + '&table=' + table + '&tip=' + tip + '&checkout=';
		thisData += string_products;
	} else{
		var thisData = 'checkout=' + $rootScope.checkout.id;

		if(!$rootScope.checkout.id){
			$location.path('/event');
			return false;
		}
	}

	$http({
		method: 'POST',
		url: 'checkout.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded', 'ACCESS-TOKEN': $rootScope.globals.currentUser.authdata}
	})
	.success(function(data){
		if(data.error){
			$log.info(data.message);
		} else{
			if(data.status === 401){
				AuthenticationService.ClearCredentials();
				alert('Faça login novamente.');
				$location.path('/login/1');
				return false;
			} else if(data.status == 1){
				$scope.message_checkout = data.message;
			} else{
				$scope.name = data.response.event_name;
				$scope.event_date = data.response.event_date;
				$scope.floor = data.response.floor;
				$scope.sector = data.response.sector;
				$scope.seat = data.response.seat;

				for(var i = 0; i < data.response.itens; i++){
					$scope.products = data.response.products;
				}

				var tax_service = Number(data.response.total) * Number(data.response.tax_service);
				var total = Number(data.response.total) + tax_service + Number(data.response.tip);
				$scope.subtotal = data.response.subtotal;
				$scope.discount = data.response.discount;
				$scope.tax_service = tax_service.toFixed(2);
				$scope.total = total.toFixed(2);

				if(data.response.coupon_number && data.response.coupon_tax){
					$scope.coupon_tax = data.response.coupon_tax * 100;
					$scope.coupon_number = data.response.coupon_number;
				}

				$scope.initial_time = data.response.initial_time;
				$scope.final_time = data.response.final_time;
				$scope.checkout_id = data.response.checkout_id;
				$scope.tip = data.response.tip;

				if(data.response.date_now != data.response.event_date){
					$scope.event_today = false;
					$scope.date_now = false;
				} else{
					$log.info(data.response.full_datetime_now+'-'+data.response.full_datetime_event);
					var date_now = new Date(data.response.full_datetime_now);
					var date_event = new Date(data.response.full_datetime_event);

					if(date_now < date_event){
						$scope.event_today = false;
						$scope.date_now = false;
					}
				}
			}
		}
	})
	.error(function(data, status, headers, config) {
		throw new Error('Algo deu errado.');
	});

	$scope.hideSchedule = function(value){
		$scope.event_today = value;
	};

	$scope.myOrder = function(){

		if(!$rootScope.globals){
			$scope.messageBuy = "Problema ao realizar o pedido.";
			return false;
		}
		$scope.dataLoading = true;

		var thisData = 'checkout='+ $scope.checkout_id + '&bdaytime=' + $scope.bdaytime + '&schedule=' + $scope.schedule;
		thisData += '&type_card='+ $scope.type_card + '&month_expiration=' + $scope.month_expiration + '&year_expiration=' + $scope.year_expiration;
		thisData += '&security_card='+ $scope.security_card + '&email=' + $rootScope.globals.currentUser.email;

		$http({
			method: 'POST',
			url: 'payment.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded', 'ACCESS-TOKEN': $rootScope.globals.currentUser.authdata}
		})
		.success(function(data){
			if(data.error){
				$scope.messageBuy = data.message;
				$scope.dataLoading = false;
			} else{
				if(data.status === 401){
					AuthenticationService.ClearCredentials();
					alert('Faça login novamente.');
					$location.path('/login/1');
					return false;
				} else if(data.status == 1){
					$scope.messageBuy = data.message;
				} else{
					$location.path('/order-success/' + data.response.ve);
				}
				$scope.dataLoading = false;
			}
		})
		.error(function(data, status, headers, config) {
			$scope.dataLoading = false;
			throw new Error('Algo deu errado.');
		});
	};

}]);

app.controller('OrderSuccessCtrl', ['$scope', '$log', '$rootScope', '$routeParams', 'AuthenticationService', '$http', '$location', function($scope, $log, $rootScope, $routeParams, AuthenticationService, $http, $location) {

	var validate_order = "http://www.snack4me.com/global/read.php?ve=" + $routeParams.id;
	$scope.url = "http://chart.apis.google.com/chart?chs=150x150&cht=qr&chld=L|0&chl=" + validate_order;

	localStorage.removeItem("coupon");
	localStorage.removeItem("floor");
	localStorage.removeItem("id_event");
	localStorage.removeItem("num_products");
	localStorage.removeItem("products");
	localStorage.removeItem("seat");
	localStorage.removeItem("sector");
	localStorage.removeItem("tip");

	delete $rootScope.checkout;

	if($rootScope.globals.currentUser.id == 1){
		AuthenticationService.ClearCredentials();
	}

	$scope.rating = 0;
    $scope.ratings = [{
        current: -1,
        max: 5
    }];

    $scope.getSelectedRating = function(rating) {
    	var vote = confirm("Deseja marcar " + rating + " estrela(s)?");

    	if(vote){
    		$scope.dataLoading = true;

    		var thisData = 've='+ $routeParams.id + '&rating='+rating;

    		$http({
    			method: 'POST',
    			url: 'opinion.php',
    			data: thisData,
    			headers:{'Content-type': 'application/x-www-form-urlencoded', 'ACCESS-TOKEN': $rootScope.globals.currentUser.authdata}
    		})
    		.success(function(data){
    			if(data.error){
    				$log.info(data.message);
    				$scope.dataLoading = false;
    			} else{
	    			if(data.status === 401){
						AuthenticationService.ClearCredentials();
						return false;
					} else{
						$scope.msgBuyingOpinion = data.message;
					}
	    			$scope.dataLoading = false;
    			}
    		})
    		.error(function(data, status, headers, config) {
    			$scope.dataLoading = false;
    			throw new Error('Algo deu errado.');
    		});
    	} else{
    		$scope.rating = 0;
    	    $scope.ratings = [{
    	        current: -1,
    	        max: 5
    	    }];
    	}
    }
}]);

app.controller('ReadOrderCtrl', ['$scope', '$log', '$rootScope', '$routeParams', '$http', '$location', function($scope, $log, $rootScope, $routeParams, $http, $location) {

	var thisData = 've='+ $routeParams.id;
	$scope.readOrder = false;

	$http({
		method: 'POST',
		url: '../read-order.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded'}
	})
	.success(function(data){
		if(data.error){
			$log.info(data.message);
		} else{
			$scope.num_order = data.response.num_order;
			$scope.event_name = data.response.event_name;
			$scope.floor = data.response.floor;
			$scope.seat = data.response.seat;
			$scope.date = data.response.date;
			$scope.hour = data.response.hour;
      $scope.status_order = data.response.status_order;
			$scope.products = data.response.products;
			$scope.local = data.response.local;
			$scope.price = data.response.price;
			$scope.discount = data.response.discount;
			$scope.tax_service = data.response.tax_service;
			$scope.price_total = data.response.price_total;

			if(data.response.length == 0){
				$scope.messageOrder = "Nenhum pedido encontrado!";
			}
		}
	})
	.error(function(data, status, headers, config) {
		throw new Error('Algo deu errado.');
	});

}]);

app.controller('ForgotPasswordCtrl', ['$scope', '$log', '$http', '$location', function($scope, $log, $http, $location) {

	$scope.dataLoading = false;

	$scope.checkEmail = function(){
		var thisData = 'email=' + $scope.recovery_email;

		$http({
			method: 'POST',
			url: 'forgot-password.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$scope.messageAlert = 'msg-alert alert-danger';
			} else{
				if(data.status == 1){
					$scope.messageAlert = 'msg-alert alert-success';
				} else{
					$scope.messageAlert = 'msg-alert alert-warning';
				}
			}
			$scope.message_forgot_email = data.message;
			$scope.dataLoadingRegister = false;
		})
		.error(function(data, status, headers, config) {
			throw new Error('Algo deu errado.');
		});
	};

}]);


app.controller('BuyNoRegisterCtrl', ['$scope', '$log', '$http', '$location', function($scope, $log, $http, $location) {

	$scope.dataLoading = false;

	$scope.buyAnonymous = function(){
		$scope.dataLoading = true;
		$scope.message_email_anonymous = '';

		var id_event = localStorage.getItem("id_event");
		var floor = localStorage.getItem("floor");
		var sector = localStorage.getItem("sector");
		var num_products = localStorage.getItem("num_products");
		var seat = localStorage.getItem("seat");
		var coupon = localStorage.getItem("coupon");
		var room = localStorage.getItem("room");
		var table = localStorage.getItem("table");
		var tip = localStorage.getItem("tip");

		var products = JSON.parse(localStorage.getItem("products"));
		var string_products = '';
		for (var i = 0; i < products.length; i++) {
			string_products += "&id_product_" + i + "=" + products[i]['id'] + "&qtd_product_" + i + "=" + products[i]['quantity'];
		}

		var thisData = 'email=' + $scope.email_anonymous + '&id_event=' + id_event + '&floor=' + floor + '&sector=' + sector;
		thisData += '&num_products=' + num_products + '&seat=' + seat + '&coupon=' + coupon + '&room=' + room + '&table=' + table + '&tip=' + tip;
		thisData += string_products;

		$http({
			method: 'POST',
			url: 'buy-no-register.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$scope.messageAlert = 'msg-alert alert-danger';
			} else{
				$scope.messageAlert = 'msg-alert alert-success';
			}
			$scope.message_email_anonymous = data.message;
			$scope.dataLoading = false;
		})
		.error(function(data, status, headers, config) {
			throw new Error('Algo deu errado.');
		});
	};

}]);

app.controller('AnonymousCtrl',['$scope', '$log', '$rootScope', '$routeParams', 'AuthenticationService', '$http', '$location', function($scope, $log, $rootScope, $routeParams, AuthenticationService, $http, $location) {

	var thisData = 've=' + $routeParams.id;

	$http({
		method: 'POST',
		url: 'anonymous.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded'}
	})
	.success(function(data){
		if(data.error){
			//$scope.messageAlert = 'msg-alert alert-danger';
			$log.info(data);
		} else{
			$rootScope.checkout = {
                	id: data.response.checkout,
                	email: data.response.email
		        };
			AuthenticationService.SetCredentials(data.response.email, data.response.XSRF, data.response.id, data.response.name);
			$location.path('/checkout');
		}
	})
	.error(function(data, status, headers, config) {
		throw new Error('Algo deu errado.');
	});
}]);

app.controller('PagePersonalCtrl',['$scope', '$log', '$rootScope', 'AuthenticationService', '$http', '$location', function($scope, $log, $rootScope, AuthenticationService, $http, $location) {

	if(!$rootScope.globals.currentUser){
		$location.path('/login/1');
	} else{
		if($rootScope.globals.currentUser.id == 1){
			AuthenticationService.ClearCredentials();
			$location.path('/login/1');
		}
	}

	$scope.name = $rootScope.globals.currentUser.name;
	$scope.email = $rootScope.globals.currentUser.email;
	$scope.orders = [];
	$scope.messageOrders = '';
	$scope.dataLoading = true;

	var thisData = 'email=' + $scope.email;

	$http({
		method: 'POST',
		url: 'page-personal.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded', 'ACCESS-TOKEN': $rootScope.globals.currentUser.authdata}
	})
	.success(function(data){
		if(data.error){
			$log.info(data.message);
		} else{
			if(data.status === 401){
				AuthenticationService.ClearCredentials();
				alert('Faça login novamente.');
				$location.path('/login/1');
				return false;
			} else if(data.status == 1){
				$scope.messageOrders = data.message;
			} else {
				$scope.orders = data.response;
			}
		}
		$scope.dataLoading = false;
	})
	.error(function(data, status, headers, config) {
		$scope.dataLoading = false;
		throw new Error('Algo deu errado.');
	});
}]);

app.controller('OrderCtrl',['$scope', '$log', '$rootScope', '$routeParams', '$http', '$location', 'AuthenticationService', function($scope, $log, $rootScope, $routeParams, $http, $location, AuthenticationService) {
	if(!$rootScope.globals.currentUser){
		$location.path('/login/1');
	}
	$scope.readOrder = true;

	$scope.num_order = '';
	$scope.event_name = '';
	$scope.event_date = '';
	$scope.floor = '';
	$scope.sector = '';
	$scope.seat = '';
	$scope.products = [];
	$scope.date = '';
	$scope.hour = '';
	$scope.price = '';
	$scope.discount = '';
	$scope.price_total = '';
	$scope.messageOrder = '';
	$scope.tax_service = '';

	var thisData = 'order=' + $routeParams.id;

	$http({
		method: 'POST',
		url: 'order.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded', 'ACCESS-TOKEN': $rootScope.globals.currentUser.authdata}
	})
	.success(function(data){
		if(data.error){
			$log.info(data.message);
		} else{
			if(data.status === 401){
				AuthenticationService.ClearCredentials();
				alert('Faça login novamente.');
				$location.path('/login/1');
				return false;
			} else if(data.status == 1){
				$scope.messageOrder = data.message;
			} else {
				$scope.num_order = data.response.num_order;
				$scope.event_name = data.response.event_name;
				$scope.event_date = data.response.event_date;
				$scope.floor = data.response.floor;
				$scope.sector = data.response.sector;
				$scope.seat = data.response.seat;
				$scope.date = data.response.date;
				$scope.hour = data.response.hour;
				$scope.products = data.response.products;
				$scope.price = data.response.price;
				$scope.discount = data.response.discount;
				$scope.tip = data.response.tip;
				$scope.tax_service = data.response.tax_service;
				$scope.price_total = data.response.price_total;
			}
		}
	})
	.error(function(data, status, headers, config) {
		throw new Error('Algo deu errado.');
	});
}]);

app.controller('EditDataCtrl',['$scope', '$log','$rootScope', '$http', '$location', 'AuthenticationService', function($scope, $log, $rootScope, $http, $location, AuthenticationService) {
	if(!$rootScope.globals.currentUser){
		$location.path('/login/1');
	}

	$scope.edit_email = $rootScope.globals.currentUser.email;
	$scope.edit_name = $rootScope.globals.currentUser.name;
	$scope.id = $rootScope.globals.currentUser.id;

	$scope.message_edit_data = '';
	$scope.messageClassAlert = '';

	$scope.editData = function(){
		var thisData = 'email=' + $scope.edit_email + '&name=' + $scope.edit_name + '&password=' + $scope.edit_password + '&id=' + $scope.id;
		$scope.dataLoading = true;

		$http({
			method: 'POST',
			url: 'edit-data.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded', 'ACCESS-TOKEN': $rootScope.globals.currentUser.authdata}
		})
		.success(function(data){
			if(data.error){
				$log.info(data.message);
				$scope.dataLoading = false;
			} else{
				if(data.status === 401){
					AuthenticationService.ClearCredentials();
					alert('Faça login novamente.');
					$location.path('/login/1');
					return false;
				} else if(data.status == 1){
					$scope.messageClassAlert = 'msg-alert alert-danger';
				} else{
					$scope.messageClassAlert = 'msg-alert alert-success';
					$scope.edit_password = '';
    			}
    			$scope.message_edit_data = data.message;
				$scope.dataLoading = false;
			}
		})
		.error(function(data, status, headers, config) {
			$scope.dataLoading = false;
			throw new Error('Algo deu errado.');
		});
	};

}]);

app.controller('ChangePasswordCtrl',['$scope', '$log','$rootScope', '$http', '$location', 'AuthenticationService', function($scope, $log, $rootScope, $http, $location, AuthenticationService) {
	if(!$rootScope.globals.currentUser){
		$location.path('/login/1');
	}

	$scope.message_change_password = '';
	$scope.messageClassAlert = '';

	$scope.changePassword = function(){

		if($scope.new_password != $scope.confirm_password){
			alert('A nova senha não confere com a confirmação.');
			return false;
		}

		var thisData = 'old_password=' + $scope.old_password + '&new_password=' + $scope.new_password + '&email=' + $rootScope.globals.currentUser.email;
		$scope.dataLoading = true;

		$http({
			method: 'POST',
			url: 'change-password.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded', 'ACCESS-TOKEN': $rootScope.globals.currentUser.authdata}
		})
		.success(function(data){
			if(data.error){
				$log.info(data.message);
				$scope.dataLoading = false;
			} else{
				if(data.status === 401){
					AuthenticationService.ClearCredentials();
					alert('Faça login novamente.');
					$location.path('/login/1');
					return false;
				} else if(data.status == 1){
					$scope.messageClassAlert = 'msg-alert alert-danger';
				} else{
					$scope.messageClassAlert = 'msg-alert alert-success';
					$scope.old_password = '';
					$scope.new_password = '';
					$scope.confirm_password = '';
    			}
    			$scope.message_change_password = data.message;
				$scope.dataLoading = false;
			}
		})
		.error(function(data, status, headers, config) {
			$scope.dataLoading = false;
			throw new Error('Algo deu errado.');
		});
	};
}]);

app.controller('CheckEmailCtrl',['$scope', '$log', '$rootScope', '$http', '$location', '$routeParams', 'AuthenticationService', function($scope, $log, $rootScope, $http, $location, $routeParams, AuthenticationService) {
	$scope.message_check_email = '';
	$scope.messageClassAlert = '';

	var thisData = 've=' + $routeParams.id;
	$scope.dataLoading = true;

	$http({
		method: 'POST',
		url: 'check-email.php',
		data: thisData,
		headers:{'Content-type': 'application/x-www-form-urlencoded'}
	})
	.success(function(data){
		if(data.error){
			$scope.messageClassAlert = 'msg-alert alert-danger';
			$scope.message_check_email = data.message;
		} else{
			$scope.messageClassAlert = 'msg-alert alert-success';
			$scope.message_check_email = data.message;
			AuthenticationService.SetCredentials(data.response.email, data.response.XSRF, data.response.id, data.response.name);
		}
		$scope.dataLoading = false;
	})
	.error(function(data, status, headers, config) {
		$scope.dataLoading = false;
		throw new Error('Algo deu errado.');
	});
}]);

app.controller('CartCtrl',['$scope', '$log','$rootScope', '$http', '$location', function($scope, $log, $rootScope, $http, $location) {

	var id_event = localStorage.getItem("id_event");
	$scope.id_event = id_event;
	$scope.tax_service = '';
	$scope.tip = '';

	if(id_event){
		$scope.button = "Carregando ...";
		$scope.dataLoading = true;

		var floor = localStorage.getItem("floor");
		var sector = localStorage.getItem("sector");
		var num_products = localStorage.getItem("num_products");
		var seat = localStorage.getItem("seat");
		var room = localStorage.getItem("room");
		var table = localStorage.getItem("table");
		var products = JSON.parse(localStorage.getItem("products"));
		var string_products = '';

		if(products){
			for (var i = 0; i < products.length; i++) {
				string_products += "&id_product_" + i + "=" + products[i]['id'] + "&qtd_product_" + i + "=" + products[i]['quantity'];
			}
		}

		var thisData = 'id_event=' + id_event + '&floor=' + floor + '&sector=' + sector;
		thisData += '&num_products=' + num_products + '&seat=' + seat + '&room=' + room + '&table=' + table;
		thisData += string_products;

		$http({
			method: 'POST',
			url: 'cart.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$log.info(data.message);
				$scope.dataLoading = false;
			} else{
				if(data.status == 1){

					localStorage.removeItem("coupon");
					localStorage.removeItem("floor");
					localStorage.removeItem("id_event");
					localStorage.removeItem("num_products");
					localStorage.removeItem("products");
					localStorage.removeItem("seat");
					localStorage.removeItem("sector");
					localStorage.removeItem("tip");
					delete $rootScope.checkout;
					delete $scope.id_event;

					$scope.message = "Não existe nenhum produto em seu carrinho.";

					$scope.button = "Faça o seu pedido";
					$scope.action_button = '/event';

				} else{
					$scope.event_name = data.response.event_name;
					$scope.event_date = data.response.event_date;
					$scope.button = "Informe a localização da sua cadeira";
					$scope.action_button = '/location/'+id_event+'/'+data.response.event_name+'/'+data.response.date;

					if(data.response.seat != "null"){
						$scope.floor = data.response.floor;
						$scope.sector = data.response.sector;
						$scope.seat = data.response.seat;

						$scope.button = "Informe os produtos que deseja";
						$scope.action_button = '/product';
					}

					if(data.response.products.length > 0){
						$scope.products = data.response.products;

						$scope.button = "Faça o pagamento";
						$scope.action_button = '/checkout';
					}

					if(data.response.total){
						var tip = localStorage.getItem("tip");
						$scope.tip = Number(tip).toFixed(2);

						var tax_service = data.response.tax_service * data.response.subtotal;
						var total = Number(data.response.subtotal) + tax_service + Number($scope.tip);
						$scope.subtotal = data.response.subtotal;
						$scope.tax_service = tax_service.toFixed(2);
						$scope.total = total.toFixed(2);

						$scope.button = "Finalizar o pedido";
						$scope.action_button = '/checkout';
					}
    			}
				$scope.dataLoading = false;
			}
		})
		.error(function(data, status, headers, config) {
			$scope.dataLoading = false;
			throw new Error('Algo deu errado.');
		});
	} else{
		localStorage.removeItem("coupon");
		localStorage.removeItem("floor");
		localStorage.removeItem("id_event");
		localStorage.removeItem("num_products");
		localStorage.removeItem("products");
		localStorage.removeItem("seat");
		localStorage.removeItem("sector");
		localStorage.removeItem("tip");

		delete $rootScope.checkout;
		$scope.message = "Não existe nenhum produto em seu carrinho.";

		$scope.button = "Faça o seu pedido";
		$scope.action_button = '/event';
	}

	$scope.clearCart = function(){
		localStorage.removeItem("coupon");
		localStorage.removeItem("floor");
		localStorage.removeItem("id_event");
		localStorage.removeItem("num_products");
		localStorage.removeItem("products");
		localStorage.removeItem("seat");
		localStorage.removeItem("sector");
		localStorage.removeItem("tip");

		delete $rootScope.checkout;
		$scope.message = "Não existe nenhum produto em seu carrinho.";
		$scope.id_event = "";

		$scope.button = "Faça o seu pedido";
		$scope.action_button = '/event';
	}

}]);

app.controller('HeaderCtrl', ['$scope', '$rootScope', '$log', '$cookieStore', '$location', 'AuthenticationService', function($scope, $rootScope, $log, $cookieStore, $location, AuthenticationService) {

	$scope.usuario = {};

	$scope.entrar = function (){
		//$scope.usuario = {
		//		nome:'Lucas',
		//		email: 'lucashen@gmail.com',
		//		id: 21
		//};
	};

	$scope.isUsuarioLogado = function (){
		$rootScope.globals = $cookieStore.get('globals') || {};

		if(Object.keys($rootScope.globals).length !== 0){
			if ($rootScope.globals.currentUser.id != 1) {
				return true;
			} else{
				return false;
			}
		} else{
			return false;
		}
	};

	$scope.logout = function (){
		AuthenticationService.ClearCredentials();
		$location.path('/login/1');
	};

}]);

app.controller('FooterCtrl', ['$scope', '$http', '$log', '$location', function($scope, $http, $log, $location) {

	$scope.signNewsletter = function(){
		var thisData = 'email=' + $scope.email;

		$http({
			method: 'POST',
			url: 'newsletter.php',
			data: thisData,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data){
			if(data.error){
				$log.info(data.message);
			} else{
    			if(data.status == 1){
    				alert(data.message);
    			} else{
    				$scope.email = "";
    				$location.path('/newsletter');
    			}
			}
		})
		.error(function(data, status, headers, config) {
			throw new Error('Algo deu errado.');
		});
	};
}]);
