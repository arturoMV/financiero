angular.module('transferenciaCtrl')
.service('TransferenciaService', function($http, $q) { 
	var transferencias = [];
	
	transferencias = $q.defer();
	$http.get("/transferencias").then(function(data){
		transferencias.resolve(data);
	});

	this.getTransferencias=function(){
		return transferencias.promise;
	};


	this.setTransferencias=function(items){
		transferencias = items;
	};
});