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

$datos_moto = consulta_assoc_hot($tabla4,'idcarro',$_REQUEST['idcarro'],$conexion);

//$datos_empresa = consulta_assoc_hot($tabla16,'id_usuario',$_REQUEST['id_hotel'],$conexion)
?>
<head>
  <title></title>

  <link rel="stylesheet" href="../css/style.css">

<meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<script src='../js/bootstrap.min.js'></script>
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
  <div id="container" >
  <div id="div_123_modificar">
  <br><br>
  <form>
    <input type="hidden" id="idcarro" value="<?php echo $_REQUEST['idcarro'] ?>" >
    <div class="form-group">
        <div class="row">
            <div class= "col-md-3 colxs-12">
              <label for = "placa">PLACA </label>
            </div>
            <div class= "col-md-6 colxs-12">
                <input disabled type="text" id="placa" value="<?php echo  $datos_moto['placa'] ?>" class=" form-control fila_llenar" >
            </div>
        </div>
   </div>

 <div class="form-group">
        <div class="row">
            <div class= "col-md-3 colxs-12">
              <label for = "marca">MARCA </label>
            </div>
            <div class= "col-md-6 colxs-12">
                <input disabled type="text" id="marca" value="<?php  echo $datos_moto['marca'] ?>" class=" form-control fila_llenar" >
            </div>
        </div>
   </div>


   <div class="form-group">
        <div class="row">
            <div class= "col-md-3 colxs-12">
              <label for = "id_empresa">EMPRESA </label>
            </div>
            <div class= "col-md-6 colxs-12">
               
              <select id="id_empresa_externa"  class="form-control" >
                <?php
                  colocar_select_general_condicion_mejorada_dest($empresas_externas,$conexion,'id_empresa_externa','nombre_empresa',$datos_moto['id_empresa_externa']);
                ?>

              </select> 

            </div>
        </div>
   </div>
   


<button type="submit"  id="btn_grabar_modificar" class="btn btn-primary btn-block">GRABAR</button>

  </form>

 </div> <!--div modificar-->
 </div> <!-- container--> 
</body>
</html> 
<?php

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
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_grabar_modificar").click(function(){
            //alert('modificar destino');
                
                  var data =  'idcarro=' + $("#idcarro").val();
                 
                  data += '&id_empresa_externa=' + $("#id_empresa_externa").val();
                  /*
                  data += '&id_empresa=' + $("#id_empresa").val();
                  data += '&nombre=' + $("#nombre").val();
                  */
                 // data += '&clave=' + $("#clave").val();
                  $.post('grabar_modificar_moto.php',data,function(b){
                  $(window).attr('location', '../empresas_externas/consulta_general_motos.php');
                  //$("#div_123_modificar").html(b);
                    //alert(data);
                  }); 
          
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>