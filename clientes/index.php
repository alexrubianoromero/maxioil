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
	 <link rel="stylesheet" href="css/style_menu_navegacion.css"> 
</head>
<body>
<? include("../empresa.php"); ?>
<Div id="contenidos">
		
	<nav>
	<ul class="menu">

		 
		  <li><a href=./consultacliente_general.php  class="menu"  >INGRESO / CONSULTA / MODIFICACION</a></li>
		  <!--
		  <li><a href=./menu_modificar_cliente.php  class="menu"  >MODIFICACION DE CLIENTES</a></li>
		  -->
		  	<li><a href="../menu_principal.php" class="menu"> MENU PRINCIPAL </a></li>


	</ul>
</nav>
</Div>
	
</body>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   
</html>




 


