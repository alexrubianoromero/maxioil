<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/tecnicos/vista/TecnicosVista.php');
require_once($raiz.'/tecnicos/modelo/TecnicosModelo.php');

class  TecnicosControllerMovil 
{
    private $vista;
    private $model; 
    public function __construct()
    {
        // echo 'llego a controlador de tecnicos '; 
        $this->vista = new TecnicosVista(); 
        $this->model = new TecnicosModelo();

        if($_REQUEST['opcion']=='pantallaPrincipalTecnicos'){
            $this->pantallaPrincipalTecnicos(); 
        }
        if($_REQUEST['opcion']=='editarTecnico'){
            $this->editarTecnico($_REQUEST); 
        }
        if($_REQUEST['opcion']=='formuNuevoTecnico'){
            $this->formuNuevoTecnico(); 
        }
        if($_REQUEST['opcion']=='grabarTecnico'){
            $this->grabarTecnico($_REQUEST); 
        }
        if($_REQUEST['opcion']=='actualizarTecnico'){
            $this->actualizarTecnico($_REQUEST); 
        }
        if($_REQUEST['opcion']=='eliminarTecnico'){
            $this->eliminarTecnico($_REQUEST); 
        }

    }

    public function pantallaPrincipalTecnicos()
    {
        // die('llegoa la funcion del controlador '); 
        $tecnicos =  $this->model->traerTecnicosNew();
        $this->vista->pantallaprincipalTecnicos($tecnicos);  
    }
    
    public function editarTecnico($request)
    {
        $tecnico = $this->model->traerTecnicoPorId($request['idcliente']);
        // $this->vista->pantallaDatosTecnico($tecnico);
        $this->vista->formuNuevoTecnico($tecnico);
        
    }
    
    
    public function formuNuevoTecnico()
    {
        $this->vista->formuNuevoTecnico();
        
    }
    public function grabarTecnico($request)
    {
        $this->model->grabarTecnico($request);
    }
    public function actualizarTecnico($request)
    {
        $this->model->actualizarTecnico($request);
    }
    public function eliminarTecnico($request)
    {
        $this->model->eliminarTecnico($request['idcliente']);
    }

}


?>