<?php

session_start();
?>
<!DOCTYPE html>
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
<?php

include('../numerosALetras.class.php');
  $n = new numerosALetras ( 159 ) ; 
//echo $n -> resultado ;
//$letras = $n -> resultado ;
//echo '<br>letras'.$letras; 
//echo
/*
 '<pre>';
print_r($_GET);
echo '</pre>';
*/


//exit();





include('../valotablapc.php');  
include('../funciones.php'); 
include('../num2letras.php'); 

/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();
/*
$sql_placas = "select cli.nombre as nombre ,cli.identi as identi ,cli.direccion as direccion,cli.telefono as telefono ,car.placa as placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
 where o.id = '".$_GET['idorden']."' ";
 */
$sql_ruta_imagen = "select ruta_imagen,nombre,casillas_horas from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_ruta_imagen,$conexion);
$ruta_imagen = mysql_fetch_assoc($consulta_empresa);
$casillas_horas=$ruta_imagen['casillas_horas'];
/*
echo  '<pre>';
print_r($ruta_imagen);
echo '</pre>';
echo '<br>'.$ruta_imagen;
echo '<br>casillas horas'.$ruta_imagen['casillas_horas'];
*/
//exit();  

$nombre_empresa = $ruta_imagen['nombre'];
$ruta_imagen = '../logos/'.$ruta_imagen['ruta_imagen'];
$ruta_imagen2 = '../logos/tarjetas3.jpg';

///////////////////////////////

                $sql_informacion = "select cli.nombre as nombre ,cli.identi as identicli ,cli.direccion as direccioncli,cli.telefono as telefonocli 
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
 


 //echo '<br>'.$sql_informacion;
 //exit();
$datos = mysql_query($sql_informacion,$conexion);
$datos = get_table_assoc($datos);
/*
echo  '<pre>';
print_r($datos);
echo '</pre>';
*/
$sql_items_orden = "select * from $tabla11 where id_factura = '".$_REQUEST['if_factura']."' order by id_item ";
//echo '<br>id_orden '.$datos[0]['id_orden'];
$consulta_items = mysql_query($sql_items_orden,$conexion);

$sql_numero_items ="select count(*) as total from $tabla100 where no_factura = '".$_REQUEST['if_factura']."'  ";
$consulta_numero_items = mysql_query($sql_numero_items,$conexion);
$numero_items = mysql_fetch_assoc($consulta_numero_items);

//echo '<br>items '.$numero_items['total'];

/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/


//$fechapan =  time();



?>
<?php
  //$prefijo = '';
  		$razon_social =   $datos[0]['razon_social'].' NIT. '.$datos[0]['identi'];
	   if( $datos[0]['resolucion'] == 1 && $datos[0]['regimen'] == '1')
			  {  
          $nombre_documento = 'FACTURA No'; 
		  //$razon_social = 'GRUPO EMPRESARIAL BALCAZAR S.A.S. NIT: 900861474-6';
		  //$razon_social = 'SERVI-MARTHA NIT. 52.297.022-6';
		   
		  $palabra_iva = 'IVA';
		  $palabra_retefuente = 'RETEFUENTE';
		   //echo $datos[0]['empreresolucion']; 
				 $linea1 = substr($datos[0]['empreresolucion'],0,25);
				  $linea2 = substr($datos[0]['empreresolucion'],26,36);
				   $linea3 = substr($datos[0]['empreresolucion'],61,14);
         // $prefijo = $datos[0]['prefijo'];
        }
      else { 
	  		$nombre_documento  =  'DOCUMENTO No ';
	  		  
			  $palabra_iva = '';
			   $palabra_retefuente = ''; 
            if ($datos[0]['regimen'] == '2'){$linea3 = 'Regimen Simplificado';}  
			} 
			
	?>

<?php
if($datos[0]['recibe_tarjetas'] == 1)
	{
	echo '
		<div id="Layer4">
		  <h7>
			<div align="center"></div>
		  </h7>
		</div>';
	
	echo'	
		<div id="Layer3"></div>
		';
		
	}	
?>
<!-- ///////////////////////////////////////////////////////   -->


<?php
$ancho_tabla = '95%';

?>
<table width="<?php echo $ancho_tabla;  ?>" border="0">
  <tr>
    <td align="center"><img src="<?php  echo $ruta_imagen    ?>" width="222" height="94"></td>
    <td><h9>
      <div align="center"><?php echo $datos[0]['razon_social'].'<br>NIT:'.$datos[0]['identi'].'<br>'.$datos[0]['direccion'].'<br>Tels:'.$datos[0]['telefonos'].'<br>'.
	$datos[0]['email_empresa'].'<br>Bogota-Colombia'
	  ; ?></div>
    </h9></td>
    <td align = "center"><h9><span class="style1">FACTURA DE VENTA</span><BR>
      No<span class="style2">
      <?php  echo $datos[0]['numero_factura'];  ?>
      </span><BR><span class="style1">FECHA FACTURA<BR></span><?php echo $datos[0]['fecha_factura'];  ?><BR><span class="style1">FECHA VENCIMIENTO</span><br><?php echo $datos[0]['fecha_vencimiento'];  ?></h9></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1">
  <tr>
    <td width ="16%"><h8>Facturar a: </h8></td>
    <td width ="48%"><h8><?php echo substr($datos[0]['nombre'],0,30)?></h8></td>
    <td width ="10%"><h8>Modelo:</h8></td>
    <td width ="26%"><h8><?php echo $datos[0]['modelo']?></h8></td>
  </tr>
  <tr>
    <td><h8>Direccion:</h8></td>
    <td><h8><?php echo substr($datos[0]['direccioncli'],0,30)?></h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h8>Nit o C.C. </h8></td>
    <td><h8><?php echo substr($datos[0]['identicli'],0,30)?></h8></td>
    <td><h8>Motor:</h8></td>
    <td><h8><?php echo $datos[0]['motor']?></h8></td>
  </tr>
  <tr>
    <td><h8>Telefono:</h8></td>
    <td><h8><?php echo substr($datos[0]['telefonocli'],0,30)?></h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h8>Email: </h8></td>
    <td><h8><?php echo substr($datos[0]['emailcli'],0,30)?></h8></td>
    <td><h8>Chasis:</h8></td>
    <td><h8><?php echo $datos[0]['chasis']?></h8></td>
  </tr>
  <tr>
    <td><h8>Forma Pago: </h8></td>
    <td><h8><?php   if ($datos[0]['forma_pago'] > 0){echo 'CONTADO';} else {echo 'CREDITO';}  ?></h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1">
  <tr align="center">
    <td width="10%"><h8>CODIGO</h8></td>
    <td width="52%"><h8>DESCRIPCION</h8></td>
    <td width="14%"><h8> VR/UNITARIO</h8></td>
    <td width="10%"><h8>CANTIDAD</h8></td>
    <td width="14%"><h8>VR/TOTAL</h8></td>
  </tr>
  <?php
  
  $id_empresa = $_SESSION['id_empresa'];
    $subtotal =  muestre_items_nuevo($datos[0]['id_orden'],$tabla100,$conexion,$id_empresa,$datos['0']['resolucion']); 
	 $completar = completar_espacios($numero_items);
  ?>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1">
  <tr>
    <td width="76%" rowspan="3" align = "justify"><h81><?php echo  $datos[0]['condiciones_factura']?></h81></td>
    <td width ="10%"><h8>SUBTOTAL</h8></td>
    <td width ="14%" align = "right"><h8><?php echo '$'.number_format($datos[0]['subtotalfac'], 0, ',', '.'); ?></h8></td>
  </tr>
  <tr>
    <td><h8>IVA</h8></td>
    <td align = "right"><h8><?php echo '$'.number_format($datos[0]['ivafac'], 0, ',', '.');  ?></h8></td>
  </tr>
  <tr>
    <td><h8>TOTAL</h8></td>
    <td align = "right"><h8> <?php  echo '$'.number_format($datos[0]['totalfac'], 0, ',', '.') ?></h8></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1">
  <tr>
    <td width ="50%">ENTREGADO POR: </td>
    <td width ="50%" >RECIBI A SATISFACCION </td>
  </tr>
  <tr>
    <td>&nbsp;<br>&nbsp;</td>
    <td>&nbsp;<br>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>c.c. o NIT. </td>
  </tr>
</table>


<!-- ///////////////////////////////////////////////////////   -->
</body>

<?php

function completar_espacios($numero_items)
	{    
	     $repeticiones = 7-$numero_items['total'];
				for ($i = 1 ; $i<= $repeticiones;$i++)
						{							  
						 echo '
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
	}// fin de la funcion
?>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

