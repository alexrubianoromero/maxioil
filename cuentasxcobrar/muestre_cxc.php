<?php
session_start();
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

 }//fin de cxp
echo '</table>';
?>

</div>	
</body>
</html>
