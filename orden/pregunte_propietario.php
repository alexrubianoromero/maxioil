<?php
session_start();
include('../valotablapc.php');
function colocar_select_general_clientes($tabla,$conexion,$campo1,$campo2){
  $sql_general = "select * from $tabla   ";
  //echo '<br>'.$sql_personas;
  $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
    echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
  }
}
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div id = "div_propietario">
	SELECCIONE PROPIETARIO  
	<input type ="hidden"  id = "placa123" value = "<?php echo $_REQUEST['placa123']  ?>">
 	<select id="id_cliente"  class="fila_llenar"  >
            <?php
                colocar_select_general_clientes($tabla3,$conexion,'idcliente','nombre');
            ?>
         
          </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <button id="btn_crear_cliente">CREAR NUEVO PROPIETARIO..</button> 
     <BR><BR>
   <button id="btn_siguiente" type ="submit" >CONTINUAR CON LA CREACION DE LA ORDEN</button>     


</div>
	
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">      
$(document).ready(function(){

			///////////////////////////////////////
			$("#btn_siguiente").click(function(){
			         //alert('asdasdas');

			              
			                if($("#id_cliente").val().length < 1)
			                  { alert('Escoja un nombre por favor '); 
			                  $(id_cliente).focus();
			                  return false; }

			              var data =  'id_cliente=' + $("#id_cliente").val();
			              data += '&placa123=' + $("#placa123").val();
			              $.post('../orden/pregunte_informacion_moto.php',data,function(b){
			              //$(window).attr('location', '../index.php);
			              $("#div_propietario").html(b);
			                //alert(data);
			              }); 
			 });

			////////////////////////////////////
			$("#btn_crear_cliente").click(function(){
              //alert('asdasds');
              
              var data =  'placa123=' + $("#placa123").val();
              //data += '&placa123=' + $("#placa123").val();
              $.post('../orden/pregunte_datos_nuevo_cliente_orden.php',data,function(a){
              //$(window).attr('location', '../index.php);
                 $("#div_propietario").html(a);
                //alert(data);
               
              }); 
              }); 

			////////////////////////////////////

});   ////finde la funcion principal de script
</script>



