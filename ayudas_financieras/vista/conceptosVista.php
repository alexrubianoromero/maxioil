<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/vista/vista.php');

class conceptosVista extends vista
{
    public function menuPrincipalConceptos($conceptos = [])
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
            <div>
                <div>
                    <div class="row">
                        <button 
                            class="btn btn-primary"
                            data-toggle="modal" data-target="#myModaNuevoConcepto"
                            onclick="formuNuevoConcepto();">NUEVO</button>
                    </div>
                </div>
                <div id="divResultadosConceptos">
                        <?php   $this->mostrarConceptos($conceptos);   ?>
                </div>
            </div>
            <?php  $this->modalNuevoConcepto();  ?>
        </body>
        </html>

        <?php
    }
    public function modalNuevoConcepto()
    {
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModaNuevoConcepto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Conceptos</h4>
                  </div>
                  <div id="cuerpoModalNuevoConcepto" class="modal-body" style="color:black">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal" 
                        onclick="pantallaConceptos();"
                      >Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }

    public function formuNuevoConcepto()
    {
        ?>
            <div>
                <div class = "form-group">
                    <div class = "col-xs-3">
                         <label for="">Concepto:</label>   
                    </div>
                    <div class="col-xs-9">
                        <input class ="form-control" type="text" id="txtConcepto">
                    </div>
                </div>
                <div>
                    <button 
                        class = "btn btn-primary"
                        onclick="grabarConcepto();"
                    >Grabar Concepto</button>
                </div>
            </div>
        <?php       
    }
    public function mostrarConceptos($conceptos)
    {
        $this->draw_table($conceptos); 
    }
}
?>