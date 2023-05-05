<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$valor_tabla_iva = traer_iva($tabla17,$conexion);
//echo '<br>iva'.$valor_tabla_iva;


$ancho_tabla = '95%';

$sql_placas = "select cli.nombre as nombrecli,cli.identi as clidenti,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,car.chasis,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,
 e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa,o.kilometraje_cambio,e.tipo_taller,cli.email,e.condiciones_orden,
 o.fecha_entrega, o.fecha_salida , e.email_empresa,e.razon_social,o.abono,cli.entidad,car.sigla
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa)
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'   and   o.id_empresa = '".$_SESSION['id_empresa']."'   ";
 //echo '<br>'.$sql_placas.'<br>';
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
$datos_orden = mysql_fetch_assoc($datos);
/*
echo '<pre>';
print_r($datos_orden);
echo '</pre>';
*/
$ancho_tabla = "95%";

if($datos_orden['mecanico']== '')
	{
		$nombre_mecanico = 'MECANICO NO ASIGNADO';
	}
else {
        $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$datos_orden['mecanico']."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
	}
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<!--<meta charset="UTF-8">-->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
<!--

#Layer3 {
	position:relative;
	width:95%;
	height:89px;
	z-index:2;
}
.style1 {font-weight: bold}
#Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
}
#Layer2 {
	position:absolute;
	width:274px;
	height:115px;
	z-index:1;
	left: 788px;
	top: 35px;
}

-->
    </style>
</head>
<body>
<div = "contenidos">
<br>
<table width="<?php echo $ancho_tabla; ?>" border="0">
  <tr>
    <td width="17%"><img src="../logos/twister.png" width="210" height="168"></td>
    <td width="46%"><div align="center"><img src="../imagenes/honda_orden/todosjuntos.jpg" width="422" height="137"></div></td>
    <td width="37%"><div id="Layer2">
      <table width="64%" height="90" border="1">
        <tr>
          <td><div align="center">ORDEN DE TRABAJO </div></td>
          </tr>
        <tr>
          <td height="32" align="center"><H40><?php echo $datos_orden['orden']  ?></H40></td>
          </tr>
        <tr>
          <td height="79"><div align="center">FECHA</div></td>
          </tr>
        <tr>
          <td height="79"><h40>
            <div align="center"><?php echo $datos_orden['fecha']  ?></div>
          </h40></td>
          </tr>
      </table>
    </div></td>
  </tr>
</table>

<table width="95%" border="1">
  <tr>
    <td><div align="center">ORDEN DE TRABAJO </div></td>
    </tr>
</table>

<table width="95%" border="1">
  <tr>
    <td width="12%">CLIENTE</td>
    <td width="53%"><?php echo $datos_orden['nombrecli']  ?></td>
    <td width="19%">FECHA</td>
    <td width="16%"><?php echo $datos_orden['fecha']  ?></td>
  </tr>
  <tr>
    <td>ENTIDAD</td>
    <td><?php echo $datos_orden['entidad']  ?></td>
    <td>TELEFONO</td>
    <td><?php echo $datos_orden['telefono']  ?></td>
  </tr>
  <tr>
    <td>DIRECCION</td>
    <td><?php echo $datos_orden['direccion']  ?></td>
    <td>ORDEN No </td>
    <td><?php echo $datos_orden['orden']  ?></td>
  </tr>
</table>
<table width="95%" border="1">
  <tr>
    <td colspan="6"><div align="center">DATOS DE LA MOTOCICLETA </div></td>
    </tr>
  <tr>
    <td width="12%">MARCA</td>
    <td colspan="2"><?php echo $datos_orden['marca']  ?></td>
    <td width="11%">TIPO</td>
    <td colspan="2"><?php echo $datos_orden['tipo']  ?></td>
    </tr>
  <tr>
    <td>CHASIS</td>
    <td width="24%"><?php echo $datos_orden['chasis']  ?></td>
    <td width="18%">COLOR</td>
    <td><?php echo $datos_orden['color']  ?></td>
    <td width="19%">SIGLA</td>
    <td width="16%"><?php echo $datos_orden['sigla']  ?></td>
  </tr>
  <tr>
    <td>KILOMETRAJE</td>
    <td><?php echo $datos_orden['kilometraje']  ?></td>
    <td>MODELO</td>
    <td><?php echo $datos_orden['modelo']  ?></td>
    <td>PLACA</td>
    <td><?php echo $datos_orden['placa']  ?></td>
  </tr>
</table>
<table width="95%" border="1">
  <tr>
    <td colspan="5"><div align="center">DESCRIPCION DEL TRABAJO </div></td>
    </tr>
  <tr>
    <td>CANT </td>
    <td>REPUESTOS</td>
    <td>IVA</td>
    <td>V/UNITARIO</td>
    <td>VALOR TOTAL </td>
  </tr>

<?php
$subtotal = muestre_items_local_repuestos($_REQUEST['idorden'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'R');
$subtotal_repuestos1 = $subtotal;
?>
</table>
<table width="95%" border="1">
  <tr>
    <td colspan="5"><div align="center">MANO DE OBRA </div></td>
    </tr>

<?php
$subtotal = muestre_items_local_repuestos($_REQUEST['idorden'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'MO');
$subtotal_mano_obra = $subtotal;
//echo '<br>subtotal mano de obra='.$subtotal_mano_obra;
?>
</table>
</table>
<table width="95%" border="1">
  <tr>
    <td colspan="5"><div align="center">LUBRICANTES Y TECNOMECANICA </div></td>
    </tr>

<?php
$subtotal = muestre_items_local_repuestos($_REQUEST['idorden'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'LT');
$subtotal_lubricantes=$subtotal ;
?>
</table>
<table width="95%" border="1">
  <tr>
    <td width="70%">&nbsp;</td>
    <td width="19%">Valor Repuestos </td>
    <td width="11%" align = "right"><?php  echo number_format($subtotal_repuestos1, 0, ',','.') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Valor Mano de Obra </td>
    <td " align = "right"><?php  echo number_format($subtotal_mano_obra, 0, ',', '.') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Valor Lubricantes </td>
    <td " align = "right"><?php  echo number_format($subtotal_lubricantes, 0, ',', '.') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>SUBTOTAL</td>
	<?php  
	
	
$subtotal_repuestos1_iva = ($subtotal_repuestos1*$datos_orden['iva'])/100;
$subtotal_mano_obra_iva  = ($subtotal_mano_obra*$datos_orden['iva'])/100;

    
	//$subtotal_iva  =  $subtotal_repuestos1_iva +  $subtotal_mano_obra_iva + $subtotal_lubricantes ; 
	$subtotal_iva = traer_suma_iva_items_con_iva($_REQUEST['idorden'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12);
	$subtotal123  =  $subtotal_repuestos1 +  $subtotal_mano_obra + $subtotal_lubricantes ; 
	?>
    <td " align = "right"><?php  echo number_format($subtotal123, 0, ',', '.') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>IVA</td>
    <td  align="right"><?php  echo number_format($subtotal_iva, 0, ',', '.') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>TOTAL </td>
	<?php
	$gran_total_final =  $subtotal123 + $subtotal_iva;
	
	?>
    <td align = "right"><?php  echo number_format($gran_total_final, 0, ',', '.') ?></td>
  </tr>
</table>
<table width="95%" border="0">
  <tr>
    <td align = "center"><?php echo 'Nota: '.$datos_orden['condiciones_orden'];  ?></td>
  </tr>
  <tr>
  <td align = "center"><?php echo 'Direccion: '.$datos_orden['direccion_empresa'].'-'.$datos_orden['telefonos_empresa'];  ?></td>
  </tr>
 </table> 



</div>
 
<?php

//////////////////////////////
// esta funcion la utilizo cuando se va a facturar por esto ya tiene un formato predefinido para que cuadre al momento de mostrar la factura e imprimirla 
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
///////////////////////////

//////////////////////////
// esta funcion me trae la suma de los repuestos de los items asociados a la orden 
function suma_repuestos_items($orden,$tabla,$conexion,$id_empresa,$tabla12)
		{
				$subtotal = 0;
				$valor_repuestos=0;
				$valor_mano = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  and anulado < 1 order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
				

				
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			/*
				echo '<tr>
			     
                <td >'.$items['codigo'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td align="center"> '.$items['cantidad'].'</td>
    			<td align="right">'.$items['valor_unitario'].'</td>
   			    <td align="right">'.$items['total_item'].'</td>
					</tr>
				';
				*/
				//<td width="34">'.$i.'</td>
				$subtotal = $subtotal + $items['total_item'];
				////////////////////averiguar si es codigo de nomina o no simplemente lo que no se a codigo de nomina es repuesto
				$sql_confirmar_nomina = "select nomina from  $tabla12 where id_empresa = '".$id_empresa."'  and codigo_producto = '".$items['codigo']."'  and nomina = '1' ";
				$consulta_nomina = mysql_query($sql_confirmar_nomina,$conexion);
				$filas_nomina = mysql_num_rows($consulta_nomina);
					if($filas_nomina > 0)
						{
							$valor_mano = $valor_mano + $items['total_item'];					
						}
					else{
							$valor_repuestos = $valor_repuestos + $items['total_item'];
					    } 	
						
				////////////////////////////////////////////////////
				
								
			 }
			
			 return $valor_repuestos; 
		}
///////////////////////////
function suma_manos_obra($orden,$tabla,$conexion,$id_empresa,$tabla12)
		{
				$subtotal = 0;
				$valor_repuestos=0;
				$valor_mano = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  and anulado < 1 order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
				

				
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			/*
				echo '<tr>
			     
                <td >'.$items['codigo'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td align="center"> '.$items['cantidad'].'</td>
    			<td align="right">'.$items['valor_unitario'].'</td>
   			    <td align="right">'.$items['total_item'].'</td>
					</tr>
				';
				*/
				//<td width="34">'.$i.'</td>
				$subtotal = $subtotal + $items['total_item'];
				////////////////////averiguar si es codigo de nomina o no simplemente lo que no se a codigo de nomina es repuesto
				$sql_confirmar_nomina = "select nomina from  $tabla12 where id_empresa = '".$id_empresa."'  and codigo_producto = '".$items['codigo']."'  and nomina = '1' ";
				$consulta_nomina = mysql_query($sql_confirmar_nomina,$conexion);
				$filas_nomina = mysql_num_rows($consulta_nomina);
					if($filas_nomina > 0)
						{
							$valor_mano = $valor_mano + $items['total_item'];					
						}
					else{
							$valor_repuestos = $valor_repuestos + $items['total_item'];
					    } 	
						
				////////////////////////////////////////////////////
				
								
			 }
			
			 return $valor_mano; 
		}

function traer_iva($tabla17,$conexion)
		{
				$sql_iva = "select iva from $tabla17  ";
				$consulta_iva = mysql_query($sql_iva,$conexion);
				$valor_iva = mysql_fetch_assoc($consulta_iva);
				$valor_iva = $valor_iva['iva'];
				return $valor_iva;
		}
////////////////////////////////funcion para traer la suma del iva de los items de la orden

function traer_suma_iva_items_con_iva($orden,$tabla,$conexion,$id_empresa,$tabla12)
		{
				$subtotal = 0;
				$valor_repuestos=0;
				$valor_mano = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."' and anulado < 1  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
				

				
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			/*
				echo 
				
				'<tr>
				<td >'.$items['cantidad'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td  > '.$items['iva'].'</td>
    			<td align="right">'.number_format($items['valor_unitario'], 0, ',', '.').'</td>
   			    <td align="right">'.number_format($items['total_item'], 0, ',', '.').'</td>
					</tr>
				';
				*/
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
				$subtotal = $subtotal +$items['valor_iva'];
				////////////////////averiguar si es codigo de nomina o no simplemente lo que no se a codigo de nomina es repuesto
						
				////////////////////////////////////////////////////
				
								
			 }
			
			 return $subtotal; 
		}
///////////////////////////

//////////////////////////////
?>
<br>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>  
