<?php
include('../valotablapc.php');
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';

$sql_placas = "select cli.nombre as nombrecli,cli.identi as clidenti,cli.direccion,
cli.telefono,cli.email,
car.placa,car.marca,car.modelo,car.color,car.tipo,car.chasis,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,
 e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa,o.kilometraje_cambio,e.tipo_taller,cli.email,e.condiciones_orden,
 o.fecha_entrega, o.fecha_salida , e.email_empresa,e.razon_social,o.abono,cli.entidad,car.sigla
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa)
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'    ";
 //echo '<br>'.$sql_placas.'<br>';
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
$datos_orden = mysql_fetch_assoc($datos);

$body ='';

$body .= "
placa ".$datos_orden['placa'];
$body .= "
orden ".$datos_orden['orden'];
$body .= "
orden ".$datos_orden['observaciones'];

///////////////////////////////////
$body = 'Te damos la bienvenida a MOTORCYCLE ROOM

De antemano queremos agradecer tu confianza en nosotros, y en respuesta a ello hemos dispuesto de los mejores técnicos, insumos y experiencia, para satisfacer completamente tus requerimientos hacia nuestro servicio. 

Hemos creado una orden con la siguiente informacion. 
Placa: '.$datos_orden['placa'].' Orden No : '.$datos_orden['orden'].' 

TRABAJO A REALIZAR : '.$datos_orden['observaciones'].'

Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes contactarnos!

MOTORCYCLE ROOM. 
Taller Multimarca 
3142536548 

O envianos un E-mail a motorcycleroom@gmail.com 
Recuerda, estamos ubicados en la Av. calle 80 20c- 49..';
//$body="prueba envio correo";
/*
$cuerpo_correo="crecion de orden";
*/
//////////////////////////////////////////////////////////////////	
/////////////////enviar el correo 
//mail($_REQUEST['email'],'MOTORCYCLE ROOM',$body,$headers); 
$email = $datos_orden['email'];
include('enviar_correo_repetido.php');


//////////////////////////////////

//echo $body;
//falta meter lso repuestos de la cotizacion 


//include('enviar_correo_cotiza.php');
?>

<?php
function muestre_items_local_repuestos($orden,$tabla,$conexion,$id_empresa,$tabla12,$parametro)
		{
				$subtotal = 0;
				$valor_repuestos=0;
				$valor_mano = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."' and anulado < 1  
				and codigo = '".$parametro."' order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
				

				
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			echo 
				
				'<tr>
				<td >'.$items['cantidad'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td  > '.$items['iva'].'</td>
    			<td align="right">'.number_format($items['valor_unitario'], 0, ',', '.').'</td>
   			    <td align="right">'.number_format($items['total_item'], 0, ',', '.').'</td>
					</tr>
				';
				/*
				'<tr>
				<td >'.$items['codigo'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td align="center"> '.$items['cantidad'].'</td>
    			<td align="right">'.$items['valor_unitario'].'</td>
   			    <td align="right">'.$items['total_item'].'</td>
					</tr>
				';
				*/
				//<td width="34">'.$i.'</td>
				
				//$iva_item = ($items['total_item'] * $items['iva'])/100;
				//$item_menos_iva = $items['total_item']-$iva_item ;
				$subtotal = $subtotal +$items['total_item'];
				////////////////////averiguar si es codigo de nomina o no simplemente lo que no se a codigo de nomina es repuesto
						
				////////////////////////////////////////////////////
				
								
			 }
			
			 return $subtotal; 
		}
///////////////////////
?>


