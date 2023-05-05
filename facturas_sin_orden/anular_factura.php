<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
 function  consulta_assoc_fac($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

 $datos_factura =  consulta_assoc_fac($tabla11,'id_factura',$_REQUEST['id_factura'],$conexion);
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
<style>
#div_anular_factura{
	font-size: 20px;

}

</style>	
</head>
<body>
<div id = "div_anular_factura" align= "center">
	<input type="hidden"   id="id_factura"  value ="<?php echo $_REQUEST['id_factura'] ?>"  >
<h1>ANULAR FACTURA </h1>
<BR><BR>
INFORMACION DE FACTURA 
<br>
<table  border = "1">
   <tr>
   		<td>Factura Numero</td>	
   		<td>Fecha</td>	
   		<td>Valor</td>	
   </tr>
   <tr>
   		<td><?php  echo $datos_factura['numero_factura'] ?></td>	
   		<td><?php  echo $datos_factura['fecha'] ?></td>
   		<td><?php  echo $datos_factura['total_factura'] ?></td>
   </tr>

   
</table> 
<br><br>
<button id="btn_anular_factura">ANULAR FACTURA</button>
</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 


<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			
						$("#btn_anular_factura").click(function(){
							var data =  'id_factura=' + $("#id_factura").val();
							//data += '&descripan=' + $("#descripan").val();
								$.post('anulacion_factura.php',data,function(a){
							$("#div_anular_factura").html(a);
								//alert(data);
							});	
								
						 });
					
			});		////finde la funcion principal de script	
</script>


