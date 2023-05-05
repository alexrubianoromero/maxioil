<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/tecnicos/modelo/TecnicosModelo.php');
require_once($raiz.'/tecnicos/vista/TecnicosVista.php');



class TecnicosController
{

    private $tecnicos;
    // private $vista; 
    private $vista;

    public function __construct(){

        echo 'llego al controlador'; 
        $this->tecnicos = new TecnicosModelo();
        $this->vista = new TecnicosVista();
        if(!isset($_REQUEST)){
            $this->pantallaPrincipalTecnicos(); 
        }
    }

    public function traerTecnicos($conexion){
       $arregloTecnicos = $this->tecnicos->traerTecnicos($conexion);
        if(mysql_num_rows($arregloTecnicos)>0);
        {
            echo json_encode();
                // $this->vista->mostrarTecnicos($arregloTecnicos);
        }
    //    return $arregloTecnicos; 
    }

    public function pantallaPrincipalTecnicos()
    {
        $tecnicos = $this->tecnicos->traerTecnicosNew();
        $this->vista->pantallaprincipalTecnicos($tecnicos); 
    }

}





?>