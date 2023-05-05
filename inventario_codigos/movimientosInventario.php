<?php
    $raiz = dirname(dirname(__file__));
    require_once($raiz.'/inventario_codigos/controladores/MovimientosInventarioController.php');
    $instancia = new MovimientosInventarioController();

?>