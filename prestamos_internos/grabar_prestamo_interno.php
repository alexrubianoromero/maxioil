<?php
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_grabar_prestamo = "insert into $prestamos_internos  (id_orden_que_presta, id_orden_que_recibe
	, motivo_prestamo
	,valor
	,fecha_prestamo
	)

values (
	'".$_REQUEST['idorden_prestadora']."'
	,'".$_REQUEST['idorden_recibe']."'
	,'".$_REQUEST['motivo_prestamo']."'
	,'".$_REQUEST['valor_prestado']."'
	,'".$_REQUEST['fecha_prestamo']."'
	)
";
//echo '<br>'.$sql_grabar_prestamo;
$consulta_grabar = mysql_query($sql_grabar_prestamo,$conexion);

?>