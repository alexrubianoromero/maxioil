<?php

$raiz = dirname(dirname(dirname(__file__)));

// echo $raiz;

// die();

require_once($raiz.'/clientes/vista/ClientesVista.php');

require_once($raiz.'/clientes/modelo/ClientesModelo.class.php');
require_once($raiz.'/vehiculos/modelo/VehiculosModelo.php');



class ClientesControlador{

    private $conexion; 

    private $modelo;

    private $vista;
    protected $modelCar;



    public function __construct($conexion){



        $this->modelo = new ClientesModelo();

        $this->vista = new ClientesVista();
        $this->modelCar = new VehiculosModelo();

        $this->conexion = $conexion;





        if(!isset($_REQUEST['opcion'])){

            // die('llego aca '); 

            $this->pantallainicialClientes($conexion = '');

          }

        if($_REQUEST['opcion']=='verClientes'){
            $this->verClientes($conexion);
          }
          
          if($_REQUEST['opcion']=='nuevoPropietario'){
              
              $this->nuevoPropietario($this->conexion);
              
            }  
            
            if($_REQUEST['opcion']=='nuevoPropietarioDesdeVehiculo'){
                
                $this->nuevoPropietarioDesdeVehiculo($this->conexion);
                
            }  
            
            if($_REQUEST['opcion']=='grabarPropietario'){
                
                //     echo '<pre>';
                
                // print_r($_REQUEST);
                
                // echo '</pre>';
                
                // die();
                
                $this->grabarPropietario($this->conexion,$_REQUEST);
                
            }
            
            if($_REQUEST['opcion']=='validarIdenti'){
                
                $this->validarIdenti($this->conexion,$_REQUEST['identi']);
                
            }   
            
            if($_REQUEST['opcion']=='cargarUltimoPropietario'){
                
                $this->cargarUltimoPropietario($conexion);
                
            }
            if($_REQUEST['opcion']=='buscarClientePorId'){
                $this->buscarClientePorId($_REQUEST);
            }
            
            if($_REQUEST['opcion']=='buscarClientePorNombre'){
                $this->buscarClientePorNombre($_REQUEST);
            }
            if($_REQUEST['opcion']=='formuFiltroBusqueda'){
                $this->formuFiltroBusqueda();
            }
            if($_REQUEST['opcion']=='buscarPorFiltros'){
                $this->buscarPorFiltros($_REQUEST);
            }


            
        }
        
        
        
        public function pantallainicialClientes($conexion){
            $clientes = $this->modelo->traerDatosCliente0($conexion);
            $this->vista->pantallaInicialClientesNew($clientes);
    }

    public function verClientes($conexion){
        $clientes = $this->modelo->traerDatosCliente0($conexion);
        $this->vista->verClientes($clientes);
    }
    
    public function nuevoPropietario(){
        
        $this->vista->nuevoPropietario();
        
    }
    
    public function nuevoPropietarioDesdeVehiculo(){
        
        $this->vista->nuevoPropietarioDesdeVehiculo();
        
    }
    
    
    
    public function grabarPropietario($conexion,$request){

        $this->modelo->grabarPropietario($conexion,$request);
        
        $this->vista->propietarioGrabado();
        
    }
    
    
    
    
    
    public function cargarUltimoPropietario($conexion){
        
        $maxId = $this->modelo->traerMaxIdCLiente0($conexion);
        
        funciones::select_general_condicion('cliente0',$conexion,'idcliente','nombre' , $maxId);
        
    }
    
    
    
    public function validarIdenti($conexion,$identi){
        
        $validacion = $this->modelo->validarPropietario($conexion,$identi);
        
        if($validacion >0){
            
            echo '<p class="alerta1">Esta identidad ya existe en la base de datos</p> ';
            
        }
        
    }
    
    
    public function buscarClientePorId($request)
    {
        $infoCLiente = $this->modelo->traerDatosClienteIdNew($request['idCliente']);
        
        //voya a hacerla desde clientes haber
        
        
        $vehiculos = $this->modelCar->traerVehiculosCliente($request['idCliente']);
        
        // echo 'veeeehiculos<pre>';
        //             print_r($vehiculos);
        //             echo '</pre>';
        //             die();
        $this->vista->muestreInfoCliente($infoCLiente,$vehiculos);        
        
    }
    
    function buscarClientePorNombre($request)
    {
        $clientes = $this->modelo->buscarClientePorNombre($request['nombre']);
        $this->vista->verClientes($clientes);
    }
    
    public function formuFiltroBusqueda()
    {
        $this->vista->formuFiltroBusqueda();
        
    }
    
    public function buscarPorFiltros($request)
    {
                    //   echo 'veeeehiculos<pre>';
                    // print_r($request);
                    // echo '</pre>';
                    // die();
        $clientes = $this->modelo->buscarClientePorFiltros($request);
        $this->vista->verClientes($clientes);

    }
    
}



?>