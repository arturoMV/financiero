angular.module("financieroCtrl",[])
.controller("financieroTemplate", function($scope, PartidasService, $http) {
	$scope.model = {};
	var init = function() {
		// PartidasService.setPartidas(PartidasFactory());
		// $scope.model = PartidasService.getPartidas();
		// console.log($scope.model);
		$http.get("/partidas").success(function(data){
			$scope.model = data;
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
		console.log($scope.myOrder)
	};
	init();
});