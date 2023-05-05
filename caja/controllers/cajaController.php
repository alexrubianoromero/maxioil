<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/caja/vista/cajaVista.php');
require_once($raiz.'/caja/model/ReciboCajaModelo.php');
require_once($raiz.'/caja/model/ConceptoModel.php');
require_once($raiz.'/tecnicos/modelo/TecnicosModelo.php');
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');
require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');

class cajaController
{
    
    protected $vista;
    protected $model;
    protected $modelConcepto;  
    protected $modelTecnico;
    protected $modelItem;
    protected $modelOrden;

    public function __construct()
    {
        $this->vista = new cajaVista(); 
        $this->model = new ReciboCajaModelo();
        $this->modelConcepto = new ConceptoModel();
        $this->modelTecnico = new TecnicosModelo(); 
        $this->modelOrden = new OrdenesModelo(); 
        $this->modelItem = new itemsOrdenModelo();

        if($_REQUEST['opcion']=='menuPrincipalCaja')
        {
            $this->menuPrincipalCaja();
        }
        if($_REQUEST['opcion']=='pregunteEntradaCaja')
        {
            $this->pregunteEntradaCaja($_REQUEST);

        }
        if($_REQUEST['opcion']=='grabarRecibo')
        {
            $this->grabarRecibo($_REQUEST);
        }

        if($_REQUEST['opcion']=='informeCaja')
        {
            $this->informeCaja($_REQUEST);
        }
        if($_REQUEST['opcion']=='informeSalario')
        {
            $this->informeSalario();
        }
    }


    public function menuPrincipalCaja()
    {
        $saldoActual = $this->model->traerSaldoActual();
        $this->vista->cajaVistaPrincipal($saldoActual);
    }
    public function grabarRecibo($request)
    {
        // echo 'entonces debe cambiar el estado de la orden '; 
        // echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die(); 
        $this->model->grabarRecibo($request);
        if($request['idOrden'] !=''){
            $this->modelOrden->actualizarEstadoOrdenId($request['idOrden']);   
        }
    }
    
    public function informeCaja($request)
    {
        // echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die(); 
        
        $recibos = $this->model->informeCaja($request);
        // $this->vista->mostrarRecibos($recibos);
        $this->vista->mostrarRecibosNew($recibos);
        
    }
    public function  pregunteEntradaCaja($request)
    {
        // echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die();
        // $sumaItems =  $this->modelItem->sumarItemsIdOrden($request['idOrden']);
        // die($sumaItems);
        $conceptos = $this->modelConcepto->traerConceptos();
        $tecnicos = $this->modelTecnico->traerTecnicosNew();
        $this->vista->formuCajaEntrada($request,$conceptos,$tecnicos);
    }
    public function informeSalario()
    {
        // $valores=[];
        // $valores['tipoInforme'] =='1';
        // $recibos123 = $this->model->informeCaja($valores);
        // $recibosDia = $this->model->traerLosRecibosDelDia();
        // foreach($recibosDia as $recibo )
        // {
        //     echo 'controller<br>'.$recibo['id_recibo'];
        // }
        // die();
        // $this->vista->muestreSalario($recibosDia);
        $this->vista->mustreSalarioDiario();
        // echo 'llego a funcion salario '; 
    }

}
?>




