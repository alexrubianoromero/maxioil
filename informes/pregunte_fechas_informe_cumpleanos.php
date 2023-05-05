<?php
session_start();
include('../valotablapc.php');

function colocar_select_general($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla   ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >Seleccione el Mes</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}


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
</style>
</head>
<body>
<h3>DIGITE LAS FECHAS DEL INFORME CUMPLEANOS </h3>
<div id="div_informe_total">

<div id="div_fechas">
	
	<label for="id_mes" >MES </label>
<select id="id_mes">
	<?php
		
		colocar_select_general($meses,$conexion,'id_mes','nombre');
	?>

</select>	
	

	<button id="btn_consultar">CONSULTAR</button>

</div>

<div id="muestre_informe">

</div>

</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script type="text/javascript">
 $(document).ready(function(){
	  $("#btn_consultar").click(function(){
							var data =  'id_mes=' + $("#id_mes").val();
							//data += '&fechafin=' + $("#fechafin").val();
							
							$.post('informe_cumpleanos_por_fecha.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre_informe").html(a);
								//alert(data);
							});	
						 });
	  	
  });//fin de la funcion principal 

</script>   
