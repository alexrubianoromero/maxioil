<?PHP
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
echo 'existencias '.$_POST['exispan']; 
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
?>
<input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "<? echo $_POST['orden_numero'] ?>"  >
<?php
$total_item_sin_iva = $_POST['valor_unit'] * $_POST['cantipan'];
$sql_grabar_item = "insert into $tabla15 (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado,iva,total_item_con_iva,valor_iva)
values ('".$_POST['orden_numero']."','".$_POST['codigopan_']."','".$_POST['descripan']."','".$_POST['cantipan']."',
'".$total_item_sin_iva ."','".$_POST['valor_unit']."','".$_SESSION['id_empresa']."','0','".$_POST['exispan']."','".$_POST['totalpan']."','".$_POST['valorivapan']."')";

$consulta_grabar_item  = mysql_query($sql_grabar_item,$conexion);
///taer el valor del inventario en este momento 

$sql_consultar_el_valor_real_existencias = 
"select cantidad from $tabla12 where 
codigo_producto = '".$_REQUEST['codigopan_']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_valor_real_existencias = mysql_query($sql_consultar_el_valor_real_existencias,$conexion);
$arreglo_existencias_codigo = mysql_fetch_assoc($consulta_valor_real_existencias);

$valor_final_inventario = $arreglo_existencias_codigo['cantidad']-$_POST['cantipan'];

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
