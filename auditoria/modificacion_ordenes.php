<?php
session_start();
include('../valotablapc.php');
$sql_auditoria_modificacion_ordenes = "select o.orden,u.login, au.fechayhora from $tabla60 au
inner join $tabla14 o on (o.id = au.id_orden)
inner join $tabla16 u on (u.id_usuario = au.id_usuario)
where au.id_empresa = '".$_SESSION['id_empresa']."' order by id_cambios asc ";

//echo '<br>'.$sql_auditoria_modificacion_ordenes;

$consulta_auditoria = mysql_query($sql_auditoria_modificacion_ordenes,$conexion);

echo '<br>AUDITORIA DE CAMBIOS REALIZADOS EN LAS ORDENES<BR><BR>';
echo '<table border = "1">';
echo '<tr>';
echo '<td>ORDEN</td>';
echo '<td>USUARIO</td>';
echo '<td>FECHA/HORA</td>';

echo '</tr>';
while ($cambios = mysql_fetch_assoc($consulta_auditoria))
{
  echo '<tr>';
   echo '<td>'.$cambios['orden'].'</td>';
   echo '<td>'.$cambios['login'].'</td>';
   echo '<td>'.$cambios['fechayhora'].'</td>';
    echo '</tr>';
}//fni de while 
echo '<table>';
?>