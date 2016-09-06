
var app = angular.module('Snack4me', ['ngRoute', 'ngSanitize', 'ngCookies', 'ngAnimate', 'ngFacebook', 'directive.g+signin']);
	
app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
	$routeProvider
		.when('/', {
			templateUrl: 'view/home.html',
			requireLogin: false
		})
		.when('/index', {
			templateUrl: 'view/home.html',
			requireLogin: false
		})
		.when('/event', {
			templateUrl: 'view/event.html',
			controller: 'EventsCtrl',
			requireLogin: false
		})
		.when('/location/:id/:name/:date', {
			templateUrl: 'view/location.html',
			controller: 'LocationCtrl',
			requireLogin: false
		})
		.when('/product', {
			templateUrl: 'view/product.html',
			controller: 'ProductsCtrl',
			requireLogin: false
		})
		.when('/anonymous/:id', {
			template: " ",
			controller: 'AnonymousCtrl',
			requireLogin: false
		})
		.when('/login/:option?', {
			templateUrl: 'view/login.html',
			controller: 'LoginCtrl',
			requireLogin: false
		})
		.when('/forgot-password', {
			templateUrl: 'view/forgot-password.html',
			controller: 'ForgotPasswordCtrl',
			requireLogin: false
		})
		.when('/buy-no-register', {
			templateUrl: 'view/buy-no-register.html',
			controller: 'BuyNoRegisterCtrl',
			requireLogin: false
		})
		.when('/checkout', {
			templateUrl: 'view/checkout.html',
			controller: 'CheckoutCtrl',
			requireLogin: true
		})
		.when('/page-personal', {
			templateUrl: 'view/page-personal.html',
			controller: 'PagePersonalCtrl',
			requireLogin: true
		})
		.when('/order/:id', {
			templateUrl: 'view/order.html',
			controller: 'OrderCtrl',
			requireLogin: true
		})
		.when('/order-success/:id', {
			templateUrl: 'view/order-success.html',
			controller: 'OrderSuccessCtrl',
			requireLogin: true
		})
		.when('/read-order/:id', {
			templateUrl: 'view/order.html',
			controller: 'ReadOrderCtrl',
			requireLogin: false
		})
		.when('/edit-data', {
			templateUrl: 'view/edit-data.html',
			controller: 'EditDataCtrl',
			requireLogin: true
		})
		.when('/cart', {
			templateUrl: 'view/cart.html',
			controller: 'CartCtrl',
			requireLogin: false
		})
		.when('/change-password', {
			templateUrl: 'view/change-password.html',
			controller: 'ChangePasswordCtrl',
			requireLogin: true
		})
		.when('/check-email/:id', {
			templateUrl: 'view/check-email.html',
			controller: 'CheckEmailCtrl',
			requireLogin: false
		})
		.when('/newsletter', {
			templateUrl: 'view/newsletter.html',
			requireLogin: false
		})
		.otherwise({
	        redirectTo: '/',
	        requireLogin: false
	    });

}]);

app.config(['$facebookProvider', function($facebookProvider) {
	$facebookProvider.setAppId('1446959648919101').setPermissions(['email']);
}]);

app.run(['$rootScope', '$window', function($rootScope, $window) {
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	$rootScope.$on('fb.load', function() {
		$window.dispatchEvent(new Event('fb.load'));
	});
}]);
	
app.run(['$rootScope', '$location', '$cookieStore', '$http', function ($rootScope, $location, $cookieStore, $http) {
	
	$rootScope.globals = $cookieStore.get('globals') || {};
	
	if($rootScope.globals){
		if ($rootScope.globals.currentUser) {
			$http.defaults.headers.common['ACCESS_TOKEN'] = $rootScope.globals.currentUser.authdata;
		}
	} else{
		$rootScope.globals.currentUser = {};
	}
	
	$rootScope.$on('$routeChangeStart', function (event, next, current) {
		
    	if(next.requireLogin) {
    		
    		if ($location.path() !== '/login' && !$rootScope.globals.currentUser) {
    			$location.path('/login');
            }
    	}
    });
}]);

app.filter('slice', function() {
	return function(arr, start, end) {
		return (arr || []).slice(start, end);
	};
});

app.filter('dateBr', function () {
	return function (data) {
		for(var i = 0; i < data.length; i++){
			data = data.replace("-", "/");
		}
		return data;
    };
 });

app.run(function($rootScope, $location, $anchorScroll, $routeParams) {
	$rootScope.$on('$routeChangeSuccess', function(newRoute, oldRoute) {
		$location.hash($routeParams.scrollTo);
		$anchorScroll();  
	});
});

app.directive('ngModelOnblur', function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        priority: 1,
        link: function(scope, elm, attr, ngModelCtrl) {
           
           var update = function () {
              scope.$apply(function () {
                  ngModelCtrl.$setViewValue(elm.val().trim());
                  ngModelCtrl.$render();
              });
          };
          elm.off('input').off('keydown').off('change').on('focus', function () {
              scope.$apply(function () {
                  ngModelCtrl.$setPristine();
              });
          }).on('blur', update).on('keydown', function (e) {
              if (e.keyCode === 13) {
                  update();
              }
          });        
        }
    };
});

app.directive('rodape', function(){
	return{
		restrict: 'E',
		templateUrl: 'view/footer.html',
		controller: 'Snack4meCtrl'
	};
});

app.directive('starRating', function () {
    return {
        restrict: 'A',
        template: '<ul class="rating">' +
            '<li ng-repeat="star in stars" ng-class="star" ng-click="toggle($index)">' +
            '\u2605' +
            '</li>' +
            '</ul>',
        scope: {
            ratingValue: '=',
            max: '=',
            onRatingSelected: '&'
        },
        link: function (scope, elem, attrs) {

            var updateStars = function () {
                scope.stars = [];
                for (var i = 0; i < scope.max; i++) {
                    scope.stars.push({
                        filled: i < scope.ratingValue
                    });
                }
            };

            scope.toggle = function (index) {
                scope.ratingValue = index + 1;
                scope.onRatingSelected({
                    rating: index + 1
                });
            };

            scope.$watch('ratingValue', function (oldVal, newVal) {
                if (newVal) {
                    updateStars();
                }
            });
        }
    }
});