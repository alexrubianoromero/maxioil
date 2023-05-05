<?php
require_once('../orden/modelo/itemsOrdenModelo.php');
class ConsultaOrdenesVista
{
    private $itemsOrden;

    public function __construct(){
        $this->itemsOrden = new itemsOrdenModelo();
    }

     public function pantallaInicial($arregloOrdenes){
         ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../css/bootstrap.min.css">  
                <link rel="stylesheet" href="../css/estilosresponsivos.css">  
                <script src="https://kit.fontawesome.com/6f07c5d6ff.js" crossorigin="anonymous"></script>
                <title>Document</title>
            </head>
            <body class="container">
                <div align = "center" id = "div_general_modulo_ordenes">   
                    <div id="titulo">
                        <h3>ORDENES <button onclick = "iraCraerOrden();"  id= "btnCrearOrden">CREAR ORDEN</button></h3>
                    </div>
                    
                    <div id="div_mostrar_ordenes" class = "resultadosValidacion">
                        <table class="table" >
                           <thead> 
                            <tr>
                                <td>No</td>        
                                <td>Fecha</td>        
                                <td>Placa</td>        
                                <td>Linea</td>        
                            </tr>
                           </thead>
                           <tbody>
                                <?php  $this->pintarOrdenes($arregloOrdenes);  ?>
                           </tbody>
                        </table>
                    </div>
                </div>
                <?php  $this->modal(); ?>


            </body>
            </html>
            <script src = "../js/jquery-2.1.1.js"> </script>    
            <script src="../js/bootstrap.min.js"></script>
            <script src="../orden/js/orden.js"></script>

         <?php
     }

     public function pintarOrdenes($arregloOrdenes){
         
         for ($i=0; $i <= sizeof($arregloOrdenes);$i++ ){
            echo '<tr>';
            echo '<td><button  onclick="muestreDetalleOrden('.$arregloOrdenes[$i]['id'].');" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">'.$arregloOrdenes[$i]['orden'].'</button></td>';
            // echo '<td><button  onclick="muestreDetalleOrden('.$arregloOrdenes[$i]['id'].');" class="btn btn-primary" >'.$arregloOrdenes[$i]['orden'].'</button></td>';
            echo '<td>'.$arregloOrdenes[$i]['fecha'].'</td>';
            echo '<td>'.$arregloOrdenes[$i]['placa'].'</td>';
            echo '<td>'.$arregloOrdenes[$i]['tipo'].'</td>';
            echo '</tr>';
         }
     }

     
       public function modal (){
           ?>
            <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
            Launch demo modal
            </button> -->
             <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                     <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title" id="myModalLabel">Detalle Orden</h4>
                     </div>
                     <div id="cuerpoModal" class="modal-body">
                         el modal 
                         
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                         <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                     </div>
                     </div>
                 </div>
             </div>
           <?php
       }


       public function mostrarInfoOrden($arregloOrden,$conexion){
            //  echo $arregloOrden['observaciones'];
            //  die();
        //     echo '<pre>';
        // print_r($arregloOrden);
        // echo '</pre>';
        // die();
            ?>
                <div id = "div_detalle_orden">
                        <div id="div_info_moto">

                        </div>
                        <div id="div_info_orden">
                             <table class="table table-striped">
                                 <tr>
                                     <td>Orden No</td>
                                     <td><?php echo $arregloOrden['orden']; ?></td>
                                 </tr>
                                 <tr>
                                     <td>Fecha</td>
                                     <td><?php echo $arregloOrden['fecha']; ?></td>
                                 </tr>
                            
                                 <tr>
                                     <td>Telefono</td>
                                     <td><?php echo $arregloOrden['telefono']; ?></td>
                                 </tr>
                                 <tr>
                                     <td>Kilometraje</td>
                                     <td><?php echo $arregloOrden['kilometraje']; ?></td>
                                 </tr>
                                 <tr>
                                     <td>Mecanico</td>
                                     <td><?php echo $arregloOrden['mecanico']; ?></td>
                                 </tr>
                                 <tr>
                                     <td colspan= "2" align="center">Observaciones</td>
                                 </tr>
                                 <tr>
                                     <td colspan="2">
                                                 <?php echo $arregloOrden['observaciones']; ?>
                                    </td>
                                 </tr>
                             </table>
                        </div>
                </div>
                <div  id="div_items_orden">
                    <p align="center" id="letrero_items">ITEMS ORDEN </p>
                        <?php 
                      
                        $this->mostrarItemsOrden($arregloOrden['id'],$conexion);  
                        ?>
                </div>
            <?php

       }
       public function mostrarItemsOrden($id,$conexion){
         $items =  $this->itemsOrden->traerItemsOrdenId( $id,$conexion);
        // echo '<pre>';
        // print_r($items);
        // echo '</pre>';
        // die();
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
                    for($i=0;$i<=(sizeof($items));$i++)
                    {
                         echo '<tr>';
                         echo '<td>'.$items[$i]["codigo"].'</td>';
                         echo '<td>'.$items[$i]["descripcion"].'</td>';
                         echo '<td align="right">'.$items[$i]["valor_unitario"].'</td>';
                         echo '<td>'.$items[$i]["cantidad"].'</td>';
                         echo '<td align="right">'.$items[$i]["total_item"].'</td>';
                         echo '</tr>';
                         $sumaItems += $items[$i]["total_item"];
                    }
                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td align="right">Total</td>';
                    echo '<td></td>';
                    echo '<td align="right">'.$sumaItems.'</td>';
                    echo '</tr>';
                    ?>
                </tbody>
            </table>


            <?php
       }

}

?>