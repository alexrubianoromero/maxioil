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
<? include("../empresa.php"); 
include("../valotablapc.php"); 

$sql_pefiles = "select * from $tabla30 where id_empresa = '".$_SESSION['id_empresa']."' order by id_perfil";
$consulta_perfiles = mysql_query($sql_pefiles,$conexion);
//echo '<br>'.$sql_pefiles;
?>
<br>
<br>	
<h3>INGRESO</h3>
<div id = "datos">
<table width="50%" border="1">
  <tr>
    <td>NOMBRE</td>
    <td><input type="text" name="nombre"  id = "nombre"></td>
  </tr>
  <tr>
    <td>lOGIN</td>
    <td><input type="text" name="login"  id = "login"></td>
  </tr>

  <tr>
    <td>PERFIL</td>
    <td>
	<select id="id_perfil" name = "id_perfil">
     <option value = "">...</option>

	<?php
		while($perfil = mysql_fetch_assoc($consulta_perfiles))
	{
			
			echo '<option value = "'.$perfil['id_perfil'].'">'.$perfil['nombre_perfil'].'</option>';
			
	}
	?>
	</select>
	</td>
  </tr>

  <tr>
    <td><button type ="button"  id = "grabar_tecnico" ><h4>GRABAR</h4></button></td>
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
							data += '&login=' + $("#login").val();
							data += '&id_perfil=' + $("#id_perfil").val();
							$.post('grabar_persona.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#datos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

  
