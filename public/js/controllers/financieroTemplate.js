angular.module("financieroCtrl",[])
.controller("financieroTemplate", function($scope, PartidasService) {
	$scope.model = {};
	var init = function() {
		//PartidasService.setPartidas(PartidasFactory.getPartidasFactory());
		$scope.model = PartidasService.getPartidas();
		console.log($scope.model);
	};
	$scope.orderTable = function(order) {
		if (!$scope.myOrder) {
			$scope.myOrder = order;
		} else if ($scope.myOrder === order) {
			$scope.myOrder = "-"+order;
		} else {
			$scope.myOrder = order;
		}
		console.log($scope.myOrder)
	};
	init();
});