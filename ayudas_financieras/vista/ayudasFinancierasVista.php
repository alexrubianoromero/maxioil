<?php

class ayudasFinancierasVista
{
     public function __construct()
     {
     }

     public function pantallaPrincipalAyudas()
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
                    
               </div>
               <div>
                    <button class = "btn btn-primary bontonesmenu"  onclick="pantallaPrincipalCaja();">CAJA 
                           <i class="far fa-money-bill-1"></i>
                   </button>
                    <button class = "btn btn-primary bontonesmenu"  onclick="pantallaConceptos();">CONCEPTOS DE CAJA 
                           <i class="far fa-money-bill-1"></i>
                   </button>
               </div>
          </div>
          
        </body>
        </html>
        <?php
     }
}



?>