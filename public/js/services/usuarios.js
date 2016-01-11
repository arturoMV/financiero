angular.module('usuarioCtrl')
.service('UsuariosService', function($http, $q) { 
	var usuarios = [];
	
	usuarios = $q.defer();
	$http.get("/usuarios").then(function(data){
		usuarios.resolve(data);
	});
	
	this.getUsuarios=function(){
		return usuarios.promise;
	};


	this.setUsuarios=function(items){
		usuarios = items;
	};
});