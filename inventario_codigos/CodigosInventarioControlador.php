<?php
$raiz = dirname(dirname(dirname(__file__)));

// require_once($raiz.'/inventario_codigos/vista/inventarioCodigosVista.php');

class CodigosInventarioControlador{
    private $vista; 


    public function __construct(){

        echo '<pre>'; 
        print_r($_REQUEST);
        echo '</pre>';
        die(); 
        // $this->vista =  new inventarioCodigosVista();
        //     if(isset($_REQUEST['option']) &&  $_REQUEST['option'] == 'vistaPrincipalInventarios'){
        //         $this->showVistaPrincipal();
        //     } 
    }
    public function showVistaPrincipal(){
            $this->vista->inventariosMainVista();
    } 
}



?>