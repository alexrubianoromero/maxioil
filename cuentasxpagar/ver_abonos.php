<?php
session_start();
include('../valotablapc.php');
$sql_cxc_abonos= "select * from $tabla23   where anulado = '0' and id_cxp = '".$_REQUEST['id_cxp']."'  and tipo_recibo = 2";
$con_cxp_abonos = mysql_query($sql_cxc_abonos,$conexion);

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
<div  id="div_ver_abonos"  >

<h3>ABONOS REALIZADOS </h3>	
<?php
echo '<table border = "1" width="50%">';
   echo '<tr>';
    echo '<td>FECHA</td>';
   echo '<td>NUMERO_RECIBO</td>';
    echo '<td>VALOR</td>';
   echo '</tr>';
   $total_abonos= 0;
while($abonos = mysql_fetch_assoc($con_cxp_abonos))
{
echo '<tr>';
echo '<td>'.$abonos['fecha_recibo'].'</td>';
   echo '<td>'.$abonos['numero_recibo'].'</td>';
   echo '<td align="right">'.$abonos['lasumade'].'</td>';
   $total_abonos = $total_abonos + $abonos['lasumade'];
}
 echo '<tr>';
    echo '<td align="right"></td>';
   echo '<td align="right">TOTAL ABONOS</td>';
    echo '<td align="right">'.$total_abonos.'</td>';
   echo '</tr>';
echo '</table>';
?>
</div>	
</body>
</html>