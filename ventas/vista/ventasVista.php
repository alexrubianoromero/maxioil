<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php');

class ventasVista
{
    protected $codigosModelo; 

    public function __construct()
    {
        $this->codigosModelo = new CodigosInventarioModelo();
    }


    public function pantallaPrincipalVentas()
    {
        ?>
        <div id= "div_principal_ventas">
            <div id="div_botones_ventas" class ="row">
                <div class ="col-md-3">
                    <button 
                        class="btn btn-primary" 
                        data-toggle="modal" data-target="#myModalNuevaVenta"
                        onclick="pantallaNuevaVenta();"
                        >
                        Nueva Venta Mostrador
                    </button>
                </div>
                <div class ="col-md-3"></div>
                <div class ="col-md-3"></div>
                <div class ="col-md-3"></div>
            </div>
            <div id="div_resultado_ventas">

            </div>
            <?php  $this->modalFiltrosCodigosNew(); ?>
            <?php  $this->modalCajaVentas(); ?>
            <?php  $this->modalNuevaVenta(); ?>
            <?php  $this->modalAgregarItemsNew(); ?>
            <?php  $this->modalFiltrosCodigosNew2(); ?>
        </div>
        <?php
    }
    public function modalNuevaVenta (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalNuevaVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevaOrden">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Nueva Venta Mostrador </h4>
                  </div>
                  <div id="cuerpoModalNuevaVenta" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button  type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
   
    public function modalFiltrosCodigosNew (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalFiltrosCodigosNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Filtros Codigos New</h4>
                  </div>
                  <div id="cuerpoModalFiltrosCodigosNew" class="modal-body">
         
                      
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
    public function modalFiltrosCodigosNew2()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalFiltrosCodigosNew2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Filtros Codigos New.</h4>
                  </div>
                  <div id="cuerpoModalFiltrosCodigosNew2" class="modal-body">
         
                      
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
    public function modalCajaVentas()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="color:black">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Recibo de Caja Ventas</h4>
                  </div>
                  <div id="cuerpoModalCaja" class="modal-body">
                      
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



    
    public function modalAgregarItemsNew()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalAgregarItemsNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevaOrden">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">BUSCAR CODIGO </h4>
                  </div>
                  <div id="cuerpoModalAgregarItemsNew" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button  type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function pantallaNuevaVenta($idTemp='')
    {
        ?>
        <input style="color:black;" type="hidden" id="idTemp" value = "<?php   echo $idTemp;  ?>">
        <div id="div_nueva_venta">
            <div id="div_previzualizar_codigo">
                <div id ="div_filtros_codigo">
                  <button
                    class="btn btn-primary"
                    data-toggle="modal" data-target="#myModalAgregarItemsNew" 
                    onclick="pregunteItemsNewVentas();"
                  >Agregar Item</button>
                </div>
                <div id="div_muestre_info_codigo">
                    <!-- <table class ="table">
                        <tr>
                            <td>Codigo</td>
                            <td>Referencia</td>
                            <td>Descripcion</td>
                            <td>Valor</td>
                            <td>Cantidad</td>
                            <td>Total</td>
                            <td>Agregar</td>
                            
                        </tr>
                    </table> -->
                </div>

            </div>
            <div id="div_final_venta">

            </div>
        </div>

        <?php
    }

    public function pregunteNuevoItemNewVentas($request='')
    {
      ?> 
      <div  style="color:black">
      <input style="color:black;" type="hidden" id="idTemp" value = "<?php   echo $request['idTemp'];  ?>">
      
      <div class="row" style="color:black">
          <div class="col-xs-2">
              </div>   
              <div class="col-xs-4">
                  <button  
                  onclick="filtroBuscarCodigoIngresoOrdenNewVentas();"
                  class="btn btn-primary" 
                  data-toggle="modal" data-target="#myModalFiltrosCodigosNew2"
                  >
                  <i class="fas fa-search" ></i> 
                  BUSCAR CODIGO.
                </button>
                
            </div>
            <div class="col-xs-4">
                <button
                class="btn btn-primary" 
                onclick= "cerrarventanaItems();"
                >
                CERRAR 
              </button>
            </div>    
            <div class="col-xs-2">
                </div>  
                
                
            </div>
            <br>
            <input type = "hidden" value= "<?php echo $id ?>">
            <input type = "hidden" id="idCodigopan" >
            <div class="row form-group">
                <div class="col-xs-3">
                    <label >Codigo Ventas:</label>
                </div>
                <div class="col-xs-7">
                    <!-- Codigo:<input type="text" id = "codNuevoItem" onblur="verifiqueCodigo();"> -->
                    <input class ="form-control" 
                    type="text" 
                    id = "codNuevoItem" 
                    onkeyup="verificarSiExisteCodigoVentas();"
                    >
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    <label >Referencia:</label>
                </div>
                <div class="col-xs-7">
                    <input class ="form-control" type="text" id = "referenciapan" >
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    <label >Descripcion:</label>
                </div>
              <div class="col-xs-7">
                  <input class ="form-control" type="text" id = "descripan" ">
              </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    <label > Valor Unit:</label>
                </div>
                <div class="col-xs-7">
                    <input class ="form-control" type="text" id = "valorUnitpan" ">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    <label > Cantidad: <span id="existencias" style="color:green;"></span><input type ="hidden" id="inputexistencias"></label>
                </div>
                <div class="col-xs-7">
                    
                    <input class ="form-control" 
                    type="text" 
                    id = "cantipan" 
                    onkeyup="generarTotalItem();"
                    >
                </div>
            </div>
            
            <div class="row form-group">
                <div class="col-xs-3">
                    <label > Total:</label>
                </div>
                <div class="col-xs-7">
                    <input class ="form-control" type="text" id = "totalItem" onfocus="blur();" >
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-6">
                    <button class="btn btn-primary"  
                    data-dismiss="modal"
                    onclick="cerrarVentanaNuevoItem();"
                    >Cancelar</button>
                </div>
                <div class="col-xs-6">
                    <button class="btn btn-primary" 
                    id = "grabarNuevoItem" 
                    data-dismiss="modal"
                    onclick="agregarItemTemporalVenta();"
                    >Agregar Item</button>
                    <!-- onclick="agregarItemVenta();" -->
                    <!-- onclick="grabarNuevoItemNew();" -->
                </div>
            </div>
        </div>
        <?php
    }
    

    public function formuFiltrosInventarioVentas()
    {
        ?>
        <div  style="color:black;">
            <div class="row form-group">
                
                <div class="col-xs-3" align="left">
                    <label for="">Referencia Ventas:</label>
                </div>
                <div class="col-xs-9" align="left">
                    <input 
                    class="form-control" 
                    type="text"  
                    id="txtReferencia"
                    onkeyup="busqueCodigosConFiltroVentas(); "
                    >
                </div>
            </div>
            <div class="row form-group">
                
                <div class="col-xs-3" align="left">
                    <label for="">Descripcion</label>
                </div>
                <div class="col-xs-9" align="left">
                    <input 
                    class="form-control" 
                    type="text"  
                    id="txtBuscarDescrip"
                    onkeyup="busqueCodigosConFiltroVentas(); "
                    >
                </div>
            </div>
            <div>
                <!-- <button 
                class = "btn btn-primary"
                data-dismiss="modal"
                onclick="buscarClienteFiltros();">Buscar Filtro</button> -->
            </div>
            <div id="divMuestreCodigosaBuscarVentas">
                
                </div>
                
            </div>
            <?php
    }
    
    
    
    public function mostrarCodigosBucadosFiltroVentas($codigos){
        echo '<div class="row" style ="color:black;">';
        echo '<table class="table" >';
        echo '<tbody>';
        echo '<tr>';
        echo '<th>Codigo Ventas</th>';
        echo '<th>Referencia</th>';
        echo '<th>Descripcion</th>';
        echo '<th>P.Venta</th>';
        echo '<th>Can/Mov</th>';
        // echo '<th>Descontar</th>';
        echo '</tr>';
        echo '</tbody>';
        while($codigo = mysql_fetch_assoc($codigos)){
            echo '<tr>'; 
            echo '<td align="right">
            <button 
            data-dismiss="modal"
            onclick="colocarInfoCodigoEnItemVentas('.$codigo['id_codigo'].');" 
                    class="btn btn-primary" 
                    >'.$codigo['codigo_producto'].
                    '</button></td>';
                    echo '<td>'.$codigo['referencia'].'</td>';
                    echo '<td>'.$codigo['descripcion'].'</td>';
                    echo '<td>'.number_format($codigo['valorventa'],0,",",".").'</td>';
                    
                    echo '<td>'.$codigo['cantidad'].'</td>';
                    // echo '<td><button id="btnRetirarExistencias" class="btn btn-info"><i class="fas fa-minus"></i></button></td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            }
            
            public function muestreItemsTemporales($idTemp,$itemsTemporales)
            {
                echo '<div style="color:black">';
                echo '<input style="color:black;" type="hidden" id="idTemp" value = "'.$idTemp.'">';
                
                echo '<table class ="table">
                <tr>
                <td>Codigo</td>
                <td>Referencia</td>
                <td>Descripcion</td>
                <td>Valor</td>
                <td>Cantidad</td>
                <td>Total</td>
                </tr>';
                $total = 0;
                foreach($itemsTemporales as $itemTemporal)
                {
                    $infoCode = $this->codigosModelo->getInfoCodeById($itemTemporal['idCode']); 
                    echo '<tr>'; 
                    echo '<td>'.$itemTemporal['codigo'].'</td>';
                    echo '<td>'.$infoCode['referencia'].'</td>';
                    echo '<td>'.$itemTemporal['descripcion'].'</td>';
                    echo '<td align="right">'.number_format($itemTemporal['valor_unitario'],0,",",".").'</td>';
                    echo '<td align="center">'.$itemTemporal['cantidad'].'</td>';
                    echo '<td align="right">'.number_format($itemTemporal['total_item'],0,",",".").'</td>';
                    echo' </tr>';    
                    $total = $total + $itemTemporal['total_item']; 
                }
                
                echo '<tr>'; 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>Total</td>';
                echo '<td align="right">'.number_format($total,0,",",".").'</td>';
                echo '</tr>';
                
        echo '</table>';
        echo '<button class = "btn btn-primary"
                onclick ="grabarVenta();"
                data-dismiss="modal"
                > 
              Finalizar Venta </button>';        

        echo '</div>'; 
        
        
    }
    
    
}



?>