<?php
include('../valotablapc.php');
 $body .='
      
      '.$_REQUEST['nombre'].'
      Un feliz cumpleanos 
      te desea tu taller de motos check machine!

      Recuerda que estamos para servirte 
      Tesperamos pronto.

      CHECK MACHINE
      Taller  
      E-mail: a checkmachine@gmail.com 
      Direccion:  Bogota';

$headers .= "From: 	SPORTRACING <checkmachine3@gmail.com>\r\n"; 


//$headers .= "Bcc: Alex <alexrubianoromero@gmail.com>\r\n"; 


mail($_REQUEST['email'],"FELIZ_CUMPLEANOS",$body,$headers); 

$sql_actualizar = "update $tabla3 set felicitacion_enviada = '1'   where idcliente = '".$_REQUEST['idcliente']."' ";
$consulta_actualizar = mysql_query($sql_actualizar,$conexion);

?>
