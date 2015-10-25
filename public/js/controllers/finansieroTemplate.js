angular.module("finansieroCtrl",[])
.controller("finansieroTemplate", function($scope, PartidasFactory, PartidasService) {
	var init = function() {
		alert()
		PartidasService.setPartidas(PartidasFactory());
	};
	init();
});