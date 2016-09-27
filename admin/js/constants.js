(function () {
    'use strict';

    angular
        .module('app')
        .constant('CONFIG', {
            "url": "http://snack4me.com/hotel/api/"
        })
        .constant('DOCTRINE', {
        "url": "http://snack4me.com/hotel/webapi/public/index.php"
    })

    ;
})();
