<?php



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('America/Bogota');

// $ruta = dirname(dirname(__FILE__));

require '../../phpmailer/Exception.php';

require '../../phpmailer/PHPMailer.php';

require '../../phpmailer/SMTP.php';

//Create an instance; passing `true` enables exceptions

$mail = new PHPMailer(true);

try {

    //Server settings

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output

    $mail->SMTPDebug = 0;                      //Enable verbose debug output

    $mail->isSMTP();                                            //Send using SMTP

    $mail->Host       = 'mail.arsolutiontechnology.com';                     //Set the SMTP server to send through

    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Username   = 'prueba2@arsolutiontechnology.com';                     //SMTP username

    $mail->Password   = 'Prueba24680*';                               //SMTP password

    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption

    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption

    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



    //Recipients

    $mail->setFrom('prueba@arsolutiontechnology.com', 'KAYMO Software para Talleres');

    // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient

    $mail->addAddress($_REQUEST['email']);     //Add a recipient

    $mail->addAddress('alexrubianoromero@hotmail.com');     //Add a recipient

    // $mail->addAddress('ellen@example.com');               //Name is optional

    // $mail->addReplyTo('info@example.com', 'Information');

    // $mail->addCC('cc@example.com');

    // if(!empty($data['emailCopia'])){

    //     $mail->addBCC($data['emailCopia']);

    // }



    //Attachments

    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments

    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name



    //Content

    $mail->isHTML(true);                                  //Set email format to HTML

    $mail->Subject = 'Bienvenido a KAYMO SOFTWARE';

    $mail->Body    = $body;

    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



    $mail->send();

    echo 'Mensaje Enviado';

} catch (Exception $e) {

    echo "Error en e  el envio del mensaje: {$mail->ErrorInfo}";

}



?>