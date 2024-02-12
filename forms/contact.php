<?php

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // Passing `true` enables exceptions

try {
    //Server settings
    $mail->SMTPDebug = 2;                                      // Enable verbose debug output
    $mail->isSMTP();                                           // Set mailer to use SMTP
    $mail->Host       = 'smtp.example.com';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
    $mail->Username   = 'zeinmusarsaa@gmail.com';                    // SMTP username
    $mail->Password   = 'zeinZEIN13122001!';                        // SMTP password
    $mail->SMTPSecure = 'tls';                                 // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                   // TCP port to connect to

    //Recipients
    $mail->setFrom('your@example.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');     // Add a recipient

    // Content
    $mail->isHTML(true);                                       // Set email format to HTML
    $mail->Subject = 'Subject Here';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Thank You! Your message has been sent.';
} catch (Exception $e) {
    echo "Oops! Something went wrong and we couldn't send your message. Error: {$mail->ErrorInfo}";
}


?>



