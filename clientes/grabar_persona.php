<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/
//control para que no deje grabar mas de una vez un cliente 

$sql_verificar_cliente = "select * from $tabla3 where identi = '".$_REQUEST['cedula']."'
   and nombre = '".$_REQUEST['nombre']."' ";
   //echo '<br>'.$sql_verificar_cliente.'<br>';
$consulta_verificar = mysql_query($sql_verificar_cliente,$conexion);
$filas_verificar = mysql_num_rows($consulta_verificar);

if($filas_verificar < 1 )//osea si no encontro este cliente creado 
{
$sql_grabar_persona  = "insert into $tabla3 (identi,nombre,telefono,direccion,entidad,id_empresa,email,observaci,fecha_cumpleanos)  
 values(
 	'".$_POST['cedula']."'
 	,'".$_POST['nombre']."'
 	,'".$_POST['telefono']."'
 	,'".$_POST['direccion']."'
	,'".$_POST['entidad']."'
 	,'300'
 	,'".$_POST['email']."'
 	,'".$_POST['observaciones']."'
 	,'".$_POST['fecha_cumpleanos']."'
 	

 	)"; 

$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);

//echo '<br>'.$sql_grabar_persona.'<br>';

echo '<H3>GRABACION EXITOSA</H3>';
}//fin de si se puede grabar el cliente 
else {
	echo '<br>este cliente ya esta creado en la base de datos<br> No es posible crearlo nuevamente ';
}
include('../colocar_links2.php');

?>