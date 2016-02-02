angular.module("coordinacionCtrl",[])
.controller("coordinacionTemplate", function($scope, CoordinacionService, $http) {
	$scope.modelC = [];

	$scope.maximo = [{max:0}];
	
	var init = function() {
		getAllCoordinaciones();
	};

	var getAllCoordinaciones = function() {
		var promise = CoordinacionService.getCoordinaciones();
		promise.then(function(coordinaciones){
			$scope.modelC = coordinaciones.data;
		});
	};
	$scope.orderTable = function(order) {
		if (!$scope.myOrder) {
			$scope.myOrder = order;
		} else if ($scope.myOrder === order) {
			$scope.myOrder = "-"+order;
		} else {
			$scope.myOrder = order;
		}
	};
	init();
});