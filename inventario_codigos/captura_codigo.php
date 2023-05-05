<?php
session_start();
$fechapan =  time();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
    
<!--
.style1 {color: #0000FF}
-->
    </style>
</head>
<body>
<? include("../empresa.php"); ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
		<nav>
		<ul class="menu">
	  
		</ul>
	</nav>
	<section>
	<article>
	    <div id= "captura">
		<table width="532" border="1">
  <tr>
    <td width="286"><h3>FECHA</h3></td>
    <td width="230"><input size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>></td>
  </tr>
  <!--
  <tr>
    <td><h3 class="style1">FACTURA DE COMPRA</h3></td>
    <td><label>
     <h3> <input type="text" name="factura_compra"  id="factura_compra"  ><h3>
    </label></td>
  </tr>
  -->
  <tr>
  
    <td><h3>CODIGO DEL PRODUCTO </h3></td>
    <td><label>
     <h3> <input type="text" name="codigo"  id="codigo" class="fila_llenar" ><h3>
    </label></td>
  </tr>
  <tr>
    <td><h3>PROVEEDOR</h3></td>
    <td><h3><input type="text" name="proveedor"  id="proveedor" class="fila_llenar" ></h3></td>
  </tr>
  <tr>
    <td><h3>UBICACION</h3></td>
    <td><h3><input type="text" name="ubicacion"  id="ubicacion" class="fila_llenar" ></h3></td>
  </tr>
  <tr>
    <td><h3>MARCA</h3></td>
    <td><h3><input type="text" name="marca"  id="marca" class="fila_llenar" ></h3></td>
  </tr>
   <tr>
    <td><h3>LINEA</h3></td>
    <td><h3><input type="text" name="linea"  id="linea" class="fila_llenar" ></h3></td>
  </tr>
  <tr>
    <td><h3>REFERENCIA</h3></td>
    <td><h3><input type="text" name="referencia"  id="referencia" class="fila_llenar" ></h3></td>
  </tr>


  </table>


  <table width="870" border="1">
  <tr>
    <td width="308"><h3>DESCRIPCION</h3></td>
    <td width="567"><h3><input type="text" name="descripcion"  id="descripcion" class="fila_llenar" size="80"></h3></td>
  </tr>
  </table>
   <table width="532" border="1">
  <tr>
    <td><h3>PRECIO DE COMPRA </h3></td>
    <td align="right"><h3><input type="text" name="valorunit"  id="valorunit" class="fila_llenar" ></h3></td>
  </tr>
    <tr>
      <td><h3>PORCENTAJE GANANCIA </h3></td>
      <td><h3><input type="text" name="porcentaje_ganancia"  id="porcentaje_ganancia" class="fila_llenar" size="8" placeholder="% Y ENTER">%</h3></td>
    </tr>
    <tr>
    <td><h3>PRECIO DE VENTA (Sin iva)</h3></td>
    <td align="right"><h3><input type="text" name="valorventa"  id="valorventa" class="fila_llenar" ></h3></td>
  </tr>
  <!--
   <tr>
    <td><h3>IVA </h3></td>
    <td align="right"><h3><input type="text" name="iva"  id="iva" class="fila_llenar" ></h3></td>
  </tr>
  <tr>
    <td><h3>PRECIO DE VENTA CON IVA</h3></td>
    <td align="right"><h3><input type="text" name="valorconiva"  id="valorconiva" class="fila_llenar" ></h3></td>
  </tr>
-->
  <tr>
    <td><h3>CANTIDAD INICIAL	</h3></td>
    <td><h3><input type="text" name="cantidad"  id="cantidad" class="fila_llenar" ></h3></td>
  </tr>
   
 
   <tr>
    <td><h3><label for ="nomina">CODIGO_DE_NOMINA</label></h3></td>
    <td><label>
      <h3><input type="checkbox" name="nomina"  id = "nomina" value="1"></h3>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><button type ="button"  id = "grabar_codigo" ><h3>GRABAR_CODIGO</h3></button></td>
    </tr>
</table>

		</div>
	</article>
	</section>
	
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
					
					/////////////////////////
					$("#grabar_codigo").click(function(){
							var data =  'codigo=' + $("#codigo").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&valorunit=' + $("#valorunit").val();
							data += '&cantidad=' + $("#cantidad").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&valorventa=' + $("#valorventa").val();
							data += '&valorventa=' + $("#valorventa").val();
							data += '&iva=' + $("#iva").val();
							data += '&nomina=' + $("#nomina:checked").val();
							data += '&factura_compra=' + $("#factura_compra").val();
              data += '&proveedor=' + $("#proveedor").val();
              data += '&ubicacion=' + $("#ubicacion").val();
              data += '&valorconiva=' + $("#valorconiva").val();
              data += '&marca=' + $("#marca").val();
              data += '&referencia=' + $("#referencia").val();
              data += '&linea=' + $("#linea").val();

							$.post('grabar_codigo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#captura").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					//////////////////
			   $("#porcentaje_ganancia").keyup(function(e){
					//$("#cosito").html( $("#nombrepan").val() );
					if (e.which == 13)
					{
							var porcentaje = $("#porcentaje_ganancia").val();
							var valorunit  = $("#valorunit").val();
							var incremento = (parseInt(valorunit) * parseInt(porcentaje))/100;	
							var  precioventa = parseInt(valorunit)+parseInt(incremento);
							$("#valorventa").val(precioventa);
							/////////////////////////
					}// fin del if 		
			   });//finde porcentaje_ganancia

					////////////////////////
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

  