<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

include('../valotablapc.php');
$sql_cxc= "select nombre_pieza,sum(cantidad) as cantidad from $anotaciones_inventario where 1=1 ";

if($_REQUEST['fechain'] != '')
{
  $sql_cxc .= " and  fecha > '".$_REQUEST['fechain']."' ";
}

if($_REQUEST['fechafin'] != '')
{
  $sql_cxc .= " and  fecha < '".$_REQUEST['fechafin']."' ";
}

if($_REQUEST['fechain'] != '' &&  $_REQUEST['fechafin'] != '')
{
    
}

$sql_cxc .= "  group by nombre_pieza ";
//echo '<br>'.$sql_cxc.'<br>';
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
  <h2>REUMEN ROTACION INVENTARIO DEL <?php echo $_REQUEST['fechain']; ?>  AL <?php echo $_REQUEST['fechafin']; ?>  </h2>
<?php
echo '<table border = "1" width="80%">';
echo '<tr>';

   //echo '<td>FECHA</td>';
    echo '<td>NOMBRE_PIEZA</td>';
    echo '<td>CANTIDAD</td>';
   echo '</tr>';
  $valor_deuda_proveedores = 0; 
  $valor_abonado_proveedores = 0;
  $saldo_proveedores = 0;
 while($cxc = mysql_fetch_assoc($consulta_cxc))
 {
   
   echo '<tr>';
   
   //echo '<td>'.$cxc['fecha'].'</td>';
   echo '<td>'.$cxc['nombre_pieza'].'</td>';
   echo '<td>'.$cxc['cantidad'].'</td>';

   //echo '<td align="right"><a href="ver_abonos.php?id_cxp='.$cxc['id_cxp'].'" >'.$cxc['lasumade'].'</a></td>';
   echo '</tr>';
   
 }//fin de cxp

echo '</table>';

?>

</div>	
</body>
</html>