angular.module('finansieroCtrl')
.service('PartidasService', function() { 
	var partidas = {};
	/**
	 * function to get current full task object
	 * @return {[type]} [description]
	 */
	this.getPartidas=function(){
		return partidas;
	};
	this.setPartidas=function(items){
		partidas = items;
	};

});