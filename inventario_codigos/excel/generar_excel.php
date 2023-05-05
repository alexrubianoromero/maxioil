<?php
$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php');
require_once($raiz.'/inventario_codigos/vista/inventarioCodigosVista.php');
$vista = new inventarioCodigosVista();
$modelo = new CodigosInventarioModelo();
$codigos = $modelo->traerCodigos();
header("Content-Type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename= archivo.xls");
// $vista->mostrarCodigos($codigos);
// echo 'buenas '; 
echo '<table border="1">';
echo '<tr>'; 
echo '<th>NUMERO_INTERNO</th>';
echo '<th>TIPO</th>';
echo '<th>DESCRIPCION</th>';
echo '<th>REFERENCIA</th>';
echo '<th>VALOR_VENTA</th>';
echo '<th>VALOR_COSTO</th>';
echo '<th>CANTIDAD_MINIMA</th>';
echo '<th>INVENTARIO</th>';
echo '</tr>';
foreach($codigos as $codigo)
{
    echo '<tr>'; 
    echo '<td>'.$codigo['id_codigo'].'</td>';
    if($codigo['repman']=='R')
    {
        $palabra = 'REPUESTO';  
    }
    else{
        $palabra = 'SERVICIO';  
    }
    echo '<td>'.$palabra.'</td>';
    echo '<td>'.$codigo['descripcion'].'</td>';
    echo '<td>'.$codigo['referencia'].'</td>';
    echo '<td>'.$codigo['valorventa'].'</td>';
    echo '<td>'.$codigo['precio_compra'].'</td>';
    echo '<td>'.$codigo['producto_minimo'].'</td>';
    echo '<td>'.$codigo['cantidad'].'</td>';
    echo '</tr>';
} 
echo '</table>';

?>