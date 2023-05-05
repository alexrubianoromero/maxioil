<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/conexion/Conexion.php');

class EmpresaModel extends Conexion
{
    
    public function __construct()
    {

    } 

    public function traerInfoEmpresa()
    {
        $sql ="select * from empresa ";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $arreglo = mysql_fetch_assoc($consulta);
        // echo '<pre>'; 
        // print_r($arreglo); 
        // echo '</pre>';
        // die(); 
        return $arreglo;   
    } 
}

?>