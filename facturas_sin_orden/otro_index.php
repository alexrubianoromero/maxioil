<?php
session_start(); 
require_once '../../tcpdf/tcpdf.php';
include('../valotablapc.php');
//include('../funciones.php'); 
function completar_espacios($numero_items)
	{    
	     $repeticiones = 7-$numero_items['total'];
				for ($i = 1 ; $i<= $repeticiones;$i++)
						{							  
						
						 $html .= '
							  <tr>
								<td width="11%"><h8>
								  <div align="center">&nbsp;</div>
								</h8></td>
								<td width="38%"><h8>
								  <div align="center">&nbsp;</div>
								</h8></td>
								<td width="13%"><h8>
								  <div align="center">&nbsp; </div>
								</h8></td>
								<td width="13%"><h8>
								  <div align="center">&nbsp; </div>
								</h8></td>
								<td width="5%"><h8>
								  <div align="center">&nbsp;</div>
								</h8></td>
							  </tr>';
							  
							  
							}// fin de ciclo for 
	}// fin de la funcion completar espacios
///////////////////////////////////////////

function traer_subtotal($orden,$tabla,$conexion,$id_empresa,$resolucion)
		{
				//echo '<br>'.$resolucion;
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_assoc($consulta_items))
	 		 {
			 $i++;
	 			$html .= '<tr>
			     
                <td width="38"><div align="center"><h8>'.$items['codigo'].'</h8></div></td>
    			<td width="60" ><h8> '.$items['descripcion'].'</h8></td>
				<td width="87"><h8><div align = "right"> '.'$'.number_format($items['valor_unitario'], 0, ',', '.').'</div></h8></td>
				<td width="60" align="center" ><h8> '.$items['cantidad'].'</h8></td>';
				 $total_del_item = $items['total_item'];
    			//echo '<td width="82"><h8><div align = "right">'.'$'. number_format($total_del_item, 0, ',', '.').'</div></h8></td>';
				if ($items['iva']==1)
						{ $valor_iva = '16'; }
						else {$valor_iva = '0';}
				     //echo '<td width="82"><h8><div align = "right">'; 
				 
				 
			    if ($resolucion == 1)		
					{  //echo $valor_iva.'%';
					       
						 if ($items['iva']==1) 
						  {
						
						    $html .= '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item_con_iva'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
						else 	
							{
							
								$html .= '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
				    }
				else
					{
					$html .=  '</div></h8></td>
   			    		<td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						</tr>
						';	
					}			
				//<td width="34">'.$i.'</td>
				if($resolucion =='0')
					{ $subtotal = $subtotal + $total_del_item;}
				else			
					{ $subtotal = $subtotal + $items['total_item'];}
			 }
			 return $subtotal; 
		}


/////////////////////////////////////

///////////////////////////////////////////

function muestre_items_nuevo_pdf($orden,$tabla,$conexion,$id_empresa,$resolucion)
		{
				$html2= '';
				//echo '<br>'.$resolucion;
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_assoc($consulta_items))
	 		 {
			 $i++;
	 			$html2 .= '<tr>
			     
                <td width="38"><div align="center"><h8>'.$items['codigo'].'</h8></div></td>
    			<td width="60" ><h8> '.$items['descripcion'].'</h8></td>
				<td width="87"><h8><div align = "right"> '.'$'.number_format($items['valor_unitario'], 0, ',', '.').'</div></h8></td>
				<td width="60" align="center" ><h8> '.$items['cantidad'].'</h8></td>';
				 $total_del_item = $items['total_item'];
				 //echo 'paso 1 html2'.$html2.'<br>';
    			//echo '<td width="82"><h8><div align = "right">'.'$'. number_format($total_del_item, 0, ',', '.').'</div></h8></td>';
				if ($items['iva']==1)
						{ $valor_iva = '16'; }
						else {$valor_iva = '0';}
				     //echo '<td width="82"><h8><div align = "right">'; 
				 
				 
			    if ($resolucion == 1)		
					{  //echo $valor_iva.'%';
					       
						 if ($items['iva']==1) 
						  {
						
						    $html2 .= '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item_con_iva'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
						else 	
							{
							
								$html2 .= '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
				    }
				else
					{
					$html .=  '</div></h8></td>
   			    		<td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						</tr>
						';	
					}			
				//<td width="34">'.$i.'</td>
				if($resolucion =='0')
					{ $subtotal = $subtotal + $total_del_item;}
				else			
					{ $subtotal = $subtotal + $items['total_item'];}
			 }
			 //echo 'paso 2 html2'.$html2.'<br>';
			 return $html2; 
		}


/////////////////////////////////////
////////////////////////////////////////////
$sql_ruta_imagen = "select ruta_imagen,nombre,casillas_horas from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_ruta_imagen,$conexion);
$ruta_imagen = mysql_fetch_assoc($consulta_empresa);
$casillas_horas=$ruta_imagen['casillas_horas'];

$nombre_empresa = $ruta_imagen['nombre'];
$ruta_imagen = '../logos/'.$ruta_imagen['ruta_imagen'];
$ruta_imagen2 = '../logos/tarjetas3.jpg';
////////////////////////////////////////////////////////////////////////////////////////
   
$sql_informacion = "select cli.nombre as nombre ,cli.identi as identicli ,cli.direccion as direccioncli,cli.telefono as telefonocli,
cli.email as emailcli  
                 ,f.numero_factura as numero_factura,f.fecha as fecha_factura,f.sumaitems as subtotalfac ,
                 f.valor_iva as ivafac ,f.total_factura as totalfac ,f.id_orden as id_orden,f.valor_retefuente as retefuentefac,f.resolucion as resolucion,
                  f.elaborado_por,f.tipo_factura,f.fecha_vencimiento
                 , e.resolucion as empreresolucion
                 , e.prefijo_factura as prefijo ,e.nombre as empresa 
				 ,e.identi,e.direccion,e.telefonos,e.razon_social,e.horario,e.email_empresa
				 ,e.recibe_tarjetas,e.regimen,e.condiciones_factura
				 ,f.forma_pago,f.formapagotexto,f.motor,f.chasis,f.modelo
                 
                from  $tabla3 as cli 
                inner join $tabla11 as f  on (f.id_cliente= cli.idcliente)
                inner join $tabla10  as e on (e.id_empresa = f.id_empresa) 
                 where f.id_factura = '".$_REQUEST['id_factura']."' 
                and  f.id_empresa = '".$_SESSION['id_empresa']."'  ";
                ////////////////////////
 $consulta_datos = mysql_query($sql_informacion,$conexion);
 
 
 
//$datos = get_table_assoc($datos);
$datos = mysql_fetch_assoc($consulta_datos);
$sql_items_orden = "select * from $tabla11 where id_factura = '".$_REQUEST['id_factura']."' order by id_item ";
//echo '<br>id_orden '.$datos[0]['id_orden'];
$consulta_items = mysql_query($sql_items_orden,$conexion);

$sql_numero_items ="select count(*) as total from $tabla100 where no_factura = '".$_REQUEST['id_factura']."'  ";
$consulta_numero_items = mysql_query($sql_numero_items,$conexion);
$numero_items = mysql_fetch_assoc($consulta_numero_items);
/////////////////////////////////////////////////////////////////////////////////////
$ancho_tabla = '95%';
/////////////////////////////////////////////////////////////////////////////////////
//clase para crear header y footer personalizado
class mipdf extends TCPDF{  
  //Header personalizado
  public function Header() {
    //imagen en header
    //$logo = '../logos/etservice2.png';
    //$this->Image($logo, 25, 10, 25, '', 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
        
    $this->SetFont('helvetica', 'B', 20);
    //$this->Cell(0, 0, 'Titulo de p�gina', 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
  
  //footer personalizado
  public function Footer() {
    // posicion
    $this->SetY(-15);
    // fuente
    $this->SetFont('helvetica', 'I', 8);
    // numero de pagina
    $this->Cell(0, 10, 'P�gina '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}
 
//iniciando un nuevo pdf
$pdf = new mipdf(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
 
//establecer margenes
//$pdf->SetMargins(25, 35, 25); // este era el que me hacia comenzar muy abajo de la parte superior
$pdf->SetHeaderMargin(20);
 
//informacion del pdf
/*
$pdf->SetCreator('hug0');
$pdf->SetAuthor('hug0');
$pdf->SetTitle('Ejemplo de pdf con tcpdf');
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
*/
 
//tipo de fuente y tamanio
$pdf->SetFont('helvetica', '', 12);
 
//agregar pag 1
$pdf->AddPage();
/*
$html = '
<h1>Kiuvox</h1>
<p style="font-size: 16px;">Este es un ejemplo de texto html escrito con tcpdf desde <a target="_blank" href="http://blog.kiuvox.com">blog.kiuvox.com</a></p>
';
*/
$html = '<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>imprimir orden</title>
  
            <link rel="stylesheet" href="../css/normalize.css">
          <link rel="stylesheet" href="../css/style.css">
         
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:200px;
	height:67px;
	z-index:1;
	left: 533px;
	top: 115px;
}
#Layer2 {
	position:absolute;
	width:296px;
	height:88px;
	z-index:1;
	left: 177px;
	top: 6px;
}
#Layer3 {
	position:absolute;
	width:301px;
	height:37px;
	z-index:2;
	left: 792px;
	top: 25px;
}
#Layer4 {
	position:absolute;
	width:133px;
	height:45px;
	z-index:3;
	left: 626px;
	top: 26px;
}
.style1 {color:#00CC99}
.style2 {color: #FF0000}
-->
</style>
</head>
<body>
';

$ancho_tabla = '95%';


if($datos[0]['recibe_tarjetas'] == 1)
	{
	$html .= '
		<div id="Layer4">
		  <h7>
			<div align="center"></div>
		  </h7>
		</div>';
	
	$html .='	
		<div id="Layer3"></div>
		';
		
	}	
$contado_credito = 'CREDITO';
if ($datos[0]['forma_pago'] > 0){$contado_credito = 'CONTADO';} 

$html = 
'';
$html .= '
<table width="'.$ancho_tabla.'" border="0">
  <tr>
    <td align="center"><img src="'.$ruta_imagen.'" width="222" height="94"></td>
    <td><h9>
      <div align="center">'.$datos[0]['razon_social'].'<br>NIT:'.$datos[0]['identi'].'<br>'.$datos[0]['direccion'].'<br>Tels:'.$datos[0]['telefonos'].'<br>'.$datos[0]['email_empresa'].'<br>Bogota-Colombia'; 
	  
$html .= '</div>
    </h9></td>
    <td align = "center"><h9><span class="style1">FACTURA DE VENTA</span><BR>
      No<span class="style2">'.$datos[0]['numero_factura'].'
      </span><BR><span class="style1">FECHA FACTURA<BR></span>'.$datos[0]['fecha_factura'].'<BR><span class="style1">FECHA VENCIMIENTO</span><br>
	  '.$datos[0]['fecha_vencimiento'].'
	  </h9></td>
  </tr>
</table>';

$html  .=  '<table width="'.$ancho_tabla.'" border="1">
  <tr>
    <td width ="16%"><h8>Facturar a: </h8></td>
    <td width ="48%"><h8>'.substr($datos[0]['nombre'],0,30).'</h8></td>
    <td width ="10%"><h8>Modelo:</h8></td>
    <td width ="26%"><h8>'.$datos[0]['modelo'].'</h8></td>
  </tr>
  <tr>
    <td><h8>Direccion:</h8></td>
    <td><h8>'.substr($datos[0]['direccioncli'],0,30).'</h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h8>Nit o C.C. </h8></td>
    <td><h8>'.substr($datos[0]['identicli'],0,30).'</h8></td>
    <td><h8>Motor:</h8></td>
    <td><h8>'.$datos[0]['motor'].'</h8></td>
  </tr>
  <tr>
    <td><h8>Telefono:</h8></td>
    <td><h8>'.substr($datos[0]['telefonocli'],0,30).'</h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h8>Email: </h8></td>
    <td><h8>'.substr($datos[0]['emailcli'],0,30).'</h8></td>
    <td><h8>Chasis:</h8></td>
    <td><h8>'.$datos[0]['chasis'].'</h8></td>
  </tr>
  <tr>
    <td><h8>Forma Pago: </h8></td>
    <td><h8>'.$contado_credito.'</h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
';
/////////////////////////
$html .=
'<table width="'.$ancho_tabla.'" border="1">
  <tr align="center">
    <td width="10%"><h8>CODIGO</h8></td>
    <td width="52%"><h8>DESCRIPCION</h8></td>
    <td width="14%"><h8> VR/UNITARIO</h8></td>
    <td width="10%"><h8>CANTIDAD</h8></td>
    <td width="14%"><h8>VR/TOTAL</h8></td>
  </tr>';
    $id_empresa = $_SESSION['id_empresa'];
   // $subtotal = traer_subtotal($_REQUEST['id_factura'],$tabla100,$conexion,$id_empresa,$datos['0']['resolucion']); 
	//$html2   =  muestre_items_nuevo_pdf($_REQUEST['id_factura'],$tabla100,$conexion,$id_empresa,$datos['0']['resolucion']); 
	////////////////////////////////////////////////
	///////////////////////////////////////////////
	
				//echo '<br>'.$resolucion;
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla100 where no_factura = '".$_REQUEST['id_factura']."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_assoc($consulta_items))
	 		 {
			 $i++;
	 			$html .= '<tr>
			     
                <td width="38"><div align="center"><h8>'.$items['codigo'].'</h8></div></td>
    			<td width="60" ><h8> '.$items['descripcion'].'</h8></td>
				<td width="87"><h8><div align = "right"> '.'$'.number_format($items['valor_unitario'], 0, ',', '.').'</div></h8></td>
				<td width="60" align="center" ><h8> '.$items['cantidad'].'</h8></td>';
				 $total_del_item = $items['total_item'];
				 //echo 'paso 1 html2'.$html2.'<br>';
    			//echo '<td width="82"><h8><div align = "right">'.'$'. number_format($total_del_item, 0, ',', '.').'</div></h8></td>';
				if ($items['iva']==1)
						{ $valor_iva = '16'; }
						else {$valor_iva = '0';}
				     //echo '<td width="82"><h8><div align = "right">'; 
				 
				 
			    if ($resolucion == 1)		
					{  //echo $valor_iva.'%';
					       
						 if ($items['iva']==1) 
						  {
						
						    $html .= '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item_con_iva'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
						else 	
							{
							
								$html .= '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
				    }
				else
					{
					$html .=  '</div></h8></td>
   			    		<td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						</tr>
						';	
					}			
				//<td width="34">'.$i.'</td>
				if($resolucion =='0')
					{ $subtotal = $subtotal + $total_del_item;}
				else			
					{ $subtotal = $subtotal + $items['total_item'];}
			 }
			 
			
	///////////////////////////////////////////////
	///////////////////////////////////////////////
	
    //echo 'html2'.$html2.'fin html2<br>'; 
//$html = $html2;	
	//function muestre_items_nuevo_pdf($orden,$tabla,$conexion,$id_empresa,$resolucion)
	//$completar = completar_espacios($numero_items);
	
$html .= '</table>';


/////////////////////////

$html .= '</body></html>';
 //echo 'html123<br>'.$html;
//escribe el texto en la hoja
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

 
//agregar pag 2
//$pdf->AddPage();
//escrite el texto en la hoja
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
//terminar el pdf
$pdf->Output('kiuvox.pdf', 'I');
