<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


// Check if form was submitted with 'res' and 'id' parameters
if (isset($_POST['res']) && isset($_POST['id'])) {
    // Retrieve form data
    $p = $_POST['res'];
    $id = $_POST['id'];
    if (isset ($_SESSION['doctor'])) {
        $y=$_SESSION['doctor'];
    }else {
        $y=$_SESSION['admin'];
    }
    // Query appointment details from database
    $sql = "SELECT * FROM appointment WHERE sn='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row["email"]; // Get recipient's email address

        // Send email notification
        sendAppointmentNotification($email, $p,$y);
    } else {
        echo "No appointment found for ID: $id";
    }
}

function sendAppointmentNotification($recipientEmail, $status,$y)
{
    // SMTP configuration
    $mail = new PHPMailer(true);

    try {
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'ganeshkhatri00000@gmail.com';                     //SMTP username
      $mail->Password   = 'hudr ritl sjrh blgv';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;  

        // Email content
        $mail->setFrom('ganeshkhatri00000@gmail.com', 'Appointment System');
        $mail->addAddress($recipientEmail);
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Status Update';
        $mail->Body    = "<p style='color: green; font-size: 16px;'>
                            Your appointment has been $status. Thank you for visiting!
                          </p>";

        // Send email
        $mail->send();
        echo 'Email sent successfully';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
