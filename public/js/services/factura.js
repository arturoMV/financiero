 angular.module('facturaCtrl', [])
    .controller('facturaTemplate', ['$scope', function($scope) {
        $scope.factura = [{ detalle: '', precio: 0, cantidad: 0, total: 0}];

    	$scope.agregarFila = function (){
      		$scope.factura.push({ detalle: '', precio: 0, cantidad: 0, total: 0})
      	};

		$scope.eliminarFila = function(index){
		    $scope.factura.splice(index,1);
		};

		$scope.calcularFactura = function(){
			var tfactura = 0;
			angular.forEach($scope.factura, function(value, key) {
  				tfactura += value.total; 
			});
			return tfactura;
		};
		    
    }]);