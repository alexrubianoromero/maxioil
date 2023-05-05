<?php
session_start();
include('../valotablapc.php');
//include('../funciones_summers.php');

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
              <label for = "nombre_producto">NOMBRE </label>
            </div>
            <div class= "col-md-6 colxs-12">
                <input type="text"  id="nombre_producto" class="form-control fila_llenar">
            </div>
        </div>
   </div>


   <div class="form-group">
    <div class="row">
            <div class= "col-md-3 colxs-12">
      <label for = "telefono_producto">TELEFONO </label>
    </div>
          <div class= "col-md-6 colxs-12">
      <input type="text"  id="telefono_producto" class="form-control fila_llenar">
    </div>
   </div>
 </div>

   <div class="form-group">
     <div class="row">
    <div class= "col-md-3 colxs-12">
      <label for = "direccion_producto">DIRECCION </label>
    </div>
      <div class= "col-md-6 colxs-12">
      <input type="text"  id="direccion_producto" class="form-control fila_llenar">
    </div>
     </div>
    </div> 

   <div class="form-group">
     <div class="row">
    <div class= "col-md-3 colxs-12">
      <label for = "email_producto">EMAIL </label>
    </div>
      <div class= "col-md-6 colxs-12">
      <input type="text"  id="email_producto" class="form-control fila_llenar">
    </div>
   </div>
   </div>

  
     <button type="submit"  id="btn_grabar_producto" class="btn btn-primary btn-block">GRABAR</button>
  </form>   
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

          
            if($("#nombre_producto").val().length < 1)
            { alert('digite nombre ');
              $(nombre_producto).focus();
              return false;
             }



              var data =  'nombre_producto=' + $("#nombre_producto").val();
              data += '&telefono_producto=' + $("#telefono_producto").val();
              data += '&direccion_producto=' + $("#direccion_producto").val();
              data += '&telefono_producto=' + $("#telefono_producto").val();
              data += '&email_producto=' + $("#email_producto").val();
              $.post('grabar_hotel.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#div_muestre_productos").html(a);
                //alert(data);
              }); 
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>