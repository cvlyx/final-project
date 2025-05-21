<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Enable verbose debugging
    $mail->SMTPDebug = 2; // Set to 0 in production
    $mail->Debugoutput = function($str, $level) { echo "Debug level $level; message: $str<br>"; };

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'calyxchisiza@gmail.com'; // Replace with your Gmail address
    $mail->Password = 'mssg zidx mgci lpwe'; // Your App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email details
    $mail->setFrom('calyxchisiza@gmail.com', 'MZTEC University Admissions'); // Use Gmail address for testing
    $mail->addAddress('cvlyx@proton.me', 'Test Recipient'); // Replace with a test email
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from MZTEC University';
    $mail->Body = '<h1>Test Email</h1><p>This is a test email sent from PHPMailer using your Gmail App Password.</p>';
    $mail->AltBody = 'This is a test email sent from PHPMailer using your Gmail App Password.';

    $mail->send();
    echo 'Test email sent successfully!';
} catch (Exception $e) {
    echo "Test email failed: {$mail->ErrorInfo}";
}
?>