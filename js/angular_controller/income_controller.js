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
monthlyApp.controller('incomeController', ['$scope','$http', 'httpRequest' , '$window' , function MonthlyReportController($scope, $http, httpRequest, $window) {
	var paramObject = {
			action: 'listincome'
		};
		console.log(paramObject);
		httpRequest.httpPostJsonData('requestfiles/request-list.php', paramObject)
		.then(function(data) {
			$scope.inlist=data.list;
			$scope.incatlist=data.incomecatlist;
			$scope.account=data.account;
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	
	$scope.deletemodel = function(value) {
		$scope.delid= value;
	}
	$scope.deleteitem = function(value) {
		var paramObject = {
			action: 'deleteincome',
			incomeid:value,			
		};
		console.log(paramObject);
		httpRequest.httpPostJsonData('requestfiles/request-list.php', paramObject)
		.then(function(data) {
			$scope.inlist=data.list;
			$('#DeleteIncome').modal('hide');
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	}
	$scope.editmodel = function(name,amount,catid,accid,date,desc,acname,AssetsId) {
		console.log(name,amount,catid,accid,date,desc);
		$scope.inname=name;
		$scope.iamount=amount;
		$scope.incat=catid;
		$scope.selectedaccount={AccountId: accid, AccountName: acname};
		$scope.indate=date;
		$scope.indescrption=desc;
		$scope.AssetsId=AssetsId;
	}
	$scope.editincome = function() {
		var paramObject = {
				action: 'updateIncome',
				name:$scope.inname,
				amount:$scope.iamount,
				excat:$scope.incat,
				account:$scope.selectedaccount.AccountId,
				date:$scope.indate,
				description:$scope.indescrption,
				AssetsId:$scope.AssetsId,
			};
		console.log(paramObject);
		httpRequest.httpPostJsonData('requestfiles/request-list.php', paramObject)
		.then(function(data) {
			$scope.inlist=data.list;
			$('#EditIncome').modal('hide');
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	}
	
}]);
$('#income .input-group.date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true
        });