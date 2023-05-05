<?php
session_start();
include('../valotablapc.php');
function colocar_select_general($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla   ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}
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
</style>
</head>
<body>
<div id="container" align="center">
  <div id="aviso">
  <h3> CUENTAS POR PAGAR</h3>
  <br><select id="id_proveedor">
  <?php
  	colocar_select_general($proveedores,$conexion,'idcliente','nombre');
  ?>

</select>
  <button id="btn_buscar_proveedor">CONSULTAR</button>
<br><br>
</div>
<div id="muestre_cxc">
        <?php include('muestre_cxc.php');  ?>
</div>
</div>	
</body>
</html>


<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
					
					/////////////////////////
					$("#btn_buscar_proveedor").click(function(){
							var data =  'id_proveedor=' + $("#id_proveedor").val();
							//data += '&cedula=' + $("#cedula").val();
							
							$.post('muestre_cxc.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre_cxc").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

  
