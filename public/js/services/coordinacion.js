angular.module('coordinacionCtrl')
.service('CoordinacionService', function($http, $q) { 
	var coordinaciones = [];
	
	coordinaciones = $q.defer();
	$http.get("/coordinaciones").then(function(data){
		coordinaciones.resolve(data);
	});

	this.getCoordinaciones=function(){
		return coordinaciones.promise;
	};


	this.setCoordinaciones=function(items){
		coordinaciones = items;
	};
});