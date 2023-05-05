<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/caja/model/ConceptoModel.php');
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');
require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');
require_once($raiz.'/tecnicos/modelo/TecnicosModelo.php');
require_once($raiz.'/caja/model/ReciboCajaModelo.php');
require_once($raiz.'/ventas/model/VentasModel.php');

class cajaVista
{
    protected $modeloConcep; 
    protected $modelItem; 
    protected $modelOrden; 
    protected $ventasModel; 
    protected $modelTecnico; 
    protected $modelRecibo;
    public function __construct()
    {
        $this->modeloConcep = new ConceptoModel(); 
        $this->modelItem = new itemsOrdenModelo();
        $this->modelOrden =  new OrdenesModelo();
        $this->ventasModel =  new ventasModel();
        $this->modelTecnico  = new TecnicosModelo(); 
        $this->modelRecibo  = new ReciboCajaModelo(); 

    }

    public function cajaVistaPrincipal($saldoActual)
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
            
            <div>
                <h2> Saldo Actual : <?php  echo number_format($saldoActual,0,",","."); ?></h2>
                <div id="divBotonesCaja">
                    <div class="row">
                        <div class="col-xs-3">
                            <button 
                                data-toggle="modal" data-target="#myModalCaja"    
                                class ="btn btn-primary" onclick="entradaCaja(1);">Entradas</button>
                        </div>
                        <div class="col-xs-3">
                            <button 
                               data-toggle="modal" data-target="#myModalCaja"   
                               class ="btn btn-primary" onclick="entradaCaja(2);">Salidas</button>
                            </div>
                            <div class="col-xs-3">
                                <button 
                                data-toggle="modal" data-target="#myModalCajaMovimientos"   
                            class ="btn btn-primary" onclick="mostrarMovimientosDia(1);">Diario</button>
                        </div>
                        <div class="col-xs-3">
                            <button class ="btn btn-primary">Gen</button>
                        </div>
                        
                    </div>
                </div>
                <div id="divResultadosCaja">
                    
                    </div>
                </div>
            </body>
            </html>
             <?php $this->modalCaja(); ?>   
             <?php $this->modalCajaMovimientos(); ?>   
            <?php
    }
    
    public function modalCaja ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Caja</h4>
                  </div>
                  <div id="cuerpoModalCaja" class="modal-body" style="color:black">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pantallaPrincipalCaja();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalCajaMovimientos ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalCajaMovimientos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Caja</h4>
                  </div>
                  <div id="cuerpoModalCajaMovimientos" class="modal-body" style="color:black">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pantallaPrincipalCaja();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }

    public function formuCajaEntrada($request,$conceptos=[],$tecnicos = [])
    {
        if($request['tipo']==1){
            $titulo = 'Entrada';
            $dequien = 'Recibido de:';
        }
        else{
            $titulo = 'Salida';
            $dequien = 'Pagado a:';
        }
        if(isset($request['idOrden'])) //significa que es un recibo de una orden facturada 
        {
            //traer info de orden 
            $sumaItems =  $this->modelItem->sumarItemsIdOrden($request['idOrden']);
            $datosOrden = $this->modelOrden->traerOrdenId($request['idOrden']); 
            $textoInfoOrden = 'Pago Orden No '.$datosOrden['orden'];
            $titulo = 'Pago Orden No '.$datosOrden['orden'].' valor: '.number_format($sumaItems, 0, '.', '');
        }
        if(isset($request['idVenta'])) //significa que es un recibo de una venta de mostrador
        {
            //traer info venta
            $sumaItems = $this->ventasModel->sumarItemsVentaId($request['idVenta']);
            // $sumaItems =  $this->modelItem->sumarItemsIdOrden($request['idOrden']);
            // $datosOrden = $this->modelOrden->traerOrdenId($request['idOrden']); 
            $textoInfoOrden = 'Pago Venta No '.$request['idVenta'];
            $titulo = 'Pago Venta No '.$request['idVenta'].' valor: '.number_format($sumaItems,0,",",".");
        }
        ?>
        <div style="color:black">
        <input type = "hidden"  id="idOrden"  value ="<?php echo $request['idOrden']; ?>" > 
        <input type = "hidden"  id="idVenta"  value ="<?php echo $request['idVenta']; ?>" > 
        <h3 ><?php  echo $titulo;  ?></h3>
            <input type="hidden" id="tipo" value = "<?php echo $request['tipo']   ?>" >
            <div class="row" style="font-size:20px;">
                <div class ="col-xs-4"><label align="right" >Valor Total: $</label></div>
                <div class="col-xs-8" align="left" style="color:green; ">
                    <label id="txtValor" align="left"></label>
                    <!-- <input type="text" id="txtValor" class ="form-control"  onfocus="blur();"> -->
                </div>
            </div>
            <div class = row>
                <div class="col-xs-3">
                    <input 
                        class= "form-control" 
                        type="text" id="txtEfectivo" 
                        placeholder="Efectivo"
                        onkeyup = "sumarTotalRecibo(); ";
                    >
                </div>
                <div class="col-xs-3">
                    <input class= "form-control" type="text" id="txtDebito" placeholder="Nequi" onkeyup = "sumarTotalRecibo(); ">
                </div>
                <div class="col-xs-3">
                    <input class= "form-control" type="text" id="txtCredito" placeholder="Daviplata" onkeyup = "sumarTotalRecibo(); ">
                </div>
            </div>
            <div class = row>
                <div class="col-xs-3">
                    <input class= "form-control" type="text" id="txtBancolombia" placeholder="Bancolombia" onkeyup = "sumarTotalRecibo(); ">
                </div>
                <div class="col-xs-3">
                    <input class= "form-control" type="text" id="txtBolt" placeholder="Bolt" onkeyup = "sumarTotalRecibo(); ">
                </div>
                <div class="col-xs-3">
                </div>
            </div>    
            <div class="row">
                <div class ="col-xs-4"><label class ="form-control"><?php  echo  $dequien;  ?></label></div>
                <div class="col-xs-8">
                    <?php
                        if(isset($request['idOrden'])) //significa que es un recibo de una orden facturada 
                        {
                            echo '<input type="text" id="txtAquien" 
                                    class ="form-control"
                                    value = "'.$textoInfoOrden.'"
                                  >';
                        }else{
                            echo '<input type="text" id="txtAquien" class ="form-control" value="Clientes Varios">';
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class ="col-xs-4"><label class ="form-control">Concepto:</label></div>
                <div class="col-xs-8">
                    <!-- <input type="text" id="txtConcepto" class ="form-control"> -->
                   <?php
                     if($request['tipo']==1){
                   ?>
                    <select  id="txtConcepto" 
                        class = "form-control"
                    >
                        <option value="0">Seleccione Concepto</option>
                        <?php $this->mostrarConceptos($conceptos); ?>
                    </select>
                    <?php
                    }
                    else{
                        echo ' <input type="text" id="txtConcepto" class ="form-control"> ';  
                    }
                    ?>
                </div>
            </div>
            <div id="divPregunteTecnico" class="row">
                <div class ="col-xs-4">
                <?php
                     if($request['tipo']==1){
                     echo  '<label class ="form-control">Tecnico:</label>'; }
                 ?>   
                </div>
                <?php
                     if($request['tipo']==1)
                     {
                  ?>        
                    <div class="col-xs-8">
                        <select  id="idTecnico" 
                            class = "form-control"
                        >
                            <option value="0">Seleccione Tecnico</option>
                                <?php $this->mostrarTecnicos($tecnicos); ?>
                        </select>
                    </div>
                   <?php
                    }else {
                        echo '<input type="hidden" id="idTecnico" value = "0" >'; 
                    }
                   ?>     
            </div>

            <div class="row">
                <div class ="col-xs-4"><label class ="form-control">Observaciones:</label></div>
                <div class="col-xs-8">
                    <?php
                           
                           if(isset($request['idOrden']) || isset($request['idVenta'])) //significa que es un recibo de una orden facturada 
                            {
                                echo '<input 
                                        type="text" 
                                        id="txtObservacion" 
                                        class ="form-control"
                                        value = "'.$titulo.'"
                                      >';
                            }    
                            else{
                                echo '<input type="text" id="txtObservacion" class ="form-control">';
                            }
                            ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12"><button  class ="btn btn-primary" onclick="grabarRecibo();">Registrar</button></div>
            </div>
        </div>

        <?php
    }

    public function formuCajaEntrada_ante($request)
    {
        if($request['tipo']==1){
            $titulo = 'Entrada';
            $dequien = 'Recibido de:';
        }
        else{
            $titulo = 'Salida';
            $dequien = 'Pagado a:';
        }
        ?>
        <div style="color:black">
        <h3><?php  echo $titulo;  ?></h3>
            <input type="hidden" id="tipo" value = "<?php echo $request['tipo']   ?>" >
            <div class="row">
                <div class ="col-xs-4"><label class ="form-control">Valor:</label></div>
                <div class="col-xs-8"><input type="text" id="txtValor" class ="form-control"></div>
            </div>
            <div class="row">
                <div class ="col-xs-4"><label class ="form-control"><?php  echo  $dequien;  ?></label></div>
                <div class="col-xs-8"><input type="text" id="txtAquien" class ="form-control"></div>
            </div>
            <div class="row">
                <div class ="col-xs-4"><label class ="form-control">Concepto:</label></div>
                <div class="col-xs-8">
                    <input type="text" id="txtConcepto" class ="form-control">
                </div>
            </div>
            <div class="row">
                <div class ="col-xs-4"><label class ="form-control">Observaciones:</label></div>
                <div class="col-xs-8"><input type="text" id="txtObservacion" class ="form-control"></div>
            </div>
            <div class="row">
                <div class="col-xs-12"><button  class ="btn btn-primary" onclick="grabarRecibo();">Registrar</button></div>
            </div>
        </div>

        <?php
    }

    public function mostrarRecibos($recibos)
    {
        
        echo '<div class="row">';
        echo '<table class="table" >';
        echo '<tbody>';
        echo '<tr>';
        echo '<th>Fecha</th>';
        echo '<th>Tipo</th>';
        echo '<th>Nombre</th>';
        echo '<th>Concepto</th>';
        echo '<th>Valor</th>';
        // echo '<th>Descontar</th>';
        echo '</tr>';
        echo '</tbody>';
        $total = 0;
        while($recibo = mysql_fetch_assoc($recibos))
        {
            echo '<tr>';
            echo '<td>'.$recibo['fecha_recibo'].'</td>';
            echo '<td>'.$recibo['tipo_recibo'].'</td>';
            echo '<td>'.$recibo['dequienoaquin'].'</td>';
            echo '<td>';
            $concepto =  $this->modeloConcep->traerConceptoConId($recibo['idConcepto']);
            // $concepto = $this->modeloConcep->traerConceptoConId($recibo['idConcepto']); 
            // echo $recibo['idConcepto'];
            echo $concepto;
            echo '</td>';
            echo '<td align="right">'.number_format($recibo['lasumade'],0,",",".").'</td>';
            echo '</tr>';

            $total = $total + $recibo['lasumade'];

        }
        echo '<tr>';
        echo '<td colspan= "3"></td>';
        echo '<td>Total:</td>';
        echo '<td align="right">'.number_format($total,0,",",".").'</td>';
        echo '</tr>';
        
        echo '</table>';
        echo '</div>';
    }
    public function mostrarRecibosNew($recibos)
    {
        //mostrar las entradas 
        //mostrar las salidas
        ?>
            <div class="row">
                <div class="col-xs-6"><h2>RECAUDO DIARIO</h2> </div>
                <div class="col-xs-6"><h2>
                    </h2><button 
                            class="btn btn-primary"
                            onclick="muestresalarioDiario();"
                        >
                        SALARIO</button></h2></></div>
                </div>
          
        <div>
            <div>
                <label>
                    Entradas 
                </label>

                <?php $totalIngreso =$this->mostrarRecibosResumido($recibos,'1'); ?>
            </div>
            <div>
                <label>
                    Salidas
                </label>
                <?php $totalEgreso = $this->mostrarRecibosResumido($recibos,'2'); ?>

            </div>
            <div>
                <div class="row">
                    <table class = "table table-bordered">
                        <tr>
                            <td>Total Ingresos</td>
                            <td>Total Egresos</td>
                        </tr>
                        <tr>
                            <td align="right"><?php echo number_format($totalIngreso, 0, ',', '.');  ?></td>
                            <td align="right"><?php echo number_format($totalEgreso, 0, ',', '.');  ?></td>
                        </tr>
                        <?php $recaudoReal = $totalIngreso - $totalEgreso; ?>
                        <tr>
                            <td>Recaudo Real del Dia</td>
                            <td align="right"  style="color:green"><?php echo number_format($recaudoReal, 0, ',', '.'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php 
    }

    public function mostrarRecibosResumido($recibos,$tipo )
    {
        echo '<table class="table" >';
        echo '<tbody>';
        echo '<tr>';
        echo '<th>Concepto</th>';
        echo '<th >Efectivo</th>';
        echo '<th >Debito</th>';
        echo '<th >Credito</th>';
        echo '<th >Bancolombia</th>';
        echo '<th >Bolt</th>';
        echo '<th >Total</th>';
        echo '</tr>';
        echo '<tbody>';
        $efectivo=0;
        $debito = 0;
        $credito = 0;
        $credito = 0;
        $bancolombia = 0;
        $bolt = 0;
        $total = 0;
        foreach($recibos as $recibo)
        {
            if($recibo['tipo_recibo'] == $tipo)
            {
            echo '<tr>';
                if($tipo=='1')
                {
                    $concepto =  $this->modeloConcep->traerConceptoConId($recibo['idConcepto']);
                    //si es un pago de orden de servicio buscar el numero de la orden
                    if($recibo['idOrden']>0)
                    {
                        //busque el numero de la orden
                       $infoOrden =  $this->modelOrden->traerOrdenId($$recibo['idOrden']); 
                       $concepto = $concepto.' '.$infoOrden['orden'];
                    }

                }
                if($tipo=='2')
                {
                    $concepto =  $recibo['idConcepto'];
                }

                
            
            echo '<td>'.$concepto.'</td>';
            echo '<td align="right">'.number_format($recibo['efectivo'], 0, ',', '.').'</td>';
            echo '<td align="right"> '.number_format($recibo['t_debito'], 0, ',', '.').'</td>';
            echo '<td align="right">'.number_format($recibo['t_credito'], 0, ',', '.').'</td>';
            echo '<td align="right">'.number_format($recibo['bancolombia'], 0, ',', '.').'</td>';
            echo '<td align="right">'.number_format($recibo['bolt'], 0, ',', '.').'</td>';
            echo '<td align="right">'.number_format($recibo['lasumade'], 0, ',', '.').'</td>';
            echo '</tr>';
            $efectivo += $recibo['efectivo'];
            $debito   += $recibo['t_debito'];
            $credito  += $recibo['t_credito'];
            $bancolombia  += $recibo['bancolombia'];
            $bolt  += $recibo['bolt'];
            $total    += $recibo['lasumade'];
            echo '</tr>';
            }
        }
        echo '<tr>';
        echo '<td align="right">Totales:</td>';
        echo '<td align="right">'.number_format($efectivo, 0, ',', '.').'</td>';
        echo '<td align="right">'.number_format($debito, 0, ',', '.').'</td>';
        echo '<td align="right">'.number_format($credito, 0, ',', '.').'</td>';
        echo '<td align="right">'.number_format($bancolombia, 0, ',', '.').'</td>';
        echo '<td align="right">'.number_format($bolt, 0, ',', '.').'</td>';
        echo '<td align="right" style="color:green">'.number_format($total, 0, ',', '.').'</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        return $total ;

    }


    


    public function mostrarConceptos($conceptos)
    {
            foreach($conceptos as $concepto)
            {
                echo '<option value = "'.$concepto['idConcepto'].'">'.$concepto['concepto'].'</option>';
            }
    }
        
    public function mostrarTecnicos($tecnicos)
    {
        foreach($tecnicos as $tecnico)
        {
            echo '<option value = "'.$tecnico['idcliente'].'">'.$tecnico['nombre'].'</option>';
        }
            
    }

    public function muestreSalario($recibos)
    {
        // foreach($recibos as $recibo )
        // {
        //     echo '<br>'.$recibo['id_recibo'];
        // }
        // die();
        echo 'Salario';

        echo '<table class="table" >';
        echo '<tr>';
        echo '<th>Concepto</th>';
        echo '<th>Obse</th>';
        echo '<th >Valor</th>';
        echo '<th >Nombre</th>';
        echo '<th >%</th>';
        echo '<th >Valor a PAgar</th>';
        echo '</tr>';
        $totalPagos= 0;
        foreach($recibos as $recibo)
        {

            if($recibo['tipo_recibo'] == '1')
            {
                echo '<tr>';
                    $concepto =  $this->modeloConcep->traerConceptoConId($recibo['idConcepto']);
                    if($recibo['id_orden'] != '0') //es el pago de una orden 
                    {
                        // die('entro a que existe idOrden'.$recibo['id_orden']);
                        //debe traer solo la parte de mano de obra busque mano de obra de este orden
                        
                        $infoOrden =  $this->modelOrden->traerOrdenId($recibo['id_orden'],'');
                        $infoTecnico =  $this->modelTecnico->traerTecnicoPorId($infoOrden['idmecanico']); 
                        $sumaItemsMano = $this->modelItem->traerItemsOrdenManoObraIdOrden($recibo['id_orden'],'M');
                        //si la suma de manos de obra es mayor a cero se mostrara informacion de lo contrario no 
                        
                        echo '<td>'.$concepto.'</td>';
                        // $concepto = $concepto .' '.$infoOrden['orden'];
                        $tecnico = $infoOrden['mecanico'];
                        $concepto .= $infoOrden['orden']; 
                        echo '<td>'.$concepto.'</td>';
                        echo '<td align="right">'.number_format($sumaItemsMano['valor'], 0, ',', '.').'</td>';
                        echo '<td>'.$infoTecnico['nombre'].'</td>';
                        echo '<td>'.$infoTecnico['porcentaje_nomina'].'%</td>';
                        $valorPagar = ($sumaItemsMano['valor'] * $infoTecnico['porcentaje_nomina'])/100;
                        echo '<td align="right">'.number_format($valorPagar, 0, ',', '.').'</td>';
                    }
                    if($recibo['idTecnico'] >'0') //osea si es lavada 
                    {
                        echo '<td>'.$concepto.'</td>';
                        echo '<td></td>';
                        echo '<td align="right">'.number_format($recibo['lasumade'], 0, ',', '.').'</td>';
                        $tecnico = $this->modelTecnico->traerTecnicoPorId($recibo['idTecnico']); 
                        echo '<td>'.$tecnico['nombre'].'</td>';
                        echo '<td>'.$tecnico['porcentaje_nomina'].'%</td>';
                        
                        $valorPagar = ($recibo['lasumade'] * $tecnico['porcentaje_nomina'])/100;
                        echo '<td align="right">'.number_format($valorPagar, 0, ',', '.').'</td>';
                    }    
                    echo '</tr>';
                }    
                $totalPagos  = $totalPagos + $valorPagar; 
            }
            echo '<tr><td></td><td></td><td></td><td></td><td>Total: </td><td align="right">'.number_format($totalPagos, 0, ',', '.').'</td></tr>';
            echo '</table>';
        }
        public function mustreSalarioDiario()
        {
            $granTotal = 0; 
            echo '<h2>REPORTE SALARIO DIARIO</h2>';
            $idTecnicosRecibosDia = $this->modelRecibo->traerIdTecnicosRecibosDiaQueTenganIdTecnico();
            echo '<table class="table" >';
            foreach($idTecnicosRecibosDia as $tecnicoRecibo)
            {
                $totalTecnico = 0;
                $tecnico = $this->modelTecnico->traerTecnicoPorId($tecnicoRecibo['idTecnico']); 
                echo '<tr><th colspan="6">'.$tecnico['nombre'].'</th></tr>';
                echo '<tr>';
                echo '<th>Concepto</th>';
                echo '<th>Obse</th>';
                echo '<th align="right">Valor</th>';
                echo '<th >%</th>';
                echo '<th align="right">Valor a Pagar</th>';
                echo '</tr>';
                // echo '<br>'.$tecnicoRecibo['idTecnico'];
                $recibosDia = $this->modelRecibo->traerRecibosDiaPorIdTecnico($tecnicoRecibo['idTecnico']);
                foreach($recibosDia as $recibo)
                {
                    //mostrar recibos del dia de este tecnico
                    $concepto =  $this->modeloConcep->traerConceptoConId($recibo['idConcepto']);
                    echo '<tr>'; 
                    echo '<td>'.$concepto.'</td>'; 
                    echo '<td></td>'; 
                    echo '<td align="right">'.number_format($recibo['lasumade'], 0, ',', '.').'</td>'; 
                    echo '<td>'.$tecnico['porcentaje_nomina'].'%</td>'; 
                    $valorPagar = ($recibo['lasumade'] * $tecnico['porcentaje_nomina'])/100;
                    echo '<td align="right">'.number_format($valorPagar, 0, ',', '.').'</td>';
                    echo '</tr>';
                    $totalTecnico = $totalTecnico + $valorPagar; 
                }
                $granTotal += $totalTecnico; 
                echo '<tr><td colspan = "3"></td><td>Subtotal :</td><td align="right">'.number_format($totalTecnico, 0, ',', '.').'</td></tr>';
            }
            echo '<tr><td></td></tr>';
            echo '<tr><td colspan = "3"></td><td>Gran Total:</td><td align="right">'.number_format($granTotal, 0, ',', '.').'</td></tr>';
            $totalPorIngresoOrdenes = $this->muestreIngresoDiarioPorOrdenes();
            $granTotalFinal = $granTotal + $totalPorIngresoOrdenes; 
            echo '<tr><td><Gran colspan = "1">Gran Total:</td><td align="right">'.number_format($granTotalFinal, 0, ',', '.').'</td></tr>';
            
            echo '</table>';
            
            
        }
        
        public function muestreIngresoDiarioPorOrdenes()
        {
            $totalPorOrdenes = 0; 
            echo '<tr><td>Ingreso Por Ordenes</td></tr>';
            $idOrdenRecibos = $this->modelRecibo->traerIdordenRecibosPorOrdenesDeServicioDiario();
            foreach($idOrdenRecibos as $idOrdenRecibo)
            {
                
                $infoRecibo = $this->modelRecibo->traerReciboPorIdOrden($idOrdenRecibo['id_orden']);
                $infoOrden =  $this->modelOrden->traerOrdenId($idOrdenRecibo['id_orden'],'');
                $tecnico = $this->modelTecnico->traerTecnicoPorId($infoOrden['idmecanico']); 
                $concepto =  $this->modeloConcep->traerConceptoConId($infoRecibo['idConcepto']);
                $concepto .= ' Orden '.$infoOrden['orden']; 
                //traer los codigos de nomina de esa orden 
                $itemsManosObraOrden = $this->modelItem->traerItemsOrdenManoObraIdOrden($idOrdenRecibo['id_orden'],'M');
                // foreach($itemsManosObraOrden as $arr)
                // {
                //         echo '<br>valores'.$arr['valor'];
                // }
                echo'<tr>';
                echo '<td>'.$tecnico['nombre'].'</td>';
                echo '</tr>';
                $totalPorTecnico = 0; 
                foreach($itemsManosObraOrden as $itemManoObraOrden)
                {
                    echo'<tr>';
                    echo '<td>'.$concepto.'</td>';
                    echo '<td></td>';
                    echo '<td align="right">'.number_format($itemManoObraOrden['valor'], 0, ',', '.').'</td>';
                    echo '<td>'.$tecnico['porcentaje_nomina'].'%</td>';
                    $valorPagar = ($itemManoObraOrden['valor'] * $tecnico['porcentaje_nomina'])/100;
                    echo '<td align="right">'.number_format($valorPagar, 0, ',', '.').'</td>';
                    echo '</tr>';
                    $totalPorTecnico +=  $valorPagar;
                }

                $totalPorOrdenes += $totalPorTecnico;

            }
            echo '<tr>'; 
            echo '<td colspan ="3"></td><td>Subtotal </td><td align="right">'.number_format($totalPorOrdenes, 0, ',', '.').'</td>';
            echo '</tr>';
            return $totalPorOrdenes;
        }
        
}


?>