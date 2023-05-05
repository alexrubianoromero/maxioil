<?php

$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');

class UsuarioModel extends Conexion
{
    public function verificarCredenciales($request)
    {
        $conexion = $this->connectMysql();
        $sql = "select u.id_usuario,u.login,u.clave,u.nombre,u.id_perfil,p.nombre_perfil,p.nivel from usuarios u 
        inner join perfiles p on (p.id_perfil =  u.id_perfil )
        where login = '".$request['user']."'   "; 
        $consulta = mysql_query($sql,$conexion);
        $filas = mysql_num_rows($consulta);
        
        // die('<br>'.$sql.'<br>'.$filas);
        $datosUser  =[];
        if($filas>0)
        {
            $datosUser = mysql_fetch_assoc($consulta);  
            if($datosUser['clave']==$request['clave']  )
            {
                $valida = 1; 
            }
            else {
                $valida = 0;
            }
        }else{
            $valida = 0; 
        } 
        $respu = [];
        $respu['valida'] = $valida;
        $respu['datos'] = $datosUser;
        
        return $respu;  
    } 
    public function verificarClaveActual($request)
    {
        $sql="select * from usuarios where id_usuario = '".$request['idUsuario']."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $datosUser = mysql_fetch_assoc($consulta);
        return $datosUser;  
    }
    public function actualizarClave($request)
    {
        $sql = "update usuarios set
        clave = '".$request['claveNueva']."'
        where id_usuario = '".$request['idUsuario']."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }
}

?>