<?php
session_start();
if($_SESSION['id_empresa']<1)
{ //is es menor que uno es porque la sesion ya se cayo
  echo 'SU SESION HA CADUCADO POR FAVOR INGRESE NUEVAMENTE ';

}
else
{ //pues si es mayor o igual que uno es porque la session esta activa 
  //y se puede facturar
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	<style type="text/css">
	body{
	background-color:orange;
	}
		
		#contenedor div{
		background-color:#FFCC33;
		text-align:center;
		margin:20px;
		padding:10px;
		border: 1px solid black;
		font-family:Verdana;
		font-size:15px;
		color:#0099CC;
		}
		
		
		.letra2{
		  color:black;
		  font-size:20px;
		}
		
	</style>
</head>
<body>
<?php 
include("../empresa.php");
include("../valotablapc.php");
$ancho_tabla = '50%';
$sql_clientes = "select * from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."'  order by nombre";
$consulta_clientes = mysql_query($sql_clientes,$conexion);
 ?>
<Div id="contenidos">
	<br>
	<h2>POR FAVOR INGRESE EL CLIENTE</h2>
	<div id="escoger" align ="center">
	<form name ="captura_ante" id="captura" action="captura_factura.php" method="post">
	<table width="606" border="0">
  <tr>
    <td width="219">ESCOJA EL CLIENTE </td>
    <td width="371"><label>
      <select name="idcliente" class="fila_llenar">
	  <option value= "">...</option>
	  <?php
	  while($clientes = mysql_fetch_assoc($consulta_clientes))
	  {
	     echo '<option value= "'.$clientes['idcliente'].'">'.$clientes['nombre'].'-'.$clientes['identi'].'</option>';
	  }
	  ?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="envio" type="hidden" value = "1" ></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <div align="center">
        <input type="submit" name="Submit" value="ENVIAR NOMBRE" class="letra2">
        </div>
    </label></td>
    </tr>
</table>
</form>
</div>
<BR>
<BR>
<h2>INGRESAR INFORMACION NUEVO CLIENTE </h2>
	<BR>
	<div id="crear_cliente" align="center">
	<form name = "captura"  action="captura_factura.php" method="post">
	<table width="439" border="0">
  <tr>
    <td width="150">IDENTIDAD</td>
    <td width="273">
      <input type="text" name="identicli" id = "identicli" size ="50" class="fila_llenar">   </td>
  </tr>
  <tr>
    <td>NOMBRE</td>
    <td><input type="text" name="nombrecli" id = "nombrecli" size ="50" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>DIRECCION </td>
    <td><input type="text" name="direccioncli" id = "direccioncli" size ="50" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>TELEFONO</td>
    <td><input type="text" name="telefonocli" id = "telefonocli" size ="50" class="fila_llenar"></td>
  </tr>
  <tr>
    <td>EMAIL</td>
    <td><input type="text" name="emailcli" id = "emailcli" size ="50" class="fila_llenar"></td>
  </tr>
  <tr>
    <td><input name="envio" type="hidden" value = "2" ></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <div align="center">
      
        <input type="button" value="Enviar Informacion Nuevo Cliente.." onClick="valida_envia()" size ="75%" class="letra2"></h1>
  
        </div>
    </label></td>
    </tr>
</table>
	</form>
	</div>
<?php  
}// fin de si se puede facturar osea de si id_empresa tiene valor 1 o mayor 
include('../colocar_links2.php');
?>
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script type="text/javascript">
function valida_envia(){ 
 
    //valido el nombre 
    if (document.captura.identicli.value.length==0){ 
        alert("Tiene que escribir un numero de identidad ") 
        document.captura.identicli.focus() 
        return 0; 
    } 
  
    ////////////////////////////el formulario se envia 
    alert("Muchas gracias por enviar el formulario"); 
    document.captura.submit(); 
  
  
}
</script>

