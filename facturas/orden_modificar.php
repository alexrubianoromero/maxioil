<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="./js/jquery.js" type="text/javascript"></script>
</head>
<body>
<?php
/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
exit();
*/
include('../valotablapc.php');  
include('../funciones.php'); 
/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();
$idorden = $_REQUEST['idorden'];
$sql_placas = "select cli.nombre,cli.identi,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,
  e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'   and   o.id_empresa = '".$_SESSION['id_empresa']."'  and o.estado < '20' ";
 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
//echo '<br>filas =='.$filas;

 $datos = get_table_assoc($datos); 


$sql_items_orden = "select * from $tabla15 where no_factura = '".$_GET['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);
$factupan = $_GET['idorden'];


/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/
//echo '<br>'.$datos[0]['placa'];
echo '<input type = "hidden"  id="placa" name="placa"  value = "'.$datos[0]['placa'].'"   > ';
echo '<input type = "hidden"  id="orden_numero" name="orden_numero"  value = "'.$_REQUEST['idorden'].'"   > ';

//$fechapan =  time();

?>
<H2>CRECION DE DOCUMENTO</H2> 
<div id = "creacion ">
</div>
		 <div id = "div_items">
				 <?php include('prueba_items.php');   ?>
		 </div>
       <br>	 
		
		 	
<div id = "divorden">
<table border = "1" width ="95%">
<tr>
          <?php  
             $regimen = regimen($_SESSION['id_empresa'],$tabla10,$conexion);
          ?>


        <td width="20%" height="20">   <?php
echo '<button type ="button"  id = "recalcular_items" ><h4>RECALCULAR ITEMS</h4></button>';
?>	        </td>
        <td width="20%"><button type ="button"  id = "actualizar_orden" >
		 <h4>CREAR DOCUMENTO </h4>
		 </button>	</td>
        <td width="23%"><?php   if($regimen=='1'){echo '<label for ="resolucion" ><h4>FACTURA CON RESOLUCION</h4></label>';}   ?></td>
        <td width="10%"><?php 
                if($regimen=='1'){echo '
                 <label>
                 <input type="checkbox" name="resolucion"  id =  "resolucion"  value = "1">
                 </label>';}
             ?></td>
			 <td  width="20%" align ="right"><label for ="forma_pago" > <h4>PAGO DE CONTADO</h4> </label> </td>
			 <td width="20%" > <?php echo '
                 <label>
                 <input type="checkbox" name="forma_pago"  id =  "forma_pago"  value = "1"  checked>
                 </label>';  ?> </td>
</tr>
</table>
</div>
</body>
</html>
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
									$("#cantipan").focus();
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
							data += '&orden_numero=' + $("#orden_numero").val();
							$.post('procesar_items.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
				
					///////////////////////////////////
						$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						$('#totalpan').val(resultado2);  
					}	
						
					});
					
					/////////////////////////
					$("#actualizar_orden").click(function(){
							var data =  'orden_numero=' + $("#orden_numero").val();
							data += '&placa=' + $("#placa").val();
							data += '&resolucion=' + $("#resolucion:checked").val();
							data += '&iva=' + $("#iva").val();
              data += '&elaborado_por=' + $("#elaborado_por").val();
							data += '&suma_total_iva=' + $("#suma_total_iva").val();
							data += '&valor_retefuente=' + $("#valor_retefuente").val();
							data += '&total_final_factura=' + $("#total_final_factura").val();
							data += '&forma_pago=' + $("#forma_pago:checked").val();
							$.post('actualizar_orden.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
</script>

