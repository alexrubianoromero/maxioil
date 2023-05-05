<?php
require_once($raiz.'/inventario_codigos/vista/inventarioMovimientosVista.php');
require_once($raiz.'/inventario_codigos/modelo/MovimientosInventarioModelo.php');
class  MovimientosInventarioController 
{
    private $vistaMov; 
    private $modelo;

    public function __construct()
    {
        $this->vistaMov = new inventariosMovimientoVista();
        $this->modelo = new MovimientosInventarioModelo();
        if(!isset($_REQUEST['opcion'])){
            // $this->saludo();
        }
        // if($_REQUEST['opcion'] == 'vistaPrincipalInventarios'){
        //     $this->registerMov($data);
        // } 
        // if($_REQUEST['opcion'] == 'verMovimientosCodigo'){
        //     $this->showMovCode($_REQUEST);
        // } 
    }
    // public function saludo()
    // {
    //     echo 'buenas desde MovimientosInventarioController'; 
    // }
    public function registerMov($data)
    {
        $this->modelo->registerMov($data,'1');
        
    }
    // public function showMovCode($request)
    // {
    //     $movimientos = $this->modelo->searchMovCode($request['idCodigo']);
    //     $this->vistaMov->showMovCode($movimientos);
    // }


}

?>