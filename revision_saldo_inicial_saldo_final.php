<!DOCTYPE html>
<html>
<head>
</head>
<body bgcolor="#999999" >

<?php
include('valotablapc.php');
$sql_traer_salin_salfin = "select * from $tabla22  where id_empresa = '300' order by id_dia_caja ";
$consulta1 = mysql_query($sql_traer_salin_salfin,$conexion);
/////////////////////////////////////////
$saldo_final_anterior = 0;
//////////////////////////////////////
echo '<table border="1">';
echo '<tr>';
echo '<td>fecha</td>';


echo '<td>Entradas</td>';
echo '<td>salidas</td>';
echo '<td>s final</td>';
echo '<td>saldo ffinal calculado</td>';
echo '<td>saldo final anterior</td>';
echo '<td>s inicial</td>';
echo '<td>saldo final calculado</td>';





echo '</tr>';
while($salin_salfin = mysql_fetch_assoc($consulta1))
{
	$consulta_entradas_dia = "select sum(lasumade) as entradas from $tabla23 
	where fecha_recibo = '".$salin_salfin['fecha']."' and id_empresa = '300' 
	and tipo_recibo = '1'  and anulado = 0 ";
	$entradas = mysql_query($consulta_entradas_dia,$conexion);	
	$areglo_entradas = mysql_fetch_assoc($entradas);
	$valor_entradas = $areglo_entradas['entradas'];

	$consulta_salidas = "select sum(lasumade) as salidas from $tabla23 
	where fecha_recibo = '".$salin_salfin['fecha']."' and id_empresa = '300' 
	and tipo_recibo = '2' and anulado = 0  ";
	$salidas = mysql_query($consulta_salidas,$conexion);
	$areglo_salidas = mysql_fetch_assoc($salidas);
	$valor_salidas  = $areglo_salidas['salidas'];

	$saldo_final = $salin_salfin['saldo_inicial']+$valor_entradas -$valor_salidas;

	$saldo_final_calculado = $saldo_final_anterior + $valor_entradas - $valor_salidas;


	echo '<tr>';
	echo '<td>'.$salin_salfin['fecha'].'</td>';
	
	echo '<td>'.$valor_entradas.'</td>';
	echo '<td>'.$valor_salidas.'</td>';
	echo '<td>'.$salin_salfin['saldo_final'].'</td>';
	echo '<td>'.$saldo_final.'</td>';
	echo '<td>'.$saldo_final_anterior.'</td>';
	echo '<td>'.$salin_salfin['saldo_inicial'].'</td>';
	echo '<td>'.$saldo_final_calculado.'</td>';
	
	
	$actualizar_salin_salfin = "update $tabla22   
	set saldo_inicial = '".$saldo_final_anterior."',
	 saldo_final = '".$saldo_final_calculado."'  
	 where id_dia_caja =  '".$salin_salfin['id_dia_caja']."'  ";
//echo '<br>'.$actualizar_salin_salfin.';<br>';
 $consulta_actualizar = mysql_query($actualizar_salin_salfin,$conexion);

	$saldo_final_anterior = $saldo_final_calculado; //este deberia ser el saldo inicial del siguiente dia 
	echo '</tr>';
}//fin del while
echo '</table>';

?>

</body>
</html>