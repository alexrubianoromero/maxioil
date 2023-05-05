<?php

$body= '
	   MOTORCYCLE ROOM Te informa!
	   
	   MODIFICACION/COTIZACION

	   Que tu moto de placa '.$_REQUEST['placa'].' recibida bajo el numero de orden'.$_REQUEST['orden_numero'].'
	   
	   OBSERVACIONES
	   
	   
	   Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes	 contactarnos!

MOTORCYCLE ROOM 
Taller Multimarca 
3142536548 

O envíanos un E-mail a motorcycleroom@gmail.com <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
	';
	//echo '<br>Se enviara el correo de que esta lista <br>';
	include('enviar_correo_cotiza.php');  



?>