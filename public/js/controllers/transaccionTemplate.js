angular.module("transaccionCtrl",[])
.controller("transaccionTemplate", function($scope, TransaccionService, $http) {
	$scope.modelTra = [];
	var init = function() {
		getAllTransacciones();
	};

	var getAllTransacciones = function() {
		var promise = TransaccionService.getTransacciones();
		promise.then(function(transacciones){
			$scope.modelTra = transacciones.data;
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