<?php
session_start();
include('../valotablapc.php');
$sql_placas = "select idcarro,placa from $tabla4   where id_empresa = '".$_SESSION['id_empresa']."'  ";
//echo '<br>'.$sql_placas.'<br>';
$consulta_placas = mysql_query($sql_placas,$conexion);
echo '<br>';
echo 'CAMBIO DE PLACA';
echo '<br>';

echo '<br>';
echo '<table border = "1"';
echo '<tr>';
echo '<td>PLACA ACTUAL </td>';
echo '<td>PLACA  NUEVA</td>';
echo '<td>ACCION</td>';
echo '</tr>';
while($placas = mysql_fetch_assoc($consulta_placas))
{
	echo '<form name = "formu_'.$placas['idcarro'].'" method="post" action = "cambiar_placa.php">';
	echo '<tr>';
	echo '<td><input type="text"  name = "placa_anterior"   value ="'.$placas['placa'].'">
	<input type="hidden"  name = "idcarro"   value ="'.$placas['idcarro'].'"></td>';
	echo '<td><input type = "text" name="nueva_placa"  </td>';
	echo '<td><input type="submit"  value = "cambiar" </td>';
	echo '<tr>';
	echo '</form>';


}


echo '</table>';

?>