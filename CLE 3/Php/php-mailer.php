<?php
//API
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//plugins
require '../plugins/PHPMailer/src/Exception.php';
require '../plugins/PHPMailer/src/PHPMailer.php';
require '../plugins/PHPMailer/src/SMTP.php';


$mail= new PHPMailer(true);

try {

    //port encryption type, host server, email account login
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'cle3team15@gmail.com';
    $mail->Password   = 'justdancear15';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //sends email from first email to second email which can be a variable
    $mail->setFrom('cle3team15@gmail.com', 'CLE3 Team 15');
    $mail->addAddress('1006222@hr.nl', 'Jesper');

    //makes email in html
    $mail->isHTML(true);
    $mail->Subject = 'Code';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //if email can't process html
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //sends confirmation email to given email, otherwise shows error
    $mail->send();
    echo 'Uw code is naar uw mail gestuurd';
} catch (Exception $e) {
    echo "Code kon niet verstuurd worden naar uw Mail, MAIL ERROR: {$mail->ErrorInfo}";
}

