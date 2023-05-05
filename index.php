<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

<meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='css/bootstrap.min.css'>
<script src='js/bootstrap.min.js'></script>
<style>
#bordesito{
  /*
  border:1px solid white; 
  */
}
#btn_submit{
  padding:0px;
}
#imagen{
  width: 50%;
}
@media (max-width: 600px){
  #imagen{
  width: 100%;
}
}

@media (min-width: 600px){
#caja_input{
  font-size: 25px;
  border-radius: 10px; 
}
}
#centro{
  text-align: center;
}
#derecha{
  text-align: right;
}
#izquierda {
  text-align: left;
}
@media (max-width: 600px){
  #izquierda,#derecha{
  text-align: center;
}
}
</style>
</head>
<body  background="imagenes/fondo.jpg">
<div id="container">
<form action="verificar_usuario.php" method="post">
  <div class="row">
      <div class="col-md-12 col-xs-12 text-center" >
         <img src = "imagenes/logo.png" id="imagen" >
      </div>
  </div> 

  <div class="row"  id="bordesito">
        <div class=" col-md-offset-4 col-md-2  col-xs-12 " id="bordesito" >
          <div id="centro">
            <img src="imagenes/usuario.png" width="60" height="72">
          </div>
        </div>  
        <div class=" col-md-3  col-xs-12 text-center" id="bordesito">
          <div id="izquierda">
             <input type="text" name="usuario" id="caja_input"  size="12px" value = "admin"/>
           </div>
       </div>  
  </div> 


  <br><br>
  <div class="row">
      <div class=" col-md-offset-4 col-md-2  col-xs-12 " id="bordesito" >
        <div id="centro">
       <img src="imagenes/clave.png" width="60" height="30">
     </div>
      </div>  
        <div class="  col-md-3  col-xs-12 text-center" id="bordesito">
           <div id="izquierda">
         <input type="password" name="clave" id="caja_input" size="12px" value = "1234"/>
       </div>
      </div>  
  </div> 
  <br><br>
   <div class="row">
       <div class="  col-md-12  col-xs-12 text-center">

          <input type="image" id="btn_submit" name="Submit" value="Enviar" src="imagenes/boton_enviar.png" width ="150" heigh = "20" />
       
       </div>
   </div>  
   <br><br>
   <div class="row">
       <div class="  col-md-12  col-xs-12 text-center">

          <img  id="imagen" src="imagenes/texto_final.png"  >
       
       </div>
   </div>  

  </form> 
</div> <!--div de container -->
</body>
</html>

<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   

