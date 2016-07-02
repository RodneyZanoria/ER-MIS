var clientApp = angular.module('clientApp', []);

clientApp.controller('ClientsController', function ($scope, $http) {
$http.get('data/test.json')
.success(function(data, status) {
	$scope.clients = data;
});

});