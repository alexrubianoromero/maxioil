<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$sql_motos_cliente = "select * from $tabla4 where propietario = '".$_REQUEST['idcliente']."'  and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo '<br>'.$sql_motos_cliente;
$consulta_motos = mysql_query($sql_motos_cliente,$conexion);
echo '<BR>LISTADO DE MOTOS DEL CLIENTE <BR><BR>';
echo '<table border = "1">';
echo '<tr>';
echo '<td>PLACA</td><td>MARCA</td><td>MODELO</td><td>HISTORIAL</td>';
echo '</tr>';
while($motos = mysql_fetch_assoc($consulta_motos))
		{
			echo '<tr>';
			echo '<td><a href ="../vehiculos/muestre_datos_carro.php?placa='.$motos['placa'].'">'.$motos['placa'].'</a></td>';
			echo '<td>'.$motos['marca'].'</td>';
			echo '<td>'.$motos['modelo'].'</td>';
			echo '<td><a href="../consultas/muestre_listado_ordenes_por_placa.php?placa123='.$motos['placa'].'">HISTORIAL</a></td>';
			echo '</tr>';
		}
echo '</table>';
?>