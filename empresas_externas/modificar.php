<?php
session_start();
include('../valotablapc.php');



function  consulta_assoc_hot($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$arr_hotel = consulta_assoc_hot($hoteles,'id_hotel',$_REQUEST['id_hotel'],$conexion)

?>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<?php

echo '<div id="div_123_modificar"';
echo '<br><br>';
echo '<table border = "1" >';
echo '<tr>';
echo '<td> <input type="hidden" id="id_hotel" value="'.$_REQUEST['id_hotel'].'" ></td><td></td>';
echo '</tr>';

echo '<tr>';
echo '<td>NOMBRE</td><td> <input type="text" id="nombre" value="'.$_REQUEST['nombre'].'" class="fila_llenar" ></td>';
echo '</tr>';


echo '<tr>';
echo '<td>DESTINO</td>';
echo '<td><select id="id_destino">';
colocar_select_general_condicion_mejorada_dest($destinos,$conexion,'id_destino','nombre',$arr_hotel['id_destino']);
echo '</select></td>';
echo '<tr>';






echo '<tr>';
echo '<td><button id="btn_grabar_modificar" >MODIFICAR</button></td>';

echo '<tr>';
echo '</table>';


/*
$sql_modificar = "update $destinos 
set nombre = '".$_REQUEST['nombre']."' 
 where id_destino = '".$_REQUEST['id_destino']."'  ";

$consulta_modif = mysql_query($sql_modificar,$conexion); 
*/

function colocar_select_general_condicion_mejorada_dest($tabla,$conexion,$campo1,$campo2,$condicion){
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

?>
</div>	
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_grabar_modificar").click(function(){
           	//alert('modificar destino');
           			
		              var data =  'nombre=' + $("#nombre").val();
		              data += '&id_hotel=' + $("#id_hotel").val();
		              data += '&id_destino=' + $("#id_destino").val();
		            
		              $.post('grabar_modificar_destino.php',data,function(a){
		              //$(window).attr('location', '../index.php);
		              $("#div_123_modificar").html(a);
		                //alert(data);
		              }); 
					
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>