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
monthlyApp.controller('dashboardController', ['$scope','$http', 'httpRequest' , '$window' , function MonthlyReportController($scope, $http, httpRequest, $window) {
	var paramObject = {
			action: 'dashboard'
		};
		console.log(paramObject);
		httpRequest.httpPostJsonData('requestfiles/request-dashboard.php', paramObject)
		.then(function(data) {
		var allIncome=data.allIncome;
		var allexpence=data.allexpence;
			$scope.expence=data.expence;
			$scope.Income=data.income;
			$scope.allexpence=data.allexpence;
			$scope.allIncome=data.allIncome;
			$scope.income_list=data.income_list;
			$scope.expence_list=data.expence_list;
			$scope.budjet_list=data.budjet_list;
			$scope.budjet_total=data.budjet_total;
			$scope.highchartALl($scope.allIncome,$scope.allexpence,$scope.Income,$scope.expence);
		}, function(statusCode) {
				$scope.error = statusCode;
		});
	//console.log($scope.allexpence,allexpence);
	$scope.highchartALl =function(allIncome,allexpence,Income,expence){
	$('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false,
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer'
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            center: [100, null],
            size: 100,
            dataLabels: {
				enabled: true
			},
            showInLegend: true,
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        },
                {
            type: 'pie',
            name: 'Browser share',
            center: [300, null],
            size: 100,
            dataLabels: {
				enabled: true
			},
                    showInLegend: true,
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                {
                    name: 'dass',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['Others',   0.7]
            ]
        }]
    });
		
			Highcharts.chart('incomevsexpense', {
					chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false,
							type: 'pie'
					},
					title: {
							text: 'income vs expense'
					},
					tooltip: {
							pointFormat: '{series.name}: <b>{point.y}</b>'
					},
					plotOptions: {
							pie: {
									allowPointSelect: true,
									cursor: 'pointer',
									dataLabels: {
											enabled: true,
											format: '<b>{point.name} Rs</b>: {point.y} ',
											style: {
													color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
											}
									}
							}
					},
					series: [{
            type: 'pie',
            name: 'Rs',
            center: [100, null],
            size: 100,
            dataLabels: {
							enabled: true
						},
            showInLegend: true,
            data: [
                ['All Income',   allIncome],
                {
                    name: 'All Expence',
                    y: allexpence,
                    sliced: true,
                    selected: true
                }]
								},
                {
            type: 'pie',
            name: 'Rs',
            center: [300, null],
            size: 100,
            dataLabels: {
				enabled: true
			},
                    showInLegend: true,
            data: [
                ['Income',   Income],
                {
                    name: 'expence',
                    y: expence,
                    sliced: true,
                    selected: true
                }
            ]
        }]
			});
	};
	
	
}]);
