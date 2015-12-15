// angular.module("facturaCtrl",[])
// .controller("facturaTemplate", function($scope, FacturaService, $http) {
// 	$scope.modelP = [];
// 	var init = function() {
// 		getAllFacturas();
// 	};

// 	var getAllPartidas = function() {
// 		var promise = FacturasService.getPartidas();
// 		promise.then(function(partidas){
// 			$scope.modelP = partidas.data;
// 		});
// 	};
// 	// $scope.orderTable = function(order) {
// 	// 	if (!$scope.myOrder) {
// 	// 		$scope.myOrder = order;
// 	// 	} else if ($scope.myOrder === order) {
// 	// 		$scope.myOrder = "-"+order;
// 	// 	} else {
// 	// 		$scope.myOrder = order;
// 	// 	}
// 	// };
// 	init();
// });