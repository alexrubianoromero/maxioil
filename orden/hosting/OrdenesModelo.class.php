<?php
Class OrdenesModelo{
  

    public function __construct(){
    }

    public function verificarPlaca($tabla4,$conexion){
            $sql_verificar_placa = "select * from ".$tabla4." where placa = '"
            .$_REQUEST['placa']."' ";
            $consulta_placa = mysql_query($sql_verificar_placa,$conexion);
            return $consulta_placa;
   }
//    public function consultarPropietario(){

//    }

}
?>