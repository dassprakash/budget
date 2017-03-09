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
monthlyApp.controller('MonthlyReportController', ['$scope','$http', 'httpRequest' , '$window' , function MonthlyReportController($scope, $http, httpRequest, $window) {
	if($('#userid').val())
	{
	var paramObject = {
			action: 'profile'
		};
		httpRequest.httpPostJsonData('requestfiles/request-signin.php', paramObject)
		.then(function(data) {
			$scope.fname = data.profile.first_name;
			$scope.lname = data.profile.last_name;
			$scope.username = data.profile.username;
			$scope.email = data.profile.email;
			
			}, function(statusCode) {
				$scope.error = statusCode;
		});
	}
	
	
	$scope.signin=true;
	$scope.forget=true;
	$scope.signup=false;
	$scope.forgetpass = function(){
		$scope.forget=false;	
	}
	$scope.loginreg = function(value){
		if(value == 'signup'){
			$scope.signup=true;
			$scope.signin=false;
		}else{
			$scope.signup=false;
			$scope.signin=true;
		}
	}
	$scope.login = function(uname,password) {
	if((uname==''||uname== undefined) || (password==''||password== undefined))
	{
		$scope.errormsg='Please provide Correct information';
		$('#errormsg').show();
		setTimeout(function() {
				$('#errormsg').hide();
		}, 3000);
	}else{
		var paramObject = {
				action: 'login',
				uname:uname,
				password:password
			};
			console.log(paramObject);
			httpRequest.httpPostJsonData('requestfiles/request-signin.php', paramObject)
			.then(function(data) {
				if(data.sucess)
				{
					$window.location.href="http://dassprakash.com/budjet/dashboard.php";
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
	$scope.register = function() {
	console.log($scope.email);
		if(($scope.fname==''||$scope.fname== undefined) || ($scope.lname==''||$scope.lname== undefined) || ($scope.username==''||$scope.username== undefined) || ($scope.email==''||$scope.email== undefined) || ($scope.password==''||$scope.password== undefined))
		{
			$scope.errormsg='Please provide Correct information';
			$('#errormsg').show();
			setTimeout(function() {
					$('#errormsg').hide();
			}, 3000);
		}else{
			if($scope.password == $scope.cpassword)
			{
				var paramObject = {
					action: 'register',
					fname:$scope.fname,
					lname:$scope.lname,
					username:$scope.username,
					email:$scope.email,
					password:$scope.password
				};
				httpRequest.httpPostJsonData('requestfiles/request-signin.php', paramObject)
				.then(function(data) {
					if(data.sucess)
					{
						$scope.sucessmsg=data.sucess;
						$('#sucessmsg').show();
						setTimeout(function() {
								$('#sucessmsg').hide();
								$window.location.href="http://dassprakash.com/budjet/index.php";
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
			else{
				$scope.errormsg='Miss-match confirm password';
				$('#errormsg').show();
				setTimeout(function() {
						$('#errormsg').hide();
				}, 3000);
			}
		}
	}
	$scope.updateprofile = function() {
	console.log($scope.oldpassword);
		if($scope.oldpassword == '' || $scope.oldpassword == undefined)
		{
			$scope.errormsg='Enter Your Old Password';
 	  }
		else if($scope.password != $scope.cpassword)
		{
			$scope.errormsg='password and confirm password not match';
		}else{
			$scope.errormsg='';
		}
		if(!$scope.errormsg){
			var paramObject = {
				action: 'updateprofile',
				fname:$scope.fname,
				lname:$scope.lname,
				username:$scope.username,
				email:$scope.email,
				password:$scope.password,
				oldpassword:$scope.oldpassword
			};
			httpRequest.httpPostJsonData('requestfiles/request-signin.php', paramObject)
			.then(function(data) {
				if(data.sucess)
				{
					$scope.sucessmsg=data.sucess;
					$('#sucessmsg').show();
					setTimeout(function() {
							$('#sucessmsg').hide();
							$window.location.href="http://dassprakash.com/budjet/profile.php";
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
		}else{
			$('#errormsg').show();
			setTimeout(function() {
					$('#errormsg').hide();
			}, 3000);
		}
	}
}]);