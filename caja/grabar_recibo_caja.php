<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

// verificar que el numero de recibo no este creado 

$total_recibo = $_REQUEST['efectivo'] + $_REQUEST['t_debito'] + $_REQUEST['t_credito'];

$sql_revisar_recibo = "select * from $tabla23  where numero_recibo = '".$_POST['numero_recibo']."' ";
$consuta_verificar= mysql_query($sql_revisar_recibo,$conexion);
$filas_verificar = mysql_num_rows($consuta_verificar);
if($filas_verificar<1)
{	
$sql_grabar_salida = "insert into $tabla23 
(fecha_recibo,dequienoaquin,porconceptode,lasumade,observaciones,tipo_recibo,numero_recibo,id_empresa,
	id_usuario_creacion,id_orden,id_cxp,efectivo,t_debito,t_credito) 
values (
'".$_REQUEST['fecha']."'
,'".$_REQUEST['dequienoaquin']."' 
,'".$_REQUEST['porconceptode']."'
,'".$total_recibo."'
,'".$_REQUEST['observaciones']."'
,'".$_REQUEST['tipo_recibo']."'
,'".$_REQUEST['numero_recibo']."'
,'".$_SESSION['id_empresa']."'
,'".$_SESSION['id_usuario']."'
,'".$_REQUEST['id_orden']."'
,'".$_REQUEST['id_cxp']."'
,'".$_REQUEST['efectivo']."'
,'".$_REQUEST['t_debito']."'
,'".$_REQUEST['t_credito']."'
) ";

//echo '<br>sql grabar<br>'.$sql_grabar_salida;
$consulta_grabar = mysql_query($sql_grabar_salida,$conexion);
//////////////////////////////////
//////////////grabar una trazabilidad del recibo una copia de respaldo automatica para saber que pasa con los recibos 
////
$sql_grabar_salida_traz = "insert into $tabla50 
(fecha_recibo,dequienoaquin,porconceptode,lasumade,observaciones,tipo_recibo,numero_recibo,id_empresa,id_usuario_creacion) 
values (
'".$_REQUEST['fecha']."'
,'".$_REQUEST['dequienoaquin']."' 
,'".$_REQUEST['porconceptode']."'
,'".$total_recibo ."'
,'".$_REQUEST['observaciones']."'
,'".$_REQUEST['tipo_recibo']."'
,'".$_REQUEST['numero_recibo']."'
,'".$_SESSION['id_empresa']."'
,'".$_SESSION['id_usuario']."'
) ";
$consulta_grabar_traz = mysql_query($sql_grabar_salida_traz,$conexion);

//////traer el valor actual del saldo
$sql_traer_saldo_caja = "select saldocajamenor from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_traer_saldo = mysql_query($sql_traer_saldo_caja,$conexion);
$traer_saldo = mysql_fetch_assoc($consulta_traer_saldo);
$saldo_actual_caja = $traer_saldo['saldocajamenor'];
//echo '<br>saldo_actual<br>'.$saldo_actual_caja;
//calcular el valor del nuevo saldo 
if($_POST['tipo_recibo'] == '1') { $nuevo_saldo =  $saldo_actual_caja + $total_recibo ;}
//echo '<br>nuevo saldo<br>'.$nuevo_saldo;
if($_POST['tipo_recibo'] == '2') { $nuevo_saldo =  $saldo_actual_caja - $total_recibo ;}
//echo '<br>nuevo saldo<br>'.$nuevo_saldo;

/////////actualizar el valor del saldo 
$sql_actualizar_saldo  = "update $tabla10   set saldocajamenor = '".$nuevo_saldo."'     
 where id_empresa = '".$_SESSION['id_empresa']."' ";
 //echo '<br>consulta actulizar saldo<br>'.$sql_actualizar_saldo;
$consulta_actualizar = mysql_query($sql_actualizar_saldo,$conexion);

//actulizar el numero del recibo utilizado 

$sql_actulizar_recibo = "update $tabla10 set contarecicaja = '".$_POST['numero_recibo']."'  where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_actualizar_recibo = mysql_query($sql_actulizar_recibo,$conexion);
echo '<br><br>';
echo '<h2>RECIBO GRABADO SATISFACTORIAMENTE Y SALDO DE CAJA ACTUALIZADO</h2>';
echo '<br>';
echo '<h2>EL NUEVO SALDO ES DE $'.number_format($nuevo_saldo, 0, ',', '.').' </h2>';
echo '<br>';
echo  '<h2><a href="recibo_imprimir.php?numero='.$_POST['numero_recibo'].'" target = "_blank" >VISTA IMPRESION DE RECIBO</a></h2>';

if($_REQUEST['id_orden'] != '')
{	
echo  '<h2><a href="enviar_correo_abono.php?numero_recibo='.$_REQUEST['numero_recibo'].'&idorden='.$_REQUEST['id_orden'].'&id_proveedor='.$_REQUEST['id_proveedor'].'&id_cxp='.$_REQUEST['id_cxp'].'"  >ENVIAR CORREO</a></h2>';
}

///////////si es recibo de abono debe restar al saldo de la orden 
if($_REQUEST['abono']=='1' )
{
	$sql_traer_saldo_orden = "select saldo from $tabla14 where id =  '".$_REQUEST['id_orden']."'  ";
	$con_saldo = mysql_query($sql_traer_saldo_orden,$conexion);
	$arr_saldo = mysql_fetch_assoc($con_saldo);

	$nuevo_saldo = $arr_saldo['saldo']- $total_recibo  ;

	$grabar_nuevo_saldo_orden = "update $tabla14 set saldo = '".$nuevo_saldo."'    where id= '".$_REQUEST['id_orden']."'  ";
	$con_grabar_nuevo_saldo = mysql_query($grabar_nuevo_saldo_orden,$conexion);
}
if($_REQUEST['pago_proveedor']== '1' )
{
	$sql_traer_saldo_cuentacxp = "select saldo from $cuentasxpagar where id_cxp =  '".$_REQUEST['id_cxp']."'  ";
	$con_saldo = mysql_query($sql_traer_saldo_cuentacxp,$conexion);
	$arr_saldo = mysql_fetch_assoc($con_saldo);

	$nuevo_saldo = $arr_saldo['saldo']-$total_recibo ;

	$grabar_nuevo_saldo_orden = "update $cuentasxpagar set saldo = '".$nuevo_saldo."'    where id_cxp= '".$_REQUEST['id_cxp']."'  ";
	$con_grabar_nuevo_saldo = mysql_query($grabar_nuevo_saldo_orden,$conexion);
}




include('../colocar_links2.php');
}//fin de si se puede grabar el recibo de caja 
else
{
	echo '<br><br>Este numero de recibo ya se encuentra GRABADO <BR> no se puede volver a grabar ';
}
?>