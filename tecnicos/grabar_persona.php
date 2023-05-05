<?php
session_start();
include('../valotablapc.php');

$sql_grabar_persona  = "insert into $tabla21 (identi,nombre,telefono,direccion,id_empresa,porcentaje_nomina)   
values('".$_POST['cedula']."','".$_POST['nombre']."','".$_POST['telefono']."','".$_POST['direccion']."','".$_SESSION['id_empresa']."','".$_POST['porcentaje']."')"; 
$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);

echo 'TECNICO GRABADO';

include('../colocar_links2.php');

?>