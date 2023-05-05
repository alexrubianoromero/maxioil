<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Codigos</title>
 <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php
include('../valotablapc.php');  
echo '<div id="total_codigos" >';
echo '<br><br>';
	echo '<div id="botones" align="center">';
 echo '* El sistema filtrara con los campos digitados';
	echo '<input type="text" id="buscarcodigo"  placeholder ="codigo" class="fila_llenar"> ';
	echo '<input type="text" id="buscar"  placeholder ="descripcion" class="fila_llenar"> ';
	echo '<input type="text" id="marca"  placeholder ="marca" class="fila_llenar"> ';
	echo '<input type="text" id="linea"  placeholder ="linea" class="fila_llenar"> ';
	echo '<input type="text" id="referencia"  placeholder ="referencia" class="fila_llenar"> ';

	echo '<button id="btn_buscar" >buscar</button>';
	echo '<br>';


	echo '</div>';
		echo '<div id="1234" >';
		// echo 'filtro codigos'; 
		include ('traer_codigos.php');
		echo '</div>';
echo '</div>';
?>





<?php
/*
include('../colocar_links2.php');
include('../valotablapc.php');  
include('../funciones.php'); 
$tamano_letra= '20px';
$sql_muestre_codigos = "select codigo_producto as codigo_producto, descripcion as descripcion ,marca,referencia ,valor_unit as valor_unitario , 
cantidad as existencias, id_codigo,valorventa,proveedor,ubicacion,valorventaconiva   from $tabla12  where id_empresa = '".$_SESSION['id_empresa']."'";

//echo '<br>'.$sql_muestre_codigos;
$consulta_codigos = mysql_query($sql_muestre_codigos,$conexion);
$filas = mysql_num_rows($consulta_codigos);
//echo '<br>filas'.$filas;   
if($filas == 0 )
		{
			echo "<br>NO EXISTEN CODIGOS EN LAS BASES DE DATOS ";
		}
	else
	 	{
			//$codigos = get_table_assoc($consulta_codigos);
			
			//draw_table($codigos);
			echo '<br>';
	 		echo '<table border = "1" style="font-size:'.$tamano_letra.'">';
	 		 echo '<tr align="center">';
	 		 echo '<td>CODIGO</td><td>DESCRIPCION</td><td>MARCA</td><td>REFERENCIA</td><td>PROVEEDOR</td>';
	 		 echo '<td>UBICACION</td><td>COSTO</td><td>VALOR VENTA<br>(Sin Iva)</td><td>VALOR VENTA<br>(Con Iva)</td><td>UTILIDAD</td> <td>EXIS. </td><td>COMPRAS</td><td>MODIFICAR</td><td>ACCION</td>';
	 		 echo '</tr>';
			  while($codigos = mysql_fetch_assoc($consulta_codigos))
			  		{
			  			$utilidad =$codigos['valorventa']- $codigos['valor_unitario'] ;
						echo '<tr>';
			  				echo '<td>'.$codigos['codigo_producto'].'</td><td>'.$codigos['descripcion'].'</td>';
			  				echo '<td>'.$codigos['marca'].'</td><td>'.$codigos['referencia'].'</td>';
			  				
			  				echo '<td>'.$codigos['proveedor'].'</td><td>'.$codigos['ubicacion'].'</td>';
			  				echo '<td>'.$codigos['valor_unitario'].'</td><td>'.$codigos['valorventa'].'</td>';
							echo '<td>'.$codigos['valorventaconiva'].'</td>';
							echo '<td>'.$utilidad.'</td><td>'.$codigos['existencias'].'</td>';

			  				echo '<td><a href = "adicion_existencias_codigo.php?id_codigo='.$codigos['id_codigo'].'"     >ADICIONAR </a></td>';
							echo '<td><a href = "modificar_codigo.php?id_codigo='.$codigos['id_codigo'].'"     >MODIFICAR</a></td>';
							echo '<td><a href = "reporte_movimientos_codigo.php?id_codigo='.$codigos['id_codigo'].'"     >MOVIMIENTOS</a></td>';
			  			echo '</tr>';

			  		}
			  echo '</table>';		
		}  
*/

?>



</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>  
<script type="text/javascript">
  $(document).ready(function(){
  			$("#btn_buscar").click(function(){

							var data =  'buscar=' + $("#buscar").val();
							  data += '&buscarcodigo=' + $("#buscarcodigo").val();
							  data += '&marca=' + $("#marca").val();
							  data += '&linea=' + $("#linea").val();
							  data += '&referencia=' + $("#referencia").val();


							//data += '&clave=' + $("#clave").val();
							$.post('traer_codigos.php',data,function(a){
							      $("#1234").html(a);

							});	

  		 });

  }); //fin funcion principal
 
</script>  	 


