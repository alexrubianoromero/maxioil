<?php

include('../valotablapc.php');
				echo '<pre>';
				print_r($_REQUEST);
				echo '</pre>';
				//exit();
//revisar que este cliente no tenga ligado ningun vehiculo 

$sql_revisar_ciente = "select  cli.identi,cli.nombre,c.placa  from $tabla21 as cli 
inner join $tabla4 as c on (c.propietario = cli.idcliente)
where cli.idcliente = '".$_REQUEST['idcliente']."'
";

//echo '<br>'.$sql_revisar_ciente;

$consulta_revision = mysql_query($sql_revisar_ciente,$conexion);
$filas_revision = mysql_num_rows($consulta_revision);

if($filas_revision < 1)
{
$sql_eliminar_cliente = "delete from $tabla21 where idcliente = '".$_REQUEST['idcliente']."'  ";
$consulta_eliminar= mysql_query($sql_eliminar_cliente);
echo 'INFORMACION ELIMINADA ';
}



?>  