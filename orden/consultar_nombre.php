<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
$sql_clientes = "select * from $tabla3 where nombre like '%".$_REQUEST['nombre']."%' order by nombre";
//echo '<br>'.$sql_clientes;
$consulta_clientes = mysql_query($sql_clientes,$conexion);

echo '<select id="propietario123" size="10" >';

while($clientes = mysql_fetch_assoc($consulta_clientes))
	{
		if($clientes['idcliente']=='1125')
		{
			//echo '<option value="'.$clientes[idcliente].'" selected >'.$clientes['nombre'].'  </option>';
		}
		else
		{
			echo '<option value="'.$clientes[idcliente].'" >'.$clientes['nombre'].'-'.$clientes['identi'].'  </option>';
		}
	}
echo '</select>';

?>


<script language="JavaScript" type="text/JavaScript">
    $(document).ready(function(){
		/////////////
		
			$("#propietario123").change(function(){
            var valor=$("#propietario123").val();
            var texto=$("#propietario123 option:selected").text();
            $("#propietario").val(valor);
			$("#nombre_propietario").val(texto);
			$("#div_propietario").css("display","none")
        	});
	   //////////////////	
		
    });
</script>
