<?php
    $raiz = dirname(dirname(dirname(__file__)));
    require_once($raiz.'/conexion/Conexion.php');

    class MovimientosInventarioModelo extends Conexion
    {
        public function __construct(){
         
        }

      
        public function registerMovInicial($data,$id_codigo)
        {
            // echo '<pre>'; 
            // print_r($data); 
            // echo '</pre>';
            // die();
                $observaciones = 'Registro Inicial'; 
                $sql = "insert into movimientos_inventario 
                (fecha_movimiento,cantidad,tipo_movimiento,id_codigo_producto,observaciones)
                values( 
                now()
                , '".$data['cantidad']."'
                ,'0'
                ,'".$id_codigo."'
                ,'".$observaciones."'
                ) "; 
                $consulta = mysql_query($sql,$this->connectMysql());  
                echo '<br>Movimiento grabado';        
        }


        public function registerMov($data)
        {
            $conexion = $this->connectMysql();
            
            if($data['tipo']==6)
            { 
                $obseTipo= '';
                $campo = 'id_factura_venta';
            }        

            if($data['tipo']==4)
            { 
                $obseTipo= '';
                $campo = 'facturacompra';
            }        
            if($data['tipo']==3)
            { 
                $obseTipo= '';
                $campo = 'facturacompra';
            }        
            
            if($data['tipo']==1)
            { 
                $obseTipo= 'Entrada Inventario';
                $campo = 'facturacompra';}
                
                if($data['tipo']==2){ 
                    $obseTipo = 'Salida  Inventario';
                    $campo = 'id_factura_venta';
                }
                
                $observaciones = $obseTipo.': '.$data['observaciones'];
                
                
                $sql = "insert into movimientos_inventario 
                (fecha_movimiento,cantidad,tipo_movimiento,".$campo.",id_codigo_producto,observaciones)
                values( now(), '".$data['cantidad']."','".$data['tipo']."'
                ,'".$data['factura']."'
                ,'".$data['id']."'
                ,'".$observaciones."'
                ) "; 
                //  die($sql); 
                $consulta = mysql_query($sql,$conexion);  
                // echo '<br>Movimiento grabado';        
        }
        public function searchMovCode($idCode)
        {
            $conexion = $this->connectMysql();
            $sql = "select * from movimientos_inventario where id_codigo_producto = '".$idCode."'  order by fecha_movimiento asc ";
            $consulta = mysql_query($sql,$conexion);
            return $consulta;
        }


    }


?>