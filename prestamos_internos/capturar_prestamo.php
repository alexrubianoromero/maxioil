<?php
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan );
?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
</style>
</head>
<body>
<div id="div_prestamos_internos">	
	<div id="encabezado_prestamo">
<h2>DIGITE LA INFORMACION DEL PRESTAMO</h2>
 <input type="hidden" id="idorden_prestadora" value = "<?php echo $_REQUEST['idorden_prestadora']  ?>">
EL DINERO SE TOMARA DE LA ORDEN NO <?php  echo $_REQUEST['orden'] ?> 
  PLACA <?php  echo $_REQUEST['placa'] ?> 
 <br>POR FAVOR DIGITE EL NUMERO DE LA ORDEN A LA CUAL SE LE REALIZARA EL PRESTAMO
 <br><br>NUMERO DE LA ORDEN QUE RECIBIRA EL PRESTAMO <input id="orden_recibe" type="text" > <button id="btn_consultar_orden" >CONSULTAR</button>
<br><br>
</div>
<hr>
<div id="cuerpo_prestamo">
<h3>DATOS DE LA MOTO QUE RECIBIRA EL PRESTAMO</h3>
Fecha_prestamo  <input type="text" id="fecha_prestamo" value = "<?php echo $fechapan; ?>">
<br>Placa<input type="text" id="placa_recibe"><input type="hidden" id="idorden_recibe">
<br>
<textarea id="motivo_prestamo" cols="40" rows="5" placeholder="MOTIVO PRESTAMO"></textarea>
<BR>Valor a Prestar <input type="text" id="valor_prestado">
<br>	<br>
<button id="btn_grabar_prestamo" >GRABAR PRESTAMO</button>

</div>

</div>
</body>
</html>

<script src="../js/jquery-2.1.1.js"></script>   

<script type="text/javascript">
 $(document).ready(function(){


 	//////////////////
			   $("#btn_consultar_orden").click(function(){
					//$("#cosito").html( $("#nombrepan").val() );
							//alert('fsdfsdfssd');
							var data1 ='orden_recibe=' + $("#orden_recibe").val();
							//$.post('buscarelnombre.php',data1,function(b){
							$.post('traer_datos_orden.php',data1,function(b){
							        //  $("#descripan").val() =  descripcion;
									$("#placa_recibe").val(b[0].placa);
									$("#idorden_recibe").val(b[0].idorden);
									//$("#nombre").val(b[0].nombre);
									
							 //(data1);
							},
							'json');
							
						
			   });//finde btn_consultar_orden
			  
			/////////////////////////////////

     /////////////////////////////////	
						$("#btn_grabar_prestamo").click(function(){
							
							//alert('dasdas');
							 if($("#idorden_recibe").val().length < 1)
					        { alert('Debe consultar una orden que recibira el dinero '); 
					        $(orden_recibe).focus();
					        return false; }

					         if($("#motivo_prestamo").val().length < 1)
					        { alert('Digite motivo_prestamo'); 
					        $(motivo_prestamo).focus();
					        return false; }

					         if($("#valor_prestado").val().length < 1)
					        { alert('Digite valor a prestar'); 
					        $(valor_prestado).focus();
					        return false; }
							
								var data =  'idorden_prestadora=' + $("#idorden_prestadora").val();
								data += '&idorden_recibe=' + $("#idorden_recibe").val();
								data += '&motivo_prestamo=' + $("#motivo_prestamo").val();
								data += '&valor_prestado=' + $("#valor_prestado").val();
								data += '&fecha_prestamo=' + $("#fecha_prestamo").val();
								
								$.post('../prestamos_internos/grabar_prestamo_interno.php',data,function(a){
								$("#cuerpo_prestamo").html(a);
									//alert(data);
								});	
								

						 });//fin de agregar_item 
				

});


</script> 	