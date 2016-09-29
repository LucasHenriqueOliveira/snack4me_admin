(function () {
    'use strict';

    angular
        .module('app')
        .factory('TimezoneService', function ($jstz) {
            var name, now;
            name = jstz.determine().name();
            name = (name === null || name === '' || name === undefined) ? 'America/New_York' : name;
            now = new Date();
            return resolve(name, now);
        });


})();
