<?php

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();

session_start();



include('../valotablapc.php');
///////////////////
$sql_traer_iva = "select  iva from $tabla17 ";
$consulta_traer_iva = mysql_query($sql_traer_iva,$conexion);
$arreglo_iva = mysql_fetch_assoc($consulta_traer_iva);
$iva_tabla_iva = $arreglo_iva['iva'];

////////////////cilo para colocar valores a loscampos que vienen indefinidos de nombres inventarios
$sql_nombres_items_inventarios = "select * from $tabla24  where decarroomoto = '".$_POST['decarroomoto']."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo '<br>'.$sql_nombres_items_inventarios.'<br>';
$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
$filas_nombres_items = mysql_num_rows($consulta_nombres_items);

while ($id_items = mysql_fetch_assoc($consulta_nombres_items))
{
   //echo '<br>'.$id_items['id_nombre_inventario'];
   
   if ($_POST[$id_items['id_nombre_inventario']]== 1)
   {$_POST[$id_items['id_nombre_inventario']] = 'SI';}
}

//exit();
////////////

if ($_POST['radio']== 'undefined'){$_POST['radio'] = 0;}
if ($_POST['antena']== 'undefined'){$_POST['antena'] = 0;}
if ($_POST['repuesto']== 'undefined'){$_POST['repuesto'] = 0;}
if ($_POST['herramienta']== 'undefined'){$_POST['herramienta'] = 0;}

/////////////////


///////////////

$sql_maxima_remision  = "select contaor from $tabla10  where id_empresa = '".$_SESSION['id_empresa']."'  ";
         $maximoid = mysql_query($sql_maxima_remision,$conexion);
         $maximoid = mysql_fetch_assoc($maximoid);
		 
		 $ordenpan = $maximoid['contaor'] + 1 ;  
				$_SESSION['ordenpan']= $ordenpan;


////////////////////////////////////////
$sql_actualizar_contaor = "update $tabla10 set  contaor = '".$ordenpan."'  where   id_empresa = '".$_SESSION['id_empresa']."' "; 
$consulta = mysql_query($sql_actualizar_contaor,$conexion);
//////////////////////////////////////
//aqui se crea el registro de la orden 
$sql_grabar_orden = "insert into $tabla14 
(orden,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros,
	iva,id_empresa,estado,kilometraje,mecanico,tipo_orden,kilometraje_cambio,fecha_entrega,notificacion
	,gasolina,usuario_creacion,cotiza,documentos_recibidos,tipo_medida_kms_millas_horas) 
values (
'".$ordenpan."',
'".$_POST['placa']."',
'".$_POST['clave']."',
'".$_POST['fecha']."',
'".$_POST['descripcion']."',
'".$_POST['radio']."',
'".$_POST['antena']."',
'".$_POST['repuesto']."',
'".$_POST['herramienta']."',
'".$_POST['otros']."',
'".$iva_tabla_iva."',
'300',
'0',
'".$_POST['kilometraje']."',
'".$_POST['mecanico']."',
'1',
'".$_POST['kilometraje_cambio']."',
'".$_POST['fecha_entrega']."',
'".$_POST['notificacion']."',
'".$_POST['gasolina']."',
'".$_SESSION['id_usuario']."',
'".$_POST['valor_estimado']."',
'".$_POST['documentos_recibidos']."',
'".$_POST['tipo_medida']."'
)";
//echo '<br>'.$sql_grabar_orden.'<br>';
// el  que se graba en tipo_orden de ordenes indica que es una orden normal 
//porque cuando se graba una venta ya se indica un tipo de orden 2 
//esto para evitar confucion entre un numero de orden normal y un numero de orden de venta que se crea con el numero de factura
//echo '<br>'.$sql_grabar_orden;

$consulta_grabar = mysql_query($sql_grabar_orden,$conexion); 




//ahora se debe actulizar el numero del consecutivo del campo contaor de  la tabla empresa 
//ahora despues de grabar la orden con el consecutivo que se trae de empresa 
///se debe actualizar el numero del id de la orden para los items creados para que los items queden bien creados con el numero del id de la orden
$sql_traer_id_orden = "select max(id) as id  from $tabla14 where placa = '".$_POST['placa']."'   and id_empresa = '".$_SESSION['id_empresa']."'  ";
//echo '<br>'.$sql_traer_id_orden;
$consulta_id_orden = mysql_query($sql_traer_id_orden,$conexion);
$id_orden = mysql_fetch_assoc($consulta_id_orden);
/*
echo '<pre>';
print_r($id_orden);
echo '</pre>';
*/

//echo "<br>id orden asignado= ".$id_orden['id'];
//despues de obtener el id vamoa a actulizarlo para los items de la orden  osea lo reemplazamos para todos los items que 
//tengan el numero de la orden $_POST['orden_numero']  ny de la empresa respectiva y les colocamnos el id de la orden   en el campo no_factura porque  como el programa 
//es multicliente la idea es que todos los clientes tendras su numeroacion de ordenes y de facturas pero el progrma se basara en los id respectivos

/*
$sql_actualizar_id_orden_item = "update $tabla15  set     no_factura = '".$id_orden['id']."'  where   no_factura = '".$_POST['orden_numero']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo '<br>'.$sql_actualizar_id_orden_item;
$consulta_actualizar_items = mysql_query($sql_actualizar_id_orden_item,$conexion) ;
*/
///////////////////////////////////////////////////////// TRANSLADAR ITEMS DE TEMPORAL A DEFINITIVO
////CONSULTA PARA TRAER LOS ITEMS DE TEMPORAL Y LUEGO CON UN CICLO LOS VAMOS GUARDANDO UNO A UNO EN LA UBICACION DEFINITIVA

$sql_traer_items_temporal = "select * from $tabla18    where  no_factura =  '".$_POST['orden_numero']."'   and id_empresa = '".$_SESSION['id_empresa']."' order by id_item ";

$consulta_temporal_definitivo = mysql_query($sql_traer_items_temporal,$conexion);
while($items  =  mysql_fetch_array($consulta_temporal_definitivo))
		{
			$sql_grabar_items = " insert into $tabla15   (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado) 
			values ('".$id_orden['id']."','".$items[2]."','".$items[3]."','".$items[4]."','".$items[5]."','".$items[7]."','".$items[8]."','0')";
			$consulta_trasladar_item = mysql_query($sql_grabar_items,$conexion);
			//falta actualizar los valores de inventario;
			//tengo que traer el valor existente en la base 
			$sql_valor_existente = "select codigo_producto,cantidad from $tabla12 where codigo_producto =  '".$items[2]."'   and id_empresa = '".$_SESSION['id_empresa']."'    ";	
			//echo '<br>'.$sql_valor_existente;
			$consulta_valor_inventario = mysql_query($sql_valor_existente,$conexion); 
			$valor_actual_inventario = mysql_fetch_assoc($consulta_valor_inventario);

			$valor_final_inventario = $valor_actual_inventario['cantidad']  -  $items[4];
			$sql_actualizar_inventario = "update $tabla12 set cantidad = '".$valor_final_inventario."'   
					 where codigo_producto = '".$items[2]."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";

					$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);  
		} // temina el proceso de los items
///////////////////////////////////////////////////////////
//grabar un item en blanco para que no se oculte la parte de inventario cuando queda sin items y se le dice agragar
$sql_grabar_items = " insert into $tabla15   (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado) 
			values ('".$id_orden['id']."','','','','','','".$items[8]."','0')";
			$consulta_trasladar_item = mysql_query($sql_grabar_items,$conexion);		
		
////////////////////////////////////////////////////////
		///////////////////////hay que borrar la tabla temporal 
		$sql_borrar_temporal = "delete from $tabla18 where id_empresa = '".$_SESSION['id_empresa']."' ";
		$consulta_borrar = mysql_query($sql_borrar_temporal,$conexion);

		
//////////////////////////////////////////////////////////////
////////ahora para las ordenes de renault debo guardar los valores adicionales de los inventarios 
////////traemos el numero de items adicionales de la empresa 
/////revisamos los datos de la empresa 

$sql_datos_empresa = "select ruta_imagen,nombre,tipo_taller,identi,telefonos,direccion from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_datos_empresa,$conexion);
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$sql_nombres_items_inventarios = "select * from $tabla24  where decarroomoto = '".$datos_empresa['tipo_taller']."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo 'consulta<br>'.$sql_nombres_items_inventarios.'<br>';
$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
$filas_nombres_items = mysql_num_rows($consulta_nombres_items);
//$nombres2_items = get_table_assoc($consulta_nombres_items);
$contador = 0;
//$id_orden['id'];
//echo 'pasooooo11111111111111111111111';
while ($nombres2_items = mysql_fetch_assoc($consulta_nombres_items))
{
	//echo 'pasooooo11111111111111111111111';
	//echo '<br>'.$nombres2_items['nombre'];
	$id_item = $nombres2_items['id_nombre_inventario'];
	//echo '<br>valor del id_item'.$id_item.'fin de valor ';

				//echo '<br>id_nombre_inventario'.$nombres2_items['id_nombre_inventario'].'valor  de post en id_item'.$_POST[$id_item];
				$palabra_cantidad = 'cantidad_'.$id_item;
				$sql_grabar_item_inventario = "insert into $tabla25 
				(id_empresa,id_orden,id_nombre_inventario,valor,cantidad) 
				values ('".$_SESSION['id_empresa']."','".$id_orden['id']."','".$id_item."','".$_POST[$id_item]."','".$_POST[$palabra_cantidad]."')";
				//echo '<br>la consulta'.$sql_grabar_item_inventario.'<br>';
				//echo '<br>123post'. $_POST[$id_item].'valor del nombre'.$nombres2_items['nombre'];
				// si existe este itemen el post pues grabelo en la tabla  de relacion de orden con el inventario
				$consulta_grabar_valores_items = mysql_query($sql_grabar_item_inventario,$conexion);
				
			
}//// fin de while ($contador <  $filas_nombres_items)
/*
$cuerpo_correo = 'Atentamente se informa que se creo la roden de trabajo en el taller';
$cuerpo_correo .= 'de acuerdo a la siguiente informacion';

$cuerpo_correo .=  'No orden :'.$ordenpan.' placa'.$_POST['placa'];
$cuerpo_correo .=  'Trabajo a realizar '.$_POST['descripcion'];
*/
/*
$cuerpo_correo = " 
Hemos creado una orden con la siguiente informaci�n.

Orden Numero : ".$ordenpan."
Placa: ".$_POST['placa']."
";
*/


/*
$body = '
<html>
<head>
<style>
 #cuerpo{
  color:black;
  font-size:15px;
 }
</style>
</head>
<body id="cuerpo"  >
<h3  style="color:blue;">�Te damos la bienvenida a MOTORCYCLE ROOM!</h3>
<p id="cuerpo">
De antemano queremos agradecer tu confianza en nosotros, y en respuesta a ello hemos dispuesto de los mejores t�cnicos, insumos y experiencia, para satisfacer completamente tus requerimientos hacia nuestro servicio. 
<br><br>
Hemos creado una orden con la siguiente informaci�n.
</p>
<p>
Placa: '.$_POST['placa'].' Orden Numero : '.$ordenpan.' 
 <br>
<span>TRABAJO A REALIZAR <span>: 
'.$_POST['descripcion'].'
<br>
<div id="cuerpo">
Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes contactarnos!
<br>
MOTORCYCLE ROOM <br>
Taller Multimarca <br>
3142536548 
<br>
O env�anos un E-mail a motorcycleroom@gmail.com <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
</div>
</p>
</body>
</html>
';
 y en respuesta a ello hemos dispuesto de los mejores t�cnicos, insumos y experiencia, para satisfacer completamente tus requerimientos hacia nuestro servicio. 
o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes contactarnos!

*/

//   buscar la placa  y si esta mas de una vez no se envia mensaje de bienvenida
// si solo esta una vez osea es la primera vez, se envia mensaje de bienvenida 

$body = '';


$sql_buscar_ordenes_placa = "select * from $tabla14 where placa =  '".$_REQUEST['placa']."'   ";
$con_ordenes_Placa = mysql_query($sql_buscar_ordenes_placa,$conexion);
$filas_ordenes_placa = mysql_num_rows($con_ordenes_Placa);

if($filas_ordenes_placa  < 2)
{
      $body .='Te damos la bienvenida a KAYMO SOFTWARE <br>
De antemano queremos agradecer tu confianza en nosotros, <br> ';
}
else{
	$body .='Es todo un placer contar con tu confianza y poderte atender nuevamente <br>';
}


$body .='

Hemos creado una orden con la siguiente informacion! <br>
Placa: '.$_POST['placa'].' Orden No : '.$ordenpan.' <br>

TRABAJO A REALIZAR : '.$_POST['descripcion'].' <br>

TALLER DE MOTOS<br>
Taller: KAYMO  <br>
E-mail:  alexrubianoromero@gmail.com <br>
Direccion:  Bogota '; 

/*
$body="prueba envio correo11:24";
*/
/*
$cuerpo_correo="crecion de orden";
*/
//////////////////////////////////////////////////////////////////	
/////////////////enviar el correo 
//mail($_REQUEST['email'],'MOTORCYCLE ROOM',$body,$headers); 
// include('enviar_correo.php');
include('enviar_correo_phpmailer.php');

if($_REQUEST['desdemovil'] == '1'){
    ?>
     <div id="div_orden_grabada">
		 <h2>ORDEN No <?php echo $ordenpan; ?> CREADA</h2>
		 <br>
		 <button id="btnAdicionarItems" >Adicionar_Items</button>
	 </div>
	<?php
}
else{
	echo "<br><br><br><h2>ORDEN No ".$ordenpan."   GRABADA </h2>";
	echo '<br><h2><a href="orden_modificar_honda.php?idorden='.$id_orden['id'].'">ADICIONAR ITEMS A ESTA ORDEN DE ENTRADA</a></h2>';
	//include('../colocar_links2.php');
}	

?>