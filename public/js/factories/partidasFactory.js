'use strict';
angular.module('finansieroCtrl')
.factory('PartidasFactory', function(PartidasService, $http) {
	$http.get("/partida").success(function(data){
		console.log(data)
		return data;
	});
});