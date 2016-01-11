angular.module('transaccionCtrl')
.service('TransaccionService', function($http, $q) { 
	var transacciones = [];
	
	transacciones = $q.defer();
	$http.get("/financiero/public/transaccionesReporte").then(function(data){
		transacciones.resolve(data);
	});

	this.getTransacciones=function(){
		return transacciones.promise;
	};

	this.setTransacciones=function(items){
		transacciones = items;
	};
});