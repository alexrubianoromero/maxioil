<?php
session_start();
//echo 'id_empresa '.$_SESSION['id_empresa'];
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

if(isset($_REQUEST['aexcel']) && $_REQUEST['aexcel']==1)
{
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
}

?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? 
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
$sql_muestre_ordenes = "select id as No_Orden,
fecha,
placa,
id,
orden,
kilometraje,
estado,
mecanico
from $tabla14  where id_empresa = '".$_SESSION['id_empresa']."' and tipo_orden < '2' and anulado = '0' 
and fecha between '".$_REQUEST['fechain']."' and '".$_REQUEST['fechafin']."'
 order by id desc";

$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);




?>
<Div id="contenidos">
		<header>
			<h2>CONSULTA ORDENES </h2>
		</header>
	
<?php
//include('../colocar_links2.php');
echo '<table border= "1">';
	echo '<tr>';
	echo '<td><h3>No Orden<h3></td><td><h3>Estado</h3></td><td><h3>Linea</h3></td><td><h3>Fecha</h3>
	</td><td><h3>Placa</h3></td><td><h3>Tecnico</h3></td><td><h3>Repuestos</h3></td><td><h3>Mano Obra</h3></td><td><h3>lubricantes</h3></td><td><h3>Subtotal</h3></td><td><h3>Iva</h3></td><td><h3>Total</h3></td>';
	echo '</tr>';
	$total_general_repuestos = 0;
				$total_general_mano_obra = 0;
				$total_general_lubricantes = 0;
				$total_general_de_subtotal = 0;
				$total_general_iva = 0;
				$total_general_gran_total = 0;
		while($ordenes = mysql_fetch_array($consulta_ordenes))
			{
				
				
				
				$nombre_estado = busque_estado($tabla26,$ordenes[6],$_SESSION['id_empresa'],$conexion);
				$sql_traer_tipo  = "select tipo from $tabla4 where placa='".$ordenes['2']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
				$consulta_tipo = mysql_query($sql_traer_tipo,$conexion);
				$linea_tipo = mysql_fetch_assoc($consulta_tipo);
				$linea_tipo = $linea_tipo['tipo'];
				//////////////////////////////////
				$nombre_mecanico = buscar_mecanico($tabla21,$ordenes['7'],$id_empresa,$conexion);
				/////////////////////////////////
				//aqui se definiran los colores a usar
				
				if($ordenes[6] == 0){ echo '<tr class="fila_blanca">'; }
				if($ordenes[6] == 1){ echo '<tr class="fila_amarilla">'; }
				if($ordenes[6] == 2){ echo '<tr class="fila_verde">'; }
				
				echo '<td><h3>'.$ordenes['4'].'</h3></td><td><h3>'.$nombre_estado.'</h3></td><td><h3>'.$linea_tipo.'</h3></td><td><h3>'.$ordenes['1'].'</h3></td><td><h3>'.$ordenes['2'].'</h3></td><td><h3>'.$nombre_mecanico.'</h3></td>';
				
				$subtotal_repuestos = muestre_items_local_repuestos($ordenes['0'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'R');
				echo '<td><h3>'.$subtotal_repuestos.'</h3></td>'; 
				$subtotal_mano_obra = muestre_items_local_repuestos($ordenes['0'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'M');
				echo '<td><h3>'.$subtotal_mano_obra.'</h3></td>'; 
				$subtotal_lubricantes = muestre_items_local_repuestos($ordenes['0'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12,'LT');
				echo '<td><h3>'.$subtotal_lubricantes.'</h3></td>'; 
				$subtotal_general = $subtotal_repuestos + $subtotal_mano_obra + subtotal_lubricantes;
				echo '<td><h3>'.$subtotal_general.'</h3></td>'; 
				$subtotal_iva = traer_suma_iva_items_con_iva($ordenes['0'],$tabla15,$conexion,$_SESSION['id_empresa'],$tabla12);
				echo '<td><h3>'.$subtotal_iva.'</h3></td>'; 
				$gran_total_final = $subtotal_general + $subtotal_iva;
				echo '<td><h3>'.$gran_total_final.'</h3></td>'; 
				/////sumas totales 
				$total_general_repuestos 	 = $total_general_repuestos + $subtotal_repuestos ;
				$total_general_mano_obra	 = $total_general_mano_obra + $subtotal_mano_obra ;
				$total_general_lubricantes 	 = $total_general_lubricantes + $subtotal_lubricantes;
				$total_general_de_subtotal   = $total_general_de_subtotal + $subtotal_general ;
				$total_general_iva 			 = $total_general_iva + $subtotal_iva;
				$total_general_gran_total 	 = $total_general_gran_total + $gran_total_final;	
			}
			//echo '<table border= "1">';
			
echo '</tr>';
				
				/////
				echo '<tr>';
				echo '<td></td><td></td><td></td><td></td><td></td><td></td>';
				echo '<td><h3>'.$total_general_repuestos.'</h3></td>'; 
				echo '<td><h3>'.$total_general_mano_obra.'</h3></td>'; 
				echo '<td><h3>'.$total_general_lubricantes.'</h3></td>'; 
				echo '<td><h3>'.$total_general_de_subtotal.'</h3></td>'; 
				echo '<td><h3>'.$total_general_iva.'</h3></td>'; 
				echo '<td><h3>'.$total_general_gran_total.'</h3></td>';
				echo '</tr>';
echo '</table>';
//////////////
function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)
	{
	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";
	  $consulta_estados = mysql_query($sql_estados,$conexion);
	  $resultado = mysql_fetch_assoc($consulta_estados);
	  $nombre_estado = $resultado['descripcion_estado'];
	  return $nombre_estado;
	}
	
/////////////
function buscar_mecanico($tabla21,$id_mecanico,$id_empresa,$conexion)
{
 $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$id_mecanico."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
					return $nombre_mecanico;
}//fin de la funcion


//////////////////////////////

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

///////////////////////////////
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


?>
	</Div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
