<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
</style>
</head>
<body>

<div id="nueva_anotacion">
	<h2>ANOTACION DE INVENTARIO</h2>
	<BR>

	<table border = "1">
		<tr>
            <td>FECHA</td>
            <td><input type="date"  id="fecha"></td>
		</tr>
		<tr>
            <td>NOMBRE PIEZA</td>
            <td><input type="text"  id="nombre_pieza"></td>
		</tr>
		<tr>
            <td>CANTIDAD</td>
            <td><input type="text"  id="cantidad"></td>
		</tr>
	</table>
	<br>
	<button id ="btn_grabar">GRABAR ANOTACION</button>	
</div>	

</body>
</html>


<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
					
					/////////////////////////
			$("#btn_grabar").click(function(){
							var data =  'fecha=' + $("#fecha").val();
							data += '&nombre_pieza=' + $("#nombre_pieza").val();
							data += '&cantidad=' + $("#cantidad").val();
							
							$.post('grabar_anotacion_inventario.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre_cxc").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
	
</script>

  
