<?php
session_start();
include('../valotablapc.php');

$sql_modificar = "update $tabla4 
set id_empresa_externa = '".$_REQUEST['id_empresa_externa']."' 
 

 where idcarro = '".$_REQUEST['idcarro']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 


echo 'MODIFICADO OK';



?>