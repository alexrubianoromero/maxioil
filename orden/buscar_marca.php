<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

$sql_traer_codigos = "select * from $tabla12 where marca like '%".$_REQUEST['descricodigo']."%'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_codigos = mysql_query($sql_traer_codigos,$conexion);

echo "<select name='marca_a_escoger' id='marca_a_escoger' class='fila_llenar' multiple= 'multiple' >";
  echo "<option value='' selected>...</option>";     
  while($codigos = mysql_fetch_assoc($consulta_codigos))
      {
             echo '<h2><option value= '.$codigos['codigo_producto'].'>'.$codigos['marca'].'-'.$codigos['codigo_producto'].'-'.$codigos['descripcion'].'</h2></option>';
        }
   echo "</select>";
?>


<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
    $(document).ready(function(){
               /////////////////////////
          $("#marca_a_escoger").change(function(){
            var codigo = $("#marca_a_escoger").val();  
              var data1 ='codigopan=' + codigo;
                $.post('traer_marca_descripcion.php',data1,function(b){
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
           


