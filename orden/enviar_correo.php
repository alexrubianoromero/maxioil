<?php

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// echo '<br>';

// echo $body.'<br>';
// die();
//los que yo tenia $headers = "MIME-Version: 1.0\r\n"; 
//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
// $headers .= "From: 	KAYMO SOFTWARE <ventas@alexrubiano.com>\r\n"; 
$headers .= "From: 	KAYMO SOFTWARE <motorcycleroom@arsolutiontechnology>\r\n"; 
//$headers .= "From: 	KAYMO SOFTWARE <alexrubianoromero@gmail.com>\r\n"; 
//$headers .= "Cc:arsolution <ventas@alexrubiano.com>\r\n";
//$headers .= "Cc:Alex <{$_REQUEST['email']}>\r\n";
//$headers .= "Cc:Alex <alexrubiano@hotmail.com>\r\n";

//echo '<br>'.$_REQUEST['email'];
mail($_REQUEST['email'],"BIENVENIDA",$body,$headers); 
mail("gerentegeneral@arsolutiontechnology.com","BIENVENIDA",$body,$headers); 
mail("motorcycleroom@arsolutiontechnology.com","BIENVENIDA",$body,$headers); 
mail("motorcycleroom@alexrubiano.com","BIENVENIDA",$body,$headers); 
mail("alexrubianoromero@gmail.com","BIENVENIDA",$body,$headers); 

?>
