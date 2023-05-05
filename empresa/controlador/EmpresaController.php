<?php

class EmpresaController{

    public function __construct(){

    }
        
    
    public function traerInfoEmpresa($conexion){
        $sql = "select * from empresa ";
        $consulta = mysql_query($sql,$conexion);
        $arreglo = mysql_fetch_assoc($consulta);
        return $arreglo;  
    }
    public function pruebaEmpresa(){

        echo 'llego aca ';
    }
}

?>