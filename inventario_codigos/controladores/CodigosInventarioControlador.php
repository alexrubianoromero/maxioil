<?php
$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/inventario_codigos/vista/inventarioCodigosVista.php');
require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php');
require_once($raiz.'/inventario_codigos/modelo/MovimientosInventarioModelo.php');

class CodigosInventarioControlador{
    private $vista; 
    private $modelo;
    private $movimientosModelo;  


    public function __construct(){

        // echo '<pre>'; 
        // print_r($_REQUEST);
        // echo '</pre>';
        // die(); 
        $this->vista =  new inventarioCodigosVista();
        $this->modelo = new CodigosInventarioModelo();
        $this->movimientosModelo = new MovimientosInventarioModelo();
            if($_REQUEST['opcion'] == 'vistaPrincipalInventarios'){
                $this->showVistaPrincipal();
            } 
            if($_REQUEST['opcion'] == 'mostrarCodigo'){
                $this->showCode($_REQUEST['idCodigo']);
            }
            
            if($_REQUEST['opcion'] == 'pregunteNuevoCodigo'){
                $this->askNewCode();
            }
            if($_REQUEST['opcion'] == 'grabarCodigo'){
                $this->saveCode($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'aumentarDisminuirInventario'){
      
                $this->moreLessInvent($_REQUEST);
            }
         
            if($_REQUEST['opcion'] == 'grabarEntradaSalidaInventario'){
      
                $this->saveMoreLessInvent($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'formuFiltrosInventario'){
      
                $this->formuFiltrosInventario($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'busqueCodigosConFiltro'){
      
                $this->busqueCodigosConFiltro($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'verAlertasInventario'){
      
                $this->verAlertasInventario();
            }
            if($_REQUEST['opcion'] == 'editarCodigo'){
      
                $this->editarCodigo($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'verifiqueCodigo'){
      
                $this->verifiqueCodigo($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'actualizarCodigo'){
      
                $this->actualizarCodigo($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'traerInfoCodeJson'){
      
                $this->traerInfoCodeJson($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'eliminarCodigo'){
      
                $this->eliminarCodigo($_REQUEST);
            }
            if($_REQUEST['opcion'] == 'generarExcelInventario'){
      
                $this->generarExcelInventario($_REQUEST);
            }




            
            
         
    }
    public function showVistaPrincipal(){
        // echo 'llego a vista principal '; 
        // die();
            $codigos = $this->modelo->mostrarCodigosInventarios();
            $this->vista->inventariosMainVista($codigos);
    } 
    public function showCode($idCodigo){
            // echo 'codigo '.$idCodigo;
            $infoCode = $this->modelo->getInfoCodeById($idCodigo);
            //       echo '<pre>'; 
            // print_r($infoCode);
            // echo '</pre>';
            // die();
            $this->vista->pantallaCodigo($infoCode);            
        }
        
        public function askNewCode(){
            // die('llego aca');
            $this->vista->pantallaPregunteCodigo('',0);    
        }
        
        public function saveCode($request)
        {
            $this->modelo->saveCode($request);
            $id_codigo = $this->modelo->traerIdCodeConCode($request['codigo']);
            //registrtrar el movimiento de creacion del codigo 
            $this->movimientosModelo->registerMovInicial($request,$id_codigo); 
            
        }
        
        public function morelessInvent($request){
            $infoCode = $this->modelo->getInfoCodeById($request['id']);
            $this->vista->pregunteInfoAumentarInvent($infoCode,$request['tipoMov']);   
        }
        
        
        public function saveMoreLessInvent($request)
        {
            // echo 'llego aca savemore'; 
            // die();
            $this->modelo->saveMoreLessInvent($request);
            $this->movimientosModelo->registerMov($request); 
        }
        
        public function formuFiltrosInventario()
        {
            $this->vista->formuFiltrosInventario();
        }
        
        public function busqueCodigosConFiltro($request)
        {
            $codigos = $this->modelo->getInfoCodeFiltros($request);
            $this->vista->mostrarCodigos($codigos);
            
        }
        public function verAlertasInventario()
        {
            $codigosAlertas = $this->modelo->codigosConAlertaInventario();
            $this->vista->mostrarAlertas($codigosAlertas);
        }
        
        public function editarCodigo($request){
            $infoCode = $this->modelo->getInfoCodeById($request['idCodigo']);
            $this->vista->pantallaPregunteCodigo($infoCode,1);    
        }
        
        public function verifiqueCodigo($request)
        {
            $infoCode =  $this->modelo->verifiqueCodigoSiExiste($request['codigo']);
        }
        
        public function actualizarCodigo($request)
        {
            $this->modelo->actualizarCodigo($request);
        }
        public function traerInfoCodeJson($request)
        {
            $this->modelo->traerInfoCodeJson($request['idCod']);
        }
        public function eliminarCodigo($request)
        {
            $this->modelo->eliminarCodigo($request['idCodigo']);
        }
        
        
        public function generarExcelInventario()
        {
            $codigos = $this->modelo->traerCodigos();
            $this->vista->generarExcelInventario($codigos);    
        }
        
    }
    
    
    
    ?>