<?php

$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/vista/vista.php');

class CLientesVista extends vista
{







    public function pantallaInicialClientes(){

        ?>

        <!DOCTYPE html>

         <html lang="en">

         <head>

             <meta charset="UTF-8">

             <meta http-equiv="X-UA-Compatible" content="IE=edge">

             <meta name="viewport" content="width=device-width, initial-scale=1.0">

             <link rel="stylesheet" href="../css/bootstrap.min.css">  

             <link rel="stylesheet" href="../css/estilosresponsivos.css">  

             <link rel="stylesheet" href="../../movil/css/estilo.css">  

             <title>Document</title>

         </head>

         <body class="fondoPrograma">
         <div id="div_clientes" class="container"  align="center">
             <div id=" row divBotonesClientes">
                 <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">
                     CLIENTES..
                 </div>
                 <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">
                     <button class="btn btn-primary" onclick="btnNuevoPropietario();"  data-toggle="modal" data-target="#myModalClientes">Nuevo</button>
                    </div>
                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <!-- <button class="btn btn-primary" onclick="mostrarClientes();">Listar</button> -->
                    </div>
             </div>

             <div align = "center" id="divResultadosClientes">

              

             </div>

             <?php  $this->modalClientes(); ?>   

         </div>

         </body>

         </html>

         <script src = "../js/jquery-2.1.1.js"> </script>    

         <script src="../js/bootstrap.min.js"></script>

         <script src="../clientes/js/clientes.js"></script>
         <script src="../vehiculos/js/vehiculos.js"></script>

     <?php           

    }
    public function pantallaInicialClientesNew($clientes){

        ?>

        <!DOCTYPE html>

         <html lang="en">

         <head>

             <meta charset="UTF-8">

             <meta http-equiv="X-UA-Compatible" content="IE=edge">

             <meta name="viewport" content="width=device-width, initial-scale=1.0">

             <link rel="stylesheet" href="../css/bootstrap.min.css">  

             <link rel="stylesheet" href="../css/estilosresponsivos.css">  

             <link rel="stylesheet" href="../../movil/css/estilo.css">  

             <title>Document</title>

         </head>

         <body class="fondoPrograma">

         <div id="div_clientes" class="container"  align="center">

             <div id=" row divBotonesClientes">

                 <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12">

                     <i class="fas fa-search" 
                            onclick="busquedaAvanzada();"  
                            style="font-size:30px;" 
                            data-toggle="modal" data-target="#myModalClientesFiltro" 
                            ></i>
                    
                     <input 
                        type="text" 
                        id="txtBuscarNombre" 
                        placeholder="Nombre" 
                        style="color:black; font-size:20px;" 
                        onkeyup="buscarClientePorNombre();"
                        size = "10px"
                        >

                 </div>

                 
                 <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-6">
                     
                     <button class="btn btn-primary" onclick="btnNuevoPropietario();"  data-toggle="modal" data-target="#myModalClientes">Nuevo</button>
                </div>
                     
                <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-6">
                         <!-- <button class="btn btn-primary" onclick="mostrarClientes();">Listar</button> -->
                </div>

             </div>

             <div align = "center" id="divResultadosClientes">

              <?php $this->verClientes($clientes);    ?>

             </div>

             <?php  $this->modalClientes(); ?>   
             <?php  $this->modalClientesInfo(); ?>   
             <?php  $this->modalClientesHisto(); ?>   
             <?php  $this->modalClientesFiltro(); ?>   

             

         </div>

         </body>

         </html>

         <script src = "../js/jquery-2.1.1.js"> </script>    

         <script src="../js/bootstrap.min.js"></script>

         <script src="../clientes/js/clientes.js"></script>

     <?php           

    }

    public function modalClientes (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Informacion</h4>
                  </div>
                  <div id="cuerpoModalClientes" class="modal-body">
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
    public function modalClientesInfo (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalClientesInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Informacion</h4>
                  </div>
                  <div id="cuerpoModalClientesInfo" class="modal-body">

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
    public function modalClientesHisto (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalClientesHisto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Informacion Historial</h4>
                  </div>
                  <div id="cuerpoModalClientesHisto" class="modal-body">

                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
          <script src="../clientes/js/clientes.js"></script>
        <?php
    }
    public function modalClientesFiltro (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade " id="myModalClientesFiltro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevoCliente">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Filtros de busqueda </h4>
                  </div>
                  <div id="cuerpoModalClientesFiltro" class="modal-body">

                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
          <script src="../clientes/js/clientes.js"></script>
        <?php
    }



    public function verClientes($clientes){
        // echo '<pre>';
        // print_r($clientes);
        // echo '</pre>';
        if($clientes['filas']>0)
        {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>IDENTI</th>
                        <th>NOMBRE</th>
                        <th>TELEFONO</th>
                        <th>WatsApp</th>
                        <!-- <th>DIRECCION</th>
                        <th>EMAIL</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($clientes['datos'] as $cli){
                            echo '<tr>';
                            echo '<td><button  class ="btn btn-default btn-sm" 
                                                data-toggle="modal" data-target="#myModalClientesInfo" 
                                                onclick ="pantallaBusdqueda('.$cli['idcliente'].');"
                                                size="3px"
                                                >';
                            echo strtoupper($cli['identi']);
                            echo '</button></td>';
                            echo '<td>'.strtoupper($cli['nombre']).'</td>';
                            echo '<td>'.strtoupper($cli['telefono']).'</td>';
                            echo '<td><a href="https://web.whatsapp.com/" target="_blank"><img src="../logos/iconowatsapp.jpg" width="25px"></a></td>';
                            // echo '<td>'.strtoupper($vehi['direccion']).'</td>';
                            // echo '<td>'.$vehi['email'].'</td>';
                            echo '</tr>';
                        }
                        ?>
                </tbody>
            </table>
            <?php
        }

    }



    public function nuevoPropietario(){

        ?>

        <div id="div_pregunte_datos_propietario">

            <div id="infoVerificaciones"></div>

            <table class="table">

                <tr>

                    <td><label>Identidad</label></td>

                    <td> <input type="text" id="identi" onchange="validarIdentidad(this.value)"></td>

                </tr>

                <tr>

                    <td><label>Nombre</label></td>

                    <td> <input type="text" id="nombre"></td>

                </tr>

                <tr>

                    <td><label>Telefono</label></td>

                    <td> <input type="text" id="telefono"></td>

                </tr>

                <tr>

                    <td><label>Direccion</label></td>

                    <td> <input type="text" id="direccion"></td>

                </tr>

                <tr>

                    <td><label>Email</label></td>

                    <td> <input type="text" id="email"></td>

                </tr>

                <tr>
                    <!-- <td><label>Observaciones</label></td> -->
                    <td> <input type="hidden" id="observaciones" value="Sin Info"></td>
                </tr>

                <tr>

                    <td colspan="2"> <button onclick="grabarPrpietario();"class="btn btn-primary btn-block btn-lg" ">GRABAR PROPIETARIO</button></td>

                </tr>

            </table>

            </div>

        <?php

    }    

    public function nuevoPropietarioDesdeVehiculo(){

        ?>

        <div id="div_pregunte_datos_propietario">

            <div id="infoVerificaciones"></div>

            <table class="table">

                <tr>

                    <td><label>Identidad</label></td>

                    <td> <input type="text" id="identi" onchange="validarIdentidad(this.value)"></td>

                </tr>

                <tr>

                    <td><label>Nombre</label></td>

                    <td> <input type="text" id="nombre"></td>

                </tr>

                <tr>

                    <td><label>Telefono</label></td>

                    <td> <input type="text" id="telefono"></td>

                </tr>

                <tr>

                    <td><label>Direccion</label></td>

                    <td> <input type="text" id="direccion"></td>

                </tr>

                <tr>

                    <td><label>Email</label></td>

                    <td> <input type="text" id="email"></td>

                </tr>

                <tr>

                    <td><label>Observaciones</label></td>

                    <td> <input type="text" id="observaciones"></td>

                </tr>

                <tr>

                    <td colspan="2"> <button onclick="grabarPropietarioDesdeVehiculos();"class="btn btn-primary btn-block btn-lg" ">GRABAR PROPIETARIO</button></td>

                </tr>

            </table>

            </div>

        <?php

    }    


    public function propietarioGrabado(){
        echo '<div class= "avisoGrabado">La informacion del propietario se guardo de forma exitosa</div>';
    }

    public function muestreInfoCliente($infoCLiente,$vehiculos)
    {
        ?>
        <div  style="color:black;">
            <div class="row form-group">

                <div class="col-xs-3" align="left">
                    <label for="">Identidad</label>
                </div>
                <div class="col-xs-9" align="left">
                     <?php  echo  $infoCLiente['identi'] ?>
                </div>
            </div>
            <div class="row form-group">
            <div class="col-xs-3" align="left">
                    <label for="">Nombre</label>
                </div>
                <div class="col-xs-9" align="left">
                     <?php  echo  $infoCLiente['nombre'] ?>
                </div>
                </div>
            <div class="row form-group">
            <div class="col-xs-3" align="left">
                    <label for="">Telefono</label>
                </div>
                <div class="col-xs-9" align="left">
                     <?php  echo  $infoCLiente['telefono'] ?>
                </div>
                </div>
            <div class="row form-group">
            <div class="col-xs-3" align="left">
                    <label for="">Email</label>
                </div>
                <div class="col-xs-9" align="left">
                     <?php  echo  $infoCLiente['email'] ?>
                </div>
                </div>
            <div class="row form-group">    
            <div class="col-xs-3" align="left">
                    <label for="">Direccion</label>
                </div>
                <div class="col-xs-9" align="left">
                     <?php  echo  $infoCLiente['direccion'] ?>
                </div>
            </div>

            <div>
                <label>VEHICULOS CLIENTE</label>
                <div id="divHistorialVehiculos"></div>
                <div>
                        <?php $this->mostrarVehiculosCliente($vehiculos);   ?>
                </div>
            </div>

        </div>

        <?php
    }

    public function mostrarVehiculosCliente($vehiculos)
    {
            // echo 'vista vehiculos<pre>';
            //   print_r($vehiculos);
            //   echo '</pre>';
            //   die();

            //////////////


            ///////////
        echo '<div style="color:black;">';
        echo '<table class ="table">';
        foreach($vehiculos as $vehiculo)
        {
            $placa = $vehiculo['placa'];
            // echo '<input type = "hidden" value ="'.$placa.'" id="txtplaca">';
            echo '<tr>'; 
            echo '</tr>';
            echo '<td>';
            echo '
            <button 
            data-toggle="modal" data-target="#myModalClientesHisto"
            class ="btn btn-primary"
            onclick = "muestreHistorialVehiculo(\''.$placa.'\');"
            
            >';
            
            // onclick = "muestreHistorialVehiculo('.$placa.');"
            //////////////
            // echo '<td><button  class ="btn btn-default btn-sm" 
            // data-toggle="modal" data-target="#myModalClientesInfo" 
            // onclick ="pantallaBusdqueda('.$cli['idcliente'].');"
            // >';
            // echo strtoupper($cli['identi']);

            ///////////


            echo $placa;
            echo '</button ></td>';


            echo '<td>'.$vehiculo['marca'].'</td>';
            echo '<td>'.$vehiculo['linea'].'</td>';
            echo '<td>'.$vehiculo['color'].'</td>';
            echo '<td>'.$vehiculo['modelo'].'</td>';
        }
        
        echo '</table>';   
        echo '</div>';    
        
        // $this->draw_table($vehiculos);
    }

    public function formuFiltroBusqueda()
    {
        ?>
         <div  style="color:black;">
            <div class="row form-group">

                <div class="col-xs-3" align="left">
                    <label for="">Identificacion:</label>
                </div>
                <div class="col-xs-9" align="left">
                    <input 
                        class="form-control" 
                        type="text"  
                        id="txtBuscarIdenti">
                </div>
            </div>
            <div class="row form-group">

                <div class="col-xs-3" align="left">
                    <label for="">Telefono:</label>
                </div>
                <div class="col-xs-9" align="left">
                    <input class="form-control" type="text"  id="txtBuscarTelefono">
                </div>
            </div>
            <div>
                <button 
                class = "btn btn-primary"
                data-dismiss="modal"
                    onclick="buscarClienteFiltros();">Buscar Filtro</button>
            </div>
          
        </div>
        <?php
    }
}





?>