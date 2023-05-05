<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $tabla4 ";
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
  		echo '<td>PLACA</td>';
        echo '<td>LINEA</td>';
      echo '<td>MARCA</td>';
       echo '<td>MODELO</td>';
       echo '<td>EMPRESA_EXTERNA</td>';
       echo '<td>ACCION</td>';
       

  
  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
    //$arr_destino = consulta_assoc_dest($destinos,'id_destino',$productos['id_destino'],$conexion);
      $datos_empresa_externa = consulta_assoc_dest($empresas_externas,'id_empresa_externa',$productos['id_empresa_externa'],$conexion);
      echo '<tr>';
  		echo '<td>'.$productos['placa'].'</td>';
       echo '<td>'.$productos['tipo'].'</td>';  
      echo '<td>'.$productos['marca'].'</td>';  
      echo '<td>'.$productos['modelo'].'</td>'; 
      echo '<td>'.$datos_empresa_externa['nombre_empresa'].'</td>'; 

      echo '<td>';
      echo '<a  href="modificar_empresa_moto.php?idcarro='.$productos['idcarro'].'  ">Modificar</a>';
      echo '</td>';


  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>