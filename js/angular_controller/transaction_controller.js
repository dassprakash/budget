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
monthlyApp.controller('transactionController', ['$scope','$http', 'httpRequest' , '$window' , function MonthlyReportController($scope, $http, httpRequest, $window) {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	$scope.date =yyyy+'-'+mm+'-'+dd;
	$scope.indate =yyyy+'-'+mm+'-'+dd;
	var paramObject = {
			action: 'transaction'
		};
		httpRequest.httpPostJsonData('requestfiles/request-transaction.php', paramObject)
		.then(function(data) {
			$scope.selectedOption={AccountId: '1', AccountName: 'Cash' ,UserId: '1'};
			$scope.selectedaccount={AccountId: '1', AccountName: 'Cash' ,UserId: '1'};
			$scope.excatlist=data.excatlist;
			$scope.incatlist=data.incomecatlist;
			console.log($scope.incatlist);
			$scope.account=data.account;
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	
	$scope.addexpence = function(value) {
	if(value == 'ex'){
		if(($scope.name==''||$scope.name== undefined) || ($scope.amount==''||$scope.amount== undefined)|| ($scope.excat==''||$scope.excat== undefined))
		{
			$scope.errormsg='Please Fill all require fiels';
			$('#errormsg').show();
			setTimeout(function() {
					$('#errormsg').hide();
			}, 3000);
		}else{
			var paramObject = {
				action: 'addexpence',
				name:$scope.name,
				amount:$scope.amount,
				excat:$scope.excat,
				account:$scope.selectedOption.AccountId,
				date:$scope.date,
				description:$scope.description,
			};
		}
	}else{
		if(($scope.inname==''||$scope.inname== undefined) || ($scope.iamount==''||$scope.iamount== undefined)|| ($scope.incat==''||$scope.incat== undefined))
		{
			$scope.errormsg='Please Fill all require fiels';
			$('#errormsg').show();
			setTimeout(function() {
					$('#errormsg').hide();
			}, 3000);
		}else{
			var paramObject = {
				action: 'addIncome',
				name:$scope.inname,
				amount:$scope.iamount,
				excat:$scope.incat,
				account:$scope.selectedaccount.AccountId,
				date:$scope.indate,
				description:$scope.indescrption,
			};
		}
	}
	if(paramObject)
	{
		 httpRequest.httpPostJsonData('requestfiles/request-transaction.php', paramObject)
		.then(function(data) {
			
			if(data.sucess)
			{
				$scope.catlist=data.list;
				$scope.sucessmsg=data.sucess;
				$('#sucessmsg').show();
				setTimeout(function() {
						$('#sucessmsg').hide();
				}, 3000);
			}else{
				$scope.errormsg=data.error;
				$('#errormsg').show();
				setTimeout(function() {
						$('#errormsg').hide();
				}, 3000);
			}
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	}
	}
	
}]);