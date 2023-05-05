<?php

$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/ayudas_financieras/vista/conceptosVista.php');
require_once($raiz.'/caja/model/ConceptoModel.php');

class conceptosController
{
    protected $vista;
    protected $model ; 

    public function __construct()
    {
        $this->vista = new conceptosVista(); 
        $this->model = new ConceptoModel(); 

        if($_REQUEST['opcion']=='menuPrincipalConceptos')
        {
            $this->menuPrincipalConceptos(); 
        }
        if($_REQUEST['opcion']=='formuNuevoConcepto')
        {
            $this->formuNuevoConcepto(); 
        }
        if($_REQUEST['opcion']=='grabarConcepto')
        {
            $this->grabarConcepto($_REQUEST); 
        }
    }
    public function menuPrincipalConceptos()
    {
        // echo 'metodo de controllaro';

        $conceptos = $this->model->traerConceptos(); 
        $this->vista->menuPrincipalConceptos($conceptos);
    }
    
    public function formuNuevoConcepto()
    {
        $this->vista->formuNuevoConcepto();

    }
    public function grabarConcepto($request)
    {
        $this->model->grabarConcepto($request); 
        echo 'Concepto grabado'; 
    }
}


?>