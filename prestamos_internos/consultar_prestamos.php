<?php
include('../valotablapc.php');

$sql_prestamos_realizados = "select * from $prestamos_internos 
where id_orden_que_presta = '".$_REQUEST['idorden']."' ";

//echo '<br>'.$sql_prestamos_realizados;

$con_realizados = mysql_query($sql_prestamos_realizados,$conexion);

echo '<br> PRESTAMOS REALIZADOS DESDE ESTA ORDEN';
/////////////////////////////////////////
echo'<table border="1">';
echo '<tr>';
echo '<td>FECHA</td>';
echo '<td>ORDEN QUE PRESTO</td>';
echo '<td>ORDEN QUE RECIBIO</td>';
echo '<td>CONCEPTO</td>';
echo '<td>VALOR </td>';
echo '<td>DEVOLVER </td>';

echo '</tr>';
while($presta = mysql_fetch_assoc($con_realizados))
{
	

	$datos_recibio = consulta_assoc($tabla14,'id',$presta['id_orden_que_recibe'],$conexion);

	echo '<tr>';

	echo '<td>'.$presta['fecha_prestamo'].'</td>';
	echo '<td align="center">'.$_REQUEST['orden'].'</td>';
	echo '<td align="center">'.$datos_recibio['orden'].'</td>';
	echo '<td>'.$presta['motivo_prestamo'].'</td>';
	echo '<td>'.number_format($presta['valor'], 0, ',', '.').'</td>';
    if($presta['devuelto']>0)
    {
	echo '<td><a href="../prestamos_internos/devolver_prestamo.php?id_prestamo_interno= '.$presta['id_prestamo_interno'].'">DEVOLVER</a></td>';
	}

	echo '</tr>';
}

echo '</table>';
///////////////////////////////////////////



////////////////////////////////////////////////


$sql_prestamos_recibidos = "select * from $prestamos_internos 
where id_orden_que_recibe = '".$_REQUEST['idorden']."' ";

$con_recibidos = mysql_query($sql_prestamos_recibidos,$conexion);

echo '<br>PRESTAMOS QUE SE LE HAN HECHO A ESTA ORDEN DESDE OTRAS ORDENES';

echo'<table border="1">';
echo '<tr>';
echo '<td>FECHA</td>';
echo '<td>ORDEN QUE PRESTO</td>';
echo '<td>ORDEN QUE RECIBIO</td>';
echo '<td>CONCEPTO</td>';
echo '<td>VALOR </td>';
echo '<td>DEVOLVER </td>';

echo '</tr>';
while($presta = mysql_fetch_assoc($con_recibidos))
{
	

	$datos_recibio = consulta_assoc($tabla14,'id',$presta['id_orden_que_recibe'],$conexion);

	echo '<tr>';

	echo '<td>'.$presta['fecha_prestamo'].'</td>';
	echo '<td align="center">'.$_REQUEST['orden'].'</td>';
	echo '<td align="center">'.$datos_recibio['orden'].'</td>';
	echo '<td>'.$presta['motivo_prestamo'].'</td>';
	echo '<td>'.number_format($presta['valor'], 0, ',', '.').'</td>';
	  if($presta['devuelto'] < 1)
    {
	echo '<td><a href="../prestamos_internos/devolver_prestamo.php?id_prestamo_interno= '.$presta['id_prestamo_interno'].'">DEVOLVER</a></td>';
	}
	echo '</tr>';
}

echo '</table>';

///////////////////////////////////////////////////
 function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>