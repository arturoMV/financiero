angular.module("reservaCtrl",[])
.controller("reservaTemplate", function($scope, ReservaService, $http) {
	$scope.modelRe = [];
	var init = function() {
		getAllReservas();
	};

	var getAllReservas = function() {
		var promise = ReservaService.getReservas();
		promise.then(function(reservas){
			$scope.modelRe = reservas.data;
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