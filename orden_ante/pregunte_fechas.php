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
<?php 

include("../empresa.php");
include('../valotablapc.php');  
include('../funciones.php'); 

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);
 ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
<section>
<article>
<br>

 <div id = "datos">
CONSULTA DE ORDENES POR RAGO DE FECHAS 
<form name = "fechas"  method ="post"  action = "./muestre_orden_rango_fechas.php" >
 <table width="95%" border="1">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>FECHA INICIAL AAAA-MM-DD </td>
    <td><label>
      <input type="text" name="fechain"  id = "fechain"  >
    </label></td>
  </tr>
  <tr>
    <td>FECHA FINAL AAAA-MM-DD </td>
    <td><label>
      <input type="text" name="fechafin"  id = "fechafin"  >
    </label></td>
  <tr>
  	  <tr>
    <td><label for ="aexcel">ENVIAR A EXCEL</label> </td>
    <td><label>
      <input type="checkbox" name="aexcel"  id = "aexcel"  value = '1' >
    </label></td>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> <input type = "submit"  value ="consultar">
    	<!--
    	 <button type ="button"  id = "consultar_caja" ><h4>CONSULTAR ORDENES</h4></button>
        -->
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
  </div>   
</article>
</section>
</Div>
			<?php
echo '<br><br><br><br><br><br>';
//include('../colocar_links2.php');
?>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 


<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
					
					/////////////////////////
					$("#consultar_caja").click(function(){
							var data =  'fechain=' + $("#fechain").val();
							data += '&fechafin=' + $("#fechafin").val();
							$.post('muestre_orden_rago_fechas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#datos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

