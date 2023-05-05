<?php
session_start();
?>
<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style >
#div_propietario{
 display:none;
}
</style>
</head>
<?php
include('../valotablapc.php');
include('../funciones.php');
$sql_clientes = "select idcliente,nombre,identi from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."'  order by nombre ";
$clientes = mysql_query($sql_clientes,$conexion);

?>

<body>
<table width="255" height="104" border="1">
  <tr>
    <td height="48">
	
	PROPIETARIO<input tye = "text" id="busqueda_nombre" placeholder="BUSCAR NOMBRE">
	<div id="div_propietario">
      <?php
	echo "<select name='propietario123' id='propietario123' class='fila_llenar' >";
	echo "<option value='' selected>...</option>";     
	while($row = mysql_fetch_array($clientes))
			{
             echo "<h2><option value= ".$row[0].">".substr($row[1],0,20)."-".$row[2]."</h2></option>";
     		}
	 echo "</select>";
	
	?>
	
	</div> 
	<input type = "hidden" id="propietario" > <input tye = "text" id="nombre_propietario" onfocus="blur()">
	   
    </td>
  </tr>
  <tr>
    <td height="48"><input type="checkbox" name="casilla_clientes"  id = "casilla_clientes" value="checkbox">
      <label   for = "casilla_clientes">NUEVO CLIENTE </label></td>
  </tr>
</table>

<div id = "datos_cliente" align="center"></div>


 <table width="width="307"" height="95" border="1"> 
  <tr>
    <td width="77">PLACA</td>
    <td width="167">
      <input type="text" name="placa" id = "placa" class="fila_llenar">    </td>
  </tr>
  <tr>
    <td>SIGLA</td>
    <td><input type="text" name="sigla" id = "sigla" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>MARCA</td>
    <td><input type="text" name="marca" id = "marca" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>LINEA</td>
    <td><input type="text" name="tipo" id = "tipo" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>MODELO</td>
    <td><input type="text" name="modelo" id = "modelo" class="fila_llenar"></td>
  </tr>
   
  <tr>
    <td>COLOR</td>
    <td><input type="text" name="color" id = "color" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>CHASIS</td>
    <td><input type="text" name="chasis" id = "chasis" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>MOTOR</td>
    <td><input type="text" name="motor" id = "motor" class="fila_llenar"></td>
  </tr>
    <tr>
    <td>SOAT  </td>
    <td><input type="date" name="soat" id = "soat" class="fila_llenar"></td>
  </tr>
    <tr>
    <td>TECNOM</td>
    <td><input type="date" name="revision" id = "revision" class="fila_llenar"></td>
  </tr>
  <tr>
    <td colspan="2"> <div align="center">
      <button id = "grabar_datos_vehiculo"  type = "button">Grabar__Vehiculo </button>
    </div></td>
   </tr>
</table>
</body>
</html>
<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){
							$("#casilla_clientes").click(function(event) {
															if($(this).is(":checked")) 
															{ 
																	 $("#datos_cliente").load('pregunte_datos_nuevo_cliente.php');
																	//alert('Se hizo check en el checkbox.');
														  
														  
															} else {
																	//alert('Se destildo el checkbox');
																	$("#datos_cliente").html('');
														  }
															  
														  
												  });
												  
												  
				$("#grabar_datos_vehiculo").click(function(){
						var data =  'placa1=' + $("#placa").val();
						data += '&sigla=' + $("#sigla").val();
						data += '&marca=' + $("#marca").val();
						data += '&tipo=' + $("#tipo").val();
						data += '&modelo=' + $("#modelo").val();
						data += '&chasis=' + $("#chasis").val();
						data += '&motor=' + $("#motor").val();
						data += '&color=' + $("#color").val();
						data += '&placa=' + $("#placa").val();
						data += '&soat=' + $("#soat").val();
						data += '&revision=' + $("#revision").val();
						//data += '&idcliente=' + $("#propietario").find(':selected').val();
						data += '&idcliente=' + $("#propietario").val();
						$.post('grabar_datos_vehiculo.php',data,function(a){
							 $("#contenidos").load('muestreplacas2.php');
							$("#carros123").html('');
							//alert(data);
						});	
					});

					///////////////////////////	
					 $("#busqueda_nombre").keydown(function(e){
					     	var data =  'nombre=' + $("#busqueda_nombre").val();
							$("#div_propietario").css("display","block")
							//$("#mostrar_select").css("display","block")
							$.post('consultar_nombre.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#div_propietario").html(a);
													//alert(data);
							});	
	 
   						});
					//////////////////////////	
					$("#propietario123").change(function(){
					var valor=$("#propietario123").val();
					var texto=$("#propietario123 option:selected").text();
					$("#propietario").val(valor);
					$("#nombre_propietario").val(texto);
					$("#div_propietario").css("display","none")
					});
					/////////////////////////					    
												  
			 }); // fin de total 									  				
</script>