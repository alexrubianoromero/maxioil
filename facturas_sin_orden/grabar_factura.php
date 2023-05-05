<?php
session_start();
include('../valotablapc.php');
/*
echo 'grabar_factuera';

echo '<pre>';
print_r($_POST);
echo '<pre>';
*/


$sql_sumas_items = "select sum(total_item) as subtotal, sum(total_item_con_iva) as total  from $tabla100   where no_factura = '".$_POST['id_factura']."'";
//echo $sql_sumas_items.'<br>';

$consulta_sumas = mysql_query($sql_sumas_items,$conexion);
$arreglo_sumas = mysql_fetch_assoc($consulta_sumas);
/*
echo '<pre>';
print_r($arreglo_sumas);
echo '<pre>';
*/
////la fecha de hoy 
$fechapan = date ( "Y/m/j");

$subtotal = $arreglo_sumas['subtotal'];
//$total = $arreglo_sumas['total'];
$total_factura = $arreglo_sumas['total'];
$total = $_REQUEST['efectivo'] +  $_REQUEST['t_debito'] +$_REQUEST['t_credito'];
$valor_iva = $total - $subtotal;

$sql_actualizar_factura = "update $tabla11 set  
modelo = '".$_POST['motor']."'   
, motor = '".$_POST['motor']."' 
, chasis = '".$_POST['chasis']."'
, sumaitems = '".$subtotal."'
, total_factura = '".$total_factura."'
, valor_iva = '".$valor_iva."'
, elaborado_por = '".$_SESSION['id_usuario']."'
, forma_pago = '".$_SESSION['forma_pago']."'
, id_orden = '".$_POST['id_factura']."'
, resolucion = '1'
, id_cliente = '".$_POST['idcliente']."'
where id_factura = '".$_POST['id_factura']."' ";


//echo $sql_actualizar_factura;
$consulta_actualizar_factura = mysql_query($sql_actualizar_factura,$conexion);

//traer toda la informacion de la factura 
$sql_traer_factura = "select * from  $tabla11  where id_factura =  '".$_POST['id_factura']."' ";
$consulta_traer_factura = mysql_query($sql_traer_factura,$conexion);
$arreglo_factura = mysql_fetch_assoc($consulta_traer_factura);
//tambiendebe afectar la caja 
//una opcion que cree automaticamente el recibo de caja de la factura 
//esto seria lo mejor 
//entonces vaya mire cual es el numero actual 
//tomelo
// y sumelo al saldo de  la tabla empresa 
///////////////////////////////////////////////////////

////////////////ahora se debe crear un recibo de caja automatico para esta factura 
////para el recibo debemos traer el nombre del cliente
$sql_traer_nombre_cliente = "select nombre from $tabla3 where idcliente = '".$_POST['idcliente']."' ";
$consulta_nombre = mysql_query($sql_traer_nombre_cliente,$conexion);
$arreglo_nombre = mysql_fetch_assoc($consulta_nombre);
$nombre_cliente = $arreglo_nombre['nombre'];
///se debe traer el numero de recibo actual

$sql_numero_recibo = "select contarecicaja,saldocajamenor  from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_numero_recibo = mysql_query($sql_numero_recibo,$conexion);
$numero_actual = mysql_fetch_assoc($consulta_numero_recibo);
$siguiente_numero = $numero_actual['contarecicaja'] + 1;

$sql_grabar_recibo_de_caja = "insert into $tabla23 
(fecha_recibo,dequienoaquin,porconceptode,lasumade,observaciones,tipo_recibo,numero_recibo,id_empresa,efectivo,t_debito,t_credito) 
values (
'".$fechapan."'
,'".$nombre_cliente."' 
,'".'Factura No '.$arreglo_factura['numero_factura'].' Directa '."'
,'".$total."'
,'RECIBO DE CAJA AUTOMATICO'
,'1'
,'".$siguiente_numero."'
,'".$_SESSION['id_empresa']."'
,'".$_REQUEST['efectivo']."'
,'".$_REQUEST['t_debito']."'
,'".$_REQUEST['t_credito']."'
) ";
$consulta_grabar = mysql_query($sql_grabar_recibo_de_caja,$conexion);
////////////////////////////////////termina la creacion del recibo de caja

//////traer el valor actual del saldo
$sql_traer_saldo_caja = "select saldocajamenor from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_traer_saldo = mysql_query($sql_traer_saldo_caja,$conexion);
$traer_saldo = mysql_fetch_assoc($consulta_traer_saldo);
$saldo_actual_caja = $traer_saldo['saldocajamenor'];
//echo '<br>saldo_actual<br>'.$saldo_actual_caja;
//calcular el valor del nuevo saldo 
 $nuevo_saldo =  $saldo_actual_caja + $total;
//echo '<br>nuevo saldo<br>'.$nuevo_saldo;


/////////actualizar el valor del saldo 
$sql_actualizar_saldo  = "update $tabla10   set saldocajamenor = '".$nuevo_saldo."'     
 where id_empresa = '".$_SESSION['id_empresa']."' ";
 
 //echo '<br>consulta actulizar saldo<br>'.$sql_actualizar_saldo;
$consulta_actualizar = mysql_query($sql_actualizar_saldo,$conexion);
$sql_actulizar_recibo = "update $tabla10 set contarecicaja = '".$siguiente_numero."'  where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_actualizar_recibo = mysql_query($sql_actulizar_recibo,$conexion);

////////////////////crear el movimiento del inventario 


////////////////////////////////////////////////////////


echo "<h2>FACTURA CREADA</h2>";
echo "<a href='factura_imprimir.php?id_factura=".$_POST['id_factura']."'  target='_blank' ><h2>Vista Impresion Factura</h2></a>";
include('../colocar_links2.php');


?>