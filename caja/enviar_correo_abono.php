<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
include('../funciones_sportracing.php');
function  consulta_assoc_recibo($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }


$datos_recibo= consulta_assoc_recibo($tabla23,'numero_recibo',$_REQUEST['numero_recibo'],$conexion);

$datos_orden = consulta_assoc_recibo($tabla14,'id',$_REQUEST['idorden'],$conexion);


if($_REQUEST['idorden'] != ''){


  $sql_suma_items = "select sum(total_item) as  suma_items where no_factura = '".$_REQUEST['idorden']."'  ";
  $consulta_suma = mysql_query($sql_suma_items,$conexion);
  $arr_suma = mysql_fetcha_assoc($consulta_suma);
  $suma_items =  $arr_suma['suma_items'];   

	$sql_correo = "select cli.email,o.saldo from $tabla3 cli 
  inner join $tabla4 c on (c.propietario = cli.idcliente)
  inner join $tabla14  o on (o.placa = c.placa)
  where o.id = '".$_REQUEST['idorden']."'
	";
    $consulta_email = mysql_query($sql_correo,$conexion);
    $arr_info = mysql_fetch_assoc($consulta_email);
    $email = $arr_info['email'];
    //echo 'consulta <br>'.$sql_correo;
    //echo '<br>email<br>'.$email;
}//fin de if($_REQUEST['id_orden'] != '')
/*
if($_REQUEST['id_proveedor'] != ''){

	$sql_correo = "select cli.email,o.saldo from $proveedores cli 
  inner join $tabla4 c on (c.propietario = cli.idcliente)
  inner join $tabla14  o on (o.placa = c.placa)
  where o.id = '".$_REQUEST['idorden']."'
	";
    $consulta_email = mysql_query($sql_correo,$conexion);
    $arr_info = mysql_fetch_assoc($consulta_email);
    $email = $arr_info['email'];
    //echo 'consulta <br>'.$sql_correo;
    //echo '<br>email<br>'.$email;
}//fin de if($_REQUEST['id_orden'] != '')
*/
 $body .='
      Atentamente se informa que se creo un recibo de caja con la siguiejnte informacion :

      RECIBO NUMERO   '.$_REQUEST['numero_recibo'].'
      VALOR TOTAL ORDEN '.$suma_items.'
      VALOR ABONO $'.number_format($datos_recibo['lasumade'], 0, ',', '.').'
      POR CONCEPTO DE : '.$datos_recibo['porconceptode'].'
      SALDO : $'.number_format($arr_info['saldo'], 0, ',', '.').'


      KAYMO
      Taller  
      E-mail: a alexrubianoromero@gmail.com 
      Direccion: Bogota';

$headers .= "From: 	SPORTRACING <alexrubianoromero@gmail.com>\r\n"; 


//$headers .= "Bcc: Alex <alexrubianoromero@gmail.com>\r\n"; 


mail($email,"ABONO",$body,$headers); 



?>
