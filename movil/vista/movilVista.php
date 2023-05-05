<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/movil/model/UsuarioModel.php');
require_once($raiz.'/movil/model/EmpresaModel.php');
class movilVista{
  private $empresaModel;   
  public function __construct()
  {
    session_start();
    $this->empresaModel = new EmpresaModel(); 
    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';
  } 
  public function pantallaLogueo()
  {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <!--<meta charset="UTF-8">-->
            <meta http-equiv=?Content-Type? content=?text/html; charset=UTF-8? />
            <!--<meta http-equiv=?Content-Type? content=?text/html; charset=ISO-8859-1? />-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kaymo</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">  
        <script src="https://kit.fontawesome.com/6f07c5d6ff.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/estilo.css">
        
        <?php  header("Content-Type: text/html;charset=utf-8"); ?>
        <style>
            #divBotonesPrincipales{
                display:none;
            }
        </style>
    </head>
    <body class="fondoPrograma">
        <div id="divTotal" align="center" class="container">
            <input type="hidden" id="id_usuario" style="color:black">
             <input type="hidden" id="usuario" style="color:black">
            <input type="hidden" id="nivel"  style="color:black">
        <div id="imagenInicial" >
            <img class="imagenesinicio" src="imagen/logonuevo.png">
        </div>
        <p id="slogankaymo">TECNOLOGIA VERDADERA</p>
        <div id="divBotonesPrincipales">


            <button onclick="menuPrincipal();" class = "bontonesmenuinternos"> MENU PRINCIPAL
            <i class="fas fa-bars"></i>
        </button>
        </div>
        <div  id = "div_principal" align="center" >
            
            
            
            <?php  $this->htmlLogueo(); ?>
            <!-- <img src="planeta.png"> -->
            
        </div>
        
    </div>
        
    
    
    </body>
    </html>
    <script src="js/jquery-2.1.1.js"></script>       
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/nuevo.js"></script>
    <script src="../orden/js/orden.js"></script>
    <script src="../clientes/js/clientes.js"></script>
    <script src="../vehiculos/js/vehiculos.js"></script>
    <script src="../inventario_codigos/js/codigosInventario.js"></script>
    <script src="../inventario_codigos/js/movimientos.js"></script>
    <script src="../caja/js/caja.js"></script>
    <script src="../tecnicos/js/tecnicos.js"></script>
    <script src="../ayudas_financieras/js/ayudasfinancieras.js"></script>
    <script src="../ayudas_financieras/js/conceptos.js"></script>
    <script src="../ventas/js/ventas.js"></script>
    <?php
  }
  public function htmlLogueo(){
     echo $sinpermisos;
     ?>
        <!--             <img class="imagenesinicio" src="Logo.png">-->
        <div id="div_abajo">
            <br><br>
            <div id="div_titulo ">
                <!-- <img id="imagenlogo" src="Logo.png"> -->
            </div>  
            <!-- <img src="planeta.png"> -->
            <div class="row" id="div_botones_inicio"> 
                <div class = "form_group ">
                    <input value="" type = "text" class = "form-control botoninicio " id="txtUsuario" placeholder = "Usuario" > 
                </div>
                <br><br><br>
                <div class = "form_group ">
                    <input  value="" type = "password" class = "form-control botoninicio" id="txtClave" placeholder = "Clave"> 
                </div>
                <br><br><br><br>
                <div class = "form_group ">
                    <!-- <button onclick ="menuPrincipal();"  id = "btn_ingresar" class = "btn btn-primary btn-block bontoningresar ">INGRESAR</button>  -->
                    <button onclick ="verifiqueCredeciales();"  id = "btn_ingresar" class = "btn btn-primary btn-block bontoningresar ">INGRESAR</button> 
                                                
                </div>
            </div>  
        </div>   
        <?php
    }  
    public function menuPrincipal($request)
    {
        // echo '<pre>'; 
        // print_r($request['nivel']); 
        // echo '</pre>';
        // die(); 
        ?>
            <br><br>
            
           
            <?php
            //esta funcion me trae la info de empresa 
            //con el campo recibe_tarjetas == 1 se mostrara el modulo de ventas 
            $infoEmpresa = $this->empresaModel->traerInfoEmpresa();
        //     echo '<pre>'; 
        // print_r($infoEmpresa); 
        // echo '</pre>';
        // die(); 
            if($_SESSION['nivel'] > 2 || $request['nivel']>2)
            {
                if($infoEmpresa['recibe_tarjetas']==1)
                {
                    echo   '<button class = "btn btn-primary bontonesmenu"  onclick="pantallaVentas();">VENTAS
                        <i class="fas fa-list"></i>
                    </button>';
                }

            }  

            
            if($_SESSION['nivel'] > 2 || $request['nivel']>2)
            {
              echo   '<button class = "btn btn-primary bontonesmenu"  onclick="pantallaAyudasFinancieras();">AYUDAS FINANCIERAS 
              </button>';
            //   <i class="fas fa-list"></i>
              
            }  
            
            if($_SESSION['nivel'] > 2 || $request['nivel']>2)
            {
                echo '<br><br>';
                echo '<button class = "btn btn-primary bontonesmenu"  onclick="pantallaClientes();">CLIENTES 
                    <i class="far fa-user"></i>
                </button>';
            }    
            
            if($_SESSION['nivel'] > 2 || $request['nivel']>2)
            {
                echo     '<br><br>';
             echo '<button class = "btn btn-primary bontonesmenu"  onclick="pantallaMotos();"><span align="left">MOTOS<span> 
                    <i class="fas fa-biking"></i>
                </button>';
            }    
                
            echo  '<br><br>';

            echo    '<button class = "btn btn-primary bontonesmenu"  onclick="pantallaOrdenes();">ORDENES 
                    <!-- <i class="fas fa-boxes"></i> -->
                    <i class="fas fa-tools"></i>
                </button>';
                if($_SESSION['nivel'] > 2 || $request['nivel']>2 )
                {
                echo    '<br><br>';
             echo    '<button class = "btn btn-primary bontonesmenu"  onclick="pantallaInventario();">INVENTARIOS 
                    <i class="fas fa-list"></i>
                </button>';
            }

            
            if($_SESSION['nivel'] > 2 || $request['nivel']>2)
            {
                 echo    '<br><br>';
                echo     '<button class = "btn btn-primary bontonesmenu"  onclick="pantallaTecnicos();">TECNICOS
                            <!-- <i class="far fa-user"></i> -->
                    </button>';
             }       
             echo    '<br><br>';

            echo        '<button 
                        class = "btn btn-primary bontonesmenu"  
                        data-toggle="modal" data-target="#myModalCambioClave"
                        onclick="preguntarNuevaClave('.$_SESSION['id_usuario'].');"
                    >
                    CAMBIO DE CLAVE
                            <!-- <i class="far fa-user"></i> -->
                    </button>';
            echo     '<br><br>';
                
            echo    '<button class = "btn btn-default bontonsalir" id="btn_salir" onclick="salirSistema();">SALIR <i class="fas fa-sign-out-alt"></i></button>
            </div>';

            $this->modalCambioClave();
  }   

  public function modalCambioClave(){
    ?>
     <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
     Launch demo modal
     </button> -->
      <div style="color:black;" class="modal fade " id="myModalCambioClave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header" id="headerNuevoCliente">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Cambio de Clave </h4>
              </div>
              <div id="cuerpoModalCambioClave" class="modal-body">
              </div>
              <div class="modal-footer" id="footerNuevoCliente">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
              </div>
          </div>
      </div>
    <?php
}

public function preguntarNuevaClave($request)
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
    <div style="color:black;">
    <input type="hidden" id="input_id_usuario" value="<?php   echo $request['idUsuarioSessionStorage']  ?>">

    <div class ="form-group">
      
        <div class="col-xs-12">
            <input type = "text" id="txtClaveAnterior" class="form-control" placeholder="Clave Anterior">
        </div>
    </div>

    <br><br>
    <div class ="form-group">
 
        <div class="col-xs-12">
            <input type = "text" id="txtNuevaClave" class="form-control" placeholder="Clave Actual">
        </div>
    </div>
    <button class="btn btn-primary" onclick="actualizarClave();">Actuallizar Clave</button>
    </div> 
</body>
</html>
<?php
}
  
}