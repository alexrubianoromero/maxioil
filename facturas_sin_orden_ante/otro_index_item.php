<?php
session_start(); 
require_once '../../tcpdf/tcpdf.php';
include('../valotablapc.php');
//include('../funciones.php'); 
/////////////////////////////////////
function muestre_items_nuevo($orden,$tabla,$conexion,$id_empresa,$resolucion)
		{
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_assoc($consulta_items))
	 		 {
			 $i++;
	 			echo '<tr>
			     
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
						
						    echo '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item_con_iva'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
						else 	
							{
							
								echo '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							
							}
				    }
				else
					{
					echo '</div></h8></td>
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

$ancho_tabla = '95%';
	
$html = 
'';
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
   $subtotal =  muestre_items_nuevo($_REQUEST['id_factura'],$tabla15,$conexion,$id_empresa,$datos['0']['resolucion']); 
   ////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////
		$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla100 where no_factura = '".$_REQUEST['id_factura']."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$filas_items = mysql_num_rows($consulta_items);
				echo 'filas_items ='.$filas_items;
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
			}
			

   ////////////////////////////////////////////////////////
   /////////////////////////////////////////////////////////
   
$html .= '</table>';


/////////////////////////

$html .= '</body></html>';
 echo 'html123<br>'.$html;
//escribe el texto en la hoja
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

 
//agregar pag 2
//$pdf->AddPage();
//escrite el texto en la hoja
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
//terminar el pdf
$pdf->Output('kiuvox.pdf', 'I');
