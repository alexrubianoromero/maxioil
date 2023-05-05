<?php
session_start();
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
<div id="div_datos_cliente">
<br><br>
<input type="hidden" id = "placa123"  value = "<?php echo $_REQUEST['placa123'];  ?>" >
<table width="515" border="1">
  <tr>
    <td colspan="3"><div align="center">INGRESE LOS DATOS DEL NUEVO CLIENTE ..</div></td>
  </tr>
  <tr>
    <td width="139">Identidad </td>
    <td width="177"><label>
      <input type="text" name="identi"  id ="identi"   />
    </label></td>
    <td width="177">&nbsp;</td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input type="text" name="nombre"  id ="nombre"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Direccion</td>
    <td><input type="text" name="direccion"  id ="direccion"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Telefono</td>
    <td><input type="text" name="telefono"  id ="telefono"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email"  id ="email"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
    <button id = "btn_grabar_datos"  type = "submit">Grabar Datos Cliente</button>
    </label></td>
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
 		
				$("#btn_grabar_datos").click(function(){
						 if($("#identi").val().length < 1)
					        { alert('digite identi');
					      $(identi).focus();
					          return false;
					         }
					       if($("#nombre").val().length < 1)
					        { alert('digite nombre');
					      $(nombre).focus();
					          return false;
					         }
					         if($("#telefono").val().length < 1)
					        { alert('digite telefono');
					      $(telefono).focus();
					          return false;
					         }
					       if($("#email").val().length < 1)
					        { alert('digite email');
					      $(email).focus();
					          return false;
					         }

						var data =  'identi=' + $("#identi").val();
						data += '&nombre=' + $("#nombre").val();
						data += '&direccion=' + $("#direccion").val();
						data += '&telefono=' + $("#telefono").val();
						data += '&email=' + $("#email").val();
						data += '&placa123=' + $("#placa123").val();
						$.post('grabar_datos_cliente_nuevo_orden.php',data,function(a){
							 //$("#carros123").load('pregunte_datos_nuevo_carro.php');
							$("#div_datos_cliente").html(a);
							//alert(data);
						});	
					});
					
            });		
</script>  


