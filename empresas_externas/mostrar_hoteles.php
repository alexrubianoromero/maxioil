<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $empresas_externas ";
$con_productos = mysql_query($sql_productos,$conexion);



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
  		echo '<td>NOMBRE</td>';
        echo '<td>DIRECCION</td>';
      echo '<td>TELEFONO</td>';
       echo '<td>EMAIL</td>';
  
  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
    //$arr_destino = consulta_assoc_dest($destinos,'id_destino',$productos['id_destino'],$conexion);

      echo '<tr>';
  		echo '<td>'.$productos['nombre_empresa'].'</td>';
       echo '<td>'.$productos['direccion'].'</td>';  
      echo '<td>'.$productos['telefono'].'</td>';  
      echo '<td>'.$productos['email'].'</td>'; 

      echo '<td>';
      echo '<a  href="modificar.php?id_empresa_externa='.$productos['id_empresa_externa'].'  ">Modificar</a>';
      echo '</td>';
      
       echo '<td>';
       echo '<a  href="eliminar.php?id_empresa_externa='.$productos['id_empresa_externa'].' ">Eliminar</a>';
      echo '</td>';

  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>