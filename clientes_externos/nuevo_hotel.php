<?php
session_start();
include('../valotablapc.php');
//include('../funciones_summers.php');
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


$sql_productos = "select * from $empresas_externas  ";
$con_productos = mysql_query($sql_productos,$conexion);

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  
  <meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<link rel="stylesheet" href="../css/style.css">
<script src='../js/bootstrap.min.js'></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<style>

  #div_nuevo_producto{
    position:relative;
    width: 90%;
    border: 1px solid black;
    padding: 5px;
    text-align: center;
  }


</style>
</head>
<body>

<!--<div id="div_nuevo_producto">-->
<div id="container" >
  <form>

    <div class="form-group">
        <div class="row">
            <div class= "col-md-3 colxs-12">
              <label for = "login">LOGIN </label>
            </div>
            <div class= "col-md-6 colxs-12">
                <input type="text"  id="login" class="form-control fila_llenar">
            </div>
        </div>
   </div>


   <div class="form-group">
    <div class="row">
            <div class= "col-md-3 colxs-12">
      <label for = "nombre">NOMBRE </label>
    </div>
          <div class= "col-md-6 colxs-12">
      <input type="text"  id="nombre" class="form-control fila_llenar">
    </div>
   </div>
 </div>

   <div class="form-group">
     <div class="row">
    <div class= "col-md-3 colxs-12">
      <label for = "id_empresa_externa">EMPRESA </label>
    </div>
      <div class= "col-md-6 colxs-12">
        <select id="id_empresa_externa" class="form-control fila_llenar">
          <?php
               colocar_select_general($empresas_externas,$conexion,'id_empresa_externa','nombre_empresa');
          ?>
         </select> 
    </div>
     </div>
    </div> 
     <div class="form-group">
    <div class="row">
            <div class= "col-md-3 colxs-12">
      <label for = "clave">CLAVE </label>
    </div>
          <div class= "col-md-6 colxs-12">
      <input type="text"  id="clave" class="form-control fila_llenar">
    </div>
   </div>
 </div>

  

  
     <button type="submit"  id="btn_grabar_producto" class="btn btn-primary btn-block">GRABAR</button>
  </form>   
</div>  

<div id="div_prueba123">
 </div> 

</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_grabar_producto").click(function(){

          
            if($("#login").val().length < 1)
            { alert('digite login ');
              $(login).focus();
              return false;
             }

              if($("#nombre").val().length < 1)
            { alert('digite nombre ');
              $(nombre).focus();
              return false;
             }
              if($("#id_empresa_externa").val().length < 1)
            { alert('digite empresa ');
              $(id_empresa_externa).focus();
              return false;
             }
                if($("#clave").val().length < 1)
            { alert('digite clave ');
              $(clave).focus();
              return false;
             }





              var data =  'login=' + $("#login").val();
              data += '&nombre=' + $("#nombre").val();
              data += '&id_empresa_externa=' + $("#id_empresa_externa").val();
               data += '&clave=' + $("#clave").val();
             
              $.post('grabar_hotel.php',data,function(a){
              //$(window).attr('location', '../index.php);
              //$("#div_muestre_productos").html(a);
              $("#div_pruebita").html(a);
                //alert(data);
              }); 
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>