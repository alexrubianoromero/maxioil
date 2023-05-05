<?php
/////traer el nombre de alguien de tabla cliernte 0
 function traer_nombre_555($tabla,$id_cliente,$conexion){
      $sql_cliente= "select * from $tabla where idcliente = '".$id_cliente."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $nombre = $arr_cliente['nombre'];
      return  $nombre;
  }

 //traer la identidad 
/////////////////////////////////////////////////////////
function verificar_alertas($fechapan,$tabla,$conexion){
	$fechapan =  time();
    $fecha_actual = date ( "Y/m/j" , $fechapan );
    $sql= "select * from $tabla  where saldo > 0";
    $consulta_cuentas = mysql_query($sql,$conexion);
    $contador_fechas_vecidas = 0;

    while($cuentas = mysql_fetch_assoc($consulta_cuentas))
    {
    	$fecha1 = $fecha_actual; 
    	$fecha2 =  $cuentas['fecha_vencimiento']; 
    	$diferencia = resta_fechas($fecha1,$fecha2);

    	
    	if($diferencia  < 9){
    		$contador_fechas_vecidas++;
    		//echo '<br>'.$diferencia;
    	}


    } //fin de while
   return $contador_fechas_vecidas;
} 
///////////////////////////////fin de funcion verificar alertas

///////////////////////////////
function resta_fechas($fecha1,$fecha2){

		$diferencia = abs((strtotime($fecha1) - strtotime($fecha2))/86400);  
		//echo '<br>Diferencia<br>'.$diferencia;
		return $diferencia;
}
//fin de restafechas 
//////////////////////////////

function contar_cumpleanos($tabla,$conexion,$dia,$mes){

   $sql = "select * from $tabla where  DAY(fecha_cumpleanos) = '".$dia."' and month(fecha_cumpleanos)  = '".$mes."' 
  and felicitacion_enviada = 0
   ";
   //echo 'consulta<br>'.$sql;
    $consulta_cumple = mysql_query($sql);
    $filas_cumpleanos = mysql_num_rows($consulta_cumple);
    return $filas_cumpleanos;
}

//////////////////////////////

function cumpleanos($tabla,$conexion,$dia,$mes){
	$sql = 
	"select * from $tabla where  DAY(fecha_cumpleanos) = '".$dia."' and month(fecha_cumpleanos)  = '".$mes."' 
	and felicitacion_enviada = 0
	 ";
    $consulta_cumple = mysql_query($sql);

    while ($cumple = $consulta_cumple)
    {
			
      //$enviar = enviar_correo_cumpleanos($cumple['email'],$cumple['nombre']);
			//include('../cumpleanos/enviar_correo_cumpleanos.php');

	$sql_marcar_enviado = "update $tabla set felicitacion_enviada = '1'  where idcliente = '".$cumple['idcliente']."'";

    }//fin de while

}//fin de cumpleanos 



function enviar_correo_cumpleanos($email,$nombre){
  $body .='
      Felicitaciones en tu gran dia 
      '.$nombre.' 

      SPORTRACING
      Taller  
      E-mail: a sportracing@gmail.com 
      Direccion: Av Calle 134 No 45B-37 Bogota';

$headers .= "From:  SPORTRACING <sportracing134@gmail.com>\r\n"; 

$headers .= "Bcc: Alex <alexrubianoromero@gmail.com>\r\n"; 

//echo '<br>email'.$_REQUEST['email'];
//mail ("ventas@molecait.com,$email",$asunto,$mensaje,$cabeceras);
mail($email,"CUMPLEANOS",$body,$headers); 

}//////

?>