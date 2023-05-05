<?php

?>
<div></div>
<div align ="center " id="div_general">
    <br><br>
  
        <input type="hidden" id="usuario" value ="<?php  echo $_REQUEST['username']?>">
        <input type="hidden" id="clave" value ="<?php  echo $_REQUEST['clave']?>">


                <!-- <button class = "btn btn-primary bontonesmenu" id="btn_operaciones" onclick="pantallaOperaciones();"><span align="left">MOTOS<span> <i class="fas fa-dolly fa-align-right"></i> -->
                <!-- <button class = "btn btn-primary bontonesmenu" id="btn_operaciones" onclick="pantallaOperaciones();"><span align="left">MOTOS<span> <i class="fas fa-car"></i> -->
                <button class = "btn btn-primary bontonesmenu" id="btn_referencias" onclick="pantallaClientes();">CLIENTES 
                        <!-- <i class="fas fa-layer-group"></i> -->
                        <i class="far fa-user"></i>
                </button>
                <br><br>
                <button class = "btn btn-primary bontonesmenu" id="btn_operaciones" onclick="pantallaOperaciones();"><span align="left">MOTOS<span> 
                        <i class="fas fa-biking"></i>
                </button>

<br><br>
        <button class = "btn btn-primary bontonesmenu" id="btn_pedidos" onclick="btn_pedidos_actual();">ORDENES 
                <!-- <i class="fas fa-boxes"></i> -->
                <i class="fas fa-tools"></i>
        </button>
        <br><br>
        
        <button class = "btn btn-default bontonsalir" id="btn_salir" onclick="salir();">SALIR <i class="fas fa-sign-out-alt"></i></button>
</div>
    

<?php
//     include('footer.php');
?>