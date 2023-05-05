<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/admAplication/modelo.php';

$objSesionUsuario = new SesionUsuario();
$objSesionUsuario->IniciarSesion();
$index_retorno = $_SESSION['index_retorno'];
// Si hay una sesion valida
if ($objSesionUsuario->sesionValida()) {

    if ($_SESSION['adu_pwdtemp'] == 'y') {
        // Habilita un estado de Inactividad
    }
}

$sesionDestruida = $objSesionUsuario->cerrarSesion();
include('htmlLogueo.php');
//if (isset($_GET["unload"])) {
//    // Si fue llamada por una ventana de unload
//    $objSmarty = new Smarty($_SERVER['DOCUMENT_ROOT'] . '/admAplication/Libs/');
//    if ($sesionDestruida) {
//        $objSmarty->display('popuplogout.tpl');
//    } else {
//        $objSmarty->display('popuplogouterror.tpl');
//    }
//    exit();
//}

//if (isset($_GET["cierre"])) {
//    $objSmarty = new Smarty($_SERVER['DOCUMENT_ROOT'] . '/admAplication/Libs/');
//    $objSmarty->assign('mensaje', 'Su sesi&oacute;n ha sido cerrada por inactividad');
//    $objSmarty->display('cierre_sesion.tpl');
//    exit();
//}


// Redirecciona a la url raiz

//if (isset($index_retorno)) {
//    header('Location: ' . $index_retorno);
//    exit();
//}
//header('Location: /admAplication/index.php');
//exit();
