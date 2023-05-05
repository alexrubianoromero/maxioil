<?php
session_start();

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/


include('../valotablapc.php');

$sql_grabar_cliente = "insert into $tabla3  (identi,nombre,direccion,telefono,email,id_empresa,fecha_cumpleanos) 
values (
'".$_POST['identi']."',
'".$_POST['nombre']."',
'".$_POST['direccion']."',
'".$_POST['telefono']."',
'".$_POST['email']."',
'300',
'".$_POST['fecha_cumpleanos']."'

)

";
$consulta_grabar = mysql_query($sql_grabar_cliente,$conexion);
////////////////buscar el ultimo id de clientes ese es el que se acabao de grabar
$sql_max_idcliente = "select max(idcliente) as idcliente from $tabla3 ";
$consulta_idcliente = mysql_query($sql_max_idcliente,$conexion); 
$arreglo_cliente = mysql_fetch_assoc($consulta_idcliente);
$idcliente = $arreglo_cliente['idcliente'];
//echo '<br>'.$arreglo_cliente['idcliente'];
echo '[{
"idcliente":"'.$idcliente.'"
}]';
?>