<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$sql_buscar_orden = "
select * from $tabla14 
 where orden = '".$_REQUEST['orden_recibe']."' 
";
//select * from $tabla12 where codigo_producto  = '".$_POST['codigopan']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_orden = mysql_query($sql_buscar_orden,$conexion);
$arr_orden = mysql_fetch_assoc($consulta_orden);	
//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"placa":"'.$arr_orden['placa'].'" 
,"idorden":"'.$arr_orden['id'].'" 

}]';


?>
