<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/vista/vista.php');

class inventarioCodigosVista extends vista
{

    public function __construct(){

    
    }

    public function inventariosMainVista($codigos)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://kit.fontawesome.com/6f07c5d6ff.js" crossorigin="anonymous"></script>
            <title>Document</title>
        </head>
        <body class = "container" width ="95%">
            <div >
                <div class="row">
                    <div class="col-xs-3">
                        <button 
                            data-toggle="modal" data-target="#myModalFiltroCodigos"
                            class = "btn btn-default"
                            onclick = "pregunteFiltrosCodigo()"
                        >Filtros</button>
                    </div>
                    <div class="col-xs-3">
                        <button 
                            data-toggle="modal" data-target="#myModalProducto" 
                            class="btn btn-primary" 
                            onclick="pregunteNuevoCodigo(); "
                        >NUEVO_COD</button>
                    </div>
                    <div class="col-xs-3">
                        <button 
                            data-toggle="modal" data-target="#myModalAlertas" 
                            class="btn btn-primary" 
                            onclick="verAlertasDeInventario(); "
                        >Alertas</button>
                    </div>
                    <div class="col-xs-3">
                        <a role="button" class ="btn btn-primary" href="../inventario_codigos/excel/generar_excel.php">Exportar Excel</a>
                    </div>
                </div>
                <div id = "divResultadosInventarios"> <?php $this->mostrarCodigos($codigos); ?></div>
            </div>
            <?php $this->modalClientes(); ?>
            <?php $this->modalProducto(); ?>
            <?php $this->modalAumentarProducto(); ?>
            <?php $this->modalMovimientos(); ?>
            <?php $this->modalFiltroCodigos(); ?>
            <?php $this->modalAlertas(); ?>
        </body>
        </html>

        <?php
    }

    public function mostrarCodigos($codigos){
        echo '<div class="row">';
        echo '<table class="table" >';
        echo '<tbody>';
        echo '<tr>';
        echo '<th>Codigo</th>';
        echo '<th>Referencia</th>';
        echo '<th>Descripcion</th>';
        echo '<th>P.Venta</th>';
        echo '<th>Can/Mov</th>';
        echo '<th>Accion</th>';
        echo '<th>Eliminar</th>';
        // echo '<th>Descontar</th>';
        echo '</tr>';
        echo '</tbody>';
        while($codigo = mysql_fetch_assoc($codigos)){
            echo '<tr>'; 
            echo '<td align="right"><button onclick="mostrarInfoCodigo('.$codigo['id_codigo'].');" class="btn btn-primary" data-toggle="modal" data-target="#myModalClientes">'.$codigo['codigo_producto'].'</button></td>';
            echo '<td>'.$codigo['referencia'].'</td>';
            echo '<td>'.$codigo['descripcion'].'</td>';


            echo '<td>'.number_format($codigo['valorventa'], 0, ',', '.').'</td>';

            echo '<td><button class="btn btn-default" onclick ="verMovimientosPrueba('.$codigo['id_codigo'].');" data-toggle="modal" data-target="#myModalMovimientos" >'.$codigo['cantidad'].'</button></td>';
            echo '<td><button onclick = "aumentarInventario('.$codigo['id_codigo'].'); "  data-toggle="modal" data-target="#myModalAumentarProducto" id="btnAdicionarExistencias" class="btn btn-primary"><i class="fas fa-plus"></i></button>';
            echo  '<button id="btnRetirarExistencias" class="btn btn-info"
                    onclick = "disminuirInventario('.$codigo['id_codigo'].'); "
                    data-toggle="modal" data-target="#myModalAumentarProducto" id="btnAdicionarExistencias"
                    >
                <i class="fas fa-minus"></i>
                </button>
            </td>';
            // echo '<td><button id="btnRetirarExistencias" class="btn btn-info"><i class="fas fa-minus"></i></button></td>';
            echo '<td><button
                        class="btn btn-primary" 
                        data-toggle="modal" data-target="#myModalProducto" 
                        onclick = "eliminarCodigo('.$codigo['id_codigo'].');"
                        >Eliminar
                      </button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }

    public function modalClientes ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Consultar</h4>
                  </div>
                  <div id="cuerpoModalClientes" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="verTalleres();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalAlertas ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalAlertas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Consultar</h4>
                  </div>
                  <div id="cuerpoModalAlertas" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="verTalleres();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalProducto ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Agregar</h4>
                  </div>
                  <div id="cuerpoModalProducto" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pantallaInventario();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalAumentarProducto ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalAumentarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Inventario</h4>
                  </div>
                  <div id="cuerpoModalAumentarProducto" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pantallaInventario();">Cerrar</button>
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }

    public function modalMovimientos ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalMovimientos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Movimientos</h4>
                  </div>
                  <div id="cuerpoModalMovimientos" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="verTalleres();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }

    public function modalFiltroCodigos ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalFiltroCodigos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Filtros</h4>
                  </div>
                  <div id="cuerpoModalFiltroCodigos" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="verTalleres();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }




    public function pantallaCodigo($datosCodigo)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div class="row">
                <div class="form-group" >
                    <div align="left"class="col-xs-4 col-md-3">Codigo:</div>    
                    <div align="left" class="col-xs-8 col-md-9"><?php echo $datosCodigo['codigo_producto'] ?></div>
                </div>
                <div class="form-group" >
                    <div align="left" class="col-xs-4 col-md-3">Descripcion:</div>    
                    <div align="left"  class="col-xs-8 col-md-9"><?php echo $datosCodigo['descripcion'] ?></div>
                </div>
                <div class="form-group" >
                    <div align="left" class="col-xs-4 col-md-3">Existencias</div>    
                    <div align="left"  class="col-xs-8 col-md-9"><?php echo $datosCodigo['cantidad'] ?></div>
                </div>

                <div class="form-group" >
                    <div align="left" class="col-xs-4 col-md-3">Precio_de_compra</div>    
                    <div align="left"  class="col-xs-8 col-md-9"><?php echo  number_format($datosCodigo['precio_compra'], 0, ',', ' ') ?></div>
                </div>
                <div class="form-group" >
                    <div align="left" class="col-xs-4 col-md-3">Precio Venta</div>    
                    <div align="left"  class="col-xs-8 col-md-9"><?php echo  number_format($datosCodigo['valorventa'], 0, ',', ' ') ?></div>
                </div>
                <br>    
                <div class="form-group" >
                    <div align="left" class="col-xs-4 col-md-3">Tipo</div>    
                    <div align="left"  class="col-xs-8 col-md-9">
                        <?php 
                         if($datosCodigo['repman']=='R')
                         {
                             echo 'Repuesto';  
                            } 
                            if($datosCodigo['repman'=='M'])
                            {
                                echo 'Mano de obra';  
                            } 
                            ?>
                    </div>
                </div>
                
                <div class="form-group" >
                    <div align="left" class="col-xs-4 col-md-3">Cant Minima</div>    
                    <div align="left"  class="col-xs-8 col-md-9">
                        <?php echo $datosCodigo['producto_minimo'] ?>
                    </div>
                </div>
                <br>
                <div class="form-group" >
                    <div align="left" class="col-xs-4 col-md-3">Alerta</div>    
                    <div align="left"  class="col-xs-8 col-md-9"><?php echo $datosCodigo['alerta'] ?></div>
                </div>
                <div >
                    <button class="btn btn-primary"  
                            onclick= "editarCodigo('<?php   echo $datosCodigo['id_codigo']  ?>');"
                            >
                            Editar Codigo</button>
                </div>

            </div>
        </body>
        </html>
        <?php
    }
    public function pantallaPregunteCodigo($infoCode=[], $valor=0){
        //$valor = 0 captura codigo 
        //$valor = 1 edicion de codigo y 
        //este valor de 1 llegaria desde el controlador cuando llama la funcion 
        // value= "<?php  echo  $infoCode['codigo_producto'];  "
        ?>
        <div>
            <div id="divRespuCodigo" style="color:red;"></div>
            <div id="divRespuCodigo2" style="color:red;"></div>
            <div class="form-group">
                <div class="col-xs-3" >Codigo</div>
                <div class="col-xs-9" >
                    <input type="hidden" id="inputIdCodigo" value = "<?php echo $infoCode['id_codigo'] ;  ?>">
                    <input type="text" 
                        id="inputCodigo"
                        class="form-control"
                        <?php   
                            if($valor == 0){ echo 'onkeyup="verifiqueCodigo();"'; }
                            if($valor == 1){ 
                                echo 'onfocus="blur()"'; 
                            }
                        ?>
                        value= "<?php  echo $infoCode['codigo_producto']  ?>"
                    >
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3" >Referencia</div>
                <div class="col-xs-9" ><input type="text" 
                                            id="inputReferencia" 
                                            class="form-control" 
                                            value = "<?php echo $infoCode['referencia'] ;  ?>"
                                            >
                                        </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3" >Descripcion</div>
                <div class="col-xs-9" ><input type="text" 
                                            id="inputDescripcion" 
                                            class="form-control"
                                            value = "<?php echo $infoCode['descripcion'] ;  ?>"
                                            ></div>
            </div>
                            
            <div class="form-group">
                <div class="col-xs-3" >Cant.Ini</div>
                <div class="col-xs-9" ><input type="text" 
                                        id="inputCantidad" 
                                        class="form-control"
                                        <?php  
                                           if($valor == 1){
                                            echo 'onfocus="blur()"';
                                           } 
                                        ?>
                                        value = "<?php echo $infoCode['cantidad_inicial'] ;  ?>"
                                        ></div>
            </div>
            
            <div class="form-group">
                <div class="col-xs-3" >P.Compra</div>
                <div class="col-xs-9" ><input type="text" id="inputPrecioCompra" 
                                        class="form-control"
                                        value = "<?php echo $infoCode['precio_compra'] ;  ?>"        
                                        ></div>
            </div>
            <div class="form-group">
                <div class="col-xs-3" >P.Venta</div>
                <div class="col-xs-9" ><input type="text" id="inputPrecioVenta" class="form-control"
                                        value = "<?php echo $infoCode['valorventa'] ;  ?>"  
                                        ></div>
            </div>
            <div class="form-group">
                <div class="col-xs-3" >Tipo</div>
                <div class="col-xs-9" >
                    <select id="tipo" class="form-control">
                        <option  value = "">Seleccione...</option>

                        <option value="Repuesto" 
                                <?php   if($infoCode['repman']== 'R') {echo 'selected';}?>
                        >Repuesto</option>
                        
                        <option value="Mano de Obra"
                        <?php   if($infoCode['repman']== 'M') {echo 'selected';}?>
                        >Mano de obra</option>

                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-xs-3" >Cant Minima</div>
                <div class="col-xs-9" ><input type="text" id="inputCantMinima" class="form-control"
                                            value = "<?php echo $infoCode['producto_minimo'] ;  ?>"  
                                        >
               </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3" >Alerta</div>
                <div class="col-xs-9" >
                <select id="alerta" class="form-control">
                        <option  value = "">Seleccione...</option>
                        <option value="SI"
                        <?php   if($infoCode['alerta']== 'SI') {echo 'selected';}?>
                        >SI</option>
                        <option value="NO"
                        <?php   if($infoCode['alerta']== 'NO') {echo 'selected';}?>
                        >NO</option>
                    </select>
                </div>
            </div>

            <br><br><br>
            <div>
                <!-- data-dismiss="modal"  -->
                <button 
                class="btn btn-primary btn-block" 
                id="btnProducto" 
                <?php  if($valor == 0 ) { echo 'onclick="grabarProducto();" ';   } ?>
                <?php  if($valor == 1 ) { echo 'onclick="actualizarProducto();" ';   } ?>
                >
                <?php  if($valor == 0 ) {echo '  Grabar Producto'; } ?>
                <?php  if($valor == 1 ) {echo '  Actualizar Producto'; } ?>
              
               </button>
            </div>
        </div>
        <?php
    }

    public function pregunteInfoAumentarInvent($infoCode,$tipo){
        ?>
         <div >
            <input type="hidden" id="tipo" value = "<?php  echo $tipo ?>">
            <h3>
                <?php
                if($tipo == 1){
                       echo 'ENTRADA'; 
                    }else{
                        echo 'SALIDA'; 
                }    

                ?>    
            </h3>
            <!-- <form> -->
                <div class="row ">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Codigo:</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                        <input class="form-control" onfocus="blur();"  value = "<?php echo $infoCode['descripcion']  ?>">
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <?php 
                            if($tipo == 1){
                                echo '<label>Factura No:</label>';
                            }else{
                                echo '<label>Venta No:</label>';
                            } 

                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                        <input class="form-control"  id = "factura">
                    </div>
                </div>

                <div class="row " style="background-color: gray;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Cantidad</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                        <input autofocus  class="form-control"  id = "cantidad">
                        <br><br>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Observaciones</label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                        <textarea class ="form-control" id="observaciones" cols="20" rows="1"></textarea>
                    </div>
                </div>
                            

                    <br><br>
                    <button class="btn btn-primary" onclick="grabarEntradaSalidaInventario(<?php  echo $infoCode['id_codigo']; ?>);">Grabar Movimiento</button>

            <!-- </form> -->
         </div>   
         <script>
            document.getElementById("cantidad").focus();
         </script>                   
        <?php
    }

    public function formuFiltrosInventario()
    {
        ?>
        <div  style="color:black;">
           <div class="row form-group">

               <div class="col-xs-3" align="left">
                   <label for="">Referencia:</label>
               </div>
               <div class="col-xs-9" align="left">
                   <input 
                       class="form-control" 
                       type="text"  
                       id="txtReferencia"
                       onkeyup="busqueCodigosConFiltro(); "
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
                        onkeyup="busqueCodigosConFiltro(); "
                    >
               </div>
           </div>
           <div>
               <!-- <button 
               class = "btn btn-primary"
               data-dismiss="modal"
                   onclick="buscarClienteFiltros();">Buscar Filtro</button> -->
           </div>
         
       </div>
       <?php
    }

    public function mostrarAlertas($codigosAlertas)
    {
        // $this->draw_table($codigosAlertas);
        ?>
        <div>
            <table class="table">
            <tr>
                <th>COD</th>
                <th>REF</th>
                <th>DESCRIPCION</th>
                <th>PROD_MIN</th>
                <th>CANT.</th>

            </tr>
            <?php
            foreach($codigosAlertas as $codigoAlerta)
            {
                if($codigoAlerta['cantidad']< $codigoAlerta['producto_minimo'] )
                {
                    echo '<tr>'; 
                    echo '<td>'.$codigoAlerta['codigo_producto'].'</td>';
                    echo '<td>'.$codigoAlerta['referencia'].'</td>';
                    echo '<td>'.$codigoAlerta['descripcion'].'</td>';
                    echo '<td align="center">'.$codigoAlerta['producto_minimo'].'</td>';
                    echo '<td>'.$codigoAlerta['cantidad'].'</td>';
                    echo '</tr>';
                }
            }
        echo '</table>';    
        echo '</div>';
    }
    public function generarExcelInventario($codigos)
    {
        $filename = "inventario.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$filename);
        $this->mostrarCodigos($codigos);
    }
}

?>