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


$sql_traer_items_directas =  
"select f.numero_factura,f.fecha,io.* 
from $tabla100 io 
inner join  $tabla11  f on (f.id_factura = io.no_factura)
where f.fecha between '".$_REQUEST['fechain']."'    and   '".$_REQUEST['fechafin']."'  
 ";
//echo '<br>'.$sql_traer_items_directas;
$consulta_items_directas = mysql_query($sql_traer_items_directas,$conexion);

?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura </title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="../jquery-ui-1.12.1_ui_lightness/jquery-ui.css" rel = "stylesheet">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../jquery-ui-1.12.1_ui_lightness/jquery-ui.js"></script>

<style>
table{
  border-collapse: collapse;
  width: 80%;
}
</style>
</head>
<body>
<h3>INFORME DE VENTAS </h3>
<a href = "informe_ventas_por_fecha_excell.php?fechain=<?php echo $_REQUEST['fechain'];?>&fechafin=<?php echo $_REQUEST['fechafin'];  ?>">GENERAR_EXCELL</a>
<br><br>
<?php
echo '<table border="1" id="formato_tabla">';
	echo '<tr>';
	echo '<td align="center">ORDEN</td>';
	echo '<td align="center">FACTURA</td>';
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
	echo '<td></td>';
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

while($items_directas = mysql_fetch_assoc($consulta_items_directas))
{
	$utilidad = $items_directas['total_item'] - $items_directas['total_costo_producto'];
	echo '<tr>';
	echo '<td></td>';
	echo '<td>'.$items_directas['numero_factura'].'</td>';
	echo '<td>'.$items_directas['fecha'].'</td>';
	echo '<td>'.$items_directas['codigo'].'</td>';
	echo '<td>'.$items_directas['descripcion'].'</td>';
	echo '<td align="right">'.number_format($items_directas['total_costo_producto'], 0, ',', '.').'</td>';
	echo '<td align="right">'.number_format($items_directas['total_item'], 0, ',', '.').'</td>';
	echo '<td align="right">'.number_format($utilidad, 0, ',', '.').'</td>';
	echo '</tr>';
	$suma_costos = $suma_costos + $items_directas['total_costo_producto'];
	$suma_ventas = $suma_ventas + $items_directas['total_item'];
	$suma_utilidades = $suma_utilidades + $utilidad;
}


echo '<tr>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td align="right">TOTALES</td>';
echo '<td align="right">'.number_format($suma_costos, 0, ',', '.').'</td>';
echo '<td align="right">'.number_format($suma_ventas, 0, ',', '.').'</td>';
echo '<td align="right">'.number_format($suma_utilidades, 0, ',', '.').'</td>';

echo '</tr>';


echo '</table>';
?>
