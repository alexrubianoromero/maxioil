<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura </title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="../jquery-ui-1.12.1_ui_lightness/jquery-ui.css" rel = "stylesheet">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../jquery-ui-1.12.1_ui_lightness/jquery-ui.js"></script>

<style>
</style>
</head>
<body>
<h3>DIGITE LAS FECHAS DEL INFORME DE VENTAS </h3>
<div id="div_informe_total">

<div id="div_fechas">
	
	<label for="fechain" >FECHA INICIAL </label>
	<input type="date"   id="fechain"  >
	<label for="fechafin" >FECHA FINAL </label>
	<input type="date"   id="fechafin"  >

	<button id="btn_consultar">CONSULTAR</button>

</div>

<div id="muestre_informe">

</div>

</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script type="text/javascript">
 $(document).ready(function(){
	  $("#btn_consultar").click(function(){
							var data =  'fechain=' + $("#fechain").val();
							data += '&fechafin=' + $("#fechafin").val();
							
							$.post('informe_ventas_por_fecha.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre_informe").html(a);
								//alert(data);
							});	
						 });
	  	
  });//fin de la funcion principal 

</script>   
