<?php
include('../valotablapc.php');

$sql_marcar_devuelto   = "update $prestamos_internos   
set devuelto =  '1'  where id_prestamo_interno = '".$_REQUEST['id_prestamo_interno']."' ";

//echo '<br>'.$sql_marcar_devuelto;

$con_devolver = mysql_query($sql_marcar_devuelto,$conexion);


echo '<BR><BR>EL PRESTAMO YA QUEDO DEVUELTO ';


?>