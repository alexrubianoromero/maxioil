<?php

class inventariosMovimientoVista
{
    public function showMovCode($datosCod,$movimientos)
    {
        echo '<div>';
        echo '<h3>'.$datosCod['descripcion'];
        echo '<label style="color:green;">';
        echo ' Saldo Act: '.$datosCod['cantidad'];
        echo '</h3>'; 
        echo '</label>';
        echo '</div>';
        echo '<table class="table table-striped">';  
        echo '<tr>';
        echo '<th>Fecha</th>';
        echo '<th>Observaciones</th>';
        echo '<th>Cant</th>';
        echo '<th>Doc</th>';
        echo '</tr>';
        while($mov = mysql_fetch_assoc($movimientos))
        {
            
            echo '<tr>';
            echo '<td>'.$mov['fecha_movimiento'].'</td>'; 
            // if($mov['tipo_movimiento']== 0)
            // {
            //     $nombreMovimiento = 'Creacion Inicial';
            // }
            // if($mov['tipo_movimiento']== 1)
            // {
            //     $nombreMovimiento = 'Entrada';
            // }
            // if($mov['tipo_movimiento']== 2)
            // {
            //     $nombreMovimiento = 'Salida';
            // }
            // echo '<td>'.$nombreMovimiento.'</td>'; 
            echo '<td>'.$mov['observaciones'].'</td>';    
            echo '<td>'.$mov['cantidad'].'</td>'; 
            if($mov['tipo_movimiento']== 1 || $mov['tipo_movimiento']== 3 )
            {
                echo '<td>'.$mov['facturacompra'].'</td>'; 
                }
            if($mov['tipo_movimiento']== 2 || $mov['tipo_movimiento']== 4 )
                {
                echo '<td>'.$mov['id_factura_venta'].'</td>'; 
            }
            echo '</tr>';
        }      
        echo '</table>';
    }
}

?>