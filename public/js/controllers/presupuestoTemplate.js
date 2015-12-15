angular.module("presupuestoCtrl",[])
.controller("presupuestoTemplate", function($scope, PresupuestoService, $http) {
	$scope.modelPr = [];
	var init = function() {
		getAllPresupuestos();
	};

	var getAllPresupuestos = function() {
		var promise = PresupuestoService.getPresupuestos();
		promise.then(function(presupuestos){
			$scope.modelPr = presupuestos.data;
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