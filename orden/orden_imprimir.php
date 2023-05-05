<?php
session_start();
include('../valotablapc.php');  
include('../funciones.php'); 
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>imprimir orden</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
#div_no_orden{
position:relative;
left:30%
width:20%;
height:20px;
border:1px solid;
padding:10px;
}
#datos_basicos{
border:1px solid;
}
#documentos{
border:1px solid;
}
#condiciones{
font-size:8px;
}
</style>
</head>
<body>
<?php

include('../numerosALetras.class.php');
  $n = new numerosALetras ( 159 ) ; 
//echo $n -> resultado ;
//$letras = $n -> resultado ;
//echo '<br>letras'.$letras; 

/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
*/

//exit();






/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();


$sql_empresa = "select * from $tabla10 where id_empresa = ".$_SESSION['id_empresa']." ";
$consulta_empresa = mysql_query($sql_empresa,$conexion); 
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$ruta_imagen = '../logos/'.$datos_empresa['ruta_imagen'];

/*
echo '<pre>';
print_r($datos_empresa);
echo '</pre>';
exit(); 
*/

$razon_social = $datos_empresa['razon_social'];
// die($razon_social);
$sql_placas = "select cli.nombre as nombre ,cli.identi as identi ,cli.direccion as direccion,cli.telefono as telefono
,cli.email ,car.placa as placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.kilometraje_cambio,o.documentos_recibidos,o.fecha_entrega,o.tipo_medida_kms_millas_horas as tipo_medida
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
 where o.id = '".$_GET['idorden']."' ";
 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
//$datos = get_table_assoc($datos);
$arreglo_datos = mysql_fetch_assoc($datos);

$sql_items_orden = "select * from $tabla15 where no_factura = '".$_GET['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);

$sql_mecanico = "select nombre from $tabla21 where idcliente = '".$datos[0]['mecanico']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$nombre_mecanico = mysql_query($sql_mecanico,$conexion);
$nombre_mecanico = mysql_fetch_assoc($nombre_mecanico);
$nombre_mecanico = $nombre_mecanico['nombre'];

/*
echo '<pre>';
print_r($arreglo_datos);
echo '</pre>';
exit();
*/



//$fechapan =  time();
////////////////////////////////////////////////
$ancho_tabla = "100%";
$tamano_encabezado = "15px";
$tamano_letra = "10px";
$tamano_repuestos = "12px";

if($arreglo_datos['tipo_medida'] == 1){$medida = "KMS" ;}
if($arreglo_datos['tipo_medida'] == 2){$medida = "MILLAS" ;}
if($arreglo_datos['tipo_medida'] == 1){$medida = "HORAS" ;}
?>
<table width="<?php echo $ancho_tabla; ?>" border="0" style="font-size:<?php echo $tamano_encabezado; ?>">
  <tr>
    <td><div align="center"><img src="<?php  echo $ruta_imagen    ?>" width="108" height="80"></div></td>
    <td><div align="center">Servicio especializado
	    <br>
	    <?php echo $datos_empresa['direccion'];?>
	    <br>
	    Telefonos: <?php echo $datos_empresa['telefonos'];?>
	    <br>
	    <?php echo $datos_empresa['email_empresa'];?>
	    <br>
	    Bogota Colombia
	
	</div></td>
    <td><div align="center">ORDEN DE TRABAJO
	    <br>
    </div>      <div id="div_no_orden">
        <div align="center"><?php echo $arreglo_datos['orden'];?></div>
    </div></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla; ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>FECHA RECIBIDA:<?php echo $arreglo_datos['fecha'];?> </td>
    <td>FECHA ENTREGA:<?php echo $arreglo_datos['fecha_entrega'];?> </td>
  </tr>
</table>

<table width="<?php echo $ancho_tabla; ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>NOMBRE:</td>
    <td><?php echo $arreglo_datos['nombre'];?></td>
    <td>DIRECCION</td>
    <td><?php echo $arreglo_datos['direccion'];?></td>
    <td>DOCUMENTOS RECIBIDOS </td>
  </tr>
  <tr>
    <td>CORREO:</td>
    <td><?php echo $arreglo_datos['email'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td rowspan="3"><textarea name="documentos_recibidos" cols="30" rows="4"><?php echo $arreglo_datos['documentos_recibidos'];?></textarea></td>
  </tr>
  <tr>
    <td>TELEFONO:</td>
    <td><?php echo $arreglo_datos['telefono'];?></td>
    <td>MOTO</td>
    <td><?php echo $arreglo_datos['tipo'];?></td>
  </tr>
  <tr>
    <td>MODELO:<?php echo $arreglo_datos['modelo'];?></td>
    <td>PLACA: <?php echo $arreglo_datos['placa'];?></td>
    <td><?php echo $medida; ?></td>
    <td><?php echo $arreglo_datos['kilometraje'];?></td>
  </tr>

</table>
<?php  

$dato_saldo_orden = consulta_assoc_orden($tabla14,'id',$_REQUEST['id_orden'],$conexion);

 ?>
<table width="<?php echo $ancho_tabla; ?>" border="1" style="font-size:<?php echo $tamano_repuestos; ?>">
  <tr>
    <td>SALDO ORDEN  <?php echo $dato_saldo_orden['saldo'] ?> </div></td>
  </tr>
  <tr>
    <td><div align="center">DESCRIPCION - TRABAJOS POR REALIZAR</div></td>
  </tr>
  <tr>
    <td><textarea name="textarea" cols="95%" rows="10"><?php echo $arreglo_datos['observaciones'];?></textarea></td>
  </tr>
</table>
<br>
<table width="<?php echo $ancho_tabla; ?>" border="1" style="font-size:<?php echo $tamano_repuestos; ?>">
  <tr>
    <td><div align="center">CANT.</div></td>
    <td><div align="center">REPUESTOS Y ACCESORIOS </div></td>
    <td><div align="center">VR.UNITARIO</div></td>
    <td><div align="center">VR.TOTAL</div></td>
  </tr>
 <?php
 $subtotal_mano_de_obra = muestre_items_local_parametro($_GET['idorden'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'1');
  $subtotal_repuestos = muestre_items_local_parametro($_GET['idorden'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'0');
 
completar_espacios(15);
$total_orden = $subtotal_mano_de_obra + $subtotal_repuestos;
 
 ?>
</table>
<table width="<?php echo $ancho_tabla; ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td width="601" rowspan="4"><div id="condiciones">CONTRATO DE SERVICIO<BR>
	Autorizo a: <?php echo $razon_social;  ?>; a realizar las reparaciones aqui detalladas y suministrar los repuestos necesarios.
	<br><?php echo $razon_social;  ?> no responde en caso que las autoridades soliciten documentos de propiedad y estos no sean entregados oportunamente.
	<br><?php echo $razon_social;  ?> queda facultado para retener el vehiculo objeto de esta reparacion, hasta que los valores causados por las mismas sean cancelados en su totalidad. si despues de tres(3) dias de terminada la reparacion del vehiculo, este no es retirado , 
	SPORTRACING cobrara por concepto de ocupacion de espacio de trabajo el valor de un(1) salario minimo diario vigente, igualmente cuando la permanencia en el establecimiento sea por responsabilidad del cliente.</div>
	</td>
    <td width="132">MANO DE OBRA </td>
    <td width="146" align="right"><?php  echo '$'.number_format($subtotal_mano_de_obra, 0, ',', '.') ?></td>
  </tr>
  <tr>
    <td>REPUESTOS</td>
    <td align="right"><?php  echo '$'.number_format($subtotal_repuestos, 0, ',', '.') ?></td>
  </tr>
  <tr>
    <td>LAVADO</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>TOTAL$</td>
    <td  align="right"><?php  echo '$'.number_format($total_orden, 0, ',', '.') ?></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla; ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td><div align="center"><br>
        <br> <br>
        ________________________<br>
    FIRMA AUTORIZADA</div></td>
    <td><div align="center"> <br><br>
        ________________________<br>
    MECANICO</div></td>
    <td><div align="center">
	 Aceptada<br><br>
        ________________________<br>
    C.C.
	</div></td>
  </tr>
</table>



</body>
</html>

<?php

function muestre_items_local_parametro($orden,$tabla15,$conexion,$id_empresa,$tabla12,$parametro)
		{
				$subtotal = 0;
				$valor_repuestos=0;
				$valor_mano = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select io.id_empresa,io.cantidad,io.descripcion,io.valor_unitario,io.total_item,io.codigo
				from  $tabla15 io			
				where io.no_factura = '".$orden."' 
				and io.id_empresa = '".$id_empresa."' and anulado < 1 " ;
				$sql_items_orden  .= " order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_array($consulta_items))
	 	{
			 $i++;
			 $sql_buscar_producto = "select nomina from $tabla12  where codigo_producto = '".$items['codigo']."' ";
			 $consulta_producto = mysql_query($sql_buscar_producto,$conexion);
			 $filas_producto = mysql_num_rows($consulta_producto);
			 if($filas_producto > 0){$arreglo_producto = mysql_fetch_assoc($consulta_producto);}
			 
			 if($parametro ==1)
					{		 
					 if($filas_producto > 0 && $arreglo_producto['nomina']==1  )
						{
					 
						echo 	
						'<tr>
						<td width ="10%">'.$items['cantidad'].'</td>
						<td  > '.$parametro.'-'.$items['descripcion'].'</td>
						<td align="right">'.number_format($items['valor_unitario'], 0, ',', '.').'</td>
						<td align="right">'.number_format($items['total_item'], 0, ',', '.').'</td>					
						</tr>
						';
						$subtotal = $subtotal +$items['total_item'];
						
						} //fin delif($filas_producto > 0 && $arreglo_producto['nomina']==1  )	
					}  //fin de if($parametro ==1)	
				else	//osea si paramtro == 0 osea si no es nomina
					{
					  if($filas_producto < 1 || $arreglo_producto['nomina']==0  )
					  	{
					  	echo 	
						'<tr>
						<td width ="10%">'.$items['cantidad'].'</td>
						<td  > '.$items['descripcion'].'</td>
						<td align="right">'.number_format($items['valor_unitario'], 0, ',', '.').'</td>
						<td align="right">'.number_format($items['total_item'], 0, ',', '.').'</td>					
						</tr>
						';
						$subtotal = $subtotal +$items['total_item'];
					  	}
					}//fin del else	
						
								
			}//fin del while
			
			
			
			
			
			 return $subtotal; 
		}//fin de la funcion 

function completar_espacios($numero_items)
	{    
	     $repeticiones = 19-$numero_items['total'];
				for ($i = 1 ; $i<= $repeticiones;$i++)
						{							  
						 echo '
							  <tr>
								<td width="11%">
								  <div align="center">&nbsp;</div>
								</td>
								<td width="38%">
								  <div align="center">&nbsp;</div>
								</td>
								<td width="13%">
								  <div align="center">&nbsp; </div>
								</td>
								<td width="13%">
								  <div align="center">&nbsp; </div>
								</td>
								
							  </tr>';
							}// fin de ciclo for 
	}// fin de la funcion
	
	 function  consulta_assoc_orden($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }


?>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
