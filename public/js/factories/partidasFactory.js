'use strict';

angular.module('financieroCtrl')
.factory('PartidasFactory', function($http) {
	var obj = [];
	$http.get("/partidas").success(function(data){
		obj = data;
	});
    return obj; 
});