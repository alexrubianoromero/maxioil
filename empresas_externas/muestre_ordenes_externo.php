<?php
session_start();
include('../valotablapc.php');

echo '<pre>';
print_r($_REQUEST);
echo '</pre>';


	$sql_ordenes_placas = "select * from $tabla14 o
	inner join $tabla4 c on (c.placa = o.placa)
	where
	o.id_empresa = '".$_SESSION['id_empresa']."' 
	and c.id_empresa_externa = '".$_SESSION['id_empresa_externa']."' 
	and c.idcarro = '".$_REQUEST['idcarro']."'
	";	
/*
if($_SESSION['nombre_perfil']=='admin')
{
  $sql_ordenes_placas=  "select * from $tabla14 ";
}
*/

$consulta_ordenes = mysql_query($sql_ordenes_placas,$conexion);


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<script src='../js/bootstrap.min.js'></script>
</head>
<body>
<div id="container">
    <table  class="table"  >
     <thead>
     	<tr>
     		<td>ORDEN</td>
     		<td>FECHA</td>
     		<td>PLACA</td>
     	</tr>
     </thead>

     <tbody>

     </tbody>	


    </table>	

</div>

</body>
</html>
