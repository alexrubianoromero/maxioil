<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
<style>
#div_pregute_placa{

	font-size: 25px;

}
</style>
</head>
<body>
	<h2> CREACION ORDEN DE TRABAJO </H2>
<div id="div_total_creacion" align="center">		
	<div id ="div_pregute_placa">
		DIGITE LA PLACA <input type="text"  id="placapan1"  size="4px">
		<button id="consultar_placa">CONTINUAR</button>

	</div>
	<div id="div_muestre_resultados">
	

	</div>	


</div>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   


<script language="JavaScript" type="text/JavaScript">
            
		$(document).ready(function(){
			  	//////////////////	
			  	    $("#consultar_placa").click(function(){
			  	    	//alert('sdfsdfsdf');
			  	    	var data ='placa123=' + $("#placapan1").val();
			  	    		$.post('valide_siexiste_placa.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_resultados").html(a);
								//alert(data);
							});	
			  	    }); //fin de consultar placa  	  	

		 }); //fin de funcion principal			
</script>
