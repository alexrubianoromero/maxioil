<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_POST);
echo '<pre>';
*/

$sql_grabar_persona  = "insert into $tabla16 (nombre,login,id_perfil,clave,idempresa,activo)  
 values(
 	'".$_POST['nombre']."'
 	,'".$_POST['login']."'
 	,'".$_POST['id_perfil']."'
	,'1234'
	,'".$_SESSION['id_empresa']."'
	,'1'
 
 	)"; 
$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);

//echo '<br>'.$sql_grabar_persona.'<br>';

echo '<H3>GRABACION EXITOSA</H3>';

include('../colocar_links2.php');

?>