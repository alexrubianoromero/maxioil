<?php 
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/vehiculos/modelo/VehiculosModelo.php');
require_once($raiz.'/orden/vista/orden_captura_honda_nueva.php');
require_once($raiz.'/orden/vista/ConsultaOrdenesVista.php');
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');
require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');
require_once($raiz.'/tecnicos/modelo/TecnicosModelo.php'); 
//    echo '<pre>';
//    print_r($datos_placa);
//    echo '</pre>';
//    die();

class ordenControlador {
    private $modelo; 
    private $vista;
    private $vistaConsuOrden;
    private $modeloOrdenes;
    private $itemsOrdenModelo;
    private $tecnicos;

    public function __construct($conexion)
    {
        $this->modelo = new VehiculosModelo();
        $this->vista = new orden_captura_honda_nueva();
        $this->vistaConsuOrden = new ConsultaOrdenesVista();
        $this->modeloOrdenes = new OrdenesModelo();
        $this->itemsOrdenModelo = new itemsOrdenModelo();
      

        
        if($_REQUEST['opcion']=='ordenes'){
            $this->pantallaConsultas($conexion);
        }
        if($_REQUEST['opcion']=='consultar'){
            $this->pantallaConsultas($conexion);
        }
     
        if($_REQUEST['opcion']=='verificarPlaca'){
            $this->verificarPlaca($conexion,$_REQUEST['placa']);
        }

        if(isset($_REQUEST['id'])){
            $controlador->mostrarInfoOrden($_REQUEST['id'],$conexion);
        }
        if($_REQUEST['opcion']=='grabarOrden'){
            $this->grabarOrden($this->conexion);
        }

    }

    public function verificarPlaca($conexion,$placa){
       $resultado =   $this->modelo->verificarPlaca($conexion,$placa);
       $filas = mysql_num_rows($resultado);
       if($filas==0)
       {
           echo '<h1 style="color:red">Esta placa no existe</h1>';
           //deberia preguntar si desea crear la placa 
           echo '<button class="btn btn-primary" onclick="crearVehiculo();">CREAR VEHICULO</button>';
        }
        else {
            $datos_placa = mysql_fetch_assoc($resultado);
            echo $this->vista->mostrarFormulario($datos_placa,$conexion);
            // echo  (json_encode($datos_placa));
        }
    }

    
    public function pantallaConsultas($conexion){
        $arregloOrdenes = $this->modeloOrdenes->traerOrdenes($conexion);
        $this->vistaConsuOrden->pantallaInicial($arregloOrdenes);
    }
    
    public function mostrarInfoOrden($id,$conexion){
        $arregloOrden = $this->modeloOrdenes->traerOrdenId($id,$conexion);
        // echo '<pre>';
        // print_r($arregloOrden);
        // echo '</pre>';
        // die();
        $this->vistaConsuOrden->mostrarInfoOrden($arregloOrden,$conexion);
    
    }

    public static function traerItemsOrden($conexion,$id){
        $itemsOrden = $this->itemsOrdenModelo->traerItemsOrdenId($id,$conexion);

    }

    public function crearPlaca(){
        //aqui llega cuando la palca no esta creada 

    }

    public function grabarOrden(){

    }
}



?>