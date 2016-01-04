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
		console.log($scope.modelTra);
		$scope.suma = [];

		for (var i = 0; i < $scope.modelTra.length; i++) {
			if ($scope.modelTra[i].tPartida_idPartida == 3) {
				$scope.suma.push($scope.modelTra[i]); 
				console.log($scope.suma);
			};
		};
	});
	};

	$scope.pija = function(){
		$scope.totalSum = Object.keys($scope.suma).map(function(k){
    		return + $scope.suma[k].iMontoFactura;
			}).reduce(function(a,b){ return a + b },0);
			console.log($scope.totalSum);
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