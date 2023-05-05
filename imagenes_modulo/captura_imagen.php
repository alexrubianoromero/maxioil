<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
?>
<style type="text/css">
.style1 {
	color: black;
	margin-left: 10px;
	font-size: 30px;
  }
</style>

<br>
<br>
<span class="style1">CARGAR IMAGEN</span> 
<form method="post" enctype="multipart/form-data" action="subir_imagen.php">
 <input id="txt_codigo" type="hidden" name="codigo" value = "<?php echo $_REQUEST['idorden']; ?>" ><br />
 <table border = "0">
 <tr>
 <td><span class="style1">Descripcion: </span></td>
 <td><input id="txt_descripcion" type="text" name="descripcion" class="style1" value = "<?php echo $_REQUEST['placamasorden']; ?>" onfocus="blur()"></td>
 </tr>
 <tr>
 <td><span class="style1">Imagen</span></td><td><input id="file_url" type="file" name="foto" class="style1"></td>
 <tr>
    </tr>
  <td  colspan="2"><span class="style1"><input type="submit" value="Guardar" class="style1"> </span></td>
</tr>
 </table> 
</form>