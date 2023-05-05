<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$sql_clientes = "select nombre,telefono,email,direccion,observaci,idcliente 
from $tabla21 as cli  where  cli.id_empresa = '".$_SESSION['id_empresa']."'   ";



//inner join $tabla4 car  on (car.propietario = cli.idcliente)
//,placa,marca,color,modelo

echo '<BR>CONSULTA GENERAL  <BR>';

echo '<table border = "1" width = "95%" >';
echo '<tr><td>NOMBRE</td><td>TELEFONO</td><td>EMAIL</td><td>DIRECCION</td><td>OBSERVACIONES</td></tr>';
$consulta_clientes = mysql_query($sql_clientes,$conexion);
while($clientes = mysql_fetch_array($consulta_clientes))
	{
			echo '<tr>';	
			echo '<td><a href = "muestre_datos_cliente.php?idcliente='.$clientes[5].' " >'.$clientes[0].'</a></td>';
			echo '<td>'.$clientes[1].'</td>';
			echo '<td>'.$clientes[2].'</td>';
			echo '<td>'.$clientes[3].'</td>';
			echo '<td>'.$clientes[4].'</td>';
			
			echo '</tr>';
	}
echo '</table>';
include('../colocar_links2.php');


?>