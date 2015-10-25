angular.module("starter",['finansieroCtrl'])
.controller("mainCtrl", function($scope, $http, PartidasFactory) {
	var init = function() {
		alert()
		PartidasFactory.getPartidasFromServer();
	};
	init();
});