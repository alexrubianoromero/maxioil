<?php
session_start();

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// die();
// echo '---------------------------------------------------------------------------';

/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';

exit();
*/
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
//exit();


/*
'".$_POST['orden_numero']."',
'".$_POST['placa']."',
'".$_POST['clave']."',
'".$_POST['fecha']."',
'".$_POST['descripcion']."',
'".$_POST['radio']."',
'".$_POST['antena']."',
'".$_POST['repuesto']."',
'".$_POST['herramienta']."',
'".$_POST['otros']."'
*/
if ($_POST['cambiar_mecanico']== 'undefined'){$_POST['cambiar_mecanico'] = 0;}
if ($_POST['checkbox_pagada']== 'undefined'){$_POST['checkbox_pagada'] = 0;}
////por si se desea enviar un nuevo correo con la descripcion de la orden 
if ($_POST['enviar_correo']== 'undefined'){$_POST['enviar_correo'] = 0;}

if($_POST['cambiar_mecanico'] == 1)
{$_POST['mecanico'] = $_POST['mecanico_nuevo'];}
/*
$estados_diferentes = 0;
$estado_a_grabar  = $_POST['estado'];


if($ultimo_estado != '')
		{
				echo '<br>es estado es diferente de puntos suspensivos<br>';
				
				if($_POST['estado']<>$_POST['ultimo_estado'])
				  {
					 //echo 'los dos estados son diferentes';
					 $estado_a_grabar  = $_POST['ultimo_estado'];
					 //se coloca unindicado de que eran diferentes 
					 $estados_diferentes = 1;
					 
					 //
				  }
				 else
				 {   $estado_a_grabar  = $_POST['estado'];
				 } 
  
		}// fin de if($ultimo_estado <> '...')
		
*/		
		
//echo '<br>valor de cambiar_mecanico'.$_POST['cambiar_mecanico'];

include('../valotablapc.php');

///actualizar el saldo 
//sumar los items de la orden y actualizar el saldo 
$sql_suma_items = "select sum(total_item) as suma_items from $tabla15 where no_factura = '".$_REQUEST['id_orden']."'  ";
$consulta_suma = mysql_query($sql_suma_items,$conexion);
$arr_suma_items = mysql_fetch_assoc($consulta_suma);
$saldo_orden = $arr_suma_items['suma_items'];
//echo 'consulta =<br>'.$saldo_orden;
///////////////////////////verificar los abonos en recibos de caja de esta orden 

	$sql_abonos_orden = "select sum(lasumade) as lasumade from $tabla23 
 	where id_orden = '".$_REQUEST['id_orden']."' 
 	and anulado='0'    "  ;
 	$con_abonos = mysql_query($sql_abonos_orden,$conexion);
 	$arr_abonos = mysql_fetch_assoc($con_abonos);
///////////////////////////////////////////////////// hacer la resta 

$saldo_orden = $arr_suma_items['suma_items'] - $arr_abonos['lasumade'];

//$sql_actualizar_orden = "update  $tabla14  set (factura,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros) 
$sql_actualizar_orden = "update  $tabla14  set 
observaciones = '".$_POST['descripcion']."',
iva = '".$_POST['iva']."'
,kilometraje = '".$_POST['kilometraje']."'
,mecanico = '".$_POST['mecanico']."'
,kilometraje_cambio = '".$_POST['kilometraje_cambio']."'
,abono = '".$_POST['abono']."'
,estado = '".$_POST['estado']."'
,formapago = '".$_POST['formapago']."'
,comercial = '".$_POST['comercial']."'  
,cotiza = '".$_POST['valor_estimado']."' 
,fecha_entrega = '".$_POST['fecha_entrega']."' 
,saldo = '".$saldo_orden."' 
,documentos_recibidos = '".$_POST['documentos_recibidos']."'  
,fecha = '".$_POST['fecha']."'
";

if($_POST['checkbox_pagada']==1)
{ $sql_actualizar_orden .= ", pagada = '1' ";}

$sql_actualizar_orden .= " where id = '".$_POST['id_orden']."'
";

//echo '<br>'.$sql_actualizar_orden;
//exit();

$consulta_grabar = mysql_query($sql_actualizar_orden,$conexion); 

actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$_SESSION['id_empresa'],$id_orden,$conexion);

echo "<br><br><h2>ORDEN  ACTUALIZADA</h2>";
include('../colocar_links2.php');

//<a href="#">#</a>
//tabla24 nombres_items_carros
//tabla25 relacion_orden_inventario
function actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$id_empresa,$id_orden,$conexion)
{
  // echo '<br>pasoooooooooooooooooooooooooooo11111<br>';
   $sql_nombres_inventario = "select * from $tabla24 where id_empresa = '".$id_empresa."' order by id_nombre_inventario";
   //echo '<br>'.$sql_nombres_inventario.'<br>';
   $consulta_nombres_inventario = mysql_query($sql_nombres_inventario,$conexion);
   while ($nombres_items = mysql_fetch_assoc($consulta_nombres_inventario))
   		{
			//echo 'pasooooooo2222222222222222222222';
			//echo '<br>1 '.$nombres_items['id_nombre_inventario'];
			$id_de_nombre = $nombres_items['id_nombre_inventario'];
			//echo '<br>idnombre'.$id_de_nombre;
			$cantidad = 'cantidad_'.$id_de_nombre;
			//echo '<br>cantidad123 '.$cantidad;
			
			$consulta_actualizar_valor_cantidad ="update $tabla25  set   
					valor = '".$_REQUEST[$id_de_nombre]."',
					cantidad = '".$_REQUEST[$cantidad]."'
					where id_nombre_inventario = '".$id_de_nombre."'   
					and id_orden = '".$_REQUEST['id_orden']."' 
					and id_empresa = '".$_SESSION['id_empresa']."' ";
			//echo '<br>consulta_actualizar'.$consulta_actualizar_valor_cantidad.'<br>';
			$consulta_actulizar_valores = mysql_query($consulta_actualizar_valor_cantidad,$conexion);		
		}// fin del while 
   
   

}// fin de la funcion de actualizar_inventario_estado_vehiculo 

//echo '<h2><a href="orden_imprimir_honda_cero.php?idorden='.$_REQUEST['id_orden'].'" target="blank">VISTA IMPRESION ORDEN</a></h2>';
//echo '<h2><a href="orden_imprimir_preforma.php?idorden='.$_REQUEST['id_orden'].'" target="blank">VISTA PRE FORMA </a></h2>';







/*


if ($_POST['enviar_correo'] > 0)
{ 
/////////////////////
$body = '

�MOTORCYCLE ROOM!

De antemano queremos agradecer tu confianza en nosotros, y en respuesta a ello hemos dispuesto de los mejores t�cnicos, insumos y experiencia, para satisfacer completamente tus requerimientos hacia nuestro servicio. 

Hemos creado una orden con la siguiente informaci�n.


Placa: '.$_REQUEST['placa'].' Orden Numero : '.$_REQUEST['orden_numero'].' 

TRABAJO A REALIZAR : 
'.$_REQUEST['descripcion'].'
Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes contactarnos!

MOTORCYCLE ROOM 
Taller Multimarca 
3142536548 

O env�anos un E-mail a motorcycleroom@gmail.com <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
';

/////////////////////
		//echo '<br>Se enviara el correo de que esta se ha modificado <br>';
   include('enviar_correo.php');  
  
}//fin de if ($_POST['enviar_correo'] >0)

*/
/*

if($_REQUEST['estado']>0)
{
	$body= '
	   MOTORCYCLE ROOM Te informa!
	   
	   Que tu moto de placa '.$_REQUEST['placa'].' recibida bajo el numero de orden'.$_REQUEST['orden_numero'].'
	   
	   Ya esta lista! 
	   
	   Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes	 contactarnos!

MOTORCYCLE ROOM 
Taller Multimarca 
3142536548 

O env�anos un E-mail a motorcycleroom@gmail.com <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
	';
	//echo '<br>Se enviara el correo de que esta lista <br>';
	include('enviar_correo.php');  
	
	
}//fin de si se envia correo 
*/

if($_POST['enviar_correo'] > 0)
{
$body= '
	   	Te informa!!!
	   
	   MODIFICACION

	   Que tu moto de placa '.$_REQUEST['placa'].' recibida bajo el numero de orden'.$_REQUEST['orden_numero'].'
	   
	   OBSERVACIONES
	   
	   
	   Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes	 contactarnos!


Taller Multimarca 


O env�anos un E-mail a: <br>
Recuerda, estamos ubicados en la  Cll 134 No 45B-37
	';
	//echo '<br>Se enviara el correo de que esta lista <br>';
$datos_orden = consulta_assoc_email($tabla14,'id',$_REQUEST['id_orden']	,$conexion);
$datos_carro = consulta_assoc_email($tabla4,'placa',$datos_orden['placa']	,$conexion);
$datos_cliente = consulta_assoc_email($tabla3,'idcliente',$datos_carro['propietario'],$conexion);
$email = $datos_cliente['email'];
	include('enviar_correo_cotiza.php');  
	
} //fin de if($_POST['enviar_correo'] == 1)

/////////////////si el estado es entrgada y  el campo recibo_de_caja_creado es cero 
//crear recibo de caja  
/////traiga el valor de este campo de la tabla ordenes 
$sql_traer_valor_ordenes = "select recibo_de_caja_creado from $tabla14 where id = '".$_REQUEST['id_orden']."'";
$consulta_valor = mysql_query($sql_traer_valor_ordenes,$conexion);
$arreglo_valor = mysql_fetch_assoc($consulta_valor);
////ahora el condicional 
if($_REQUEST['estado']==2 && $arreglo_valor['recibo_de_caja_creado']<1)
{
	//echo '<br>El estado es igual a 2 entregada';
	//crear recibo de caja 
	$fechapan =  time();
	$fechapan = date ( "Y/m/j" , $fechapan );

	$nombre = traer_nombre_cliente0($conexion,$tabla3,$tabla4,$_REQUEST['placa']);
	$por_concepto_de = 'Pago reparacion orden No: '.$_REQUEST['orden'].' Placa : '.$_REQUEST['placa'];
	$suma_items= sumar_items_orden($conexion,$tabla15,$_REQUEST['id_orden']);
	$observaciones = 'Recibo generado automanticamente ';
	$siguiente_numero_recibo = traer_numero_recibo($conexion,$tabla10);

	$sql_grabar_salida = "insert into $tabla23 
	(fecha_recibo,dequienoaquin,porconceptode,lasumade,observaciones,tipo_recibo,numero_recibo,id_empresa,id_usuario_creacion) 
	values (
	'".$fechapan."'
	,'".$nombre."' 
	,'".$por_concepto_de."'
	,'".$suma_items."'
	,'".$observaciones."'
	,'".'1'."'
	,'".$siguiente_numero_recibo."'
	,'".$_SESSION['id_empresa']."'
	,'".$_SESSION['id_usuario']."'
	) ";

	$consulta_grabar = mysql_query($sql_grabar_salida,$conexion);
	//actualiazr el contador de recibos y el saldo 
	actualizar_contador_recibosysaldo_y_campo_orden($conexion,$tabla10,$siguiente_numero_recibo,$suma_items,$_REQUEST['id_orden'],$tabla14);
	//actualizar el campo de la orden indicando que se creo el recibo  

}//fin de si se puede grabar el recibo de caja 
function traer_nombre_cliente0($conexion,$tabla3,$tabla4,$placa){
	$sql_traer_nombre = "select nombre from $tabla4 c
	inner join $tabla3  cli  on (cli.idcliente = c.propietario)
	where placa = '".$placa."' ";
	$consulta_nombre = mysql_query($sql_traer_nombre,$conexion);
	$arreglo_nombre = mysql_fetch_assoc($consulta_nombre);
	return $arreglo_nombre['nombre'];
}

function sumar_items_orden($conexion,$tabla15,$id_orden){
	$sql_sumar_items = "select sum(total_item) as suma from $tabla15   
	where no_factura = '".$id_orden."'  ";
	$consulta_suma= mysql_query($sql_sumar_items,$conexion);
	$arreglo_suma =mysql_fetch_assoc($consulta_suma);
	return $arreglo_suma['suma'];
}

function traer_numero_recibo($conexion,$tabla10){
	$sql_traer_numero_actual = "select contarecicaja from $tabla10";
	$consulta_numero_actual = mysql_query($sql_traer_numero_actual,$conexion);
	$arreglo_numero_actual = mysql_fetch_assoc($consulta_numero_actual);
	$siguiente_numero = $arreglo_numero_actual['contarecicaja'] +1;
	return $siguiente_numero;
}
function actualizar_contador_recibosysaldo_y_campo_orden($conexion,$tabla10,$numero,$suma,$id_orden,$tabla14){
	$sql_actualizar_contador_recibos="update $tabla10 
	set contarecicaja = '".$numero."' "; 
	$consulta_actualizar_contador = mysql_query($sql_actualizar_contador_recibos,$conexion);	

	$sql_traer_saldo = "select saldocajamenor  from $tabla10 ";
	$consulta_saldo = mysql_query($sql_traer_saldo);
	$arreglo_saldo = mysql_fetch_assoc($consulta_saldo);
	$nuevo_saldo = $arreglo_saldo['saldocajamenor'] + $suma;
	$sql_actualizar_saldo = "update $tabla10 set saldocajamenor ='".$nuevo_saldo."'  ";
	$consulta_actualizar = mysql_query($sql_actualizar_saldo,$conexion);

	$sql_actualizar_campo_orden = "update $tabla14  
	set   recibo_de_caja_creado = '1' 
	where id = '".$id_orden."'
	";
	$consulta_orden = mysql_query($sql_actualizar_campo_orden,$conexion);
	
	}

////////////////////////////////////////

	 function  consulta_assoc_email($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
/////////////////////si el  estado  es lista osea 1 se  suman los itesm y se crea el valor del saldo 
//y va a figurar en cuentas por cobrar 
 if($REQUEST['estado']==1)
 {
 	echo '<br> Se creo la cuanta por cobrar para esta orden '; 

 }	//fin de si estado orden es 1 



?>