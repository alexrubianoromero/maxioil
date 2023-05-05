<?php
session_start();
include('../valotablapc.php');

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

$sql_traer_items  = "select o.orden,o.fecha,io.* 
from $tabla15 io 
inner join  $tabla14  o on (o.id = io.no_factura)
where o.fecha between '".$_REQUEST['fechain']."'    and   '".$_REQUEST['fechafin']."'  
 ";
//echo '<br>'.$sql_traer_items;
$consulta_items = mysql_query($sql_traer_items,$conexion);

echo '<h3>INFORME DE VENTAS </h3>';


echo '<table border="1" id="formato_tabla">';
	echo '<tr>';
	echo '<td align="center">ORDEN</td>';
	echo '<td align="center">FECHA</td>';
	echo '<td align="center">CODIGO</td>';
	echo '<td align="center">DESCRIPCION</td>';
	echo '<td align="center">TOTAL COSTO</td>';
	echo '<td align="center">TOTAL VENTA </td>';
	echo '<td align="center">UTILIDAD</td>';
	echo '</tr>';
$suma_costos=0;
	$suma_ventas=0;
	$suma_utilidades = 0;
while($items = mysql_fetch_assoc($consulta_items))
{
	$utilidad = $items['total_item'] - $items['total_costo_producto'];
	echo '<tr>';
	echo '<td>'.$items['orden'].'</td>';
	echo '<td>'.$items['fecha'].'</td>';
	echo '<td>'.$items['codigo'].'</td>';
	echo '<td>'.$items['descripcion'].'</td>';
	echo '<td align="right">'.number_format($items['total_costo_producto'], 0, ',', '.').'</td>';
	echo '<td align="right">'.number_format($items['total_item'], 0, ',', '.').'</td>';
	echo '<td align="right">'.number_format($utilidad, 0, ',', '.').'</td>';
	echo '</tr>';
	$suma_costos = $suma_costos + $items['total_costo_producto'];
	$suma_ventas = $suma_ventas + $items['total_item'];
	$suma_utilidades = $suma_utilidades + $utilidad;
	
}
echo '<tr>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td>TOTALES</td>';
echo '<td align="right">'.number_format($suma_costos, 0, ',', '.').'</td>';
echo '<td align="right">'.number_format($suma_ventas, 0, ',', '.').'</td>';
echo '<td align="right">'.number_format($suma_utilidades, 0, ',', '.').'</td>';

echo '</tr>';
echo '</table>';

?>
