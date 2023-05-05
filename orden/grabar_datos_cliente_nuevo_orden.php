<?php
session_start();

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/


include('../valotablapc.php');

$sql_grabar_cliente = "insert into $tabla3  (identi,nombre,direccion,telefono,email,id_empresa) 
values (
'".$_POST['identi']."',
'".$_POST['nombre']."',
'".$_POST['direccion']."',
'".$_POST['telefono']."',
'".$_POST['email']."',
'300'
)

";
$consulta_grabar = mysql_query($sql_grabar_cliente,$conexion);

//obtener el id del cliente 
$sql_max_cliente = "select max(idcliente) as idcliente from $tabla3   ";
$consulta_max = mysql_query($sql_max_cliente,$conexion);
$arr_max = mysql_fetch_assoc($consulta_max); 


$_REQUEST['id_cliente'] = $arr_max['idcliente'];

include('../orden/pregunte_informacion_moto.php');

?>