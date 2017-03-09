(function() {

    angular.module("monthlyApp")

    .factory("httpRequest", function($http, $q) {

        /**
         * This function will send the ajax request server to get the surveyLists json object
         **/
        var httpPromise = function(url, params) {
            var deferred = $q.defer();

            $http({
                method: "GET",
                url: url + "?" + params
            }).
            success(function(data, status, headers, config) {
                deferred.resolve(data);
            }).
            error(function(data, status, headers, config) {
                deferred.reject(status)
            });

            return deferred.promise;
        };

        var httpPostJsonData = function(url, data) {
            var deferred = $q.defer();

            $http({
                method: "POST",
                url: url,
                data: data,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            }).
            success(function(data, status, headers, config) {
                deferred.resolve(data);
            }).
            error(function(data, status, headers, config) {
                deferred.reject(status)
            });

            return deferred.promise;
        };

        return {
            httpPromise: httpPromise,
            httpPostJsonData: httpPostJsonData
        }
    })

    .factory('sessionService', function() {

        var login = function() {};

        return {
            login: login
        };
    })

    .factory('loadingService', function() {

        var loading = true;

        var setLoadingTrue = function() {
            loading = true;
        };

        var setLoadingFalse = function() {
            loading = false;
        };

        var getLoading = function() {
            return loading;
        };

        return {
            setLoadingTrue: setLoadingTrue,
            setLoadingFalse: setLoadingFalse,
            getLoading: getLoading
        };
    })

    .factory('postLoadingService', function() {

        var loading = true;

        var setPostLoadingTrue = function() {
            loading = true;
        };

        var setPostLoadingFalse = function() {
            loading = false;
        };

        var getPostLoading = function() {
            return loading;
        };

        return {
            setPostLoadingTrue: setPostLoadingTrue,
            setPostLoadingFalse: setPostLoadingFalse,
            getPostLoading: getPostLoading
        };
    })

    .factory('MyHttpInterceptor', ['$q', '$injector', 'mistryMessagerBox',
        function($q, $injector, mistryMessagerBox) {
            return {
                // On request success
                request: function(config) {

                    // Contains the data about the request before it is sent.
                    if (config.url.indexOf("?") != -1) {
                        var params = config.url.split("?")[1];

                        // console.log('GET Request', config);

                        if (params) {
                            var loading = $injector.get('loadingService');
                            loading.setLoadingTrue();
                        }
                    }

                    if (config.method == "POST") {
                        // console.log('POST Request', config);
                        var postLoading = $injector.get('postLoadingService');
                        postLoading.setPostLoadingTrue();
                    }

                    // Return the config or wrap it in a promise if blank.
                    return config || $q.when(config);
                },

                // On request failure
                requestError: function(rejection) {
                    // Contains the data about the error on the request.

                    // Return the promise rejection.
                    return $q.reject(rejection);
                },

                // On response success
                response: function(response) {
                    // Contains the data from the response.

                    if (response.config.url.indexOf("?") != -1) {
                        var params = response.config.url.split("?")[1];

                        // console.log('GET Response', response);

                        if (params) {
                            var loading = $injector.get('loadingService');
                            loading.setLoadingFalse();
                        }
                    }

                    if (response.config.method == "POST") {
                        // console.log('POST Response', response);
                        var postLoading = $injector.get('postLoadingService');
                        postLoading.setPostLoadingFalse();
                    }

                    if (response.data.error) {
                        if ($.trim(response.data.error) === 'Collector owner error.') {
                            mistryMessagerBox.prepForBroadcast(response.data.error, 'error');
                            setTimeout(function() {
                                window.location.href = LINK_PL + 'my-survey';
                            }, 2000);

                        }
                        if ($.trim(response.data.error) === 'Survey owner error.') {
                            mistryMessagerBox.prepForBroadcast(response.data.error, 'error');
                            setTimeout(function() {
                                window.location.href = LINK_PL + 'my-survey';
                            }, 2000);
                        }
                    }
                    // Return the response or promise.
                    return response || $q.when(response);
                },

                // On response failture
                responseError: function(rejection) {
                    // Contains the data about the error.

                    // Session has expired
                    switch (rejection.status) {
                        case 419:
                            var sessionService = $injector.get('sessionService');
                            var $http = $injector.get('$http');
                            var deferred = $q.defer();
                            window.location.href = LINK_PL + 'signin?url=' + window.location.href;
                            // Create a new session (recover the session)
                            // We use login method that logs the user in using the current credentials and
                            // returns a promise
                            sessionService.login().then(deferred.resolve, deferred.reject);

                            // When the session recovered, make the same backend call again and chain the request
                            return deferred.promise.then(function() {
                                return $http(rejection.config);
                            });

                        case 401:
                            break;

                        default:
                            break;
                    }

                    // Return the promise rejection.
                    return $q.reject(rejection);
                }
            };
        }
    ]);

}());