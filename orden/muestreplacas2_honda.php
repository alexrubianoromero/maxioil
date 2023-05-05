<?php
session_start();
?>
<!DOCTYPE html>
<html >
<!-- <html lang="es"  class"no-js">
-->

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	<style>
	
	#porpietario_afuera{
	  display:none;
	}
	#div_propietario
	{
	 display:none;
	}
	#div_nombre_propietario{
		/*display:none;*/
	}
	#carros123{
	
	display:none;
	
	}
	#datos_cliente{
	
	display:none;
	
	}
	/*
	#datos_cliente{
		display:none;
	}
	*/
	</style>
</head>
<body id="capturaorden">
<?php 
include('../valotablapc.php');
$sql_carros ="select idcarro,placa from $tabla4";
$consulta_placas = mysql_query($sql_carros,$conexion);

///////////////
$sql_clientes = "select idcliente,nombre,identi from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."'  order by nombre ";
$clientes = mysql_query($sql_clientes,$conexion);
?>

		<header>
			<h3 align="center">POR FAVOR ESCRIBA LA PLACA </h3>
		</header>

 <div id="muestrepplacas2_honda">
		    <input type="text"  id = "placa123" name="placa123" class="fila_llenar"  size ="10" placeholder="PLACA">
		 
				<div  id = "consulta_placa"></div>
				<button type ="button"  id = "consultar_placa" >CONSULTAR</button>
				<button type ="button"  id = "crear_orden" >SIGUIENTE</button>
				
				<label  for="casilla_carros" > NUEVA_PLACA </label>
				<input type="checkbox" name="casilla_carros" id = "casilla_carros"  value="checkbox" /> 		
		</div>

<div id="porpietario_afuera" align="center">
<table width="255" height="104" border="1">
  <tr>
    <td height="48">
	
	PROPIETARIO<input tye = "text" id="busqueda_nombre" placeholder="NOMBRE A BUSCAR" size="25%">
	
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
	
	<input type = "hidden" id="propietario" > 
	 <div id = "div_nombre_propietario">
	 <input tye = "text" id="nombre_propietario" onFocus="blur()"  size="25%">
	  </div> 
    </td>
  </tr>
  <tr>
    <td height="48"><input type="checkbox" name="casilla_clientes"  id = "casilla_clientes" value="checkbox">
      <label   for = "casilla_clientes">NUEVO CLIENTE </label></td>
  </tr>
</table>
</div>
<!-- fin de propietario afuera -->

<div id="datos_cliente" align="center">
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
    <td>Fecha Cumpleanos</td>
    <td><input type="date" name="fecha_cumpleanos"  id ="fecha_cumpleanos" class="fila_llenar"></td>
    
  </tr>
  <tr>
    <td colspan="2"><label>
    <button id = "grabar_datos"  type = "button">Grabar Datos Cliente</button>
    </label></td>
    
  </tr>
</table>
</div>






<div id = "carros123" align="center">

<?php  include('pregunte_datos_nuevo_carro.php');  ?>

</div>
	
	
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			   /*
			    $("#empresapan").change(function(event){
                    var cod = $("#empresapan").find(':selected').val();
                    $("#resultados").load('muestre_datos_cliente.php?cod='+cod );
                });
				*/
	
						///////////////////////
			           ///////////////////////
				
				
				///////////////////////////////////
					$("#casilla_carros").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										$("#porpietario_afuera").toggle("slow");
										$("#carros123").toggle("slow");
										 //$("#carros123").load('pregunte_datos_nuevo_carro.php');
										//alert('Se hizo check en el checkbox.');
							  
							  
							  	} else {
										//alert('Se destildo el checkbox');
										
										$("#porpietario_afuera").toggle("slow");
										$("#carros123").toggle("slow");
										//$("#carros123").html('');
							  }	  
					  });
					  //////////////////////////
					  
					  $("#crear_orden").click(function(){
								var placa123 =$("#placa123").val();
								$(window).attr('location', 'orden_captura_honda.php?placa123='+placa123);
									//alert(data);
								});	
							//});
							
					  /////////////////////////
					  $("#consultar_placa").click(function(){
							var data =  'placa=' + $("#placa123").val();
							$.post('consultar_placa.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#consulta_placa").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					  $("#propietario123").change(function(){
					var valor=$("#propietario123").val();
					var texto=$("#propietario123 option:selected").text();
					$("#propietario").val(valor);
					$("#nombre_propietario").val(texto);
					$("#div_propietario").css("display","none")
					});
					/////////////////////////
					$("#casilla_clientes").click(function(event) {
															if($(this).is(":checked")) 
															{ 
																	
																	
																	
																	 $("#datos_cliente").toggle("slow");
																// $("#datos_cliente").load('pregunte_datos_nuevo_cliente.php');
																	//alert('Se hizo check en el checkbox.');
														  
														  
															} else {
																	//alert('Se destildo el checkbox');
																
																	 
																	$("#datos_cliente").toggle("slow");
																	//$("#datos_cliente").html('');
														  }
															  
														  
						});

					//////////////////////////////
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
						/////////////////////////
				$("#grabar_datos").click(function(){
					
						var nombrepuente = $("#nombre").val();
						$("#nombre_propietario").val(nombrepuente);
						var data =  'identi=' + $("#identi").val();
						data += '&nombre=' + $("#nombre").val();
						data += '&direccion=' + $("#direccion").val();
						data += '&telefono=' + $("#telefono").val();
						data += '&entidad=' + $("#entidad").val();
						data += '&email=' + $("#email").val();
						data += '&fecha_cumpleanos=' + $("#fecha_cumpleanos").val();
						$.post('grabar_datos_cliente.php',data,function(a){
							 //$("#carros123").load('pregunte_datos_nuevo_carro.php');
							 //$("#placa123").css("display","none");
							 
							 $("#propietario").val(a[0].idcliente);
							 //(data1);
							},
							'json'); 
							$("#datos_cliente").css("display","none");
							//alert('hellooooooo');
							
						//});	
					});
					///////////////////////
						/////////////////////////						  
						$("#grabar_datos_vehiculo").click(function(){
						var plaquita = $("#placa").val();
						$("#placa123").val(plaquita);
						var data =  'placa1=' + $("#placa").val();
						data += '&sigla=' + $("#sigla").val();
						data += '&marca=' + $("#marca").val();
						data += '&tipo=' + $("#tipo").val();
						data += '&modelo=' + $("#modelo").val();
						//data += '&chasis=' + $("#chasis").val();
						//data += '&motor=' + $("#motor").val();
						data += '&color=' + $("#color").val();
						data += '&placa=' + $("#placa").val();
						data += '&soat=' + $("#soat").val();
						data += '&revision=' + $("#revision").val();
						//data += '&idcliente=' + $("#propietario").find(':selected').val();
						data += '&idcliente=' + $("#propietario").val();
						$.post('grabar_datos_vehiculo.php',data,function(a){
							 //$("#contenidos").load('muestreplacas2.php');
							$("#carros123").html('');
							$("#datos_cliente").html('');
							//$("#descripan").val(123);
							//alert(data);
						});	
					});
					///////////////////
					//////////////////////////	
					$("#propietario123").change(function(){
					var valor=$("#propietario123").val();
					var texto=$("#propietario123 option:selected").text();
					$("#propietario").val(valor);
					$("#nombre_propietario").val(texto);
					
					$("#porpietario_afuera").css("display","block")
					$("#div_nombre_propietario").css("display","block")
					});
					/////////////////////////	
					////////////////////////////////
					
		 });			
          	
</script>