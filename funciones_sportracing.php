<?php
/////traer el nombre de alguien de tabla cliernte 0
 function traer_nombre($tabla,$id_cliente,$conexion){
      $sql_cliente= "select * from $tabla where idcliente = '".$id_cliente."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $nombre = $arr_cliente['nombre'];
      return  $nombre;
  }

 //traer la identidad 
 function traer_identi($tabla,$id_cliente,$conexion){
      $sql_cliente= "select * from $tabla where idcliente = '".$id_cliente."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $identi = $arr_cliente['identi'];
      return  $identi;
  }

////////////////////traer el idcliente con la cedula
 function traer_idcliente($tabla,$identidad,$conexion){
      $sql_cliente= "select * from $tabla where identi = '".$identidad."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $identi = $arr_cliente['idcliente'];
      return  $identi;
  }
/////////////////////////////////


/////traer el nombre de las tarifas 
  function nombre_tarifa($tabla,$id_tarifa,$conexion){
      $sql_datos_tarifa = "select * from $tabla where id_producto =  '".$id_tarifa."'  ";
       $con_tarifa = mysql_query($sql_datos_tarifa,$conexion);
      $arr_tarifa = mysql_fetch_assoc($con_tarifa);
      $nombre = $arr_tarifa['nombre'];
      return  $nombre;
  }
function select_listar_personas($rol,$tabla,$conexion){
	$sql_personas = "select * from $tabla where rol = '".$rol."'  ";
	//echo '<br>'.$sql_personas;
	$con_personas = mysql_query($sql_personas,$conexion);
	echo '<option value="" >...</option>';
	while($personas = mysql_fetch_assoc($con_personas))
	{
		echo '<option value="'.$personas['idcliente'].'" >'.$personas['nombre'].'</option>';
	}
}
//////////////////////////////////////////////////////////////

function select_listar_estados_reserva($tabla,$conexion){
	$sql_estados = "select * from $tabla   ";
	//echo '<br>'.$sql_personas;
	$con_estados = mysql_query($sql_estados,$conexion);
	echo '<option value="" >...</option>';
	while($estados = mysql_fetch_assoc($con_estados))
	{
		echo '<option value="'.$estados['id_estado'].'" >'.$estados['nombre'].'</option>';
	}
}



///traer el estado de la reserva 
  function traer_estado($tabla,$id_estado,$conexion){
      $sql_cliente= "select * from $tabla where id_estado = '".$id_estado."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $nombre = $arr_cliente['nombre'];
      return  $nombre;
  }
//////////////////////traer el saldo de una reserva
    function traer_algo_reserva($tabla,$id_reserva,$campo,$conexion){
      $sql_reserva= "select * from $tabla where id_reserva = '".$id_reserva."'  ";
      //echo '<br>'.$sql_reserva;
      $con_reserva = mysql_query($sql_reserva,$conexion);
      $arr_reserva = mysql_fetch_assoc($con_reserva);
      $resultado = $arr_reserva[$campo];
      return  $resultado;
  }


///////////////////////////////////
function colocar_select_general($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla   ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}
///////////////////////////////////////
function colocar_select_general_condicion($tabla,$conexion,$campo1,$campo2,$campo_comparacion){
  $sql_general = "select * from $tabla    ";
  if($campo_comparacion=='adulto'){
       $campo2= 'adulto';
  }
  else //entonces es nino
  {
       $campo2= 'nino';
  }
  //echo '<br>'.$sql_personas;
  $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
    echo '<option value="'.$general[$campo2].'" >'.$general [$campo1].'-'.$general [$campo2].'</option>';
  }
}
////////////////////////////////////////////////
//////////////para traer un select y dejar una opcion seleccionada de cuerdo a la condicion
function colocar_select_general_condicion_mejorada($tabla,$conexion,$campo1,$campo2,$condicion){
  $sql_general = "select * from $tabla    ";
  
 $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
      if($general[$campo1] == $condicion){
           echo '<option value="'.$general[$campo1].'" selected >'.$general [$campo2].'</option>';
      }
      else 
      {
          echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
      }
     }//fin del while
    } //fin ed la funcion   



////////////////////////////////////////////////
////traer nombre de usuario
 function traer_nombre_usuario($tabla,$id_cliente,$conexion){
      $sql_cliente= "select * from $tabla where id_usuario = '".$id_cliente."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $nombre = $arr_cliente['nombre'];
      return  $nombre;
  }
function traer_numero_reserva($tabla,$id_reserva,$conexion){
      $sql_cliente= "select * from $tabla where id_reserva = '".$id_reserva."'  ";
      //echo '<br>'.$sql_cliente;
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $numero = $arr_cliente['no_reserva'];
      return  $numero;
  }
////con esta funcion se puede traer un valor de la tabla empresa 
function traer_numero_actual($tabla,$campo,$conexion){
      $sql_numero_actual= "select * from $tabla   ";
      //echo '<br>'.$sql_numero_actual;
      $con_numero_actual  = mysql_query($sql_numero_actual,$conexion);
      $arr_actual = mysql_fetch_assoc($con_numero_actual);
      $numero = $arr_actual[$campo];
      return  $numero;
  }

/////////////////////////////////  es para hacer una consulta de un valor unico
//  y devolver un arreglo assoc con la informacion respectiva 
  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

//////////////////////////////proveedores 
//////////////////////////////////////////
////funcion para sumar el campo de una tabla de acuerdo a una condicion
//$campo = el valor a sumar 
//$campo2 = el campo a evaluar
//$condicional == el valor que debe ser
function sumar_valores($tabla,$campo,$campo2,$condicional,$conexion)
  {
        $sql = "select sum($campo) as suma from $tabla where $campo2  = ".$condicional." ";
        //echo '<br>'.$sql;
        $con = mysql_query($sql,$conexion);
        $arreglo_suma = mysql_fetch_assoc($con);
        $suma = $arreglo_suma['suma'];
        return  $suma;
  }
//////////////////////////////////////
//////////////FUNCIONES PARA INFORMES 

 
  
?>