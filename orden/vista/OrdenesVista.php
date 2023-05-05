<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/vista/vista.php');
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');
require_once($raiz.'/tecnicos/modelo/TecnicosModelo.php');
class OrdenesVista extends vista 
{
    protected $modelOrden;
    protected $tecnicosModelo;

    public function __construct()
    {
        session_start();
        $this->modelOrden = new OrdenesModelo(); 
        $this->tecnicosModelo = new TecnicosModelo();

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
               <link rel="stylesheet" href="../orden/css/ordenes.css">  
               <script src="https://kit.fontawesome.com/6f07c5d6ff.js" crossorigin="anonymous"></script>
               <title>Document</title>
               <style>
                   #div_pedir_datos_orden{
                       font-size: 20px;
                   }
               </style>
           </head>
           <body class="container">
               <div align = "center" id = "div_general_modulo_ordenes">   
                    <div id=" row divBotonesClientes">
                        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button 
                            class="btn btn-default" data-toggle="modal" data-target="#myModalFiltrosOrdenes"
                                onclick = "formuFiltrosBusqueda();"
                            > FILTROS</button>
                        </div>
                        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <button class="btn btn-primary" onclick="pintarOrdenesNew();">Listar</button>
                        </div>
                        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <button class="btn btn-primary" onclick = "iraCraerOrden();"  id= "btnCrearOrden">NUEVA</button>
                        </div>
                    </div>
                   <br><br>
                   <div id="div_mostrar_ordenes" class = "resultadosValidacion">
                       <div>
                          
                                    <?php  $this->pintarOrdenesNew($arregloOrdenes);  ?>
                         
                        </div>  
                    </div>
                    <div id="fomularioCracionOrden">
                        <!-- si la placa existe se visualizara el formulario de creacion de la orden -->
                        <!-- <button id="btn_mostrar_formulario_creacion_orden" onclick="mostrarFormularioCreacionOrden();">CREAR ORDEN </button> -->
                    </div>   
               </div>
               <?php  $this->modal(); ?>
               <?php  $this->modalClientes(); ?>
               <?php  $this->modalDatosOrden(); ?>
               <?php  $this->modalFiltrosOrdenes(); ?>
               <?php  $this->modalFiltrosCodigos(); ?>
               <?php  $this->modalReciboCaja(); ?>
               <?php  $this->modalCaja(); ?>
               <?php  $this->modalReversionFacturada(); ?>
               <?php  $this->modalAgregarItems(); ?>
               <?php  $this->modalFiltrosCodigosNew(); ?>
               <?php  $this-> modalImagenes(); ?>

              
              

           </body>
           </html>
           <script src = "../js/jquery-2.1.1.js"> </script>    
           <script src="../js/bootstrap.min.js"></script>
           <script src="../orden/js/orden.js"></script>
           <script src="../vehiculos/js/vehiculos.js"></script>
           <script src="../clientes/js/clientes.js"></script>
           <script src="../inventario_codigos/js/codigosInventario.js"></script>

        <?php
    }

    
    public function pintarOrdenes($arregloOrdenes){
         
        echo '
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
        ';
        for ($i=0; $i <= sizeof($arregloOrdenes);$i++ ){
           echo '<tr>';
           echo '<td><button  
                        onclick="muestreDetalleOrden('.$arregloOrdenes[$i]['id'].');" 
                        class="btn btn-primary" 
                        data-toggle="modal" data-target="#myModal2"
                        >'
                        .$arregloOrdenes[$i]['orden'].'
                        </button></td>';
           // echo '<td><button  onclick="muestreDetalleOrden('.$arregloOrdenes[$i]['id'].');" class="btn btn-primary" >'.$arregloOrdenes[$i]['orden'].'</button></td>';
           echo '<td>'.$arregloOrdenes[$i]['fecha'].'</td>';
           echo '<td>'.$arregloOrdenes[$i]['placa'].'</td>';
           echo '<td>'.$arregloOrdenes[$i]['tipo'].'</td>';
           echo '</tr>';
        }

        echo '
        </tbody>
        </table>
        ';
    }
    
    public function pintarOrdenesNew($ordenes){
        echo '<div style="color:black" table-responsive>';
        echo '<table class = "table table-striped table-bordered table-hover">'; 

        echo '<thead>'; 
        echo '<tr  class="bontonesmenuinternos">'; 
        echo '<th>ORDEN</th>';
        // echo '<th>IMA</th>';
        echo '<th>PDF</th>';
        echo '<th>FECHA</th>';
        echo '<th>PLACA</th>';
        echo '<th>LINEA</th>';
        echo '<th>OBSERVACIONES</th>';
        echo '<th>ESTADO</th>';
        echo '</tr>';
        echo '</thead>';
        
        foreach($ordenes as $orden ){
            // $columna = '<tr>';
            if($orden['estado']==0)
            {
                echo '<tr class="active">';
            }
            if($orden['estado']==1)
            {
                echo '<tr class="warning">';
            }
            if($orden['estado']==2)
            {
                echo '<tr class="success">';
            }
            if($orden['estado']==3)
            {
                echo '<tr class="danger">';
            }

            
            echo '<td>
            <button 
                onclick="muestreDetalleOrden('.$orden['id'].');" 
                class="btn btn-primary" 
                data-toggle="modal" data-target="#myModal2"
                size= "6px"
                >'.$orden['orden'].'
                
            </button>
            </td>';
            echo '<td>';
 
            echo '<a href="../orden/pdf/ordenPdf3.php?idOrden='.$orden['id'].'" target="_blank">PDF</a>';
            echo '</td>';
            // echo '<td>'; 
            // echo '<button 
            //         class="btn btn-default" 
            //         onclick ="mostrarImagenesOrden('.$orden['id'].'); "
            //         data-toggle="modal" data-target="#myModalImagenes"
            //       >IMA</button>';
            
            // echo '</td>';
            echo '<td>'.$orden['fecha'].'</td>';
            echo '<td>'.$orden['placa'].'</td>';
            echo '<td>'.$orden['tipo'].'</td>';
            echo '<td>'.substr($orden['observaciones'],0,30).'</td>';
            if($orden['estado']==0){ $nombreEstado = 'En Proceso'; }
            if($orden['estado']==1){ $nombreEstado = 'Lista'; }
            if($orden['estado']==2){ $nombreEstado = 'Facturada';}
            // if($orden['estado']==3){ $nombreEstado = 'Entregada';}
            echo '<td>'.$nombreEstado.'</td>';
            echo '</tr>';
        
            // echo '<td class="success">'.$orden['orden'].'</button></td>';
            // echo '<td class="active">'.$orden['fecha'].'</td>';
            // echo '<td  class="warning">'.$orden['placa'].'</td>';
            // echo '<td class="danger">'.$orden['estado'].'</td>';
            // echo '<td class="info">'.$orden['estado'].'</td>';
            // echo '</tr>';
        }
        echo  '</div>';
        echo '</table>'; 
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
    public function modalReversionFacturada(){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalReversionFacturada" tabindex="-1" 
                role="dialog" aria-labelledby="myModalLabel"
                style="color:black;"
            >
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Reversar Facturada</h4>
                  </div>
                  <div id="cuerpoModalReversionFacturada" class="modal-body">
                      <div id="divAviso"></div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal"
                        onclick = "cerraMymodalYpintarOrdenes();"
                      >Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalReciboCaja (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalReciboCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Recibo de Caja</h4>
                  </div>
                  <div id="cuerpoModalReciboCaja" class="modal-body">
                      
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
    public function modalImagenes()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalImagenes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Imagenes Orden</h4>
                  </div>
                  <div id="cuerpoModalImagenes" class="modal-body">
                      
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
    public function modalCaja (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="color:black">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Recibo de Caja Orden</h4>
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
    public function modalFiltrosOrdenes (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalFiltrosOrdenes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Detalle Orden</h4>
                  </div>
                  <div id="cuerpoModalFiltrosOrdenes" class="modal-body">
         
                      
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
    public function modalFiltrosCodigos (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalFiltrosCodigos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Filtros Codigos</h4>
                  </div>
                  <div id="cuerpoModalFiltrosCodigos" class="modal-body">
         
                      
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
    public function modalClientes (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Informacion</h4>
                  </div>
                  <div id="cuerpoModalClientes" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalDatosOrden (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalDdatosOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevaOrden">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">CREACION DE ORDEN </h4>
                  </div>
                  <div id="cuerpoModalDatosOrden" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button onclick="pintarOrdenes();"  type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalAgregarItems (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalAgregarItems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevaOrden">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">CREACION DE ORDEN </h4>
                  </div>
                  <div id="cuerpoModalAgregarItems" class="modal-body">
                      
                      
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

    public function mostrarInfoOrden($arregloOrden,$conexion,$resultadoItems,$request){
        //  echo $arregloOrden['observaciones'];
        //  die();
        // echo '<pre>';
        // print_r($arregloOrden['id']);
        // echo '</pre>';
        $infoTecnico =   $this->tecnicosModelo->traerTecnicoAsignadoIdOrden($arregloOrden['id']); 
        // echo '<pre>';
        // print_r($tecnico);
        // echo '</pre>';
        // die();
        ?>
            <div id = "div_detalle_orden" >

                    <input type="hidden" id = "nivel" value ="<?php echo $request['nivelStorage'];   ?>">
                    <input type="hidden" id = "idOrden" value ="<?php echo $arregloOrden['id'];   ?>">
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
                                 <td>
                                    <?php
                                    if($_SESSION['nivel']>2 ||  $request['nivelStorage']>2)
                                    {
                                        // echo $arregloOrden['idmecanico'];
                                        $tecnicos=[];
                                       $tecnicos = $this->tecnicosModelo->traerTecnicosNew();  
                                       echo '<select class ="form-control" id = "idMecanicoAsignado" >';
                                       foreach($tecnicos as $tecnico)
                                       {
                                           if($tecnico['idcliente'] == $arregloOrden['idmecanico'])
                                           {

                                               echo '<option selected value="'.$tecnico['idcliente'].'" >'.$tecnico['nombre'].'</option>'; 
                                           }
                                           else{
                                               echo '<option value="'.$tecnico['idcliente'].'" >'.$tecnico['nombre'].'</option>'; 
                                           }
                                       }
                                       echo '</select>';     
                                    }
                                    else{
                                        echo '<input type = "hidden"  id="idMecanicoAsignado" value = "'.$infoTecnico['idcliente'].'"  >';
                                        echo $arregloOrden['mecanico'];
                                    }
                                    ?>
                                </td>
                             </tr>
                             <tr>
                                 <td colspan= "2" align="center">Observaciones</td>
                             </tr>
                             <tr>
                                 <td colspan="2">
                                     <?php echo $arregloOrden['observaciones']; ?>
                                 </td>
                            </tr>
                            <tr>
                                <td colspan= "2" align="center">Observaciones Tecnico</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea id="txtobservacionestecnico" class = "form-control">
                                        <?php echo trim($arregloOrden['observacionestecnico']); ?>
                                    </textarea>
                                </td>
                           </tr>
                                
                         </table>
                    </div>
            </div>
            <div>
                <div style="color:black;">
                    <div class="row">
                        <div class="col-xs-3">
                            <label>Estado:</label>
                        </div>
                        <div class="col-xs-5">
                                    <?php  
                                      if($arregloOrden['estado']==0){ $nombreEstado = 'En Proceso'; }
                                      if($arregloOrden['estado']==1){ $nombreEstado = 'Lista'; }
                                      if($arregloOrden['estado']==2){ $nombreEstado = 'Facturada';}
                                    //   if($arregloOrden['estado']==3){ $nombreEstado = 'Entregada';}
                                      if($arregloOrden['estado']==2)
                                        { 
                                           echo '<label>'.$nombreEstado.'</label>';     
                                           if($arregloOrden['estado']==2)
                                           {
                                               echo '<button 
                                                        data-toggle="modal" data-target="#myModalReversionFacturada"
                                                        onclick = "preguntarSeguroReversarFacturada('.$arregloOrden['id'].');"
                                                    > 
                                                    Rerversar Facturada</button>'; 
                                           } 

                                        }else{
                                    ?>

                                <select 
                                    id="idEstadoOrden"
                                    class="form-control"
                                    onchange = "mostrarFormuRecibo('<?php echo $arregloOrden['id'] ?>')"; 
                                >    
                                    <option value = "0"  
                                        <?php if($arregloOrden['estado']==0){ echo 'selected'; } ?>
                                        >En Proceso</option>
                                        <option value = "1"
                                        <?php if($arregloOrden['estado']==1){ echo 'selected'; } ?>
                                        
                                        >Lista</option>
                                        <?php 
                                        if($_SESSION['nivel']>2 || $request['nivelStorage']>2)
                                        {
                                        ?>        
                                        <option value = "2"
                                            <?php 
                                                if($arregloOrden['estado']==2)
                                                { echo 'selected'; } 
                                            ?>
                                        >Facturada
                                        </option>
                                        <?php
                                        }
                                        ?>
                                

                                        <!-- <option value = "3"
                                             <?php 
                                                //   if($arregloOrden['estado']==3){ echo 'selected'; } 
                                                ?>
                                        >Entregada
                                       </option> -->
                                </select>
                                             
                                <?php
                                   } 
                                ?>

                        </div>

                        <div class="col-xs-4">
                            <?php
                            $boton = '<button'; 
                                      if($arregloOrden['estado']==2)
                                      { $boton .= ' disabled '; }      
                                        

                                $boton .=  ' class="btn btn-primary"
                                            onclick="actualizarInfoOrden('.$arregloOrden['id'].'); "
                                            data-dismiss="modal"
                                            >
                                            Actualizar Orden</button>';
                                echo $boton;
                            ?>

                        </div>

                    </div>    
                </div>
                <br><br>
                    <div class="col-xs-12">
                       <?php 
                        $boton = '<button 
                        data-toggle="modal" data-target="#myModalAgregarItems" ';
                        if($arregloOrden['estado']==2)
                        { $boton .= ' disabled '; }     
                         
                            $boton .= 'class="btn btn-primary" onclick="pregunteItemsNew();"

                        >
                        Agregar Item</button>';
                        echo $boton;
                        ?>           
                    </div>
                   
                </div>
            </div>
            <div id="divPregunteNuevoItem" style="color:black"></div>
            <div  id="div_items_orden">
                    <?php 
                    // echo $resultados['filas'] ;
                    // die();
                        if($resultadoItems['filas'] > 0){
                            $this->mostrarItemsOrden($arregloOrden['id'],$resultadoItems['datos'],$arregloOrden['estado'],$request);  
                        }

                    ?>
            </div>
        <?php

   }
   public function mostrarItemsOrden($id,$items,$estadoOrden='10',$request = []){
    // $items =  $this->itemsOrden->traerItemsOrdenId( $id,$conexion);
   // echo '<pre>';
   // print_r($items);
   // echo '</pre>';
   // die();
       ?>
       <table class="table table-striped">
           <thead>

               <tr>
                   <td>Codigo</td>
                   <td>Referencia</td>
                   <td>Descripcion</td>
                   <td>Vr.Unit</td>
                   <td>Cant.</td>
                   <td>Vr.Total</td>
                   <?php 
                       if($estadoOrden<2)
                       {
                            if($_SESSION['nivel'] >2 || $request['nivelStorage'] > 2)
                            {
                                echo '<td><i class="fas fa-trash"></i></td>';
                            }
                       }
                   ?>
               </tr>
           </thead>
           <tbody>
               <?php
               $sumaItems = 0;
               for($i=0;$i<(sizeof($items));$i++)
               {
                    echo '<tr>';
                    echo '<td>'.$items[$i]["codigo"].'</td>';
                    echo '<td>'.$items[$i]["referencia"].'</td>';
                    echo '<td>'.$items[$i]["descripcion"].'</td>';
                    if($items[$i]["valor_unitario"] !=''){
                        echo '<td align="right">'.number_format($items[$i]["valor_unitario"], 0, ',', '.').'</td>';
                    }
                    else{
                        echo '<td></td>';
                    }
                   
                    echo '<td>'.$items[$i]["cantidad"].'</td>';
                    if($items[$i]["total_item"] !=''){
                        echo '<td align="right">'.number_format($items[$i]["total_item"], 0, ',', '.').'</td>';
                    }
                    else{
                        echo '<td></td>';
                    }
                    if($estadoOrden<2)
                    {
                            if($_SESSION['nivel'] >2)
                            {
                                echo '<td><i class="fas fa-trash" onclick = "eliminarItemOrden('.$items[$i]["id_item"].');"></i></td>';
                            }    
                    }

                    echo '</tr>';
                    $sumaItems += $items[$i]["total_item"];
               }
               echo '<tr>';
               echo '<td></td>';
               echo '<td></td>';
               echo '<td align="right">Total</td>';
               echo '<td></td>';
               echo '<td></td>';
               echo '<td align="right">'.number_format($sumaItems, 0, ',', '.').'</td>';
               echo '</tr>';
               ?>
           </tbody>
       </table>


       <?php
  }
  
  
  /* funcion para mostrar el formu de creacion 
  /*
  */
  public function formuCrearOrden(){
      ?> 
      <br><br>
         Placa:
          <input type="text" class = "ingresoInformacion" 
            id="placaPeritaje" VALUE = "" 
            placeholder="PLACA" 
            onkeyup="convertMayusculas();"
            > 
        <!-- <button class="btn btn-primary" id = "consultarOrden" onclick="buscarPlacaPeritaje();"> -->
            <br><br>
        <button class="btn btn-primary" id = "consultarOrden" onclick="buscarPlacaPeritajeDesdeOrden();">
        BUSCAR PLACA <i class="fas fa-search"></i>
        </button>
        <div id = "divResultadobusqueda" >

        </div>
        <div id="divBotonFormuCreacionOrden">
                <button
                    id= "btn_mostrar_formulario_creacion_orden"
                    onclick = "mostrarFormularioCreacionOrden();"
                    class = "btn btn-primary btn-lg"
                    data-toggle="modal" 
                    data-target="#myModalDdatosOrden"
                >
                    Formulario Creacion de Orden
                </button>
        </div>
        
      <?php
  }
  
  public function pedirDatosOrden($conexion,$placa,$consultaTecnicos){
      ?>
        <div id="div_pedir_datos_orden">

            <div class="row">
                <div class="form-group">
                    <label for="">Placa</label>
                    <?php echo $placa;  ?>
                </div>
            </div>
        <table>
                      
                        <tr>
                            <td>
                                <select id="tipo_medida">
                                   <option value = "1" selected > Klm</option> 
                                   <option value = "2"> Mil</option> 
                                   <option value = "3"> Hor</option> 
                                </select> 
                            </td>
                            <td>
                                <input id="kilometraje"type="text" size="6px">
                            </td>
                        </tr>
                        <tr>  
                            <td>  MECANICO:</td> </td>
                            <td> <select id ="mecanico" >
                                <?php
                                echo '<option value="-1"  >...</option>';
                                while($mecanicos = mysql_fetch_assoc($consultaTecnicos))
			                    {
			                        echo  '<option value = "'.$mecanicos['idcliente'].'"   > '.$mecanicos['nombre'].'  </option>';
			                    }
		                        ?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">MOTIVO ORDEN</td>
                        </tr>
                        <tr> 
                            <div>

                                <td colspan="2"><textarea  id ="descripcion" cols = "25%" rows="5"></textarea></td>
                            </div>  
                        </tr>
                    </table>
                    
                    <button class = "btn btn-primary btn-block btn-lg" onclick="grabarordenMovil();">GRABAR ORDEN </button>

        </div>

      <?php
  }
  public function pregunteNuevoItem($id)
  {
    ?> 
    <div>
        <div class="row">
            <div class="col-xs-2">
            </div>   
            <div class="col-xs-4">
                <button  
                onclick="filtroBuscarCodigoIngresoOrden();"
                class="btn btn-primary" 
                data-toggle="modal" data-target="#myModalFiltrosCodigos"
                >
                <i class="fas fa-search" ></i> 
                BUSCAR CODIGO
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
        <div class="row form-group">
            <div class="col-xs-3">
                <label >Codigo:</label>
            </div>
            <div class="col-xs-7">
                <!-- Codigo:<input type="text" id = "codNuevoItem" onblur="verifiqueCodigo();"> -->
                <input class ="form-control" 
                        type="text" 
                        id = "codNuevoItem" 
                        onkeyup="verificarSiExisteCodigo();"
                >
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
                <button class="btn btn-primary"  onclick="cerrarVentanaNuevoItem();">Cancelar</button>
            </div>
            <div class="col-xs-6">
                <button class="btn btn-primary" id = "grabarNuevoItem" onclick="grabarNuevoItem(<?php echo $id ?>);">Grabar Item</button>
            </div>
        </div>
    </div>
    <?php
  }
  public function pregunteNuevoItemNew($id)
  {
    ?> 
    <div  style="color:black">
        <div class="row">
            <div class="col-xs-2">
            </div>   
            <div class="col-xs-4">
                <button  
                onclick="filtroBuscarCodigoIngresoOrdenNew();"
                class="btn btn-primary" 
                data-toggle="modal" data-target="#myModalFiltrosCodigosNew"
                >
                <i class="fas fa-search" ></i> 
                BUSCAR CODIGO
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
        <div class="row form-group">
            <div class="col-xs-3">
                <label >Codigo:</label>
            </div>
            <div class="col-xs-7">
                <!-- Codigo:<input type="text" id = "codNuevoItem" onblur="verifiqueCodigo();"> -->
                <input class ="form-control" 
                        type="text" 
                        id = "codNuevoItem" 
                        onkeyup="verificarSiExisteCodigo();"
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
                        onclick="grabarNuevoItemNew(<?php echo $id ?>);"
                >Grabar Item</button>
            </div>
        </div>
    </div>
    <?php
  }

  public function formuFiltrosOrdenes()
  {
    

        ?>
        <div  style="color:black;">
           <div class="row form-group">

                <div class="col-xs-2" align="left">
                    <label for="">Placa:</label>
                </div>
                <div class="col-xs-10" align="left">
                    <input 
                        class="form-control" 
                        type="text"  
                        id="txtPlacaBuscar"
                        onkeyup="busqueCodigosConFiltroOrdenes(); "
                        >
                </div>
            </div>

            <!-- <div class="row form-group">
                
                <div class="col-xs-2" align="left">
                    <label for="">Nombre</label>
                </div>
                <div class="col-xs-10" align="left">
                    <input 
                    class="form-control" 
                    type="text"  
                    id="txtBuscarNombre"
                    onkeyup="busqueCodigosConFiltroOrdenes(); "
                    >
                </div>
            </div> -->


                <div class="row form-group">
                    
                    <div class="col-xs-2" align="left">
                        <label for="">Estado:</label>
                    </div>
                    <div class="col-xs-10" align="left">
                            <select id="idEstadoOrden"
                                class="form-control"
                                onchange="busqueCodigosConFiltroOrdenes(); "
                            >    
                                <option value = "">Seleccione...</option>
                                <option value = "0">En Proceso</option>
                                <option value = "1">Lista</option>
                             <?php   
                              if($_SESSION['nivel']>2){
                                  echo '<option value = "2">Facturada</option>';
                              }
                            ?>    
                                <!-- <option value = "3">Entregada</option> -->
                            </select>
                    </div>        
                      
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
    public function formuFiltrosInventarioOrden()
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
                       onkeyup="busqueCodigosConFiltroOrden(); "
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
                        onkeyup="busqueCodigosConFiltroOrden(); "
                    >
               </div>
           </div>
           <div>
               <!-- <button 
               class = "btn btn-primary"
               data-dismiss="modal"
                   onclick="buscarClienteFiltros();">Buscar Filtro</button> -->
           </div>
           <div id="divMuestreCodigosaBuscar">

           </div>
         
       </div>
       <?php
    }

    
    public function mostrarCodigosBucadosFiltro($codigos){
        echo '<div class="row">';
        echo '<table class="table" >';
        echo '<tbody>';
        echo '<tr>';
        echo '<th>Codigo</th>';
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
                    onclick="colocarInfoCodigoEnItem('.$codigo['id_codigo'].');" 
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

    public function pantallaImagenes($idOrden,$imagenes = [])
    {
        ?>
        <div id="div_principal_imagenes">
            <div id="div_nueva_imagen">
                <form action="subearchivo.php" method="post" enctype="multipart/form-data">
                    <input name="imagen" id="imagen" type="file">
                    <br><br><br><br>
                        <input type="submit" value="Enviar">
                </form>
            </div>
            <div id="muestre_imagenes">

            </div>
        </div>
        <?php
    }


}


?>