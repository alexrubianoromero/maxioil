<?php

$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/conexion/Conexion.php');

class VentasTemporalModel extends Conexion
{

    public function __construct(){

    }
 
    public function crearVentaTemporal()
    {
        $sql ="insert into ventas_temporal (fecha) values(now() )";
        // die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $ultimoId = $this->traerUltimoIdTemporal(); 
        return $ultimoId; 
    }
    
    public function traerUltimoIdTemporal()
    {
        $sql = "select max(id) as id from  ventas_temporal "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        $ultimo = mysql_fetch_assoc($consulta); 
        return $ultimo['id'];
        
    }
    public function grabarItemsVentaTemporal($request)
    {
        $sql ="insert into ventas_temporal_items  
        (no_factura, codigo ,descripcion
        ,valor_unitario,cantidad,total_item,idCode)
        values ('".$request['idTemp']."','".$request['codigo']."','".$request['descripcion']."'
        ,'".$request['valorUnit']."','".$request['cantidad']."' ,'".$request['total']."','".$request['idCodigo']."' )
        "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        
    }
    public function traerItemsVentaTemporal($idTemp)
    {
        $sql = "select * from ventas_temporal_items where no_factura = '".$idTemp."'  "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        $arreglo = $this->get_table_assoc($consulta);
        return $arreglo; 
    }

}    



?>