<?php

$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');



class ReciboCajaModelo extends Conexion
{
    protected $conexion;

    public function __construct()
    {
        $this->conexion = $this->connectMysql();
    }

    public function grabarRecibo($request)
    {
        // echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        if($request['idOrden']==''){ $request['idOrden']=0;}
        if($request['idVenta']==''){ $request['idVenta']=0;}

        $sql = "insert into recibos_de_caja  (dequienoaquin,lasumade,porconceptode,observaciones,
        fecha_recibo,tipo_recibo,idTecnico,idConcepto,efectivo,t_debito,t_credito,id_orden,bancolombia,bolt,id_venta)   
                values('".$request['txtAquien']."'
                    ,'".$request['txtValor']."'
                    ,'".$request['txtConcepto']."'
                    ,'".$request['txtObservacion']."'
                    ,now()
                    ,'".$request['tipo']."'
                    ,'".$request['idTecnico']."'
                    ,'".$request['txtConcepto']."'
                    ,'".$request['txtEfectivo']."'
                    ,'".$request['txtDebito']."'
                    ,'".$request['txtCredito']."'
                    ,'".$request['idOrden']."'
                    ,'".$request['txtBancolombia']."'
                    ,'".$request['bolt']."'
                    ,'".$request['idVenta']."'
                ) ";
         $consulta = mysql_query($sql,$this->conexion );    
         echo 'Registro grabado<br>';    
         $this->afectarSaldo($request);
    }

    public function  afectarSaldo($request)
    {
        $saldoActual = $this->traerSaldoActual();
        if($request['tipo']==1)
        {
            $nuevoSaldo = $saldoActual + $request['txtValor'];
        }else{
            $nuevoSaldo = $saldoActual - $request['txtValor'];
        }
        $sql = "update empresa set saldocajamenor = '".$nuevoSaldo."'  "; 
        $consulta = mysql_query($sql,$this->conexion ); 
        echo '<br>saldo actualizado';
    }

    public function traerSaldoActual()
    {
        $sql= "select saldocajamenor from empresa ";
        $consulta = mysql_query($sql,$this->conexion );
        $arrSaldo = mysql_fetch_assoc($consulta);
        $saldo = $arrSaldo['saldocajamenor'];
        return $saldo; 
    }

    public function informeCaja($request)
    {
        $fechapan =  time();
        $fechapan =  date ( "Y/m/j" , $fechapan );

        $sql = "select * from recibos_de_caja where 1=1   ";

        if(isset($request['tipoInforme']) && $request['tipoInforme']=='1' )
        {
            $sql .= "  and  fecha_recibo =  '".$fechapan."'  " ;  
            
        }
        $sql .= " order by tipo_recibo  ASC";
        //  die($sql); 
        $consulta = mysql_query($sql,$this->conexion);
        $recibos = $this->get_table_assoc($consulta);
        // foreach($recibos as $recibo )
        // {
            //     echo 'model<br>'.$recibo['id_recibo'];
            // }
            // die();
            return $recibos;
        }
        
        public function traerLosRecibosDelDia()
        {
            $fechapan =  time();
            $fechapan =  date ( "Y/m/j" , $fechapan );
            $sql = "select * from recibos_de_caja where  fecha_recibo =   '".$fechapan."' order by idTecnico ";
            $consulta = mysql_query($sql,$this->conexion);
            $arreglo = $this->get_table_assoc($consulta); 
            return $arreglo;
        }
        
        public function traerIdTecnicosRecibosDiaQueTenganIdTecnico()
        {
            $fechapan =  time();
            $fechapan =  date ( "Y/m/j" , $fechapan );
            $sql = "select distinct(idTecnico) from recibos_de_caja 
                    where  fecha_recibo =   '".$fechapan."' 
                    and idTecnico > 0 
                    group by idTecnico ";
            // die($sql); 
            $consulta = mysql_query($sql,$this->conexion);
            $arreglo = $this->get_table_assoc($consulta); 
            return $arreglo;
        }
        
        public function traerRecibosDiaPorIdTecnico($idTecnico)
        {
            //solo recibos que no sean de ordenes de servicio osea id_orden = 0
            $fechapan =  time();
            $fechapan =  date ( "Y/m/j" , $fechapan );
            $sql = "select * from  recibos_de_caja 
                    where  idTecnico =   '".$idTecnico."'
                    and fecha_recibo = '".$fechapan."' 
                    and id_orden = 0 ";
            // die($sql); 
            $consulta = mysql_query($sql,$this->conexion);
            $arreglo = $this->get_table_assoc($consulta); 
            return $arreglo;
        }
        public function traerIdordenRecibosPorOrdenesDeServicioDiario()
        {
            //solo recibos que no sean de ordenes de servicio osea id_orden = 0
            $fechapan =  time();
            $fechapan =  date ( "Y/m/j" , $fechapan );
            $sql = "select distinct(id_orden) from  recibos_de_caja 
                    where  id_orden > 0
                    and fecha_recibo = '".$fechapan."' 
                    and idTecnico =  0 
                    group by id_orden";
            //  die($sql); 
            $consulta = mysql_query($sql,$this->conexion);
            $arreglo = $this->get_table_assoc($consulta); 
            return $arreglo;
        }
        public function traerReciboPorIdOrden($idOrden)
        {
            //solo recibos que no sean de ordenes de servicio osea id_orden = 0
            $fechapan =  time();
            $fechapan =  date ( "Y/m/j" , $fechapan );
            $sql = "select * from  recibos_de_caja 
                    where  id_orden = '".$idOrden."'
                    and fecha_recibo = '".$fechapan."' 
                    and idTecnico =  0 
                    ";
            //  die($sql); 
            $consulta = mysql_query($sql,$this->conexion);
            $arreglo = mysql_fetch_assoc($consulta); 
            return $arreglo;
        }



}



?>