<?php
include('../valotablapc.php');
echo '<br>DIGITE EL NUMERO DE LA ORDEN PARA ENVIAR CORREO ';

echo '<form name="formu"  mehod="post"  action = "crear_cuerpo_reenvio_correo.php" >';
echo  '<input type="text" id = "orden"  name = "orden">';

echo '<input type = "submit"  id="reenviar_correo"  value ="Reenviar_Correo" >';


$sql_traer_ordenes  = "select * from $tabla14   where id_empresa = '300'  order by id desc  ";
$consulta_ordenes = mysql_query($sql_traer_ordenes,$conexion);
echo '<table border = "1"';
while ($ordenes = mysql_fetch_assoc($consulta_ordenes))
{
echo '<tr>';
echo '<td>';
echo '<a href="crear_cuerpo_reenvio_correo.php?idorden='.$ordenes['id'].'">Renviar Correo cotiza</a>';	
echo '</td>';		
echo '<td>'.$ordenes['fecha'].'</td>';
echo '<td>'.$ordenes['placa'].'</td>';
echo '<td>'.$ordenes['orden'].'</td>';
echo '<td>';
echo '<a href="crear_cuerpo_reenvio_correo_volver_a_enviar.php?idorden='.$ordenes['id'].'">
Renviar Correo segunda vez</a>';
echo '</td>';
echo '<td>';
echo '<a href="crear_cuerpo_reenvio_correo_volver_a_enviar.php?idorden='.$ordenes['id'].'">
Crear correo en formato html </a>';
echo '</td>';
echo '</tr>';
}
echo '</table>';
?>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   
});
</script>