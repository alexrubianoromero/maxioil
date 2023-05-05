<?php
session_start();
include('../valotablapc.php');
$dia_actual = date("d");
$mes_actual = date("m");
$sql_cxc= "select * from $tabla3 where 
DAY(fecha_cumpleanos) = '".$dia_actual."' and month(fecha_cumpleanos)  = '".$mes_actual."' 
  and felicitacion_enviada = 0
";

//echo '<br>'.$sql_cxc;
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
  <h2>CUMPLEANOS</h2>
<?php
echo '<table border = "1" width="80%">';
echo '<tr>';

   echo '<td>NOMBRE</td>';
    echo '<td>FECHA</td>';
    echo '<td>CORREO</td>';
    echo '<td>ENVIAR_CORREO</td>';
   echo '</tr>';
  $valor_deuda_proveedores = 0; 
  $valor_abonado_proveedores = 0;
 while($cxc = mysql_fetch_assoc($consulta_cxc))
 {
   
       echo '<tr>';
   
       echo '<td>'.$cxc['nombre'].'</td>';
       echo '<td>'.$cxc['fecha_cumpleanos'].'</td>';
       echo '<td>'.$cxc['email'].'</td>';
      echo '<td >
      <a href="enviar_correo_cumpleanos.php?nombre='.$cxc['nombre'].'&email='.$cxc['email'].'&idcliente='.$cxc['idcliente'].'" >
      Enviar_correo</a>
      </td>';


       echo '</tr>';
        
    
 }//fin de cxp

echo '</table>';

?>

</div>	
</body>
</html>