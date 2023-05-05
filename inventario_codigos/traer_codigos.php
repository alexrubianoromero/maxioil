<?php
session_start();

//include('../colocar_links2.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');  
$tamano_letra= '20px';

$sql_muestre_codigos = "select *
  from $tabla12  where 1=1   ";
  //echo " and anulado= '0' ";

if(isset($_REQUEST['buscar']) && $_REQUEST['buscar'] != '')
{
$sql_muestre_codigos .= " and  descripcion like '%".$_REQUEST['buscar']."%' ";
}
if(isset($_REQUEST['buscarcodigo']) && $_REQUEST['buscarcodigo'] != '')
{
$sql_muestre_codigos .= " and  codigo_producto like '%".$_REQUEST['buscarcodigo']."%' ";
}
if(isset($_REQUEST['marca']) && $_REQUEST['marca'] != '')
{
$sql_muestre_codigos .= " and  marca like '%".$_REQUEST['marca']."%' ";
}
if(isset($_REQUEST['referencia']) && $_REQUEST['referencia'] != '')
{
$sql_muestre_codigos .= " and  referencia like '%".$_REQUEST['referencia']."%' ";
}

if(isset($_REQUEST['linea']) && $_REQUEST['linea'] != '')
{
$sql_muestre_codigos .= " and  linea like '%".$_REQUEST['linea']."%' ";
}





$sql_muestre_codigos .= "order by descripcion ";


//echo '<br>'.$sql_muestre_codigos;

$consulta_codigos = mysql_query($sql_muestre_codigos,$conexion);

echo '<br>';

echo '<table border = "1" style="font-size:'.$tamano_letra.'"  id="formato_tabla123" >';
echo '<thead>'; 
echo '<tr align="center">';
 echo '<td>CODIGO</td><td>DESCRIPCION</td><td>MARCA</td>';
 echo  '<td>LINEA</td>';
 echo'<td>REFERENCIA</td><td>PROVEEDOR</td>';
echo '<td>UBICACION</td><td>COSTO</td><td>VALOR VENTA</td></td><td>UTILIDAD</td> <td>EXIS. </td><td>COMPRAS</td><td>MODIFICAR</td><td>ACCION</td>';
echo '<td>ELIMINAR</td>';
echo '<tr>';
echo '</thead>'; 
while($codigos = mysql_fetch_assoc($consulta_codigos))
{

	echo '<tbody>';
	$utilidad =$codigos['valorventa']- $codigos['valor_unit'] ;
						echo '<tr>';
			  				echo '<td>'.$codigos['codigo_producto'].'</td><td>'.$codigos['descripcion'].'</td>';
			  				echo '<td>'.$codigos['marca'].'</td>';
			  				echo '<td>'.$codigos['linea'].'</td>';

			  				echo '<td>'.$codigos['referencia'].'</td>';
			  				
			  				echo '<td>'.$codigos['proveedor'].'</td><td>'.$codigos['ubicacion'].'</td>';
			  				echo '<td align="right">'.number_format($codigos['valor_unit'], 0, ',', '.').'</td><td align="right">'.number_format($codigos['valorventa'], 0, ',', '.').'</td>';
							
							echo '<td align="right">'.number_format($utilidad, 0, ',', '.').'</td><td align="center">'.$codigos['cantidad'].'</td>';

			  				echo '<td><a href = "adicion_existencias_codigo.php?id_codigo='.$codigos['id_codigo'].'"     >ADICIONAR </a></td>';
							
							echo '<td>';
							if($_SESSION['nivel_perfil'] >2)
							{
							echo '<a href = "modificar_codigo.php?id_codigo='.$codigos['id_codigo'].'"     >MODIFICAR</a>';
							}
							echo '</td>';
							
							echo '<td><a href = "reporte_movimientos_codigo.php?id_codigo='.$codigos['id_codigo'].'"     >MOVIMIENTOS</a></td>';
			  				
			  				echo '<td>';
			  				if($_SESSION['nivel_perfil'] >2)
							{
			  					echo'<a href = "eliminar_codigo.php?id_codigo='.$codigos['id_codigo'].'"     >ELIMINAR</a>';
			  				}
			  				echo '</td>';
			  			
			  			echo '</tr>';
	echo '</tbody>';

}//FIND E WHILE 

echo '</table>';











?>  