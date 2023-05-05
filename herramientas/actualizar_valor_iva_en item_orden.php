<?php
include('../valotablapc.php');
$sql_item_orden ="select * from $tabla15    ";

echo '<BR>'.$sql_item_orden;
$consulta_items = mysql_query($sql_item_orden,$conexion);

while ($items = mysql_fetch_assoc($consulta_items) )
	{
		  $valor_con_iva = ($items['total_item'] * $items['iva'])/100;
		  echo '<br>'.$items['total_item'].'--'.$valor_con_iva;
		  $valor_con_iva = number_format($valor_con_iva, 0, ',','');
		  
		  $sql_actualizar_valor_iva = "update $tabla15   set valor_iva = '".$valor_con_iva."'   where  id_item = '".$items['id_item']."'  ";  
		  
		  echo '<br>'.$sql_actualizar_valor_iva;
		  
		  $consulta_actualizar_valor_iva = mysql_query($sql_actualizar_valor_iva,$conexion);
		  

	}




?>