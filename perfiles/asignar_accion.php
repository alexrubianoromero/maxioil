<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$sql_clientes = "select id_perfil, nombre_perfil,descripcion
from $tabla30 
where
id_empresa = '".$_SESSION['id_empresa']."'
order by id_perfil 
";
//echo '<br>'.$sql_clientes;


//inner join $tabla4 car  on (car.propietario = cli.idcliente)
//,placa,marca,color,modelo
//include('../colocar_links2.php');
echo '<h3>CONSULTA GENERAL </h3>';
echo '<h3><a href = "captura_cliente.php" >NUEVO </a></h3>';

echo '<table border = "1" width = "95%" >';
echo '<tr><td>NOMBRE PERFIL</td><td>DESCRIPCION</td></tr>';
$consulta_clientes = mysql_query($sql_clientes,$conexion);
while($clientes = mysql_fetch_assoc($consulta_clientes))
	{
			echo '<tr>';	
			//echo '<td>'.$clientes[0].'</td>';
			//echo '<td><a href ="muestre_datos_cliente.php?idcliente='.$clientes['login'].'" ></a></td>';
			//echo '<a href="orden_detallado.php?idorden='.$ordenes['0'].'">Ver Detalle</a>';
			echo '<td><a href ="muestre_acciones_de_perfil.php?id_perfil='.$clientes['id_perfil'].'" >'.$clientes['nombre_perfil'].'</a></td>';
			echo '<td>'.$clientes['descripcion'].'</td>';
	
		
			//echo '<td>'.$clientes[4].'</td>';

			$sql_carros = "select placa,marca,color,modelo from $tabla4   where propietario = '".$clientes[5]."'";	
			$consulta_carros = mysql_query($sql_carros,$conexion);
			$filas = mysql_num_rows($consulta_carros);
			/*
			if ($filas >0)
					{
						$carros = mysql_fetch_assoc($consulta_carros); 
						echo '<td><a href ="../vehiculos/muestre_datos_carro.php?placa='.$carros['placa'].'">'.$carros['placa'].'</a></td>';
						
						echo '<td>'.$carros['marca'].'</td>';
						echo '<td>'.$carros['modelo'].'</td>';
						echo '<td><a href="../consultas/muestre_listado_ordenes_por_placa.php?placa123='.$carros['placa'].'">'.$carros['placa'].'</a></td>';
					}
					else
					{
						echo '<td>NO TIENE</td>';
						echo '<td>NO TIENE</td>';
						echo '<td>NO TIENE</td>';
						echo '<td>NO TIENE</td>';
					}

			*/
			echo '</tr>';
	}
echo '</table>';
echo '<div id = "muestre">';
echo '</div>';


?>