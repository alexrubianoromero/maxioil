<?php

$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/ventas/vista/ventasVista.php');
require_once($raiz.'/ventas/model/VentasTemporalModel.php');
require_once($raiz.'/ventas/model/VentasModel.php');
require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php'); 
require_once($raiz.'/inventario_codigos/modelo/MovimientosInventarioModelo.php'); 
  // echo '<pre>'; 
        // print_r($itemsTemp);
        // echo '</pre>';
        // die(); 
class ventasController
{
    protected $vista;
    protected $codigosModelo;
    protected $ventasTemporalModel; 
    protected $ventasModel; 
    protected $movimientosModelo;

    public function __construct()
    {
        $this->vista = new ventasVista();
        $this->codigosModelo = new CodigosInventarioModelo();
        $this->movimientosModelo = new MovimientosInventarioModelo();
        $this->ventasTemporalModel = new VentasTemporalModel();
        $this->ventasModel = new VentasModel();

        // echo 'llego a controlador '; 
        if($_REQUEST['opcion']=='pantallaPrincipalVentas'){
            $this->pantallaPrincipalVentas($_REQUEST);
       }       
        if($_REQUEST['opcion']=='pantallaNuevaVenta'){
            $this->pantallaNuevaVenta($_REQUEST);
       }       
        if($_REQUEST['opcion']=='pregunteNuevoItemNewVentas'){
            $this->pregunteNuevoItemNewVentas($_REQUEST);
       }       
        if($_REQUEST['opcion']=='formuFiltrosInventarioVentas'){
            $this->formuFiltrosInventarioVentas($_REQUEST);
       }   
        if($_REQUEST['opcion']=='busqueCodigosConFiltroVentas'){
            $this->busqueCodigosConFiltroVentas($_REQUEST);
       }   
        if($_REQUEST['opcion']=='grabarItemsTemporalVenta'){
            $this->grabarItemsTemporalVenta($_REQUEST);
       }   
        if($_REQUEST['opcion']=='grabarVenta'){
            $this->grabarVenta($_REQUEST);
       }   

       
       
    }


    public function pantallaPrincipalVentas($request)
    {
        $this->vista->pantallaPrincipalVentas();
    }
    public function pantallaNuevaVenta($request)
    {
        //crear registro temporal 
        $idTemp =  $this->ventasTemporalModel->crearVentaTemporal();
        $this->vista->pantallaNuevaVenta($idTemp);
    }
    public function pregunteNuevoItemNewVentas($request){
        
        $this->vista->pregunteNuevoItemNewVentas($request);
    }
    
    
    public function formuFiltrosInventarioVentas($request){
        
        $this->vista->formuFiltrosInventarioVentas();
    }
    public function busqueCodigosConFiltroVentas($request)
    {
        $codigos = $this->codigosModelo->getInfoCodeFiltros($request);
        $this->vista->mostrarCodigosBucadosFiltroVentas($codigos);
    }
    
    public function grabarItemsTemporalVenta($request)
    {
        $this->ventasTemporalModel->grabarItemsVentaTemporal($request);
        $itemsVentaTemporal =  $this->ventasTemporalModel->traerItemsVentaTemporal($request['idTemp']);
        $this->vista->muestreItemsTemporales($request['idTemp'],$itemsVentaTemporal);
    }

    public function grabarVenta($request)
    {
        $this->ventasModel->grabarventa($request['idTemp']);
        $ultIdVenta = $this->ventasModel->traerUltimoIdVentas();
        $itemsTemp = $this->ventasTemporalModel->traerItemsVentaTemporal($request['idTemp']);
        $this->ventasModel->grabarItemsVenta($ultIdVenta,$itemsTemp); 
        $this->relizarDescuentosInventario($itemsTemp);
        $this->registrarMovimientosInventario($ultIdVenta,$itemsTemp);
        //limpiar las tablas temporales
        $respu['idVenta']= $ultIdVenta;
        echo json_encode($respu);
        exit();
    }

    public function relizarDescuentosInventario($itemsTemp)
    {
        foreach($itemsTemp as $itemTemp)
        {
            $parametros['id'] = $itemTemp['idCode'];
            $parametros['tipo'] = 6;
            $parametros['cantidad']= $itemTemp['cantidad'];
            $this->codigosModelo->saveMoreLessInvent($parametros);
        }
    }
    public function registrarMovimientosInventario($ultIdVenta,$itemsTemp)
    {
        foreach($itemsTemp as $itemTemp)
        {
            $data['tipo']= 6;
            $data['cantidad'] = $itemTemp['cantidad'];
            $data['factura'] = ''; 
            $data['id'] = $itemTemp['idCode'];
            $data['observaciones'] = 'Salida en Venta '.$ultIdVenta; 
            //ahora graba el registro del movimiento 
            $this->movimientosModelo->registerMov($data);
        }    
    }

    
}

?>