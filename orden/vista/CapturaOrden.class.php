<?php

Class CapturaOrden{

   public function infoMoto($datosMoto){
        ?>
          <table border="0" class="table">
                     <tr>
                         <td><label>Placa:</label></td>
                         <td><?php echo strtoupper($datosMoto['placa']) ?></td>
                         <td><label>Marca:</label></td>
                         <td><?php echo strtoupper($datosMoto['marca']) ?></td>
                     </tr>
                     <!-- <tr>
                     </tr> -->
                     <tr>
                         <td><label>Linea:</label></td>
                         <td><?php echo strtoupper($datosMoto['tipo']) ?></td>
                         <td><label>Modelo:</label></td>
                         <td><?php echo strtoupper($datosMoto['modelo']) ?></td>
                     </tr>
                     <!-- <tr>
                     </tr> -->
                     <tr>
                         <td><label>Color:</label></td>
                         <td><?php echo strtoupper($datosMoto['color']) ?></td>
                     </tr>
                  </table>
        <?php
    }
  
    public function infoPersona($datosCliente){
          ?>
           <table border="0" class="table">
                      <tr>
                          <td> <label>Nombre:</label></td>
                          <td><?php echo  strtoupper($datosCliente['nombre']); ?></td>
                      </tr>
                      <tr></label>
                          <td><label>Cedula:</label></td>
                          <td><?php echo  $datosCliente['identi']; ?></td>
                      </tr>
                      <tr>
                          <td><label>Direccion:</label></td>
                          <td><?php echo  strtoupper($datosCliente['direccion']); ?></td>
                      </tr>
                      <tr>
                          <td><label>Telefono:</label></td>
                          <td><?php echo  $datosCliente['telefono']; ?></td>
                      </tr>
                      <tr>
                          <td colspan="2"><?php echo  $datosCliente['email']; ?></td>
                      </tr>
                    
                  </table>
          <?php
    }
}

?>