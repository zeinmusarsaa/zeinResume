<?php

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the data from the form
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Validate the data
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo json_encode(["message" => "Please complete all fields and provide a valid email address."]);
        exit;
    }

    // Set your email address
    $recipient = "zeinmosarsaa@outlook.com"; // Your email address

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $email_headers = "From: zeinmosarsaa@outlook.com"; // Your email address

    // Send the email
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.office365.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'zeinmosarsaa@outlook.com';
        $mail->Password   = '89Ester98!';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('zeinmosarsaa@outlook.com', 'Zein Mosarsaa');
        $mail->addAddress($recipient, 'Zein Mosarsaa');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $email_content;

        $mail->send();
        echo json_encode(["message" => "Thank You! Your message has been sent.", "success" => true]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Oops! Something went wrong and we couldn't send your message. Error: {$mail->ErrorInfo}", "success" => false]);
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo json_encode(["message" => "There was a problem with your submission, please try again."]);
}

?>
