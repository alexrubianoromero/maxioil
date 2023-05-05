<?php
session_start();
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
//echo 'id_empresa '.$_SESSION['id_empresa'];
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? 
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');


$sql_muestre_ordenes = "select id as No_Orden,
fecha,
placa,
id,
orden,
kilometraje,
estado,
mecanico,
pagada,
saldo
 from $tabla14  where 1=1  and tipo_orden < '2'   order by id desc";

//echo '<br>'.$sql_muestre_ordenes.'<br>';
$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);




?>
<Div id="contenidos">
		<header>
			<h2>CONSULTA ORDENES </h2>
		</header>
	
<?php
include('../colocar_links2.php');
echo '<table border= "1">';
	echo '<tr>';

	echo '<td><h3>No Orden<h3></td><td><h3>Imagenes</h3></td><td><h3>Estado</h3></td><td><h3>Linea</h3></td><td><h3>Fecha</h3></td><td><h3>Placa</h3></td>';
	echo '<td><h3>Tecnico</h3></td>	';
	echo '<td><h3>Total<br>Saldo<br>Abonos<br>Cliente</h3></td>	';
	echo '<td><h3>Prestamos<BR>Internos</h3></td>	';
	echo'<td><h3>Pagos<BR>Tecnico</h3></td>';

	if($_SESSION['nivel_perfil'] > 2)
	{ 
	echo'<td><h3>Anular</h3></td>';
	 echo '<td><h3>Modificar</h3></td>'; 
    }

 echo '<td><h3>Imprimir</h3></td>'; 
		 //echo '<td><h3>Ver Pre Forma</h3></td>'; 
	
	echo '<tr>';
		while($ordenes = mysql_fetch_array($consulta_ordenes))
			{
				
				

				$suma_items = "select sum(total_item) as suma_items from $tabla15 where no_factura = '".$ordenes['0']."' ";
				$consulta_items = mysql_query($suma_items,$conexion);
				$arr_suma_items = mysql_fetch_assoc($consulta_items);
                //echo 'consulta<br>'.$suma_items; 

				$recibos_caja = "select sum(lasumade)  as suma_recibos from $tabla23  where   id_orden = '".$ordenes['0']."' ";
				$consulta_recibos = mysql_query($recibos_caja,$conexion);
				$arr_suma_recibos = mysql_fetch_assoc($consulta_recibos);
				$saldo_orden = $arr_suma_items['suma_items']-$arr_suma_recibos['suma_recibos'];


				$nombre_estado = busque_estado($tabla26,$ordenes[6],$_SESSION['id_empresa'],$conexion);
				$sql_traer_tipo  = "select tipo from $tabla4 where placa='".$ordenes['2']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
				$consulta_tipo = mysql_query($sql_traer_tipo,$conexion);
				$linea_tipo = mysql_fetch_assoc($consulta_tipo);
				$linea_tipo = $linea_tipo['tipo'];
				//////////////////////////////////
				$nombre_mecanico = buscar_mecanico($tabla21,$ordenes['7'],$id_empresa,$conexion);
				/////////////////////////////////
				//aqui se definiran los colores a usar
				
				if($ordenes[6] == 0){ echo '<tr class="fila_blanca">'; }
				if($ordenes[6] == 1){ echo '<tr class="fila_amarilla">'; }
				if($ordenes[6] == 2){ echo '<tr class="fila_verde">'; }
				if($ordenes[8] == 1){ echo '<tr class="fila_azul">'; }
				
				echo '<td><h3>'.$ordenes['4'].'</h3></td>';
					echo  '<td><h3>';
				echo '<a href="../imagenes_modulo/muestre_imagenes_orden.php?idorden='.$ordenes['0'].'&placamasorden='.$placa_mas_idorden.'">Imagenes</a>';
				echo '</h3></td>';
				echo '<td><h3>'.$nombre_estado.'</h3></td><td><h3>'.$linea_tipo.'</h3></td><td><h3>'.$ordenes['1'].'</h3></td><td><h3>'.$ordenes['2'].'</h3></td><td><h3>'.$nombre_mecanico.'</h3></td>';
				

				
				 echo '<td><h3>'; 
				 ////////aquidebe ir el total de la orden 
				echo number_format($arr_suma_items['suma_items'], 0, ',', '.').'<br><br>';
				////////luego el saldo
				echo number_format($saldo_orden, 0, ',', '.').'<br><br>';

				 echo '<a href="../caja/captura_recibos_de_caja.php?id_orden='.$ordenes['0'].'&tipo_recibo=1&abono=1&placa='.$ordenes['2'].'" >CREAR</a>';
				 echo '</h3></td>';
				 
				 echo '<td><h3>';
				 echo '<a href= "../prestamos_internos/consultar_prestamos.php?idorden='.$ordenes['0'].'&placa='.$ordenes['2'].'&orden='.$ordenes['4'].'">Consultar</a>';
				 echo '<br><br>';
				 echo '<a href = "../prestamos_internos/capturar_prestamo.php?idorden_prestadora='.$ordenes['0'].'&orden='.$ordenes['4'].'&placa='.$ordenes['2'].'">Prestar_A</a>';
				 

				 ////revisar si tiene algun prestamo que le hallan hecho a la orden
				 ///y que no se halla marcado como devuelto 
				 $sql_revisar_prestamos_vigentes = "select * from $prestamos_internos  
				  where id_orden_que_recibe  = '".$ordenes['0']."'  and devuelto ='0' ";
				//echo '<br>'.$sql_revisar_prestamos_vigentes;
				 $con_prestamos_vigentes = mysql_query($sql_revisar_prestamos_vigentes,$conexion);
				 $filas_prestamos = mysql_num_rows($con_prestamos_vigentes);

				 if($filas_prestamos > 0)
				 { 
				 echo '<br><BR>';	
				  echo '<a href="../prestamos_internos/muestre_prestamos_recibidos.php?idorden='.$ordenes['0'].'">Devolver</a>';
				}
				 echo '</h3></td>';

				echo  '<td><h3>';
				echo '<a href=>Pagos</a>';
				echo '</h3></td>';

				if($_SESSION['nivel_perfil'] >2)
				{			
				echo  '<td><h3>';			
			    echo '<a href="orden_anular.php?idorden='.$ordenes['0'].'" >Anular</a>';
			    echo '</h3></td>';

				echo  '<td><h3>';
				echo '<a href="orden_modificar_honda.php?idorden='.$ordenes['0'].'" >Modificar</a>';
				echo '</h3></td>';
				}

				echo  '<td>';
				echo '<h3>'; 
				echo '<a>Pdf</a>';
				echo '</h3>';
				echo '<h3>';
				echo '<a href="orden_imprimir_honda_cero_sin_sesion.php?idorden='.$ordenes['0'].'"  target="_blank" >Media_Hoja</a>';
				echo '</h3>';
				echo '<h3>';
				echo '<a href="orden_imprimir.php?idorden='.$ordenes['0'].'"  target="_blank" >Hoja_Completa</a>';
				echo '</h3>';
				echo '</td>'; 
					//////////////////
					/*
					echo  '<td><h3>';
					//////verificar que tenga prefactura 
					///si la tiene aparecera visualizar prefactura 
					////si no pues estara en balanco o un aviso de no tiene 
					
					$sql_buscar_prefactura_de_orden = "select * from $tabla_prefacturas where idorden = '".$ordenes['0']."' ";
					$consulta_prefacturas = mysql_query($sql_buscar_prefactura_de_orden,$conexion);
					$filas_prefacturas = mysql_num_rows($consulta_prefacturas);
					
					if($filas_prefacturas > 0)
					{
						echo '<a href="../prefacturas/orden_imprimir_preforma.php?idorden='.$ordenes['0'].'"  target = "_blank">Pre Forma</a>';
					}
					else
					{
						echo 'NO TIENE';					 
					}
					echo '</h3></td>'; 
					
					*/
					////////////////////
					/*
					echo  '<td><h3>';
					echo '<a href="orden_imprimir_honda_cero_ante.php?idorden='.$ordenes['0'].'"  target = "_blank">Imprimir_Orden</a>';
					echo '</h3></td>'; 
					*/
					////////
					
				echo '<tr>';
			}
echo '<table border= "1">';

//////////////
function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)
	{
	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";
	  $consulta_estados = mysql_query($sql_estados,$conexion);
	  $resultado = mysql_fetch_assoc($consulta_estados);
	  $nombre_estado = $resultado['descripcion_estado'];
	  return $nombre_estado;
	}
	
/////////////
function buscar_mecanico($tabla21,$id_mecanico,$id_empresa,$conexion)
{
 $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$id_mecanico."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
					return $nombre_mecanico;
}//fin de la funcion


/////////////

?>
	</Div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
