$( document ).ready(function() {
	insertarFila();
});

function insertarFila(){


	var tabla = document.getElementById('factura');
//tabla.deleteRow(0);
	try{
		var numeroElemento = tabla.childElementCount;


		var row = tabla.insertRow(numeroElemento-1);

		row.innerHTML = ' <td><input type="text" name="" value="" placeholder="Detalle" class="form-control"></td>'+
            '<td><div class="input-group"><div class="input-group-addon">₡</div>'+
            '<input type="number" class="form-control" id="exampleInputAmount" placeholder="Precio"></div></td>'+
            '<td><input type="number" name="" value="0" placeholder="" class="form-control"></td>'+
            '<td><div class="input-group"><div class="input-group-addon">₡</div>'+
              '<input class="form-control" type="text" placeholder="0" readonly></div></td>'+
            '<td><button class="btn btn-danger btn-xs" onclick="eliminarFila(this)">x</button></td>';
		
	
	}catch(err){

	}
}

function eliminarFila(elemento){
	var fila = elemento.parentNode.parentNode;
	document.getElementById("factura").deleteRow(fila.rowIndex-1);
	console.log(fila);	
}

function calcularMonto(elemento){
	var fila = elemento.parentNode;

	//var prueba = document.getElementById('prueba');

	var columnas = fila.childNodes;
	var txt = "";
	var precio = 0;
	var cantidad = 0;
	
	precio = Number(columnas[3].innerText);
	cantidad = Number(columnas[5].innerText);
	var resultado = precio * cantidad;

	if (isNaN(cantidad)){
		alert('error en la cantidad');
	}
	columnas[7].innerText = '₡'+resultado;
	calcularTotal(elemento);
}


function calcularTotal(elemento){
	var factura = document.getElementById('factura');

}

