<?php
//los que yo tenia $headers = "MIME-Version: 1.0\r\n"; 
//los que yo tenia$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: KAYMO <ventas@alexrubiano.com>\r\n"; 
//$headers .= 'From: Birthday Reminder <birthday@example.com>';
//$headers .= "Cc:Alex <alexrubianoromero@hotmail.com>\r\n";
//$headers .= "Cc:arsolution <gerentegeneral@arsolutiontechnology.com>\r\n";
//$headers .= "Cc: Motorcycle Room <motorcycleroom@alexrubiano.com>\r\n";
//$headers .= "Cc: Motorcycle Room <motorcycleroom@gmail.com>\r\n";
//////////////////////$headers .= "Bcc: Alex <alexrubianoromero@gmail.com>\r\n"; 

//echo '<br>email'.$_REQUEST['email'];
//mail ("ventas@molecait.com,$email",$asunto,$mensaje,$cabeceras);
//mail($email,"BIENVENIDA",$body,$headers); 
mail($_REQUEST['email'],"AVANCE",$body,$headers); 
//mail("motorcycleroom@gmail.com","BIENVENIDA",$body,$headers); 
//echo '****************';
echo 'Se envio correo al cliente indicando el avance de su reparacion';
?>
