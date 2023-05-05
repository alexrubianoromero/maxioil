<? 
/*
echo 'buenas este es idex3 ';
echo '<pre>va,valores recibidos ';
print_r($_REQUEST);
echo '</pre>';
*/

//<img src="../twister.png" width="150px" height="150px" />
/*
$cuerpo_correo = "
¡Te damos la bienvenida a MOTORCYCLE ROOM!

De antemano queremos agradecer tu confianza en nosotros, y en respuesta a ello hemos dispuesto de los mejores técnicos, insumos y experiencia, para satisfacer completamente tus requerimientos hacia nuestro servicio. 

Hemos creado una orden con la siguiente información.

Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes contactarnos!

MOTORCYCLE ROOM
Taller Multimarca
3142536548

O envíanos un E-mail a motorcycleroom@gmail.com 
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
";
*/

$cuerpo_correo="crecion de orden prueba 1234566";

//////////////////////////////////////////////////////////////////	
/////////////////enviar el correo 
mail("alexrubianoromero@gmail",'MOTORCYCLE ROOM',$cuerpo_correo) ;



//mail("alexrubianoromero@gmail.com,gn.martinez12@hotmail.com","Creacion Orden de trabajo","Creacion de orden de trabajo") 


//mail('gn.martinez12@hotmail.com',$_REQUEST['asunto'],$_REQUEST['cuerpo']) 
//mail('alexrubianoromero@gmail.com',$_REQUEST['asunto'],$_REQUEST['cuerpo']) 


?>