<?php
session_start();
include('../valotablapc.php');
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
<meta charset="UTF-8">
<meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<script src='../js/bootstrap.min.js'></script>

</head>
<body>	
  <div id="container">
<?php

 function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }




$sql_ordenes =	" 
select o.id,o.orden,o.fecha,o.placa,o.kilometraje,o.estado
,c.idcarro 
from $tabla14 o  
inner join  $tabla4 c  on (c.placa = o.placa)
where 1=1 
and c.id_empresa = '".$_SESSION['id_empresa']."'
and c.id_empresa_externa = '".$_SESSION['id_empresa_externa']."'";

if(isset($_REQUEST['idcarro']) && $_REQUEST['idcarro'] != '' )
{
  $sql_ordenes .=   " and c.idcarro = '".$_REQUEST['idcarro']."'   ";
}


if($_SESSION['nombre_perfil'] =='admin')
{
$sql_ordenes = "select o.id,o.orden,o.fecha,o.placa,o.kilometraje,o.estado
,c.idcarro 
from $tabla14 o  
inner join  $tabla4 c  on (c.placa = o.placa)

where 1=1 
and c.id_empresa = '".$_SESSION['id_empresa']."'  ";
}


//echo '<br>'.$sql_ordenes;


$con_ordenes = mysql_query($sql_ordenes,$conexion);
$filas_ordenes = mysql_num_rows($con_ordenes);

//echo '<br>'.$filas_ordenes;
echo '<h3>LISTADO ORDENES</h3> ';
if($filas_ordenes  > 0)

{
   echo '<table class="table table-striped" >';
   echo '<thead>';
   echo '<tr>';
   echo '<td>ORDEN</td>';
   echo '<td>FECHA</td>';
   echo '<td>KILOMETRAJE</td>';
    echo '<td>PLACA</td>';
    echo '<td>VALOR</td>';
   echo '<td>ESTADO</td>';

   echo '</tr>';
   echo '</thead>';
   while($ordenes = mysql_fetch_assoc($con_ordenes))
   {
     $datos_estado= consulta_assoc($tabla26,'valor_estado',$ordenes['estado'],$conexion);
     echo '<tbody>';
     echo '<tr>';
   echo '<td>'.$ordenes['orden'].'</td>';
   echo '<td><a href="../clientes_externos/orden_detallado_nuevo.php?idorden='.$ordenes['id'].'">'.$ordenes['fecha'].'</a></td>';
     echo '<td>'.$ordenes['kilometraje'].'</td>';
    echo '<td>'.$ordenes['placa'].'</td>';
   echo '<td></td>';
   echo '<td>'.$datos_estado['descripcion_estado'].'</td>';
  
   echo '</tr>';
   echo '</tbody>';
   }//fin de while
   echo '</table>';
}//fin de if($filas_ordenes  > 0)
?>
</div>
</body>
</html>
<script src="js/jquery-2.1.1.js"></script>   
