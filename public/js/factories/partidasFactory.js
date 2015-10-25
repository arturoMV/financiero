'use strict';
angular.module('financieroCtrl')
.factory('PartidasFactory', function($http) {
	this.getPartidasFactory = function() {
		$http.get("/partida").success(function(data){
			return data;
		});
	};

});