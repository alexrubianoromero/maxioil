<?php
require_once('CapturaOrden.class.php'); 
require_once('../clientes/modelo/ClientesModelo.class.php'); 
require_once('../tecnicos/modelo/TecnicosModelo.php'); 
require_once('../empresa/controlador/EmpresaController.php'); 
require_once('../vehiculos/modelo/VehiculosModelo.php'); 
// $formulario = new CapturaOrden();

class orden_captura_honda_nueva{
    private $formulario;
    private $clientes;
    private $tecnicos; 
    private $vehiculo;

    public function __construct(){
       $this->formulario =  new CapturaOrden();   
       $this->clientes = new ClientesModelo(); 
       $this->tecnicos = new TecnicosModelo(); 
       $this->empresa  = new EmpresaController(); 
       $this->vehiculo  = new VehiculosModelo(); 
    }
    
    public function mostrarFormulario($datos,$conexion)
    {   
        $datosCliente =  $this->clientes->traerDatosClienteId($datos['propietario'],$conexion);    
        // echo '<pre>';
        // print_r($datosCliente);
        // echo '</pre>';
        // die();
        
        ?>
            <!DOCTYPE html>
            <html lang="es"  class"no-js">
                <head>
                    <meta charset="UTF-8">
                    <title>Orden Captura Nueva  </title>
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../css/bootstrap.min.css">
                </head>
        <body>
            <div id="div_total">
                <div class="row">
                    <div class="col-sm-12 col-md-6 linea" align="left">
                        <?php echo $this->formulario->infoMoto($datos) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 linea" align="left">
                     <?php  echo $this->formulario->infoPersona($datosCliente) ?>
                    </div>
                </div> 
                <div align="center">
                  <button onclick="traertecnicos();"class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#myModal" >
                    CREAR ORDEN
                  </button>
                </div>
            </div>
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Crear Orden de Trabajo</h4>
            </div>
            <div class="modal-body">
                
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary "  onclick= "grabarordenMovil()">Grabar Orden</button>
            </div>
          </div>
         </div>
       </div>

        </body>
        </html>
        <?php
      
    }
}
?>