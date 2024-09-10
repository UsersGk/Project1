<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ganeshkhatri00000@gmail.com';
        $mail->Password = 'password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('ganeshkhatri99999@gmail.com', $email);
        $mail->addAddress('ganeshkhatri00000@gmail.com', 'ganesh');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Sender Name: " . $name . "<br>"."subject: ".$subject."<br>" . "Sender Email: " . $email . "<br>" . "Message: " . $message;
        // echo $senderInfo;

        $mail->send();
     header('location:contact.php');
     $_SESSION['smtp']="sent the mail";
     exit();
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header('location:contact.php');
        $_SESSION['smtp']="mail not be sent";
        exit();
    }
}
?>
