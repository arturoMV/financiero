'use strict';

angular.module('financieroCtrl')
.factory('PartidasFactory', function($http) {
	//this.getPartidasFactory = function() {
		$http.get("/partidas").success(function(data){
			return data;
		});
	//};
});