<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/vista/vista.php');
class TecnicosVista extends vista 
{


    public function pantallaprincipalTecnicos($tecnicos = [])
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div id="divPrincipalTecnicos"> 
                <div>
                    <button 
                        class = "btn btn-primary"
                        data-toggle="modal" data-target="#myModalTecnicosForm"
                        onclick="formuNuevoTecnico(); "
                    >NUEVO</button>
                </div>
                <div>
                   <table class="table">
                    <thead>
                        <tr>
                            <td>Cedula</td>
                            <td>Nombre</td>
                            <td>Telefono</td>
                            <td>Labor</td>
                            <td>%</td>
                            <td>Eliminar</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($tecnicos as $tecnico)
                            {
                                echo '<tr>';
                                echo '<td><button 
                                    class = "btn btn-primary"
                                    data-toggle="modal" data-target="#myModalTecnicos"
                                    onclick = "editarTecnico('.$tecnico['idcliente'].')"; 
                                >';
                                echo $tecnico['identi'];
                                echo '</button></td>';
                                echo '<td>'.$tecnico['nombre'].'</td>';
                                echo '<td>'.$tecnico['telefono'].'</td>';
                                echo '<td>';
                                $cargo = '';
                                if($tecnico['idlabor']=='1')
                                {
                                   $cargo = 'Mecanico';     
                                }
                                if($tecnico['idlabor']=='2')
                                {
                                   $cargo = 'Lavador';     
                                }
                                echo $cargo; 
                                echo '</td>';
                                echo '<td>'.$tecnico['porcentaje_nomina'].'</td>';
                                echo '<td><button
                                        class = "btn btn-primary"
                                        data-toggle="modal" data-target="#myModalTecnicos" 
                                        onclick = "eliminarTecnico('.$tecnico['idcliente'].')">Eliminar</button></td>';
                                echo '</tr>';
                            }

                         ?>   
                    </tbody>
                   </table>
                </div>
            </div>
            <?php  $this->modalTecnicos();  ?>
            <?php  $this->modalTecnicosForm();  ?>
            
        </body>
        </html>
        <?php
    }

    
    public function modalTecnicos ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalTecnicos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Tecnico</h4>
                  </div>
                  <div id="cuerpoModalTecnicos" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pantallaTecnicos12();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalTecnicosForm ()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalTecnicosForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Tecnico</h4>
                  </div>
                  <div id="cuerpoModalTecnicosForm" class="modal-body" style="color:black;">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pantallaTecnicos12();">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }

    public function mostrarTecnicos($arregloTecnicos){
        $arreglo = '';
        $i=0;
        echo '<select id="">';
            while($tecnicos = mysql_fetch_assoc($arregloTecnicos))
            {
                //  $arreglo[$i]['idcliente'] =   $tecnicos['idcliente']; 
                //  $arreglo[$i]['nombre'] =   $tecnicos['nombre']; 
                echo '<option value = "'.$tecnicos['idcliente'].'"  >'.$tecnicos['nombre'].'</option>';
            }
            echo '</select>';
            // echo '<pre>';
            // print_r();
            // echo '</pre>';
    }

    public function pantallaDatosTecnico($tecnico)
    {
        echo $tecnico['nombre'];


    }
    public function formuNuevoTecnico($tecnico=[])
    {
        
        ?>
            <input type="hidden"  id="idcliente" value = "<?php echo $tecnico['idcliente'];  ?>">
            <div>
                <div class = "form-group">
                    <div class = "col-xs-3">
                         <label for="">Cedula:</label>   
                    </div>
                    <div class="col-xs-9">
                        <input class ="form-control" type="text" id="txtCedula" value = "<?php  echo $tecnico['identi']  ?>">
                    </div>
                </div>
                <div class = "form-group">
                    <div class = "col-xs-3">
                         <label for="">Nombre:</label>   
                    </div>
                    <div class="col-xs-9">
                        <input class ="form-control" type="text" id="txtNombre" value = "<?php  echo $tecnico['nombre']  ?>">
                    </div>
                </div>
                <div class = "form-group">
                    <div class = "col-xs-3">
                         <label for="">Telefono:</label>   
                    </div>
                    <div class="col-xs-9">
                        <input class ="form-control" type="text" id="txtTelefono" value = "<?php  echo $tecnico['telefono']  ?>">
                    </div>
                </div>
                <div class = "form-group">
                    <div class = "col-xs-3">
                         <label for="">Labor:</label>   
                    </div>
                    <div class="col-xs-9">
                        <select  
                            id="idLabor"
                            class ="form-control" 
                        >
                            
                            <option value="0">...</option>
                        
                            <option 
                                value="1" <?php if($tecnico['idlabor'] == 1) {echo 'selected';} ?> 
                            >Mecanico</option>
                            <option value="2" <?php if($tecnico['idlabor'] == 2 ) {echo 'selected';} ?>>Lavador</option>
                        
                        </select>
                    </div>
                </div>
                <div class = "form-group">
                    <div class = "col-xs-3">
                         <label for="">Porcentaje:</label>   
                    </div>
                    <div class="col-xs-4">
                        <input class ="form-control" type="text" id="txtPorcentaje" placeholder ="%" 
                        value = "<?php  echo $tecnico['porcentaje_nomina']  ?>"
                        >
                    </div>
                    <div class="col-xs-5"></div>
                </div>

                <div>
                    <?php  
                    if($tecnico['idcliente']>0)
                        {
                            echo '<button 
                                    class = "btn btn-primary"
                                    onclick="actualizarInfoTecnico();"
                                    >
                                    Actualizar
                                    </button>';

                        }
                        else{
                    
                    echo '<button 
                            class = "btn btn-primary"
                            onclick="grabarTecnico();"
                            >
                            Grabar
                            </button>';
                        }    
                    ?>
                        

                </div>
            </div>
        <?php       
    }
}





?>