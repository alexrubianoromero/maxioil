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
</head>
<body>
<? include("../empresa.php"); ?>
<Div id="contenidos">
	
</Div>	
<h3>INGRESO</h3>
<div id = "datos">
<table width="50%" border="1">
  <tr>
    <td>NOMBRE</td>
    <td><input type="text" name="nombre"  id = "nombre"></td>
  </tr>
  <tr>
    <td>CEDULA</td>
    <td><input type="text" name="cedula"  id = "cedula"></td>
  </tr>
  <tr>
    <td>TELEFONO</td>
    <td><input type="text" name="telefono"  id = "telefono"></td>
  </tr>
  <tr>
    <td>DIRECCION</td>
    <td><input type="text" name="direccion"  id = "direccion"></td>
  </tr>
  
  <tr>
    <td>ENTIDAD</td>
    <td><input type="text" name="entidad"  id = "entidad"></td>
  </tr>
  <tr>
    <td>EMAIL</td>
    <td><input type="email" name="email"  id = "email"></td>
  </tr>
 
<tr>
    <tr>
    <td>FECHA_CUMPLEANOS</td>
    <td><input type="date" name="fecha_cumpleanos"  id = "fecha_cumpleanos"></td>
  </tr>
 
<tr>
    <td>OBSERVACIONES</td>
    <td><input type="text" name="observaciones"  id = "observaciones"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><button type ="button"  id = "grabar_tecnico" ><h4>GRABAR_CLIENTE</h4></button></td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
					
					/////////////////////////
					$("#grabar_tecnico").click(function(){
							var data =  'nombre=' + $("#nombre").val();
							data += '&cedula=' + $("#cedula").val();
							data += '&telefono=' + $("#telefono").val();
							data += '&direccion=' + $("#direccion").val();
							data += '&entidad=' + $("#entidad").val();
							data += '&email=' + $("#email").val();
              data += '&fecha_cumpleanos=' + $("#fecha_cumpleanos").val();
							data += '&observaciones=' + $("#observaciones").val();
							$.post('grabar_persona.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#datos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

  
