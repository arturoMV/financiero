angular.module("financieroCtrl",[])
.controller("financieroTemplate", function($scope, PartidasService, $http) {
	$scope.model = [];
	var init = function() {
		getAllPartidas();
	};

	var getAllPartidas = function() {
		var promise = PartidasService.getPartidas();
		promise.then(function(partidas){
			$scope.model = partidas.data;
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