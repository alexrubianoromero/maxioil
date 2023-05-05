<?php

include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

  $datos_propietario =  consulta_assoc($tabla3,'idcliente',$_REQUEST['id_cliente'],$conexion);

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
<div id="div_datos_moto">	
<table width="876" height="95" border="1"> 
	 <tr>
    <td>PROPIETARIO</td>
    <td>
    	<input  type="hidden" name="idcliente" id = "idcliente" value = "<?php  echo  $_REQUEST['id_cliente']; ?>" >
    	<input disabled type="text" name="nombre_propietario" id = "nombre_propietario" value = "<?php  echo  $datos_propietario['nombre']; ?>">
    </td>
  </tr>
  <tr>
    <td width="178">PLACA</td>
    <td width="682"><label>
      <input type="text" name="placa" id = "placa" value = "<?php echo $_REQUEST['placa123'];  ?>">
    </label></td>
  </tr>
  <tr>
    <td>MARCA</td>
    <td><input type="text" name="marca" id = "marca"></td>
  </tr>
  <tr>
    <td>LINEA</td>
    <td><input type="text" name="tipo" id = "tipo"></td>
  </tr>
  <tr>
    <td>MODELO</td>
    <td><input type="text" name="modelo" id = "modelo"></td>
  </tr>
   
  <tr>
    <td>COLOR</td>
    <td><input type="text" name="color" id = "color"></td>
  </tr>
  <tr>
    <td>CHASIS</td>
    <td><input type="text" name="chasis" id = "chasis"></td>
  </tr>
  <tr>
    <td>MOTOR</td>
    <td><input type="text" name="motor" id = "motor"></td>
  </tr>
    <tr>
    <td>SOAT  </td>
    <td><input type="date" name="soat" id = "soat">
    AAAA/MM/DD</td>
  </tr>
    <tr>
    <td>TECNOMECANICA</td>
    <td><input type="date" name="revision" id = "revision">
    AAAA/MM/DD</td>
  </tr>
  <tr>
    <td colspan="2"> <button id = "grabar_datos_vehiculo"  type = "submit">Grabar Datos Vehiculo </button></td>
   </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   	

<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){

		$("#grabar_datos_vehiculo").click(function(){

						 if($("#marca").val().length < 1)
					        { alert('digite marca');
					      $(marca).focus();
					          return false;
					         }
					       if($("#tipo").val().length < 1)
					        { alert('digite linea');
					      $(tipo).focus();
					          return false;
					         }

					         if($("#modelo").val().length < 1)
					        { alert('digite modelo');
					      $(modelo).focus();
					          return false;
					         }
					          if($("#color").val().length < 1)
					        { alert('digite color');
					      $(color).focus();
					          return false;
					         }

   


						var data =  'placa1=' + $("#placa").val();
						data += '&marca=' + $("#marca").val();
						data += '&tipo=' + $("#tipo").val();
						data += '&modelo=' + $("#modelo").val();
						data += '&chasis=' + $("#chasis").val();
						data += '&motor=' + $("#motor").val();
						data += '&color=' + $("#color").val();
						data += '&placa=' + $("#placa").val();
						data += '&soat=' + $("#soat").val();
						data += '&revision=' + $("#revision").val();
						data += '&idcliente=' + $("#idcliente").val();
					
						$.post('grabar_datos_vehiculo_nuevo123.php',data,function(a){
							 //$("#contenidos").load('muestreplacas2.php');
							$("#div_datos_moto").html(a);
							//alert(data);
						});	

					});



}); // fin de total 									  			
</script>

