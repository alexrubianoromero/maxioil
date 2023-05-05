<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/orden/modelo/itemsOrdenModelo.php');
require_once($raiz.'/orden/vista/itemsOrdenVista.php');

class itemsOrdenControlador2
{
    protected $modelItem;
    protected $vista;
    public function __construct()
    {
        
        $this->modelItem = new itemsOrdenModelo();
        $this->vista = new itemsOrdenVista();
        // echo 'buenas llego a items';
        if($_REQUEST['opcion']=='verItemsOrden')
        {   
            $this->verItemsOrden($_REQUEST);
        }
    }
        public function verItemsOrden($request)
    {
        // die('llego a la funcion verItemsOrden');
        $items = $this->modelItem->traerItemsOrdenId($request['id']);
        $this->vista->mostrarItemsOrden($items); 
    }

}


?>


