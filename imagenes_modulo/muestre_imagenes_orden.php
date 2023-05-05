<?php
session_start();
include('../valotablapc.php');  
include('../funciones.php'); 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/style.css">
<style type="text/css">
<!--
.style2 {
color: black;
	margin-left: 10px;
	font-size: 30px;
}
-->
</style>
</head>
<body>
<?php
$sql_traer_imagenes = "select * from $tablaima  where idorden  = '".$_REQUEST['idorden']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo '<br>la consulta<br>'.$sql_traer_imagenes;
$consulta_imagenes = mysql_query($sql_traer_imagenes,$conexion);
echo '<BR>';echo '<BR>';
?>

<BR>
<BR>
	<?php
echo '<a href="captura_imagen.php?idorden='.$_REQUEST['idorden'].'&placamasorden='.$_REQUEST['placamasorden'].'"><span class="style2">NUEVA_IMAGEN</span></a>';

echo '<br>';
echo '<br>';
echo '<table border = "1">';
echo '<tr>';
echo '<td>ELIMINAR</td>';
echo '<td>IMAGEN</td>';
echo '</tr>';

while($imagenes = mysql_fetch_assoc($consulta_imagenes))
		{
			echo '<tr>';
			
			echo '<td><a href="eliminar_imagen.php?ruta_imagen='.$imagenes['ruta_imagen'].'&id_imagen_orden='.$imagenes['id_imagen_orden'].'&idorden='.$_REQUEST['idorden'].'">Eliminar </a>';
			echo '<td><a href="mostrar_imagen.php?ruta_imagen='.$imagenes['ruta_imagen'].'"> 
			<img src="'.$imagenes['ruta_imagen'].'" width="100" height="100"   />
			</a></td>';
			echo '</tr>';
		}
echo '</table>';		
?>

</body>
</html>
