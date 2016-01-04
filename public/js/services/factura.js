 angular.module('facturaCtrl', [])
    .controller('facturaTemplate', ['$scope', function($scope) {
        $scope.factura = [{detalle: '', monto: '', maximo:0, partida:''}];

    	$scope.agregarFila = function (){
      		$scope.factura.push({ detalle: '', monto:''})
      	};

		$scope.eliminarFila = function(index){
		    $scope.factura.splice(index,1);
		};

		$scope.calcularFactura = function(){
			var tfactura = 0;
			angular.forEach($scope.factura, function(value, key) {
  				tfactura += value.monto;
			});
			return tfactura;
		};
		    
    }]);