<?php
$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/ayudas_financieras/vista/ayudasFinancierasVista.php');

class ayudasFinancierasController
{
    private $vista;
    public function __construct()
    {
        $this->vista = new ayudasFinancierasVista();
        if($_REQUEST['opcion']== 'menuAyudasFinancieras')
        {
            $this->pantallaPrincipalAyudas();
        }
    }

    public function pantallaPrincipalAyudas()
    {
        $this->vista->pantallaPrincipalAyudas();
    }
   

}


?>