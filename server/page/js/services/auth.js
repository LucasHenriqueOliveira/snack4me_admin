app.factory('AuthenticationService',['$http', '$cookieStore', '$rootScope',function ($http, $cookieStore, $rootScope) {
    var service = {};
 
    service.Login = function (email, password) {
            return $http({
    			method: 'POST',
			url: 'customer.php',
			data: 'email='+email+'&password='+password,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		});
    };
    
    service.LoginSocial = function (email, name, type) {
	    return $http({
			method: 'POST',
			url: 'customer-social.php',
			data: 'email='+email+'&name='+name+'&type='+type,
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		});
    };
 
    service.SetCredentials = function (email, authdata, id, name) {
 
    	$rootScope.globals = {
            currentUser: {
            	id: id,
            	name: name,
                email: email,
                authdata: authdata
            }
        };
 
        $http.defaults.headers.common['ACCESS_TOKEN'] = authdata;
        $cookieStore.put('globals', $rootScope.globals);
            
    };
 
    service.ClearCredentials = function () {
    	delete $rootScope.globals;
        $cookieStore.remove('globals');
        $http.defaults.headers.common.ACCESS_TOKEN = '';
        
        $http({
			method: 'POST',
			url: 'logout.php',
			headers:{'Content-type': 'application/x-www-form-urlencoded'}
		});
    };
 
    return service;
}]);