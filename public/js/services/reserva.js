angular.module('reservaCtrl')
.service('ReservaService', function($http, $q) { 
	var reservas = [];
	
	reservas = $q.defer();
	$http.get("/reservas").then(function(data){
		reservas.resolve(data);
	});

	this.getReservas=function(){
		return reservas.promise;
	};

	this.setReservas=function(items){
		reservas = items;
	};
});