<?php
session_start();
include('../valotablapc.php');

?>
<html>
<head>
	<title></title>

  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<div id="div_productos1" align="center">

<button id="btn_nuevo_producto" class="btn btn-primary">NUEVA EMPRESA</button><br><br>
<div id="div_muestre_productos" align="center">
	<?php
       include('mostrar_hoteles.php');
	?>
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
					 $("#btn_nuevo_producto").click(function(){
							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('nuevo_hotel.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_productos").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#vendedores").click(function(){
							var data =  'rol=' + '2';
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#nuevo").click(function(){
							var data =  'nuevo=' + '';
							//data += '&placa=' + $("#placa").val();
							$.post('captura_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////


});		////finde la funcion principal de script
		
</script>