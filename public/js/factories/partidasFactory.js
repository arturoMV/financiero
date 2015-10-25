'use strict';
angular.module('finansieroCtrl')
.factory('PartidasFactory', function(PartidasService, $http) {
	$http.get("/partidas").success(function(data){
		console.log(data)
		return data;
	});
});