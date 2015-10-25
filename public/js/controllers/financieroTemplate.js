angular.module("financieroCtrl",[])
.controller("financieroTemplate", function($scope, PartidasService, $http, PartidasFactory) {
	$scope.model = [];
	var init = function() {
		getAllPartidas();
	};

	var getAllPartidas = function() {
		var promise = PartidasService.getPartidas();
		promise.then(function(data){
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