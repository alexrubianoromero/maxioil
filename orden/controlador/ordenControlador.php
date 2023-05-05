<?php 



$raiz = dirname(dirname(dirname(__file__)));

// echo $raiz;

// die();

// require_once($raiz.'/orden/vista/orden_captura_honda_nueva.php');

require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');
require_once($raiz.'/orden/vista/OrdenesVista.php');
require_once($raiz.'/orden/modelo/OrdenesModelo.class.php');
require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');
require_once($raiz.'/tecnicos/modelo/TecnicosModelo.php'); 
require_once($raiz.'/funciones/funciones.class.php'); 
require_once($raiz.'/orden/EnviarCorreoPhpMailer.class.php'); 
require_once($raiz.'/inventario_codigos/modelo/CodigosInventarioModelo.php'); 
require_once($raiz.'/inventario_codigos/modelo/MovimientosInventarioModelo.php'); 



//    echo '<pre>';

//    print_r($datos_placa);

//    echo '</pre>';

//    die();



class ordenControlador 
{
    private $vistaOrden;
    private $modeloOrden;
    private $itemsOrdenModelo;
    private $codigosModelo;
    private $movimientosModelo;
    private $tecnicos;
    private $enviarCorreo;

    public function __construct($conexion)
    {
        session_start();
        // $this->vista = new orden_captura_honda_nueva();
        $this->vistaOrden = new OrdenesVista();
        $this->modeloOrden = new OrdenesModelo();
        $this->itemsOrdenModelo = new itemsOrdenModelo();
        $this->codigosModelo = new CodigosInventarioModelo();
        $this->movimientosModelo = new MovimientosInventarioModelo();
        $this->tecnicos = new TecnicosModelo(); 
        

        if($_REQUEST['opcion']=='ordenes'){
            $this->pantallaConsultas($conexion);
        }

        if($_REQUEST['opcion']=='pintarOrdenes'){
            $this->pintarOrdenes($conexion);
        }
        if($_REQUEST['opcion']=='pintarOrdenesNew'){
            $this->pintarOrdenesNew();
        }

        if($_REQUEST['opcion']=='verificarPlaca'){
            $this->verificarPlaca($conexion,$_REQUEST['placa']);
        }


        if(isset($_REQUEST['id'])){
            $this->mostrarInfoOrden($_REQUEST,$conexion);
        }

        if($_REQUEST['opcion']=='grabarOrden'){
            $this->grabarOrden($conexion,$_REQUEST);
        }

        if($_REQUEST['opcion']=='crearOrden'){
            $this->formuCrearOrden($conexion);
        }
        
        
        
        if($_REQUEST['opcion']=='mostrarFormularioOrden'){
            $this->mostrarFormularioOrden($conexion,$_REQUEST['placa']);
        }
        
        
        
        if($_REQUEST['opcion']=='pregunteNuevoItemOrden'){
            $this->pregunteNuevoItemOrden($_REQUEST['idOrden'],$conexion);
        }
        
        if($_REQUEST['opcion']=='pregunteNuevoItemOrdenNew'){
            $this->pregunteNuevoItemOrdenNew($_REQUEST['idOrden'],$conexion);
        }
        
        if($_REQUEST['opcion']=='grabarNuevoItemOrden'){
            $this->grabarNuevoItemOrden($_REQUEST);
         }
        if($_REQUEST['opcion']=='mostrarItemsOrden'){
             $this->mostrarItemsOrden($_REQUEST);
        }
        if($_REQUEST['opcion']=='verificarSiexisteCodigo'){
            $this->verificarSiexisteCodigo($_REQUEST);
         }
        if($_REQUEST['opcion']=='eliminarItem'){
            $this->eliminarItem($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuFiltrosOrdenes'){
            $this->formuFiltrosOrdenes();
        }
    
        if($_REQUEST['opcion']=='busqueOrdenesConFiltro'){
            $this->busqueOrdenesConFiltro($_REQUEST);
        }
        if($_REQUEST['opcion']=='actualizarOrden'){
            $this->actualizarOrden($_REQUEST);
        }
        if($_REQUEST['opcion']=='formuFiltrosInventarioOrden'){
            $this->formuFiltrosInventarioOrden();
        }
        if($_REQUEST['opcion']=='busqueCodigosConFiltroOrden'){
            $this->busqueCodigosConFiltroOrden($_REQUEST);
        }
        if($_REQUEST['opcion']=='reversarFacturada'){
            $this->reversarFacturada($_REQUEST);
        }
        if($_REQUEST['opcion']=='mostrarImagenesOrden'){
            $this->mostrarImagenesOrden($_REQUEST);
        }
       
    }



    public function mostrarFormularioOrden($conexion,$placa){
        $consultaTecnicos = $this->tecnicos->traerTecnicos($conexion); 
        // $arreglotecnicos = funciones::table_assoc($consultaTecnicos);

        //    echo '<pre>';

        //    print_r($arreglotecnicos);

        //    echo '</pre>';

        //    die();

        $this->vistaOrden->pedirDatosOrden($conexion,$placa,$consultaTecnicos);
    }



    public function  formuCrearOrden(){
        $this->vistaOrden->formuCrearOrden();
    }

    public function verificarPlaca($conexion,$placa){
       $resultado =   $this->modeloOrden->verificarPlaca($conexion,$placa);
       $filas = mysql_num_rows($resultado);
       if($filas==0)
       {
           echo '<h1 style="color:red">Esta placa no existe</h1>';
           //deberia preguntar si desea crear la placa 
           echo '<button class="btn btn-primary" onclick="crearVehiculo();">CREAR VEHICULO</button>';
        }
        else {
            $datos_placa = mysql_fetch_assoc($resultado);
            echo $this->vistaOrden->mostrarFormulario($datos_placa,$conexion);
            // echo  (json_encode($datos_placa));
        }
    }



    public function pantallaConsultas($conexion){
        $arregloOrdenes = $this->modeloOrden->traerOrdenesNew($conexion);
        $this->vistaOrden->pantallaInicial($arregloOrdenes);
    }

    public function mostrarInfoOrden($request,$conexion){
        $arregloOrden = $this->modeloOrden->traerOrdenId($request['id'],$conexion);
        // $items = self::traerItemsOrden($id,$conexion);  
        $resultadoItems = $this->itemsOrdenModelo->traerItemsOrdenId($request['id']);
        // echo '<pre>';
        // print_r($arregloOrden);
        // echo '</pre>';
        // die();
        $this->vistaOrden->mostrarInfoOrden($arregloOrden,$conexion,$resultadoItems,$request);
    }



    // public static function traerItemsOrden($conexion,$id){

    //     // $itemsOrden = $this->itemsOrdenModelo->traerItemsOrdenId($id,$conexion);

    //     $itemsOrden = $this->itemsOrdenModelo->traerItemsOrdenId($id,$conexion);

    //     return $itemsOrden;

    // }



    public function crearOrden(){

        echo 'llego a crear orden';

    }

    public function grabarOrden($conexion,$datos){

        $orden =  $this->modeloOrden->grabarOrden($conexion,$datos);

        $email = $this->modeloOrden->traerEmailCLiente($datos['placa'],$conexion);

        $body = $this->traerBody($datos,$orden,$conexion);

        $this->enviarCorreo = new enviarCorreoPhpMailer($email,$body);

        echo 'La orden '.$orden .' fue creada para la placa '.$datos['placa'];

    }



    public function pintarOrdenes($conexion){

        $arregloOrdenes = $this->modeloOrden->traerOrdenes($conexion);

        $this->vistaOrden->pintarOrdenes($arregloOrdenes);

    }

    public function pintarOrdenesNew(){

        $arregloOrdenes = $this->modeloOrden->traerOrdenesNew();

        $this->vistaOrden->pintarOrdenesNew($arregloOrdenes);

    }

    public function traerBody($datos,$orden,$conexion){
        $datosEmpresa = $this->modeloOrden->traerDatosEmpresa($conexion);
        $body .='

        Hemos creado una orden con la siguiente informacion. <br>

        Placa: '.$datos['placa'].' Orden No : '.$orden.' <br>

        

        TRABAJO A REALIZAR : '.$datos['descripcion'].'<br>

    

        '.$datosEmpresa['razon_social'].' <br>

        <br>

        Taller <br>

        E-mail:      '.$datosEmpresa['email_empresa'].' <br>

        Direccion: '.$datosEmpresa['direccion'];

            

        return $body;

    }



    public function pregunteNuevoItemOrden($id){

        $this->vistaOrden->pregunteNuevoItem($id);
        
    }
    public function pregunteNuevoItemOrdenNew($id){

        $this->vistaOrden->pregunteNuevoItemNew($id);
        
    }
    
    public function grabarNuevoItemOrden($request){
        $this->itemsOrdenModelo->grabarNuevoItem($request);
        $idItem = $this->itemsOrdenModelo->traerIdUltimoItemGrabado();
        $infoItem = $this->itemsOrdenModelo->traerInfoItemConIdItem($idItem);
        $infoCodigo = $this->codigosModelo->getInfoCode($infoItem['codigo'],'');
        $infoOrden = $this->modeloOrden->traerOrdenId($infoItem['no_factura'],''); 
        //si se esta adicionando se debe restar del inventario si existe
        $request['id']= $infoCodigo['id_codigo'];
        $request['tipo'] = 4;
        $request['cantidad'] =  $infoItem['cantidad']; 
        //actualizar inventario  
        $this->codigosModelo->saveMoreLessInvent($request);
        $data['tipo']= 4;
        $data['cantidad'] = $infoItem['cantidad'];
        $data['factura'] = ''; 
        $data['id'] = $infoCodigo['id_codigo'];
        $data['observaciones'] = 'Salida en  orden '.$infoOrden['orden']; 
        //ahora graba el registro del movimiento 
        $this->movimientosModelo->registerMov($data);
        //registrar el movimiento de inclusion en la orden 
        $this->mostrarItemsOrden($request);
    }
    
    public function mostrarItemsOrden($request)
    {
        $resultadoItems = $this->itemsOrdenModelo->traerItemsOrdenId($request['idOrden']);
        $infoOrden = $this->modeloOrden->traerOrdenId($request['idOrden']);
        $this->vistaOrden->mostrarItemsOrden($request['idOrden'],$resultadoItems['datos'],$infoOrden['estado'],$request); 
    }
    public function verificarSiexisteCodigo($request)
    {
           $result =  $this->itemsOrdenModelo->verifiqueCodigo($request['codigo']);
           echo json_encode($result); 
           exit();
    }
    public function eliminarItem($request)
    {
        //traer la informacion del item 
        $infoItem = $this->itemsOrdenModelo->traerInfoItemConIdItem($request['idItem']);
        $infoCodigo = $this->codigosModelo->getInfoCode($infoItem['codigo'],'');
    //     echo '<pre>'; 
    // print_r($infoCodigo);
    // echo '</pre>';
    // die();
        $this->itemsOrdenModelo->eliminarItem($request['idItem']);
        //traer numero de orden 
        $infoOrden = $this->modeloOrden->traerOrdenId($infoItem['no_factura'],''); 
        //si se esta eliminado se debe volver a sumar al inventario si existe
        $request['id']= $infoCodigo['id_codigo'];
        $request['tipo'] = 3;
        $request['cantidad'] =  $infoItem['cantidad']; 
        //aqui actualiza el inventario 
        $this->codigosModelo->saveMoreLessInvent($request);
        //ahora graba el registro del movimiento
        $data['tipo']=3;
        $data['cantidad'] = $infoItem['cantidad'];
        $data['factura'] = ''; 
        $data['id'] = $infoCodigo['id_codigo'];
        $data['observaciones'] = 'Entrada Anulacion Item de orden '.$infoOrden['orden']; 
        //aqui viene el id del idItem
        $this->movimientosModelo->registerMov($data);
        //aqui hay que enviarle el id pero de la orden
        $request['idOrden'] = $infoItem['no_factura'];
        $this->mostrarItemsOrden($request);
    }
    public function formuFiltrosOrdenes()
    {
        $this->vistaOrden->formuFiltrosOrdenes();
    }

    public function busqueOrdenesConFiltro($request)
    {
        $ordenes = $this->modeloOrden->busqueOrdenesConFiltroNew($request);
        $this->vistaOrden->pintarOrdenesNew($ordenes);
    }
    public function actualizarOrden($request)
    {
        
        //    echo '<pre>';
        //    print_r($request);
        //    echo '</pre>';
        //    die();
        $ordenes = $this->modeloOrden->actualizarOrdenId($request);
        //crear el registro de facturada
        // $registro = $this->modeloOrden->crearRegistroFacturada($request);
        
    }
    public function formuFiltrosInventarioOrden()
    {
        $this->vistaOrden->formuFiltrosInventarioOrden();
    }
    
    public function busqueCodigosConFiltroOrden($request)
    {
        $codigos = $this->codigosModelo->getInfoCodeFiltros($request);
        $this->vistaOrden->mostrarCodigosBucadosFiltro($codigos);
    }
    public function reversarFacturada($request)
    {
        $ultimoestadoFactu = $this->modeloOrden->traigaultimoRegistroFacturadaIdOrden($request['idOrden']);
        //comparar las fechas haber sin son del mismo dia 
        $fechapan =  time();
        $fechapan = date ( "Y/m/j" , $fechapan );
        
        // echo '<br>'.$fechapan; 
        // echo '<br>'.$ultimoestadoFactu['fecha'];
        if($fechapan = $ultimoestadoFactu['fecha'])
        {
            echo 'si se puede reversar'; 
            //llamar funcion del modelo y hacer el cambio 
            $this->modeloOrden->realizarReversionFacturadaIdOrden($request['idOrden']);
            $this->modeloOrden->crearRegistroDesfacturadaId($request['idOrden']);
            $this->modeloOrden->eliminarReciboDeCajaReversionFacturaIdOrden($request['idOrden']);
            echo 'Facturacion reversada'; 
        }
        else {
            echo 'no se puede reversar , no es del mismo dia ';
        }
    }
    
    public function  mostrarImagenesOrden($request)
    {
        $imagenes  = $this->modeloOrden->traerImagenesOrdenId($request['idOrden']);
        $this->vistaOrden->pantallaImagenes($request['idOrden'],$imagenes); 
    }

}
?>