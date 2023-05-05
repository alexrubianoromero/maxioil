<?php
session_start();
require_once ('../../jpgraph-4.2.2/src/jpgraph.php');
require_once ('../../jpgraph-4.2.2/src/jpgraph_bar.php');

include('../valotablapc.php');
$sql_cxc= "select * from $tabla14 where saldo > 0";
$consulta_cxc = mysql_query($sql_cxc,$conexion);
?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
</style>
</head>
<body>
<div id="div_cxc">
<?php

echo '<table border = "1" width="80%">';
echo '<tr>';

   echo '<td>ORDEN</td>';
    echo '<td>PLACA</td>';
   echo '<td>VR_ORDEN</td>';
   echo '<td>ABONOS</td>';
   echo '<td>SALDO</td>';
    echo '<td>ABONAR</td>';

   echo '</tr>';
   
 $i = 0;

 while($cxc = mysql_fetch_assoc($consulta_cxc))
 {
   
 	$sql_abonos_orden = "select sum(lasumade) as lasumade from $tabla23 
 	where id_orden = '".$cxc['id']."' 
 	and anulado='0'    "  ;
 	$con_abonos = mysql_query($sql_abonos_orden,$conexion);
 	$arr_abonos = mysql_fetch_assoc($con_abonos);

 	$sql_suma_items_orden = "select sum(total_item) as total_items   from $tabla15 where no_factura = '".$cxc['id']."'   ";
 	$con_suma_items =  mysql_query($sql_suma_items_orden,$conexion);
 	$arr_suma_tems = mysql_fetch_assoc($con_suma_items);


   echo '<tr>';
   echo '<td>'.$cxc['orden'].'</td>';
   echo '<td>'.$cxc['placa'].'</td>';
   echo '<td>'.$arr_suma_tems['total_items'].'</td>';
   echo '<td><a href="ver_abonos.php?id_orden='.$cxc['id'].'" >'.$arr_abonos['lasumade'].'</a></td>';
   echo '<td>'.$cxc['saldo'].'</td>';
   echo '<td><a href="../caja/captura_recibos_de_caja.php?id_orden='.$cxc['id'].'&tipo_recibo=1&abono=1&placa='.$cxc['placa'].'" >ABONAR</a></td>';
   echo '</tr>';
   

   $datos[$i] = $cxc['orden'];
   $labels[$i] = $cxc['saldo'];
   $i++;
 }//fin de cxp
echo '</table>';

echo '<br>datos<pre>';
print_r($datos);
echo '</pre>';
echo '<br>labels<pre>';
print_r($datos);
echo '</pre>';
//exit();
/////////////////////////////////////////////////////



// Creamos el grafico

//$datos=array(6,5,8,6);
//$labels=array("pepe","juanita","Maria","Luis");
/*

$grafico = new Graph(800, 700, 'auto');
$grafico->SetScale("textlin");
$grafico->title->Set("Ejemplo de GraficaAlex Rubiano");
$grafico->xaxis->title->Set("trabajadores123");
$grafico->xaxis->SetTickLabels($labels);
$grafico->yaxis->title->Set("Horas Trabajadas");

$barplot1 =new BarPlot($datos);
$barplot1->SetWidth(50); // 30 pixeles de ancho para cada barra

$grafico->Add($barplot1);
$grafico->Stroke();

*/


////////////////////////////////////////////////////



?>

</div>	
</body>
</html>
