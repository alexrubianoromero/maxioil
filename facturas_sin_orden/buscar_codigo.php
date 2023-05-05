<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

$sql_traer_codigos = "select * from $tabla12 where descripcion like '%".$_REQUEST['descricodigo']."%'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_codigos = mysql_query($sql_traer_codigos,$conexion);
/*
echo '<table border="1" width="75%">';
 echo '<tr>';
  echo '<td></td>';
    echo '<td>CODIGO</td>';
	  echo '<td>DESCRIPCION</td>';
	    echo '<td>PRECIO</td>';
		  echo '<td>CANTIDAD</td>';
   echo '</tr>';
while($codigos = mysql_fetch_assoc($consulta_codigos))
{
  echo '<tr>';
  echo '<td></td>';
  echo '<td>'.$codigos['codigo_producto'].'</td>';
  echo '<td>'.$codigos['descripcion'].'</td>';
  echo '<td>'.$codigos['valorventa'].'</td>';
   echo '<td>'.$codigos['cantidad'].'</td>';
  echo '</tr>';
  
}
echo '</table>';
*/
echo "<select name='codigo_a_escoger' id='codigo_a_escoger' class='fila_llenar' multiple= 'multiple' >";
  echo "<option value='' selected>...</option>";     
  while($codigos = mysql_fetch_assoc($consulta_codigos))
      {
             echo '<h2><option value= '.$codigos['codigo_producto'].'>'.$codigos['codigo_producto'].'-'.$codigos['descripcion'].'</h2></option>';
        }
   echo "</select>";
?>


<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
    $(document).ready(function(){
               /////////////////////////
          $("#codigo_a_escoger").change(function(){
            var codigo = $("#codigo_a_escoger").val();  
              var data1 ='codigopan=' + codigo;
                $.post('traer_codigo_descripcion.php',data1,function(b){
                    $("#codigopan").val(codigo);
                    $("#descripan").val(b[0].descripcion);
                    $("#valor_unit").val(b[0].valor_unit);
                     $("#costo_producto").val(b[0].costo_producto);
                    $("#exispan").val(b[0].existencias);
                    $("#cantipan").val('');
                    $("#cantipan").focus();
                    $("#totalpan").val(0);
                 //(data1);
                },
                'json');
              $("#busqueda_codigos").css("display","none");  
          });
        ///////////////////////
      });   ////finde la funcion principal de script  
</script>
           


