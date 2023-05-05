<?php

$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');

class ConceptoModel extends Conexion
{
    protected $conexion; 

    public function __construct()
    {
        $this->conexion = $this->connectMysql();
    }

    public function grabarConcepto($request)
    {
        $sql = "insert into conceptos (concepto) values ('".$request['concepto']."')";    
        $consulta = mysql_query($sql,$this->conexion);
    }
            
    public function traerConceptos()
    {
        $sql ="select * from conceptos order by idConcepto desc"; 
        $consulta = mysql_query($sql,$this->conexion);
        $conceptos = $this->get_table_assoc($consulta);
        return $conceptos;  
    }
    
    public function traerConceptoConId($id)
    {
        $sql = "select concepto from conceptos where idConcepto = '".$id."'  "; 
        $consulta = mysql_query($sql,$this->conexion);
        $arr = mysql_fetch_assoc($consulta);
        return $arr['concepto'];  
    }
}


?>