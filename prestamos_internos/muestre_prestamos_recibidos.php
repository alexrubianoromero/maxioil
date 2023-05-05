<?php
include('../valotablapc.php');
$sql_prestamos = "select * from $prestamos_internos   where  id_orden_que_recibe   = '".$_REQUEST['idorden']."'  and devuelto = '0' ";
$con_prestamos = mysql_query($sql_prestamos,$conexion);

echo '<h3>LISTADO DE PRESTAMOS RECIBIDOS QUE NO SE HAN DEVUELTO DE LA ORDEN </h3>';
echo'<table border="1">';
echo '<tr>';
echo '<td>FECHA</td>';
echo '<td>ORDEN QUE PRESTO</td>';
echo '<td>CONCEPTO</td>';
echo '<td>VALOR </td>';
echo '<td>DEVOLVER </td>';

echo '</tr>';
while($presta = mysql_fetch_assoc($con_prestamos))
{
	

	$datos_presto = consulta_assoc($tabla14,'id',$presta['id_orden_que_presta'],$conexion);

	echo '<tr>';

	echo '<td>'.$presta['fecha_prestamo'].'</td>';
	echo '<td align="center">'.$datos_presto['orden'].'</td>';
	echo '<td>'.$presta['motivo_prestamo'].'</td>';
	echo '<td>'.number_format($presta['valor'], 0, ',', '.').'</td>';
	echo '<td><a href="../prestamos_internos/devolver_prestamo.php?id_prestamo_interno= '.$presta['id_prestamo_interno'].'">DEVOLVER</a></td>';
	echo '</tr>';
}

echo '</table>';



//////////////////////////////////////////////////////////////

  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
?>