<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<br />
<?PHP
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
?>


<table width="307" border="1">
  <tr>
    <td colspan="3"><div align="center">INGRESE LOS DATOS DEL NUEVO CLIENTE ..</div></td>
  </tr>
  <tr>
    <td width="102">Identidad </td>
    <td width="189">
      <input type="text" name="identi"  id ="identi"  class="fila_llenar" />
    </td>
  
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input type="text" name="nombre"  id ="nombre" class="fila_llenar" /></td>
  
  </tr>
  <tr>
    <td>Direccion</td>
    <td><input type="text" name="direccion"  id ="direccion" class="fila_llenar" /></td>
 
  </tr>
  <tr>
    <td>Telefono</td>
    <td><input type="text" name="telefono"  id ="telefono"  class="fila_llenar" /></td>
   
  </tr>
  <tr>
    <td>Entidad</td>
    <td><input type="text" name="entidad"  id ="entidad" class="fila_llenar" /></td>
   
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email"  id ="email" class="fila_llenar"></td>
    
  </tr>
  <tr>
    <td colspan="2"><label>
    <button id = "grabar_datos"  type = "button">Grabar Datos Cliente</button>
    </label></td>
    
  </tr>
</table>
 </form>

</body>
</html>


<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
 		
				$("#grabar_datos").click(function(){
						var data =  'identi=' + $("#identi").val();
						data += '&nombre=' + $("#nombre").val();
						data += '&direccion=' + $("#direccion").val();
						data += '&telefono=' + $("#telefono").val();
						data += '&entidad=' + $("#entidad").val();
						data += '&email=' + $("#email").val();
						$.post('grabar_datos_cliente.php',data,function(a){
							 $("#carros123").load('pregunte_datos_nuevo_carro.php');
							//$("#resultados").html(a);
							//alert(data);
						});	
					});
					
            });		
</script>
