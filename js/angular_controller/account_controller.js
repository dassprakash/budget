// Define the `MonthlyApp` module
var monthlyApp = angular.module('monthlyApp', []);
monthlyApp.factory("httpRequest", function($http, $q) {

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
// Define the `Monthly Report` controller on the `monthlyApp` module
monthlyApp.controller('accountController', ['$scope','$http', 'httpRequest' , '$window' , function MonthlyReportController($scope, $http, httpRequest, $window) {
	var paramObject = {
			action: 'accountlist'
		};
		httpRequest.httpPostJsonData('requestfiles/request-account.php', paramObject)
		.then(function(data) {
			$scope.aclist=data.list;
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	$scope.addcategory = function(cname) {
		if(cname == '' || cname == undefined)
		{
			$scope.error='error';
		}else{
			var paramObject = {
				action: 'addaccount',
				cname:cname,
			};
			console.log(paramObject);
			httpRequest.httpPostJsonData('requestfiles/request-account.php', paramObject)
			.then(function(data) {
				$scope.aclist=data.list;
				$('#new').modal('hide');
			}, function(statusCode) {
					$scope.error = statusCode;
			});
		}
	}
	$scope.deletemodel = function(value,name) {
		$scope.delid= value;
		$scope.catname= name;
	}
	$scope.deleteitem = function(value) {
		var paramObject = {
			action: 'deletecat',
			catid:value,			
		};
		console.log(paramObject);
		httpRequest.httpPostJsonData('requestfiles/request-account.php', paramObject)
		.then(function(data) {
			$scope.aclist=data.list;
			$('#DeleteCat').modal('hide');
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	}
	$scope.editcat = function() {
		var paramObject = {
			action: 'Editcat',
			catid:$scope.delid,			
			catname:$scope.catname,			
		};
		console.log(paramObject);
		httpRequest.httpPostJsonData('requestfiles/request-account.php', paramObject)
		.then(function(data) {
			$scope.aclist=data.list;
			$('#EditCat').modal('hide');
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	}
	
}]);