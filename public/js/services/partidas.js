angular.module('financieroCtrl')
.service('PartidasService', function() { 
	var partidas = [
		{	
			"id":2,
			"idPartida":"Roy",
			"idPresupuesto":"Se la come",
			"estado":"inactivo",
			"saldo":9000,
			"descripcion":"1 veces"
		},
		{	
			"id":2,
			"idPartida":"Arturo",
			"idPresupuesto":"Se la come",
			"estado":"Activo",
			"saldo":1000,
			"descripcion":"2 veces"
		}
	];
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