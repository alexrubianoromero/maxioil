<?php

$raiz = dirname(dirname(dirname(__file__)));

// echo $raiz;

// die();

require_once($raiz.'/vehiculos/vista/VehiculoVista.php');

require_once($raiz.'/vehiculos/modelo/VehiculosModelo.php');

require_once($raiz.'/clientes/modelo/ClientesModelo.class.php');

// require_once('../funciones.class.php');

class vehiculoControlador{

    private $vehiculoVista;

    private $vehiculoModelo;

    private $clientesModelo; 

    

    public function __construct($conexion)

    {

        $this->vehiculoVista = new VehiculoVista();

        $this->vehiculoModelo = new VehiculosModelo();

        $this->clientesModelo = new ClientesModelo();



        

        if(!isset($_REQUEST['opcion']) ){

          $this->pantallainicialVehiculos($conexion);

        }

        if($_REQUEST['opcion']=='muestreVehiculos' ){
            $this->muestreVehiculos($conexion);
          }
          
        if($_REQUEST['opcion']=='muestreVehiculosPlaca' ){
            $this->muestreVehiculosPlaca($_REQUEST);
          }

          

        if($_REQUEST['opcion']=='nuevo'){

            $this->vehiculoVista->nuevaPlaca();

        }

        if($_REQUEST['opcion']=='buscarPlaca'){

            $this->buscarPlaca($conexion,$_REQUEST['placa']);

        } 

        if($_REQUEST['opcion']=='buscarPlacaDesdeOrden'){

            $this->buscarPlacaDesdeOrden($conexion,$_REQUEST['placa']);

        } 

        if($_REQUEST['opcion']=='grabarVehiculo1'){

            $this->grabarVehiculo($conexion,$_REQUEST);

        }

        if($_REQUEST['opcion']=='verificarPlacaRespuestaJson'){

            $this->verificarPlacaRespuestaJson($conexion,$_REQUEST['placa']);

        }
        if($_REQUEST['opcion']=='mostrarHistorialVehiculo'){
            $this->mostrarHistorialVehiculo($_REQUEST);
        }

    

    }



    public function verificarPlacaRespuestaJson($conexion,$placa){

        $filas = $this->vehiculoModelo->verificarPlacaRespuestaJson($conexion,$placa);
        // $respu['filas']= $filas;
        echo json_encode($filas);
    }

    public function pantallainicialVehiculos($conexion){

        $datosVehiculos = $this->vehiculoModelo->traerVehiculos($conexion);

        $this->vehiculoVista->pantallainicialVehiculos($datosVehiculos);         

    }

    

    public function muestreVehiculos($conexion){

            $datosVehiculos = $this->vehiculoModelo->traerVehiculos($conexion);

            //   echo '<pre>';

            //   print_r($datosVehiculos);

            //   echo '</pre>';

            //   die();

            // echo 'asdasdas';

            $this->vehiculoVista->verVehiculos($datosVehiculos);

    }



    public function buscarPlaca($conexion,$placa){

        $datosPlaca = $this->vehiculoModelo->buscarPlaca($conexion,$placa);

        if($datosPlaca['filas']>0){

            $datosCliente0 = $this->clientesModelo->buscarCliente0Id($conexion,$datosPlaca['datos'][0]['propietario']);

            $this->vehiculoVista->mostrarDatosPlaca($datosPlaca['datos'],$datosCliente0['datos']);

        }

        else{

            $propietarios = $this->clientesModelo->traerDatosCliente0($conexion);

            $propietarios = $propietarios['datos'];

            $this->vehiculoVista->preguntarDatosPlaca($placa,$propietarios);

        }

    }

    public function buscarPlacaDesdeOrden($conexion,$placa){

        $datosPlaca = $this->vehiculoModelo->buscarPlaca($conexion,$placa);

        if($datosPlaca['filas']>0){

            $datosCliente0 = $this->clientesModelo->buscarCliente0Id($conexion,$datosPlaca['datos'][0]['propietario']);

            $this->vehiculoVista->mostrarDatosPlaca($datosPlaca['datos'],$datosCliente0['datos']);

        }

        else{

            $propietarios = $this->clientesModelo->traerDatosCliente0($conexion);

            $propietarios = $propietarios['datos'];

            $this->vehiculoVista->preguntarDatosPlacaDesdeOrden($placa,$propietarios);

        }

    }



    // public function grabarPeritaje($conexion,$request){

    //     $this->modelo->grabarPeritaje($conexion,$request);

    //     $this->pantallaInicial($conexion);

    // }


    public function grabarVehiculo($conexion,$request){
        $idNuevoCarro = $this->vehiculoModelo->grabarVehiculo($conexion,$request);
        $this->buscarPlaca($conexion,$request['placa']);
    }

    public function mostrarHistorialVehiculo($request)
    {
        $historiales = $this->vehiculoModelo->buscarHistoriales($request['placa']);

        $this->vehiculoVista->mostrarHistorialvehiculo($historiales);
        

    }

    public function muestreVehiculosPlaca($request)
    {
        $datosVehiculos = $this->vehiculoModelo->traerVehiculosPlaca($request['placa']);
        $this->vehiculoVista->verVehiculos($datosVehiculos);
    }
}



?>