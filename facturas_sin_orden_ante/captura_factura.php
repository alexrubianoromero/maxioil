<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	<script src="./js/jquery.js" type="text/javascript"></script>
</head>
<?php
include('../valotablapc.php');
include('../funciones.php'); 
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan);

/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/



if ($_REQUEST['envio'] < 2) //osea si es un osea si se envio el id del cliente
{
		//echo 'se envio opcion uno';
		$idcliente = 	$_REQUEST['idcliente'];
}
else // osea si se enviaron los datos del cliente para ser grabados 
{
       //si se envian la informacion del nuevo cliente pues se crea
	  // echo 'se envio opcion dos';
	  //buscar que la cedula no exista 
	  $sql_clientes = "select * from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."' and identi = '".$_REQUEST['identicli']."' ";	  
	  $consulta_clientes = mysql_query($sql_clientes,$conexion);
	  $filas = mysql_num_rows($consulta_clientes);
	  $arreglo_cliente = mysql_fetch_assoc($consulta_clientes);
	  	
	  if($filas > 0) // si ya existe esta cedula
	  		{
				// pues no se graba si ya existe
				$idcliente = 	$arreglo_cliente['idcliente'];	
						
			}
	else 	{
				$sql_crear_cliente = "insert into $tabla3 (identi,nombre,telefono,email,id_empresa,direccion) values (
				'".$_REQUEST['identicli']."'
				,'".$_REQUEST['nombrecli']."'
				,'".$_REQUEST['telefonocli']."'
				,'".$_REQUEST['emailcli']."'
				,'".$_SESSION['id_empresa']."'
				,'".$_REQUEST['direccioncli']."'
				
				)";
				//echo 'consulta creaar a<br>'.$sql_crear_cliente.'<br>';
				$consulta_crear_cliente = mysql_query($sql_crear_cliente,$conexion);
				///////despues de creado hay que traer el id de la creacion entonces busquemos el maximo id  y ese es
				$sql_maximo_id_clientes = "select max(idcliente) as idcliente from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."' ";
				//echo 'maximno id cliente<br>'.$sql_maximo_id_clientes.'<br>';
				$consulta_maxid = mysql_query($sql_maximo_id_clientes,$conexion);
				$arreglo_id = mysql_fetch_assoc($consulta_maxid);
				$idcliente = $arreglo_id['idcliente'];
				
				
				
			}//fin de que la cedula no existe		
}//	  fin de que tipo de formulario se envio si un cliente que ya existe o uno nuevo
//$idcliente = $arreglo_id['idcliente'];

//echo '<br>idcliente='.$idcliente;
////se procede a realizar la conculta del cliente 
	$sql_clientes = 
	"select * from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."' and idcliente = '".$idcliente."' ";
		//echo '<br>consulta'.$sql_clientes;
		$consulta_clientes = mysql_query($sql_clientes,$conexion);
		$arreglo_cliente = mysql_fetch_assoc($consulta_clientes);
///////////////////////////  se procede a la creacion de la factura 
////se buscar el numero actual de facturas 

$contafac = traer_numero_factura_actual($tabla10,$_SESSION['id_empresa'],$conexion);
//echo '<br>contafac actural '.$contafac;
///////////////////////////////////////
//////////////
$siguiente_factura = $contafac + 1 ;
//echo '<br>siguiente numero de factura  == '.$siguiente_factura;
///  revisar que no exista el mismo numero de factura para esa empresa 
$sql_buscar_numero_factura  = "select * from $tabla11
 where numero_factura = '".$siguiente_factura ."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
 //echo '<br>consulta existe numero factura <br>'.$sql_buscar_numero_factura.'<br>';
$consulta_numero_factura = mysql_query($sql_buscar_numero_factura,$conexion); 
$filas_factura = mysql_num_rows($consulta_numero_factura);
if ($filas_factura == 0)
	{
 		
		//echo '<br>Esta factura se puede crear <br>';
		
		$sql_grabar_factura = "insert into $tabla11 (numero_factura,fecha,id_empresa,placa,tipo_factura)    
		values ('".$siguiente_factura."','".$fechapan."','".$_SESSION['id_empresa']."','".$idcliente."','8')"; 
		//echo '<br>grabar factura <br>'.$sql_grabar_factura;
		$consulta_grabar_factura = mysql_query($sql_grabar_factura,$conexion);
		//////actualizar el contador en empresa 
		$actualizar_contador = "update $tabla10 set  contafac = '".$siguiente_factura."'  ,contacot = '".$siguiente_factura."'
		
		where id_empresa =  '".$_SESSION['id_empresa']."' ";
		$consulta_actualizar_contador = mysql_query($actualizar_contador,$conexion);
		
	}

/////////////////////////////////
$sql_traer_id_factura = "select max(id_factura) as maximoid from $tabla11 where id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_maximo_id = mysql_query($sql_traer_id_factura,$conexion);
$arreglo_maximo_id_factura = mysql_fetch_assoc($consulta_maximo_id);
$maximo_id_factura = $arreglo_maximo_id_factura['maximoid'];
//echo 'maximo id factura <br>'.$maximo_id_factura;
////////////////////////////////
?>

<body>
<? include("../empresa.php"); ?>
<Div id="contenidos">
<?php
$sql_ruta_imagen = "select * from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_ruta_imagen,$conexion);
$datos = mysql_fetch_assoc($consulta_empresa);
$casillas_horas=$datos['casillas_horas'];
$ancho_tabla = '95%';
$ruta_imagen = '../logos/'.$datos['ruta_imagen'];
//echo '<br>rutaimagen'.$sql_ruta_imagen;
/*
echo '<pre>';
print_r($datos);
echo '</pre>';
*/
//////////////////////////////////////////////////	aqui comienza a preguntar datos 
?>		

<table width="<?php echo $ancho_tabla;  ?>" border="0">
  <tr>
    <td align="center"><img src="<?php  echo $ruta_imagen;    ?>" width="222" height="94"></td>
    <td><h9>
      <div align="center"><?php echo $datos['razon_social'].'<br>NIT:'.$datos['identi'].'<br>'.$datos['direccion'].'<br>Tels:'.$datos['telefonos'].'<br>'.
	$datos['email_empresa'].'<br>Bogota-Colombia'
	  ; ?></div>
    </h9></td>
    <td align = "center"><h9><span class="style1">FACTURA DE VENTA</span><BR>
      No<span class="style2">
      <?php  echo $siguiente_factura;  ?>
      </span><BR><span class="style1">FECHA FACTURA<BR></span><input type="hidden" size=10 name="fecha_factura" id = "fecha_factura"  value= <? echo $fechapan;?>><?php  echo $fechapan ?><BR><span class="style1">FECHA VENCIMIENTO</span><br><?php echo $datos[0]['fecha_vencimiento'];  ?></h9></td>
  </tr>
</table>


<table width="<?php echo $ancho_tabla;  ?>" border="1">
  <tr>
    <td width ="16%"><h8>Facturar a: </h8></td>
    <td width ="48%"><h8><?php echo $arreglo_cliente['nombre']   ?> </h8></td>
    <td width ="10%"><h8>Modelo:</h8></td>
    <td width ="26%"><h8><input type="text" name="modelo"  id = "modelo"></h8></td>
  </tr>
  <tr>
    <td><h8>Direccion:</h8></td>
    <td><h8><?php echo $arreglo_cliente['direccion']   ?> </h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h8>Nit o C.C. </h8></td>
    <td><h8><?php echo $arreglo_cliente['identi']   ?> </h8></td>
    <td><h8>Motor:</h8></td>
    <td><h8><input type="text" name="motor"  id = "motor"></h8></td>
  </tr>
  <tr>
    <td><h8>Telefono:</h8></td>
    <td><h8><?php echo $arreglo_cliente['telefono']   ?> </h8></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h8>Email: </h8></td>
    <td><h8><?php echo $arreglo_cliente['email']   ?> </h8></td>
    <td><h8>Chasis:</h8></td>
    <td><h8><input type="text" name="chasis"  id = "chasis"></h8></td>
  </tr>
  <tr>
    <td><h8><!--Forma Pago:--> </h8></td>
    <td><h8>
      <label>
     <!--
	  <select name="forma_pago"  id= "forma_pago">
	  <option value = "1"> CONTADO</option>
	  <option value  = "2"> CREDITO</option>
      </select>
	  -->
      </label>
    </h8></td>
    <td><input name="idcliente" id = "idcliente" type="hidden"  value = "<?php  echo $idcliente;  ?>"></td>
    <td><input name="id_factura"  id = "id_factura"  value = "<?php  echo $maximo_id_factura ?>"  type="hidden">
	<input name="numero_factura"  id = "numero_factura"  value = "<?php  echo $siguiente_factura ?>"  type="hidden"></td>
  </tr>
</table>
<!--  /////////////////////////////////////////////  -->
<?php
$_SESSION['id_orden'] = $maximo_id_factura;
$_SESSION['ancho_tabla']= $ancho_tabla;
?>
  <form action="" method="post">
	  
    <table width="<?php echo  $ancho_tabla;  ?>" border = "1">
      <tr>
        <td colspan="11"><div align="center">PARTES Y RESPUESTOS </div></td>
      </tr>
      <tr>
  
    <td><div align="center">COD </div></td>
    <td><div align="center">DESCRIPCION</div></td>
    <td><div align="center">VR Unit </div></td>
	<td><div align="center">% IVA </div></td>
    <td>EXIS</td>
    <td>CANT.</td>
    <td>TOTAL</td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
   
    <td width="38"><label>
      <input name="codigopan" type="text" id = "codigopan" size="5" class="fila_llenar" />
    </label></td>
    <td width="149"><input type="text" name="descripan" id = "descripan" />
    <div id = "descripcion"></div></td>
    <td width="82"><input type="text" name="valor_unit" id = "valor_unit" size = "10" /></td>
	<td><input type="text" name="ivaporce" id = "ivaporce" size = "5" /> </td>
    <td width="87"><input name="exispan" type="text" id = "exispan" size="10" /></td>
    <td width="85"><input name="cantipan" type="text" id = "cantipan"  size ="10" class="fila_llenar"/></td>
    <td width="77"><input name="totalpan" type="text" id = "totalpan" size="15" /></td>
    <td width="75"><button type = "button" id = "agregar_item">Agregar</button></td>
  </tr>
    </table>
	<div id = "nuevodiv">
	  <?php 
	  	//include('mostrar_items_temporal.php');
		//mostrar_items_temporal($_SESSION['ordenpan']);
	  ?>
    </div>
  </form>

<!--  /////////////////////////////////////////////  -->
	
	
	
<?php
///////////////aqui termina de preguntar datos 
?>	
<br><br>
<table width="<?php echo  $ancho_tabla; ?> border="1">
  <tr>
    <td width="212"><button type ="button"  id = "grabar_factura" ><h4>GRABAR_FACTURA</h4></button>		</td>
    <td width="369"><button type ="button"  id = "cancelar_creacion_factura" ><h4>CANCELAR CREACION</h4></button>		</td>
  </tr>
</table>


</Div>
	
</body>
</html>
<?php
function traer_numero_factura_actual($tabla10,$idempresa,$conexion)
	{
			$sql_traer_mumero = "select contafac from $tabla10  where id_empresa = '".$idempresa."'    ";
			echo '<br>consulta nuemro factura '.$sql_traer_mumero;
			$consulta_factura = mysql_query($sql_traer_mumero,$conexion);
			$arreglo = mysql_fetch_assoc($consulta_factura);
			$contafac = $arreglo['contafac'];
			return $contafac;
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
									$("#cantipan").val('');
									$("#ivaporce").focus();
									$("#totalpan").val(0);
							 //(data1);
							},
							'json');
					}// fin del if 		
			   });//finde codigopan
			  
				/////////////////////////////////	
						$("#agregar_item").click(function(){
							var data =  'codigopan =' + $("#codigopan").val();
							data += '&descripan=' + $("#descripan").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantipan=' + $("#cantipan").val();
							data += '&totalpan=' + $("#totalpan").val();
							data += '&exispan=' + $("#exispan").val();
							data += '&ivaporce=' + $("#ivaporce").val();
							data += '&orden_numero=' + $("#id_factura").val();
							$.post('procesar_items.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
					///////////////////////////////////
						$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							$.post('eliminar_items_temporal.php',data,function(a){
								$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
					///////////////////////////////////
						$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 iva =     ( $('#valor_unit').val()  *  $('#ivaporce').val())/100;
						 valorconiva = parseInt($('#valor_unit').val()) + parseInt(iva) ;
						 //resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						resultado2 = valorconiva *  $('#cantipan').val() ;
						$('#totalpan').val(resultado2);  
						
					}	
						
					});
					
					/////////////////////////
					$("#grabar_factura").click(function(){
							var data =  'id_factura=' + $("#id_factura").val();
							data += '&modelo=' + $("#modelo").val();
							data += '&motor=' + $("#motor").val();
							data += '&chasis=' + $("#chasis").val();
							data += '&forma_pago=' + $("#forma_pago").val();
							data += '&idcliente=' + $("#idcliente").val();
							$.post('grabar_factura.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
						/////////////////////////
					$("#cancelar_creacion_factura").click(function(){
							var data =  'id_factura=' + $("#id_factura").val();
							data += '&numero_factura=' + $("#numero_factura").val();
							$.post('cancelar_creacion_factura.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

