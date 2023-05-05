<?php
session_start();
include('../valotablapc.php');
$sql_cxc= "select * from $cuentasxpagar where saldo > 0";
$consulta_cxc = mysql_query($sql_cxc,$conexion);

$fechapan =  time();
$fecha_actual = date ( "Y/m/j" , $fechapan );

  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

function resta_fechas_321($fecha1,$fecha2){

    $diferencia = abs((strtotime($fecha1) - strtotime($fecha2))/86400);  
    //echo '<br>Diferencia<br>'.$diferencia;
    return $diferencia;
}
//fin
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

   echo '<td>PROVEEDOR</td>';
    echo '<td>FACTURA</td>';
    echo '<td>FECHA_VENCI</td>';
   echo '<td>VR_FACTURA</td>';
   echo '<td>ABONOS</td>';
   echo '<td>SALDO</td>';
    

   echo '</tr>';
  $valor_deuda_proveedores = 0; 
  $valor_abonado_proveedores = 0;
 while($cxc = mysql_fetch_assoc($consulta_cxc))
 {
   $arr_proveedor = consulta_assoc($proveedores,'idcliente',$cxc['id_proveedor'],$conexion);

 	$sql_abonos_orden = "select sum(lasumade) as lasumade from $tabla23 
 	where id_cxp = '".$cxc['id_cxp']."' 
 	and anulado='0'  
  and tipo_recibo=2  "  ;
 	$con_abonos = mysql_query($sql_abonos_orden,$conexion);
 	$arr_abonos = mysql_fetch_assoc($con_abonos);

 	$sql_suma_items_orden = "select sum(total_item) as total_items   from $tabla15 where no_factura = '".$cxc['id']."'   ";
 	$con_suma_items =  mysql_query($sql_suma_items_orden,$conexion);
 	$arr_suma_tems = mysql_fetch_assoc($con_suma_items);

    
  $diferencia = resta_fechas_321($fecha_actual,$cxc['fecha_vencimiento']);
     if($diferencia  < 9)
     {
       echo '<tr>';
       echo '<td>'.$arr_proveedor['nombre'].'</td>';
       echo '<td>'.$cxc['factura_compra'].'</td>';
       echo '<td>'.$cxc['fecha_vencimiento'].'</td>';
      echo '<td align="right">'.$cxc['valor_factura'].'</td>';

       echo '<td align="right"><a href="ver_abonos.php?id_cxp='.$cxc['id_cxp'].'" >'.$arr_abonos['lasumade'].'</a></td>';
       echo '<td align="right">'.$cxc['saldo'].'</td>';


       echo '</tr>';
         $valor_deuda_proveedores  =  $valor_deuda_proveedores  + $cxc['saldo'];
          $valor_abonado_proveedores  =  $valor_abonado_proveedores  + $arr_abonos['lasumade'];
     }// fin de    if($diferencia  < 9)
 }//fin de cxp

echo '<tr>';
echo '<td>TOTALES </td>';
echo '<td></td>';
echo '<td></td>';
echo '<td align="right">'.$arr_abonos['lasumade'].'</td>';
echo '<td align="right">'.$valor_deuda_proveedores.'</td>';
echo '<td></td>';
echo '</tr>';
echo '</table>';

?>

</div>	
</body>
</html>