<?php
session_start();
?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">

#busqueda_codigos{
display:none;
}
#div_inventario{
display:none;
}
#codigo_a_escoger{
	color:black;
}
#marca_a_escoger{
	color:black;
}
#referencia_a_escoger{
	color:black;
}


</style>
</head>
<body>
<?php
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

//echo 'valor de id orden '.$_REQUEST['id_orden'];
//exit();

include('../valotablapc.php');  
include('../funciones.php'); 

$sql_placas = "select placa from $tabla4 where id_empresa = ".$_SESSION['id_empresa']." ";
$consulta_placas = mysql_query($sql_placas);
$sql_empresa = "select * from $tabla10 where id_empresa = ".$_SESSION['id_empresa']." ";
$consulta_empresa = mysql_query($sql_empresa,$conexion); 
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$ruta_imagen = '../logos/'.$datos_empresa['ruta_imagen'];
if($datos_empresa['tipo_taller'] == '1') // OSEA SI ES TALLER DE VEHICULOS
      { $palabra_inventario1  = 'RADIO' ; 
	  $palabra_inventario2  = 'ANTENA' ; 
	  $palabra_inventario3  = 'REPUESTO' ; 
	  } 
else  { $palabra_inventario1  = 'CASCO' ; 
	  $palabra_inventario2  = 'MALETERO' ; 
	  $palabra_inventario3  = 'TANK BAG' ; } 




/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);



$sql_placas = "select cli.nombre,cli.identi as clidenti,cli.direccion as direccioncli,cli.telefono as telefonocli, cli.email as emailcli,
car.placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,documentos_recibidos
 ,e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa,o.kilometraje_cambio,e.tipo_taller,o.fecha_entrega,o.abono,o.estado 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa)
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'   and   o.id_empresa = '".$_SESSION['id_empresa']."'  and o.estado < 20 ";
 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);


$filas = mysql_num_rows($datos); 

if ($filas == 0 ) 
{
echo '<BR><BR>ESTA ORDEN NO SE PUEDE MODIFICAR 	<br>SE ENCUENTRA EN ESTADO FINALIZADA';

}
else 
{
//echo '<br>filas =='.$filas;

 $datos = get_table_assoc($datos); 

//echo '<br>mecanico'.$datos[0]['mecanico'];
//$id_orden['id']
$sql_items_orden = "select * from $tabla15 where no_factura = '".$_REQUEST['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);
$factupan = $_REQUEST['idorden'];
if($datos[0]['mecanico']== '')
	{
		$nombre_mecanico = 'MECANICO NO ASIGNADO';
	}
else {
        $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$datos[0]['mecanico']."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
	}
/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/

$sql_traer_estados = "select * from $tabla26 where id_empresa = '".$_SESSION['id_empresa']."'";
//echo'<br>consulta'.$sql_traer_estados;
$consulta_estados_almacenados = mysql_query($sql_traer_estados,$conexion);


//$fechapan =  time();
include('../colocar_links2.php');
?>

<div id = "divorden">

  <!-- <form name = "actualizarorden" action="actualizar_orden_honda.php" method="post"> -->
    <table border = "1"  width = "75%">
      <tr>
        <td colspan="2" rowspan="4"><img src="<?php  echo $ruta_imagen    ?>" width="318" height="104"></td>
        <td colspan="2"><h3>ORDEN DE REPARACION.. </h3></td>
        <td >
                 <input name="orden" id = "orden" type="text" size="20" value = "<? echo $datos[0]['orden']  ?>" onfocus = "blur()" >
				 <input type="hidden" id = "id_orden2" value = "<? echo $_REQUEST['idorden']  ?>" >
                <input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "<? echo $_REQUEST['idorden']  ?>"  >  
				 <input name="id_orden" id = "id_orden"  type="hidden" size="20" value = "<? echo $datos[0]['id']  ?>"  >         </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><?php  echo $datos[0]['identi']   ?> </div></td>
        <td>CLAVE</td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">TELS <?php  echo $datos[0]['telefonos_empresa']   ?> </div></td>
        <td><input name="clave" id = "clave" type="text" size="20" ></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><?php  echo $datos[0]['direccion_empresa']   ?> </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="85">FECHA</td>
        <td><input size=10 name=fecha id = "fecha"  value= <? echo $datos[0]['fecha']  ;?> > 
        fecha entrega </td>
        <td><input size=10 name=fecha_entrega id = "fecha_entrega"  value= <? echo $datos[0]['fecha_entrega']  ;?> class="fila_llenar"></td>
        <td width="243">MARCA</td>
        <td width="219"><input name="marca" id = "marca" type="text"  value = "<? echo $datos[0]['marca']  ?>" disabled></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>NOMBRE</td>
        <td colspan="2"><input name="nombre"  id = "nombre" type="text"  value = "<?php echo $datos[0]['nombre']; ?> " disabled></td>
        <td>LINEA</td>
        <td><input name="tipo" type="text"  value = "<? echo $datos[0]['tipo']  ?>" disabled></td>
      </tr>
      <tr>
        <td>CC/NIT</td>
        <td colspan="2"><input name="identificacion" type="text"  value = "<?php echo $datos[0]['clidenti']; ?> " disabled></td>
        <td>MODELO</td>
        <td><input name="modelo" type="text"  value = "<? echo $datos[0]['modelo']  ?>" disabled></td>
      </tr>
      <tr>
        <td>DIRECCION</td>
        <td colspan="2"><input name="direccion" type="text" size="50" value = "<? echo $datos[0]['direccioncli']  ?>" disabled ></td>
        <td>PLACA</td>
        <td><input name="placa" id = "placa" type="text" size="10" value = "<? echo $datos[0]['placa']  ?>" onfocus="blur();" ></td>
      </tr>
      <tr>
        <td>DOCUMENTOS RECIBIDOS </td>
        <td colspan="2"><textarea class= "fila_llenar" name="documentos_recibidos"  id = "documentos_recibidos" cols="40" rows="4"> <?php  echo $datos[0]['documentos_recibidos']?>
    </textarea></td>
        <td><label>
          <input type="checkbox" name="cambiar_placa" id="cambiar_placa" value="1" placeholder="PLACA">
       <label for ="cambiar_placa"> <span class="style3">CAMBIAR PLACA</span> </label> </td>
        <td><div id="mostrar_placas">
		<select name="nueva_placa" id = "nueva_placa" class = "fila_llenar">
		  <option value = ""   >   </option>
		
		<?php
		while($placas = mysql_fetch_assoc($consulta_placas))
			{
			     echo  '<option value = "'.$placas['placa'].'"   > '.$placas['placa'].'  </option>';
			}
		?>
	  </select>
		</div>
		</td>
      </tr>
      <tr>
        <td>TELEFONO</td>
        <td colspan="2"><input name="telefono" type="text" size="40" value = "<? echo $datos[0]['telefonocli']  ?>" onfocus = "blur()"></td>
        <td>COLOR</td>
        <td><input name="color" type="text" size="20" value = "<? echo $datos[0]['color']  ?>"  disabled></td>
      </tr>
	   <tr>
	     <td>EMAIL</td>
	     <td width="214"><input name="email" type="text" size="40" value = "<? echo $datos[0]['emailcli']  ?>" onfocus = "blur()"></td>
	     <td width="40">&nbsp;</td>
	  <td>KILOMETRAJE</td>
	  <td><input name="kilometraje"  id = "kilometraje"  type="text" size="20" value = "<? echo $datos[0]['kilometraje']  ?>" ></td></tr>
	   <tr>
	     <td>&nbsp;</td>
	     <td>&nbsp;</td>
	     <td>&nbsp;</td>
	     <td><span style="color: rgb(0, 0, 0); font-family: sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;">Kms Prox. Cambio</span></td>
	     <td><input name="kilometraje_cambio"  id = "kilometraje_cambio"  type="text" size="20" value = "<? echo $datos[0]['kilometraje_cambio']  ?>" ></td>
      </tr>
      <tr><td><input type ="hidden" name = "factupan" id = "factupan" value = "<?php echo $factupan;  ?>"></td>
      <td><strong>OPERARIO ACTUAL:</strong>  <input type ="hidden" name = "mecanico"  id = "mecanico"  value ="<?php echo  $datos[0]['mecanico']; ?>" >
        <span class="style2">
        <strong><?php  echo $nombre_mecanico; ?></strong>        </span></td>
      <td></td>
	  <td><label for="cambiar_mecanico">CAMBIAR OPERARIO
	    <label>
	   
	    <input type="checkbox" name="cambiar_mecanico" id = "cambiar_mecanico" value="1">
	    </label></td>
	  <td>
	  		<select name="mecanico_nuevo" id = "mecanico_nuevo">
		  <option value = ""   >   </option>
		
		<?php
		while($mecanicos = mysql_fetch_assoc($consulta_operarios))
			{
			     echo  '<option value = "'.$mecanicos['idcliente'].'"   > '.$mecanicos['nombre'].'  </option>';
			}
		?>
	  </select>	  </td></tr>
      <tr>
        <td colspan="11"></td>
      </tr>
      <tr>
        <td colspan="11"><div align="center">TRABAJO A REALIZAR </div></td>
      </tr>
      <tr>
        <td height="80" colspan="11"><label>
          <textarea class= "fila_llenar" name="descripcion"  id = "descripcion" cols="90" rows="4"> <?php  echo $datos[0]['observaciones']?>
    </textarea>
        </label></td>
      </tr>
    </table>	
  <br>
BUSCAR DESCRIPCION 
<input type="text"  id="input_buscar_codigo" name = "input_buscar_codigo" class="fila_llenar">
MARCA
<input type="text"  id="input_buscar_marca" name = "input_buscar_marca" class="fila_llenar">
REFERENCIA 
<input type="text"  id="input_buscar_referencia" name = "input_buscar_referencia" class="fila_llenar">

<div id="busqueda_codigos"  ></div> 
  <br>
 
	  <table width="75%" border = "1">
      <tr>
        <td colspan="11"><div align="center">PARTES Y RESPUESTOS </div></td>
      </tr>
      <tr>
    <td><div align="center">ITEM</div></td>
    <td><div align="center">COD </div></td>
    <td><div align="center">DESCRIPCION</div></td>
    <td><div align="center">COSTO</div></td>
    <td><div align="center">VR Unit </div></td>
    <td>EXIS</td>
 
    <td>CANT.</td>
    <!--<td>TOTAL</td>-->
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td width="34"></td>
    <td width="38"><label>
      <input name="codigopan" type="text" id = "codigopan" size="5" class= "fila_llenar" />
    </label></td>
    <td width="149"><input type="text" name="descripan" id = "descripan" class= "fila_llenar" /> <div id = "descripcion"></div></td>
     <td width="82"><input type="text" name="costo_producto" id = "costo_producto" size = "10" /></td>
    <td width="82"><input type="text" name="valor_unit" id = "valor_unit" size = "10" class= "fila_llenar" /></td>
    <td width="87"><input name="exispan" type="text" id = "exispan" size="5" disabled /></td>

    <td width="85"><input name="cantipan" type="text" id = "cantipan"  size ="10" class= "fila_llenar" placeholder="CANT"/></td>
    <!--
    <td width="77"><input name="totalpan" type="text" id = "totalpan" size="15" disabled /></td>
    -->
    <td width="75"><button type = "button" id = "agregar_item">Agregar</button></td>
  </tr>
    </table>
	
	 <BR>
  
		  <div id = "nuevodiv">
				 <?php 
				  include('mostrar_items.php');
				  $_SESSION['id_orden'] = $_REQUEST['idorden'];
				  mostrar_items($_SESSION['id_orden']);
				  //$factupan = $_GET['idorden'];
				?>
		 </div>
		 <br>
  </table>
  <br>
<div id = "div_inventario">	
  <table border = "1" width = "75%" class="color_borde_tabla">
      <tr>
        <td colspan="7"><div align="center">INVENTARIO <input name="iva" type="hidden" id = "iva"  value = "<?php echo $datos[0]['iva']; ?>"</div></td>
      </tr>
	  
	  <?php //mostrar_inventario_moto($conexion,$tabla24,$datos[0]['tipo_taller'],$tabla25,$_SESSION['id_empresa'],$_REQUEST['idorden']);
	 
		$nombre_estado = busque_estado($tabla26,$datos[0]['estado'],$_SESSION['id_empresa'],$conexion);
		
	  ?>
    </table>
</div>	
	<br>
	<table border = "1" width = "75%">
	<tr>
	<td>&nbsp;</td>
	<?php 
	//////////////////
    $sql_suma_items = "select sum(total_item) as total_item   from $tabla15  where no_factura = '".$_REQUEST['idorden']."'  ";
    $consulta_suma_item = mysql_query($sql_suma_items,$conexion);
    $arr_suma_items = mysql_fetch_assoc($consulta_suma_item);

    $sql_suma_recibos = 
    "select sum(lasumade) as valor_recibos  from $tabla23   where   id_orden = '".$_REQUEST['idorden']."'  ";
   $consulta_suma_recibos = mysql_query($sql_suma_recibos,$conexion);
   $arr_suma_recibos = mysql_fetch_assoc($consulta_suma_recibos);
   $saldo_orden = $arr_suma_items['total_item']  - $arr_suma_recibos['valor_recibos'];


	  ?>
	<td align="right">ESTADO
	<select name = "estado" id = "estado" class = "fila_llenar">
	
	<option value="">...</option>

	<?php  		
		while($estados = mysql_fetch_assoc($consulta_estados_almacenados))
			{
				//echo '<br>123456646'.$estados['descripcion_estado'];
				
				if( $estados['valor_estado']==  $datos[0]['estado']     )
				{
					
					echo '<option value= '.$estados['valor_estado'].' selected >'.$estados['descripcion_estado'].'</option>';
				
				}
				else
				{
				    ///que solo muestre el estado emtregado si saldo orden = 0;
				   //valor estado entregada = 2    

				  if($estados['valor_estado']==2)	
				  { 

				  		  if($saldo_orden>0)	
				  		  {

                    echo '<option value= '.$estados['valor_estado'].'>'.$estados['descripcion_estado'].'</option>';
                }
				  		  else
				  		  	{  
                   echo '<option value= '.$estados['valor_estado'].'>'.$estados['descripcion_estado'].'</option>';
				  			}
				  }
				  else
				  {
				   echo '<option value= '.$estados['valor_estado'].'>'.$estados['descripcion_estado'].'</option>';
				  }

				}//fin de else de si se debe marcar como seleccionado


			}
	?>	
	</select>
	 </td>
	</tr>
	</table>
	<table width = "75%" border="1">
      <tr>
        <td align="center"><h3>
        
		<input name="enviar_correo" id="enviar_correo" type="checkbox" value="1" id = "enviar_correo" >
        <label  for ="enviar_correo" >Enviar  Nuevamente</label>
		<button id="enviar_correo_items_123">Enviar Correo Items y Valor...</button>
		</h3></td>
      </tr>
    </table>
	<div id="informacion_correo"></div>
		<table border = "1"  width = "75%">
<tr>
<td><h2>
<!--<input type = "submit"  value = "ACTUALIZAR ORDEN"> -->
<input type="button" value="ACTUALIZAR_INFORMACION" onClick="valida_envia()">

</h2> 
 </td>
</tr>
</table>
  <!-- </form> -->
<?php
}// fin de si la orden si se deja modificar osea else de si filas = 0
?>


 <h2><a href="../menu_principal.php">Menu Principal</a> <h2>
  
 <a href="index.php">Menu Ordenes</a> 
</div>
</body>
</html>

<?php
function mostrar_inventario_moto($conexion,$tabla24,$tipo_taller,$tabla25,$id_empresa,$id_orden)
{

//$sql_nombres_items_inventarios_ante = "select * from $tabla24  where decarroomoto = '".$tipo_taller."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
$sql_nombres_items_inventarios = "
select * from $tabla25 r
inner join $tabla24 ic on (r.id_nombre_inventario = ic.id_nombre_inventario)
where r.id_empresa = '".$id_empresa."'
and r.id_orden = '".$id_orden."'
order by r.id_relacion_orden_inventario
";
//echo '<br>'.$sql_nombres_items_inventarios;
$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
$filas_nombres_items = mysql_num_rows($consulta_nombres_items);
$nombres2_items = get_table_assoc($consulta_nombres_items);
/*
echo '<pre>';
print_r($nombres2_items);
echo '</pre>';
*/

//echo '<br>consulta'.$sql_nombres_items_inventarios.'<br>';
	echo '<tr>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	echo '</td>';
		echo '<td>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	
	echo '</tr>';


  $items_por_columna = $filas_nombres_items/2;
	$contador = 0 ;
	
	while($contador <  $items_por_columna )
	{
		//echo 'paso222';
		echo '<tr>';
		echo '<td>';
		echo $nombres2_items[$contador]['nombre'];
		echo '</td>';
		echo '<td>';
		echo '<input type="text"  name = "'.$nombres2_items[$contador]['id_nombre_inventario'].'" id = "" value ="'.$nombres2_items[$contador]['valor'].'" size="2"> '; 
		//$nombres2_items[$contador]['valor'];	
		echo '</td>';
		echo '<td>';
		/*
		echo ' <input  type = "text" name = "cantidad_'.$nombres2_items[$contador]['id_nombre_inventario'].'" size="2" 
		 value = "'.$nombres2_items[$contador]['cantidad'].'">';
		 */
		 echo '</td>';
		$segunda_fila = $contador + $items_por_columna;
		echo '<td>'.$nombres2_items[$segunda_fila]['nombre'].'</td>';
		echo '<td>';
		echo '<input type="text"  name = "'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'" id = "" 
		value ="'.$nombres2_items[$segunda_fila]['valor'].'" size="2"> ';
		echo '</td>';
		echo '<td>';
		/*
		echo ' <input  type = "text" name = "cantidad_'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'" size="2" 
		 value = "'.$nombres2_items[$segunda_fila]['cantidad'].'">';
		 */
		//echo $nombres2_items[$segunda_fila]['cantidad'];
			echo '</td>';
		
		echo '</tr>';
		$contador++;
		
	} // fin del while
}// fin del a funcion 


function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)
	{
	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";
	  $consulta_estados = mysql_query($sql_estados,$conexion);
	  $resultado = mysql_fetch_assoc($consulta_estados);
	  $nombre_estado = $resultado['descripcion_estado'];
	  return $nombre_estado;
	}
?>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
						//////////////////
			   $("#codigopan").keyup(function(e){
					//$("#cosito").html( $("#nombrepan").val() );
					if (e.which == 13)
					{
							//alert('digito enter');
							var data1 ='codigopan=' + $("#codigopan").val();
							//$.post('buscarelnombre.php',data1,function(b){
							$.post('traer_codigo_descripcion.php',data1,function(b){
							        //  $("#descripan").val() =  descripcion;
									$("#descripan").val(b[0].descripcion);
									$("#valor_unit").val(b[0].valor_unit);
									$("#exispan").val(b[0].existencias);
									$("#costo_producto").val(b[0].costo_producto);
									$("#cantipan").val('');
									$("#cantipan").focus();
									$("#totalpan").val(0);
							 //(data1);
							},
							'json');
					}// fin del if 		
			   });//finde codigopan
			  //////////////////////////////////
				/////////////////////////////////	
						$("#agregar_item").click(function(){
							

							 if($("#cantipan").val().length < 1)
					        { alert('Digite Cantidad'); 
					        $(cantipan).focus();
					        return false; }
							
								var data =  'codigopan =' + $("#codigopan").val();
								data += '&descripan=' + $("#descripan").val();
								data += '&valor_unit=' + $("#valor_unit").val();
								data += '&cantipan=' + $("#cantipan").val();
								data += '&totalpan=' + $("#totalpan").val();
								data += '&exispan=' + $("#exispan").val();
								data += '&costo_producto=' + $("#costo_producto").val();
								data += '&id_mecanico=' + $("#id_mecanico").val();
								data += '&orden_numero=' + $("#orden_numero").val();

								data += '&porcentaje_mecanico=' + $("#porcentaje_mecanico").val();
								$.post('procesar_items.php',data,function(a){
								$("#nuevodiv").html(a);
									//alert(data);
								});	
								//alert('pruebassss');	
										$("#codigopan").val('');
		   								$("#codigopan").focus();
		   								$("#descripan").val('');
										$("#valor_unit").val('');
										$("#exispan").val('');
										$("#cantipan").val('');
										$("#totalpan").val(0);
										$("#costo_producto").val(0);

							

						 });//fin de agregar_item 
				
					///////////////////////////////////para eliminar items
					$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							data += '&factupan=' + $("#orden_numero").val();
							$.post('eliminar_items.php',data,function(a){
								$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
					//////////////////////////////////

					/*
					$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						$('#totalpan').val(resultado2);  
					}	
						
					});
					*/


					/////////////////////////
					$("#actualizar_orden").click(function(){
							var data =  'orden_numero=' + $("#orden_numero").val();
							data += '&clave=' + $("#clave").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&placa=' + $("#placa").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&iva=' + $("#iva").val();
							data += '&kilometraje=' + $("#kilometraje").val();
							data += '&mecanico=' + $("#mecanico").val();
							data += '&kilometraje_cambio=' + $("#kilometraje_cambio").val();
							data += '&cambiar_mecanico=' + $("#cambiar_mecanico:checked").val();
							data += '&estado=' + $("#estado").val();
							data += '&ultimo_estado=' + $("#ultimo_estado").val();
							data += '&enviar_correo=' + $("#enviar_correo:checked").val();
							$.post('actualizar_orden_honda.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
						///////////////////////////////////
				
					$("#cambiar_placa").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										 $("#mostrar_placas").css("display","block");
										//alert('Se hizo check en el checkbox.');
							  
							  
							  	} else {
										//alert('Se destildo el checkbox');
										$("#mostrar_placas").css("display","none");
							  }	  
					  });
					  //////////////////////////
					 

						$("#input_buscar_codigo").click(function(){
							$("#busqueda_codigos").toggle("slow");
						});
					 ///////////////////////////
					 $("#input_buscar_marca").click(function(){
							$("#busqueda_codigos").toggle("slow");
						});
					 	 ///////////////////////////
					 $("#input_buscar_referencia").click(function(){
							$("#busqueda_codigos").toggle("slow");
						});

					 ///////////////////////////
					 $("#cerrar_busqueda").click(function(){
							$("#busqueda_codigos").css("display","none");
						});
					 /////////////////////////////


					 	 $("#input_buscar_codigo").keydown(function(e){
					     	var data =  'descricodigo=' + $("#input_buscar_codigo").val();
							
						  //$("#replica").val($("#mitexto").val());
							$.post('buscar_codigo.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#busqueda_codigos").html(a);
													//alert(data);
							});	
	 
   						});
					 //////////////////////////


					 	 $("#input_buscar_marca").keydown(function(e){
					     	var data =  'descricodigo=' + $("#input_buscar_marca").val();
							
						  //$("#replica").val($("#mitexto").val());
							$.post('buscar_marca.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#busqueda_codigos").html(a);
													//alert(data);
							});	
	 
   						});
					 //////////////////////////


					 	 $("#input_buscar_referencia").keydown(function(e){
					     	var data =  'descricodigo=' + $("#input_buscar_referencia").val();
							
						  //$("#replica").val($("#mitexto").val());
							$.post('buscar_referencia.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#busqueda_codigos").html(a);
													//alert(data);
							});	
	 
   						});





					 /////////////////////////
					$("#codigo_a_escoger").change(function(){
						//alert('escogio un codigo ');
					var valor=$("#codigo_a_escoger").val();
					var texto=$("#codigo_a_escoger option:selected").text();
					$("#codigopan").val(valor);
					//$("#codigopan").val(texto);
					
					//$("#porpietario_afuera").css("display","block")
					//$("#div_nombre_propietario").css("display","block")
					});

	   			    	 /////////////////////////
					 $("#enviar_correo_items_123").click(function(){
							var data =  'idorden=' + $("#orden_numero").val();
							data += '&placa=' + $("#placa").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&orden=' + $("#orden").val();
							$.post('generar_correo_items.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#informacion_correo").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
/////////////////////////////////////////////////////
			
			});		////finde la funcion principal de script	
</script>

<script>
function valida_envia(){ 
	// alert("click en valida");
   	//valido el nombre 
	/*
   	if (document.actualizarorden.abono.value.length==0){ 
      	alert("Tiene que escribir su kilometraje_cambio") 
      	document.actualizarorden.kilometraje_cambio.focus() 
      	return 0; 
   	} 
	*/
	
//el formulario se envia 
   	// alert("Muchas gracias por enviar el formulario"); 
   	//  document.actualizarorden.submit(); 

	   var data =  'orden=' + $("#orden").val();
	   data += '&orden_numero=' + $("#id_orden2").val();
	   data += '&id_orden=' + $("#id_orden").val();
	   data += '&clave=' + $("#clave").val();
	   data += '&fecha=' + $("#fecha").val();
	   data += '&fecha_entrega=' + $("#fecha_entrega").val();
	   data += '&placa=' + $("#placa").val();
	   data += '&documentos_recibidos=' + $("#cladocumentos_recibidosve").val();
	   data += '&nueva_placa=' + $("#nueva_placa").val();
	   data += '&telefono=' + $("#telefono").val();
	   data += '&email=' + $("#email").val();
	   data += '&kilometraje=' + $("#kilometraje").val();
	   data += '&kilometraje_cambio=' + $("#kilometraje_cambio").val();
	   data += '&factupan=' + $("#factupan").val();
	   data += '&mecanico=' + $("#mecanico").val();
	   data += '&mecanico_nuevo=' + $("#mecanico_nuevo").val();
	   data += '&descripcion=' + $("#descripcion").val();
	   data += '&input_buscar_codigo=' + $("#input_buscar_codigo").val();
	   data += '&input_buscar_marca=' + $("#input_buscar_marca").val();
	   data += '&input_buscar_referencia=' + $("#input_buscar_referencia").val();
	   data += '&codigopan=' + $("#codigopan").val();
	   data += '&descripan=' + $("#descripan").val();
	   data += '&costo_producto=' + $("#costo_producto").val();
	   data += '&valor_unit=' + $("#valor_unit").val();
	   data += '&cantipan=' + $("#cantipan").val();
	   data += '&iva=' + $("#iva").val();
	   data += '&estado=' + $("#estado").val();
	   $.post('actualizar_orden_honda.php',data,function(a){
	   //$(window).attr('location', '../index.php);

	//    $("#divorden").html(a);
	//    	//alert(data);
	    });	
	   $( "#divorden" ).load( "muestre_orden_sin_modif.php" );

}


</script>


