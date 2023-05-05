<?PHP
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';

exit();
*/

///////////////////////////
//$factupan = '1234567';
//$factupan = $_POST['factupan'];
/*
$db = "prueba_facturacion";
include('access_facturacion.php');
*/
include('../valotablapc.php');
$factupan = $_SESSION['id_orden'];

//echo 'idorden============'.$factupan;
?>
<input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "<? echo $_POST['orden_numero'] ?>"  >
<?php
$total_item = $_REQUEST['cantipan']  *  $_REQUEST['valor_unit'];
$total_item_sin_iva = $_POST['valor_unit'] * $_POST['cantipan'];
$total_costo_producto = $_REQUEST['cantipan'] * $_REQUEST['costo_producto']  ;
$iva = 0;
if($_POST['ivaporce'] > 0){$iva=1;}
$sql_grabar_item = "insert into $tabla100 
(no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado,porcentaje_iva,
	total_item_con_iva,
	iva,
	costo_producto,total_costo_producto)
values ('".$_POST['orden_numero']."','".$_POST['codigopan_']."','".$_POST['descripan']."','".$_POST['cantipan']."',
'".$total_item."','".$_POST['valor_unit']."',
'".$_SESSION['id_empresa']."','0',
'".$_POST['ivaporce']."'
,'".$total_item."'
,'".$iva."'
,'".$_POST['costo_producto']."'
,'".$total_costo_producto."'
)";
//echo '<br>consulta<br>'.$sql_grabar_item;
$consulta_grabar_item  = mysql_query($sql_grabar_item,$conexion);

$valor_final_inventario = $_POST['exispan']-$_POST['cantipan'];

$sql_actualizar_inventario = "update $tabla12 set cantidad = '".$valor_final_inventario."'   
 where codigo_producto = '".$_POST['codigopan_']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);  
include('mostrar_items.php');
mostrar_items($factupan);
?>
<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
			
			$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							data += '&factupan=' + $("#orden_numero").val();
							$.post('eliminar_items.php',data,function(a){
								$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
            });	
			
			function prueba(codigo)
			{
				alert(codigo);
			}
</script>			
