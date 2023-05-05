<?php

//$headers = "MIME-Version: 1.0\r\n"; 
//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: Motorcycle Room <motorcycleroom@gmail.com>\r\n"; 
/*
$body = '
<html>
<body>

atentamente estamos enviando una prueba 300 
<br>con una imagen  comilla simple
<br>
<body>
</html>
';
*/
/*
$body='
<img src="www.alexrubiano.com/prueba_envio_mail/twister.png"/>
¡Te damos la bienvenida a MOTORCYCLE ROOM!
<br>
De antemano queremos agradecer tu confianza en nosotros, y en respuesta a ello hemos dispuesto de los mejores técnicos, insumos y experiencia, para satisfacer completamente tus requerimientos hacia nuestro servicio. 
<br>
Hemos creado una orden con la siguiente información.
<br>
Orden Numero :  <br>
Placa:  <br>
<br>
TRABAJO A REALIZAR

<br>
Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes contactarnos!
<br>
MOTORCYCLE ROOM <br>
Taller Multimarca <br>
3142536548 <br>
<br>
O envíanos un E-mail a motorcycleroom@gmail.com  <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.

';

*/
//echo '<br>email'.$_REQUEST['email'];

mail($_REQUEST['email'],"BIENVENIDA",$body,$headers) 

?>
