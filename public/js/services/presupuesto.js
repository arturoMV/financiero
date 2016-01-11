angular.module('presupuestoCtrl')
.service('PresupuestoService', function($http, $q) { 
	var presupuestos = [];
	
	presupuestos = $q.defer();
	$http.get("/presupuestos").then(function(data){
		presupuestos.resolve(data);
	});

	this.getPresupuestos=function(){
		return presupuestos.promise;
	};

	this.setPresupuestos=function(items){
		presupuestos = items;
	};
});