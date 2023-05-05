<?php
session_start();
/*
echo  '<pre>';
print_r($_REQUEST);
echo  '</pre>';
*/
include('../valotablapc.php');




$sql_traer_items  = "select   *
from $tabla3 
where month(fecha_cumpleanos)  ='".$_REQUEST['id_mes']."'  
 ";
//echo '<br>'.$sql_traer_items;
$consulta_items = mysql_query($sql_traer_items,$conexion);
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura </title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href="../jquery-ui-1.12.1_ui_lightness/jquery-ui.css" rel = "stylesheet">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../jquery-ui-1.12.1_ui_lightness/jquery-ui.js"></script>

<style>
table{
  border-collapse: collapse;
  width: 80%;
}
</style>
</head>
<body>
<h3>INFORME CUMPELANOS </h3>
<br><br>
<?php
echo '<table border="1" id="formato_tabla">';
	echo '<tr>';
	echo '<td align="center">Fecha_Cumpleanos</td>';
	echo '<td align="center">Nombre</td>';
	echo '<td align="center">Telefono</td>';
	echo '<td align="center">Email</td>';
	echo '<td align="center">Direccion</td>';
	echo '</tr>';

while($items = mysql_fetch_assoc($consulta_items))
{

	echo '<tr>';
	echo '<td>'.$items['fecha_cumpleanos'].'</td>';
	echo '<td>'.$items['nombre'].'</td>';
	echo '<td>'.$items['telefono'].'</td>';
	echo '<td>'.$items['email'].'</td>';
	echo '<td>'.$items['direccion'].'</td>';
	
	echo '</tr>';

}

echo '</table>';
?>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script type="text/javascript">
 $(document).ready(function(){
	  $("#btn_consultar").click(function(){
							var data =  'fechain=' + $("#fechain").val();
							data += '&fechafin=' + $("#fechafin").val();
	
							$.post('informe_cumpleanos_por_fecha.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre_informe").html(a);
								//alert(data);
							});	
						 });
	  	
  });//fin de la funcion principal 

</script>   