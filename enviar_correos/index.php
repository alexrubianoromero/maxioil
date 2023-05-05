<?php
session_start();
include("../empresa.php"); 
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<input type="text"  id="valor" name = "valor" >

<?php
$correo = 'alexrubianoromero@gmail.com';
$asunto = 'Creacion de Orden De trabajo ';
$cuerpo = "Atentamente informamos que se realizo la creacion de la orden de trabajo numero 123";

?>
<button id="enviar_correo">Enviar Correo  </button>
<button id="enviar_correo2">Enviar Correo2  </button>
<a href="http://www.alexrubiano.com/prueba_enviar_mail/index3.php?correo=<?php echo $correo; ?>&asunto=<?php echo $asunto; ?>&cuerpo=<?php echo $cuerpo; ?>" >prueba enviar parametros</a>
<div id="muestre">
</div>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
					/////////////////////////
					$("#enviar_correo").click(function(){
					      
							var data =  'valor=' + $("#valor").val();
							 
							//data += '&dequienoaquin=' + $("#dequienoaquin").val();
							//$.post('http://www.alexrubiano.com/kaymo/orden/index.php',data,function(a){
							$.post('http://www.alexrubiano.com/prueba_enviar_mail/index3.php',data,function(a){
							//$(window).attr('location', '../index.php);
							
							 $("#muestre").html(a);
								alert('se realizo click ');
							});	
							
						 });
					////////////////////////
					///////////////////////
					
					$("#enviar_correo2").click(function(){
					      
							var data =  'valor=' + $("#valor").val();
							 
							//data += '&dequienoaquin=' + $("#dequienoaquin").val();
							//$.load('http://www.alexrubiano.com/kaymo/orden/index.php',data,function(a){
							//$.post('enviar_correo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							 //$("#muestre").load('enviar_correo.php');
							 $("#muestre").load('http://www.alexrubiano.com/prueba_enviar_mail/index3.php');
								
							 //
						 });
						
					/////////////////////
			});		////finde la funcion principal de script		
</script>
  
