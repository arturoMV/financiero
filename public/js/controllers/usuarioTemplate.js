angular.module('usuarioCtrl',[])
.controller('usuarioTemplate', function($scope, UsuariosService, $http) {
	$scope.modelU = [];
	var init = function() {
		getAllUsuarios();
	};

	var getAllUsuarios = function() {
		var promise = UsuariosService.getUsuarios();
		promise.then(function(usuarios){
			$scope.modelU = usuarios.data;
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