angular.module('partidaCtrl')
.service('PartidasService', function($http, $q) { 
	var partidas = [];
	
	partidas = $q.defer();
	$http.get("/partidas").then(function(data){
		partidas.resolve(data);
	});

	this.getPartidas=function(){
		return partidas.promise;
	};


	this.setPartidas=function(items){
		partidas = items;
	};
});