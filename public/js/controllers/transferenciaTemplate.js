angular.module("transferenciaCtrl",[])
.controller("transferenciaTemplate", function($scope, TransferenciaService, $http) {
	$scope.modelT = [];
	var init = function() {
		getAllTransferencias();
	};

	var getAllTransferencias = function() {
		var promise = TransferenciaService.getTransferencias();
		promise.then(function(transferencias){
			$scope.modelT = transferencias.data;
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