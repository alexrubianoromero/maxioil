<?php
include('../valotablapc.php');  
session_start();
 function  consulta_assoc_codigo($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }


$datos_codigo = consulta_assoc_codigo($tabla12,'id_codigo',$_REQUEST['id_codigo'],$conexion);


?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Codigos</title>
 <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div id="1234" align="center">	
	<input type="hidden"  id="id_codigo"  value = "<?php echo $_REQUEST['id_codigo'];  ?>"  >
<h3>ELIMINAR CODIGO</h3>
<br><br>
<table border = "1">
<tr>
   <td>CODIGO</td>
   <td>DESCRIPCION</td>
   <td>RERERENCIA</td>
</tr>	
<tr>
  <?php
    echo '<td>'.$datos_codigo ['codigo_producto'].'</td>';
    echo '<td>'.$datos_codigo ['descripcion'].'</td>';
    echo '<td>'.$datos_codigo ['referencia'].'</td>';
  ?>
</tr>

</table>	
<br><br>
<button  id="btn_eliminar_codigo">ELIMINAR_CODIGO</button>
</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>  
<script type="text/javascript">
  $(document).ready(function(){
  			$("#btn_eliminar_codigo").click(function(){

							var data =  'id_codigo=' + $("#id_codigo").val();
							 // data += '&buscarcodigo=' + $("#buscarcodigo").val();
							$.post('eliminacion_codigo.php',data,function(a){
							      $("#1234").html(a);

							});	

  		 });

  }); //fin funcion principal
 
</script>  	 