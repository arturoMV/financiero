<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Prueba</title>
	<link rel="stylesheet" href="">
	<script type="text/javascript">
	var count = 0;

	function pruebaMouse(){
		var btn = document.getElementById('btn');
		var text = document.getElementById('text');

		text.innerText = "Numero de Clicks = " + count++;

	}
	</script>
</head>
<body>
	<input id="btn" type="button" name="" onclick="pruebaMouse()" value="Cilck me!" placeholder="">

	<div id="text">
		
	</div>
</body>
</html>