angular.module("partidaCtrl",[])
.controller("partidaTemplate", function($scope, PartidasService, $http) {
	$scope.modelP = [];
	var init = function() {
		getAllPartidas();
	};

	var getAllPartidas = function() {
		var promise = PartidasService.getPartidas();
		promise.then(function(partidas){
			$scope.modelP = partidas.data;
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