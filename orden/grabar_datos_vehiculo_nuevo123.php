<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

//exit();



include('../valotablapc.php');

$sql_grabar_carro = "insert into $tabla4  (placa,marca,tipo,modelo,color,propietario,id_empresa,vencisoat,revision,chasis,motor) 
values (
'".$_POST['placa']."',
'".$_POST['marca']."',
'".$_POST['tipo']."',
'".$_POST['modelo']."',
'".$_POST['color']."',
'".$_POST['idcliente']."',
'300',
'".$_POST['soat']."',
'".$_POST['revision']."',
'".$_POST['chasis']."',
'".$_POST['motor']."'
)

";
//echo '<br>.'$sql_grabar_carro.'<br>';
//exit();
$consulta_grabar_carros = mysql_query($sql_grabar_carro,$conexion);
$_REQUEST['placa123'] = $_POST['placa'];
include('../orden/orden_captura_honda.php');

?>