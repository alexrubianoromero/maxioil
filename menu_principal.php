<?php  
session_start();
date_default_timezone_set('America/Bogota');
include('valotablapc.php');
include('funciones_alarmas.php');
$fechapan =  time();
$fecha_actual = date ( "Y/m/j" , $fechapan );
$dia_actual = date("d");
$mes_actual = date("m");

//echo '<br>............'.$dia_actual;
$alertas = verificar_alertas($fechapan,$cuentasxpagar,$conexion);

$contar_cumpleanos = contar_cumpleanos($tabla3,$conexion,$dia_actual,$mes_actual);
//echo 'aaaaaaaaaaaaaaaaaaaaaaaaa'.$contar_cumpleanos;
//cumpleanos($tabla3,$conexion,$dia_actual,$mes_actual);
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit();
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<meta name="viewport" content="initial-scale=1">
<script src="js/jquery.js"></script>  
<link rel="stylesheet" href="css/style_menu_navegacion.css">
<link rel="stylesheet" href="css/style.css">
<!-- <link rel="stylesheet" href="css/fontello.css"> -->
 <!-- <script type="text/javascript" src="js/cssrefresh.js"></script> -->
<style>
body{
background-color: #FCAB65;	
background-color: #c0c0c0;	
}
#fondo_foto{
	position:relative;
	background-color: #93B8C5;
	background-color: red;
	border: 1px solid black;
}
#alarmas{
	position:absolute;
	bottom: 5%;
	right: 10%;
	width: 50px;
	height: 50px;
	display: inline-block;
	/*border: 1px solid black;*/
}
#div_cumpleanos{
	position:absolute;
	bottom: 5%;
	right: 15%;
	width: 50px;
	height: 50px;
	display: inline-block;
	/*border: 1px solid black;*/
}
#info_usuario{
	position:absolute;
	bottom: 0%;
	left: 5%;
	width: 300px;
	height: 50px;
	display: inline-block;
	color:white;
	/*border: 1px solid black;*/

}
</style>
</head>
<body>
<?php 
    $sql_empresa = "select * from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
    $consulta_empresa = mysql_query($sql_empresa,$conexion);
    $ruta_empresa = mysql_fetch_assoc($consulta_empresa);
    $nombre_imagen = $ruta_empresa['ruta_imagen'];
    //echo '<br>'.$nombre_imagen;

?>
 <div align="center" id="fondo_foto">
 	
 	<div id="info_usuario">
 		<?php  
             echo '<br>Usuario: '.$_SESSION['nombre_usuario'].'   Perfil: '. $_SESSION['nombre_perfil'];
 		?>
 	
 	</div>
 	
 	<img src="logos/<?php echo $nombre_imagen;  ?>" width="420px" height="150px" />
    <div id="div_cumpleanos">
    	<?php  
    		if($contar_cumpleanos > 0)
    		{  
    	?>	
       
    	<a href="cumpleanos/muestre_cumpleanos.php"   target ="cuadro_principal"  ><img src="logos/cumpleanos.png"  width="50px" height="50px" /></a>
    	<?php
        }// fin de if($alertas > 0)
    	?>

    </div>
    <div id="alarmas">
    	<?php  
    		if($alertas > 0)
    		{  
    	?>	
       
    	<a href="alarmas/muestre_alarmas.php"   target ="cuadro_principal"  ><img src="logos/alarma.jpg"  width="50px" height="50px" /></a>
    	<?php
        }// fin de if($alertas > 0)
    	?>

    </div> 
 </div>
<header>
			
			<input type="checkbox" id="btn-menu">
			<label for="btn-menu" class="entypo-menu"></label>
			<nav class="menu">
			<?php 
			include('pintar_menu_categorias.php');
			?>	
			
				<!--
				<ul>
					<li><a href="#">Item 1</a></li>

					<li class="submenu"><a href="#">Item 2<span class="entypo-down-open"></span></a>
						<ul>
							<li><a href="#">Sub Item 1</a></li>
							<li><a href="#">Sub Item 2</a></li>
							<li><a href="#">Sub Item 3</a></li>
							<li><a href="#">Sub Item 4</a></li>
						</ul>
					</li>
					
					<li class="submenu"><a href="#">Item 3<span class="entypo-down-open"></span></a>
						<ul>
							<li><a href="#">Sub Item 1</a></li>
							<li><a href="#">Sub Item 2</a></li>
							<li><a href="#">Sub Item 3</a></li>
							<li><a href="#">Sub Item 4</a></li>
						</ul>
					</li>
					<li><a href="#">Item 4</a></li>
				</ul>
				-->
			</nav>
		</header>
		<iframe name = "cuadro_principal" width="100%" height="600">
</iframe>
</body>
</html>
<script src="menu.js"></script>  