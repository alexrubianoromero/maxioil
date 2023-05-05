<?php
$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');

    class CodigosInventarioModelo extends Conexion
    {
        public function __construct(){
         
        }

       public function getInfoCode($codigo,$conexion)
        {
            $sql = "select * from productos where codigo_producto = '".$codigo."'  ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrCodigo = mysql_fetch_assoc($consulta);
            return $arrCodigo;
        }


       public function traerCodigos()
        {
            $sql = "select * from productos order by id_codigo ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrCodigo = $this->get_table_assoc($consulta);
            return $arrCodigo;
        }


        public function traerIdCodeConCode($code)
        {
            $sql ="select id_codigo from productos   where codigo_producto = '".$code."'  ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $arrCodigo = mysql_fetch_assoc($consulta);
            $id_codigo = $arrCodigo['id_codigo']; 
            return $id_codigo; 
        }

        
    public function verifiqueCodigoSiExiste($codigo)
    {
        $conexion = $this->connectMysql();
        $sql = "select * from productos where codigo_producto = '".$codigo."' limit 1 "; 
        $consulta = mysql_query($sql,$conexion);
        $filas = mysql_num_rows($consulta);
        if($filas > 0)
        {
            $arregloCodigo = mysql_fetch_assoc($consulta); 
            $result['filas'] = $filas;
            $result['data'] = $arregloCodigo;
        }else{
            $result['filas'] = 0;
            $result['data'] = '';
        }  
        return $result;
    }


        public function mostrarCodigosInventarios(){
            $conexion = $this->connectMysql();
            $sql = "select * from productos order by id_codigo asc ";
            $consulta = mysql_query($sql,$conexion);
            return $consulta; 
        } 
        
        public function getInfoCodeById($id)
        {
            $sql = "select * from productos where id_codigo = '".$id."'   ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $infoCode = mysql_fetch_assoc($consulta);
            return $infoCode; 
            
        }
        public function traerInfoCodeJson($id)
        {
            $sql = "select * from productos where id_codigo = '".$id."'   ";
            $consulta = mysql_query($sql,$this->connectMysql());
            $infoCode = mysql_fetch_assoc($consulta);
            
            echo json_encode($infoCode);            
        }
        public function getInfoCodeFiltros($request)
        {
            $conexion = $this->connectMysql();
            $sql = "select * from productos where 1=1 ";
            if($request['referencia'] != '' )
            {
               $sql .= "  and referencia like '%".$request['referencia']."%'   ";
            }
            
            if($request['descripcion'] != '' )
            {
               $sql .= "  and descripcion like '%".$request['descripcion']."%'   ";
            }
            // die($sql); 
            $consulta = mysql_query($sql,$conexion);
            return $consulta; 
        }


        public function saveCode($request){
            $conexion = $this->connectMysql();
            $sql = "insert into productos (codigo_producto,descripcion,cantidad,cantidad_inicial,
                    precio_compra,valorventa,valor_unit,repman,referencia,producto_minimo,alerta)   
            values ('".$request['codigo']."'
            ,'".$request['descripcion']."'
            ,'".$request['cantidad']."'
            ,'".$request['cantidad']."'
            ,'".$request['precioCompra']."'
            ,'".$request['precioVenta']."'
            ,'".$request['precioCompra']."'
            ,'".$request['tipoCod']."'
            ,'".$request['referencia']."'
            ,'".$request['cantidadMinima']."'
            ,'".$request['alerta']."'
            
            )";
            // die($sql); 
            $consulta = mysql_query($sql,$conexion);
            echo 'Codigo Grabado'; 
        }

        public function saveMoreLessInvent($request)
        {
        //             echo '<pre>'; 
        // print_r($request);
        // echo '</pre>';
        //     die('buenas ');
            //En el request deben llegar tres parametros 
            //id  el id del codigo 
            //tipo  es la razon de la entrada o el descuento si es por aplicar el codigo a una orden o por venta o por simple cuadre
            //cantidad la cantidad que se va a 
            //1 y 3 son entradas y suma al inventario 
            //1 es entrada de inventario realizada desde el modulo de inventario osea suma al inventario
            //3 es es la eliminacion del un item del inventario osea se suma al inventario porque vuelve 
            //2 y 4 son salidas y resta al inventario 
            //2 es una salida de inventario desde el modulo de inventarios osea resta del inventario
            //4 es un item agregado a una orden osea resta del inventario
            //6 es una venta de mostrador

            $infoCode = $this->getInfoCodeById($request['id']);
            $conexion = $this->connectMysql();
            $infoActual = $this->getInfoCodeById($request['id']);
            if($request['tipo']==1 || $request['tipo']==3 ) //lo que suma al inventario
            {
                $saldo = $infoActual['cantidad'] +  $request['cantidad'];
            }
            if($request['tipo']==2 || $request['tipo']==4 || $request['tipo']==6  ) //lo que resta al inventario 
            {
                $saldo = $infoActual['cantidad'] -  $request['cantidad'];
            }

            $sql = "update productos set cantidad = '".$saldo ."' 
            where id_codigo = '".$request['id']."'   "; 
            //   die($sql);
    
            $consulta = mysql_query($sql,$conexion);   

            // echo 'Saldo actualizado !!!!'; 
        }

        function codigosConAlertaInventario()
        {
            //traer todos los codigos y mas bien los controlo desde la vista 
            $sql = "select * 
            from productos 
            where 1=1 
            and alerta = 'SI'";
            $consulta = mysql_query($sql,$this->connectMysql()); 
            $codigosAlerta = $this->get_table_assoc($consulta); 
            // echo 'desde el modelo<pre>'; 
            // print_r($sql);
            // echo '</pre>';
            // die();
            return $codigosAlerta;
        }

        public function actualizarCodigo($request)
        {
                $sql = "
                update productos set 
                descripcion = '".$request['descripcion']."'
                ,precio_compra = '".$request['precioCompra']."'
                ,valor_unit = '".$request['precioCompra']."'
                ,valorventa = '".$request['precioVenta']."'
                ,repman = '".$request['tipoCod']."'
                ,referencia = '".$request['referencia']."'
                ,producto_minimo = '".$request['cantidadMinima']."'
                ,alerta = '".$request['alerta']."'
                where id_codigo = '".$request['idCodigo']."'
                ";
                $consulta = mysql_query($sql,$this->connectMysql()); 
                // die($sql);
                
                echo 'Producto Actualizado';
                
            }
            
            public function eliminarCodigo($idCodigo)
            {
                $sql = "delete from productos where id_codigo = '".$idCodigo."'  "; 
                $consulta = mysql_query($sql,$this->connectMysql()); 
                echo 'Producto Eliminado';

        }

    }




?>