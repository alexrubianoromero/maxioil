<?php
session_start();
include('../valotablapc.php');
 function  consulta_assoc_orden($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

 $datos_orden =  consulta_assoc_orden($tabla14,'id',$_REQUEST['idorden'],$conexion);
 $datos_carro =  consulta_assoc_orden($tabla4,'placa',$datos_orden['placa'],$conexion);
 $datos_propietario = consulta_assoc_orden($tabla3,'idcliente',$datos_carro['propietario'],$conexion);
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
<meta charset="UTF-8">
<meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<script src='../js/bootstrap.min.js'></script>

</head>
<body>	
<div id="container">
<div class="row">
	<div class="col-md-6 col-xs-6" >
		   <label>FECHA:</label>
		   <?php  echo $datos_orden['fecha'];  ?>
	</div>	
	<div class="col-md-6 col-xs-6" >
		  <label>ORDEN:</label>
		   <?php  echo $datos_orden['orden'];  ?>

	</div>	
</div>	

<div class="row">
	<div class="col-md-6 col-xs-6" >
		   <label>NOMBRE:</label>
		   <?php  echo $datos_propietario['nombre'];  ?>
	</div>	
	<div class="col-md-6 col-xs-6" >
		  <label>PLACA:</label>
		   <?php  echo $datos_carro['placa'];  ?>

	</div>	
</div>	







</div>    <!-- fin de container -->
</body>

</html>
