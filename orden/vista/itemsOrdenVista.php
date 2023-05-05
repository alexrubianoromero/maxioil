<?php

class itemsOrdenVista
{
    public function mostrarItemsOrden($items){
    //    echo '<pre>';
    //    print_r($items);
    //    echo '</pre>';
    //    die();
           ?>
           <table class="table table-striped">
               <thead>
    
                   <tr>
                       <td>Codigo</td>
                       <td>Descripcion</td>
                       <td>Vr.Unit</td>
                       <td>Cant.</td>
                       <td>Vr.Total</td>
                   </tr>
               </thead>
               <tbody>
                   <?php
                   $sumaItems = 0;
            //         echo '<pre>';
            //    print_r($items['datos']);
            //    echo '</pre>';
            //    die();
                   foreach($items['datos'] as $item)
                   {
                        echo '<tr>';
                        echo '<td>'.$item["codigo"].'</td>';
                        echo '<td>'.$item["descripcion"].'</td>';
                        if($item["valor_unitario"] !=''){
                            echo '<td align="right">'.number_format($item["valor_unitario"], 0, ',', '.').'</td>';
                        }
                        else{
                            echo '<td></td>';
                        }
                       
                        echo '<td>'.$item["cantidad"].'</td>';
                        if($item["total_item"] !=''){
                            echo '<td align="right">'.number_format($item["total_item"], 0, ',', '.').'</td>';
                        }
                        else{
                            echo '<td></td>';
                        }
    
                        echo '</tr>';
                        $sumaItems += $item["total_item"];
                   }
                   echo '<tr>';
                   echo '<td></td>';
                   echo '<td></td>';
                   echo '<td align="right">Total</td>';
                   echo '<td></td>';
                   echo '<td align="right">'.number_format($sumaItems, 0, ',', '.').'</td>';
                   echo '</tr>';
                   ?>
               </tbody>
           </table>
    
    
           <?php
      }
      
}


?>