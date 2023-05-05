<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $tabla16  where id_perfil = 13 ";
$con_productos = mysql_query($sql_productos,$conexion);

//echo '<br>'.$sql_productos;

  function  consulta_assoc_dest($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<script src='../js/bootstrap.min.js'></script>
</head>
<body>
<table class="table">
  <thead>
<?php
	echo '<tr>';
  		echo '<td>NOMBRE_USUARIO</td>';
      echo '<td>NOMBRE_PERSONA</td>';
      echo '<td>EMPRESA </td>';  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
    $datos_empresa = consulta_assoc_dest($empresas_externas,'id_empresa_externa',$productos['id_empresa_externa'],$conexion);

      echo '<tr>';
  		echo '<td>'.$productos['login'].'</td>';
       echo '<td>'.$productos['nombre'].'</td>';  
      echo '<td>'.$datos_empresa['nombre_empresa'].'</td>';  
    

      echo '<td>';
      echo '<a  href="modificar.php?id_hotel='.$productos['id_usuario'].'  ">Modificar</a>';
      echo '</td>';
      
       echo '<td>';
       echo '<a  href="eliminar.php?id_hotel='.$productos['id_usuario'].' ">Eliminar</a>';
      echo '</td>';

  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>