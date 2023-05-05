<?php
session_start();
date_default_timezone_set('America/Bogota');
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

//$tipo_recibo = '0';
if($_REQUEST['tipo_recibo']== '1'){ $tipo_recibo = 'INGRESO DINERO';} 
if($_REQUEST['tipo_recibo']== '2'){ $tipo_recibo = 'EGRESO (SALIDA DE DINERO)';} 
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
<? include("../empresa.php"); 
$fechapan =  time();
$sql_numero_recibo = "select contarecicaja,saldocajamenor  from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_numero_recibo = mysql_query($sql_numero_recibo,$conexion);
$numero_actual = mysql_fetch_assoc($consulta_numero_recibo);

$sql_orden = "select * from $tabla14 where id='".$_REQUEST['id_orden']."'   "; 
$con_orden = mysql_query($sql_orden,$conexion);
$arr_orden = mysql_fetch_assoc($con_orden);

/*
echo '<pre>';
print_r($numero_actual);
echo '</pre>';
*/
$siguiente_numero = $numero_actual['contarecicaja'] + 1;

echo '<input type="hidden"  id="id_orden"  value = "'.$_REQUEST['id_orden'].'"   >';
echo '<input type="hidden"  id="id_proveedor"  value = "'.$_REQUEST['id_proveedor'].'"   >';
echo '<input type="hidden"  id="id_cxp"  value = "'.$_REQUEST['id_cxp'].'"   >';
?>

<Div id="contenidos2">
		<header>
		<h1><? echo $empresa; ?></h1>
<h2><? echo $slogan; ?><h2>
	</header>
    
    <section>
<?php
if ($tipo_recibo == ''  )
{
   echo 'NO SE DEFINIO UN TIPO DE RECIBO VALIDO ';
}
else
{//	
echo '<H2>RECIBO DE '.$tipo_recibo.'</H2>';

///////////////colocar mensaje de acuerdo a si es abono de una cxc(orden) o una cxp(proveedor)
if(isset($_REQUEST['id_orden']))
    {
      $letrero_de_donde_viene = 'SALDO ORDEN ';
    // $datos_orden = consulta_assoc_4444($tabla14,'id',$_REQUEST['id_orden'],$conexion);
    //$saldo_a_mostrar = $datos_orden['saldo'];
      $sql_orden = "select saldo from $tabla14 where id = '".$_REQUEST['id_orden']."'  ";
      $consulta_saldo_orden = mysql_query($sql_orden,$conexion);
      $arr_saldo = mysql_fetch_assoc($consulta_saldo_orden);
      $saldo_a_mostrar = $arr_saldo['saldo'];
   }
if(isset($_REQUEST['id_cxp']))
    {
      $letrero_de_donde_viene = 'SALDO CXP ';
    // $datos_orden = consulta_assoc_4444($tabla14,'id',$_REQUEST['id_orden'],$conexion);
    //$saldo_a_mostrar = $datos_orden['saldo'];
      $sql_orden = "select saldo from $cuentasxpagar where id_cxp = '".$_REQUEST['id_cxp']."'  ";
      $consulta_saldo_orden = mysql_query($sql_orden,$conexion);
      $arr_saldo_cxp = mysql_fetch_assoc($consulta_saldo_orden);
      $saldo_a_mostrar = $arr_saldo_cxp['saldo'];
   }






?>





<table width="95%" border="1">


  <tr>


     <!--Saldo caja_actual -->
     <input name="saldo_actual" type="hidden"  id = "saldo_actual" value = "<?php  echo $numero_actual['saldocajamenor'] ?>" onFocus="blur()" >
    

    <td><?php echo $letrero_de_donde_viene;  ?>  </td>
    <td><?php echo $saldo_a_mostrar;  ?> </td> 
     
</tr>



  <tr>
    <td>RECIBO NUMERO </td>
    <td> <input name="numero_recibo" type="text"  id = "numero_recibo" value = "<?php echo ' '.$siguiente_numero   ?>"   onFocus="blur()">
	  <input name="tipo_recibo" type="hidden"  id = "tipo_recibo" value = "<?php  echo $_REQUEST['tipo_recibo'];?>"></td>
  </tr>
  <tr>
    <td width="22%">FECHA:</td>
    <td width="78%"><input size=10 name=fecha id = "fecha"  value=" <? echo date ( "Y/m/j" , $fechapan );?>"  onFocus="blur()" ></td>
  </tr>
  <tr>
    <td>
	 <?php
	 if($_REQUEST['tipo_recibo']== '1'){$recibidopagado =  'RECIBIDO DE';}
	  if($_REQUEST['tipo_recibo']== '2'){$recibidopagado= 'PAGADO A';}
	  echo $recibidopagado;
	 ?>	</td>
    <td><label>
       <?php
        if(isset($_REQUEST['abono']))
        {
              
              echo '<input name="dequienoaquin" type="text"  id = "dequienoaquin" size="60%"   
              value = "'.'PLACA '.$_REQUEST['placa'].' ORDEN No '.$arr_orden['orden'].' " >';
        }
        else
        {
          //echo '<input name="dequienoaquin" type="text"  id = "dequienoaquin" size="60%"  >';

            if(isset($_REQUEST['pago_proveedor']))
              {
                    
                    echo '<input name="dequienoaquin" type="text"  id = "dequienoaquin" size="60%"   
                    value = "'.$_REQUEST['nombre_proveedor'].' Factura '.$_REQUEST['factura'].' " >';
              }
              else
              {
                echo '<input name="dequienoaquin" type="text"  id = "dequienoaquin" size="60%"  >';
              }


        }//fin ed si no existe abono 
         


       ?>
      
    </label></td>
  <!--
  </tr>
  <tr>
    <td>LA SUMA DE (numeros sin puntos)</td>
    <td><input type="text" name="lasumade"  id = "lasumade" size="60%" class="fila_llenar"></td>
  </tr>
-->
  <tr>
      <td colspan="2">
      EFECTIVO <input type="text" id="efectivo" name = "efectivo" class="fila_llenar" placeholder="Efectivo">
      T. DEBITO <input type="text" id="t_debito" name = "t_debito" class="fila_llenar"  placeholder="T. Debito">
      T. CREDITO <input type="text" id="t_credito" name = "t_credito" class="fila_llenar" placeholder="T. Credito">

      
    </td>
    </tr>

  <tr>
    <td>POR CONCEPTO DE : </td>
    <?php
        if(isset($_REQUEST['abono'])&& $_REQUEST['tipo_recibo']==1)
        {
              
           echo '<input type="hidden" id="abono"  value="1">';
           echo  '<td><textarea name="porconceptode" id = "porconceptode" cols="80%" rows="2">PLACA'.$_REQUEST['placa'].' ORDEN No '.$arr_orden['orden'].'</textarea></td>';   
            
        }
        else
        {
          //echo  '<td><textarea name="porconceptode" id = "porconceptode" cols="80%" rows="2"></textarea></td>';
             if(isset($_REQUEST['pago_proveedor']))
              {
                    
                 echo '<input type="hidden" id="pago_proveedor"  value="1">';
                 echo  '<td><textarea name="porconceptode" id = "porconceptode" cols="80%" rows="2">ABONO FACTURA No '.$_REQUEST['factura'].' PROVEEDOR  '.$_REQUEST['nombre_proveedor'].'</textarea></td>';   
                  
              }
              else
              {
                echo  '<td><textarea name="porconceptode" id = "porconceptode" cols="80%" rows="2"></textarea></td>';
              }


        }//fin de else de si no es abono tipo 1


       
       ?>

       ?>



    
  </tr>
  <tr>
    <td>OBSERVACIONES</td>
    <td><textarea name="observaciones" id = "observaciones" cols="80%" rows="2"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><button type ="button"  id = "grabar_recibo" >
			      <h4>GRABAR_RECIBO</h4>
	      </button></td>
    </tr>
</table>
<?php 
}// fin de si es un tipo de recibo valido

include('../colocar_links2.php');
?>
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
					$("#grabar_recibo").click(function(){
							var data =  'fecha=' + $("#fecha").val();
							data += '&dequienoaquin=' + $("#dequienoaquin").val();
							data += '&porconceptode=' + $("#porconceptode").val();
							data += '&lasumade=' + $("#lasumade").val();
							data += '&observaciones=' + $("#observaciones").val();
							data += '&tipo_recibo=' + $("#tipo_recibo").val();
							data += '&numero_recibo=' + $("#numero_recibo").val();
              data += '&id_orden=' + $("#id_orden").val();
               data += '&abono=' + $("#abono").val();
               data += '&id_proveedor=' + $("#id_proveedor").val();
               data += '&pago_proveedor=' + $("#pago_proveedor").val();
               data += '&id_cxp=' + $("#id_cxp").val();
               data += '&efectivo=' + $("#efectivo").val();
               data += '&t_debito=' + $("#t_debito").val();
               data += '&t_credito=' + $("#t_credito").val();


							$.post('grabar_recibo_caja.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos2").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>
  





 


