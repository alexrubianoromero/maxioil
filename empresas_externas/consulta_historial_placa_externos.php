<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
function colocar_select_general($tabla,$conexion,$campo1,$campo2,$id_externa,$nombre_perfil){

	$sql_general = "select * from $tabla  where  id_empresa_externa = '".$id_externa."'  ";

	if($_SESSION['nombre_perfil']=='admin')
    {
    	$sql_general = "select * from $tabla"; 
    }
    

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
<html>
<head>
	<title></title>
	
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<script src='../js/bootstrap.min.js'></script>
</head>
<body>
<div id="container">
<div id="arriba">	
<h3>PLACA  <select id="idcarro">
<?php
colocar_select_general($tabla4,$conexion,'idcarro','placa',$_SESSION['id_empresa_externa'],$_SESSION['nombre_perfil']);
?>

</select> <button  id="btn_consultar" class="btn btn-primary" >CONSULTAR</button></h3>
</div>

<div id="div_mustre_ordenes_externo">
     <?php

       include("../clientes_externos/muestre_ordenes_clientes.php");
     ?>

</div>	

</div>	

</body>
</html>

<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_consultar").click(function(){
            //alert('modificar destino');
                
                  var data =  'idcarro=' + $("#idcarro").val();
                 
                  //data += '&id_empresa_externa=' + $("#id_empresa_externa").val();
                  /*
                  data += '&id_empresa=' + $("#id_empresa").val();
                  data += '&nombre=' + $("#nombre").val();
                  */
                 // data += '&clave=' + $("#clave").val();
                  $.post('../clientes_externos/muestre_ordenes_clientes.php',data,function(b){
                  //$(window).attr('location', '../empresas_externas/consulta_general_motos.php');
                  $("#div_mustre_ordenes_externo").html(b);
                    //alert(data);
                  }); 
          
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>


