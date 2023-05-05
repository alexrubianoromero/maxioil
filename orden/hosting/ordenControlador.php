<?php 
require_once('../vehiculos/modelo/VehiculosModelo.php');
require_once('../orden/vista/orden_captura_honda_nueva.php');
// require_once('./orden_captura_honda_nueva.php');
class ordenControlador {
    private $modelo; 
    private $vista;

    public function __construct()
    {
        $this->modelo = new VehiculosModelo();
        $this->vista = new orden_captura_honda_nueva();
    }
    public function verificarPlaca($tabla4,$conexion,$tabla3,$placa){
       $resultado =   $this->modelo->verificarPlaca($conexion,$placa);
       $filas = mysql_num_rows($resultado);
        if($filas==0)
        {
            echo '<h1 style="color:red">Esta placa no existe por favor verifique</h1>';
        }
        else {
            $datos_placa = mysql_fetch_assoc($resultado);
            echo $this->vista->mostrarFormulario($datos_placa,$tabla3,$tabla4,$conexion);
            //pintar el formulario
            // require_once('vista/orden_captura_honda_nueva.php');

            // echo  (json_encode($datos_placa));
        }
    }



}



?>