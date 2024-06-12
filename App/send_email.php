<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $replyEmail = $_POST['reply_email'];
    $message = $_POST['message'];

    $yourEmail = 'testtestnpbd@gmail.com';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $yourEmail;
        $mail->Password = 'ahve dhlj dzrc zaym';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';
        $mail->setLanguage('uk', 'vendor/phpmailer/phpmailer/language/');

        $mail->setFrom($yourEmail, $name);
        $mail->addAddress($yourEmail);
        $mail->addReplyTo($replyEmail, $name);

        $mail->Subject = 'Заявка';
        $mail->Body    = "Ім'я: $name\nEmail для зворотного зв'язку: $replyEmail\nПовідомлення:\n$message";

        $mail->send();
        http_response_code(200);
    } catch (Exception $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}