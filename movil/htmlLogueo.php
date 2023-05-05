<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

     
    <?php  echo $sinpermisos ?>
<!--             <img class="imagenesinicio" src="Logo.png">-->
          <div id="div_abajo">
              <br><br>
                <div id="div_titulo ">
                <!-- <img id="imagenlogo" src="Logo.png"> -->
                <!--<img  class="imagenesinicio" id="imagenlogo" src="planeta.png">-->
             </div>  
             <?php //  include('htmlLogueo.php'); ?>
                <!-- <img src="planeta.png"> -->
              
                        <div class="row" id="div_botones_inicio"> 
                                   <div class = "form_group ">
                                           <!-- <label for ="usuario ">Usuario:</label> -->

                                               <input value="" type = "text" class = "form-control botoninicio " id="usuario" placeholder = "Usuario" > 
                                   </div>
                            <br><br><br>
                                   <div class = "form_group ">
                                       <!-- <label for ="clave ">Clave:</label> -->
                                       <input  value="" type = "password" class = "form-control botoninicio" id="clave" placeholder = "Clave"> 
                                   </div>
                            <br><br><br><br>
                                   <div class = "form_group ">
                                           <button onclick ="btn_ingresar();"  id = "btn_ingresar" class = "btn btn-primary btn-block bontoningresar ">INGRESAR</button> 
                                        
                                   </div>
                     </div>  
             </div>   

<?php

//include('footer.php');
?>
