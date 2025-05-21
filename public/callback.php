<?php
session_start();

require_once('../vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load SMTP configuration
$config = require '../config/config.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password if needed
$dbname = "mztec_university";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for required session data
if (!isset($_SESSION['transaction_ref']) || !isset($_SESSION['admission_data'])) {
    die("Session data missing.");
}

$transaction_ref = $_SESSION['transaction_ref'];
$admission_data = $_SESSION['admission_data'];

$client = new \GuzzleHttp\Client();

try {
    // Verify payment with PayChangu API
    $response = $client->request('GET', "https://api.paychangu.com/transactions/verify/$transaction_ref", [
        'headers' => [
            'Authorization' => 'Bearer sec-live-MkvCp8GeWeLU6F6kbU0s2dN8kzrDi5bj',
            'accept' => 'application/json',
        ],
    ]);

    if ($response->getStatusCode() !== 200) {
        throw new Exception("API request failed with status code " . $response->getStatusCode());
    }

    $data = json_decode($response->getBody(), true);
    error_log("Verifying payment for transaction reference: $transaction_ref");
    error_log("API response status: " . $response->getStatusCode());

    // Check payment status
    if (isset($data['status']) && $data['status'] === 'success' && isset($data['data']['payment_status']) && $data['data']['payment_status'] === 'completed') {
        $payment_status = 'paid';

        // Insert admission data into database
        $sql = "INSERT INTO admissions (
            surname, firstname, middlename, email, dob, gender, nationalid, phone, residence, origin, 
            traditional, village, address, guardian, guardianPhone, disability, firstChoice, secondChoice, 
            tvBackground, tvField, boarding, anyCollege, applicationDate, certificate_path, payment_status, 
            transaction_ref, subjects_grades
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare SQL statement: " . $conn->error);
        }

        $stmt->bind_param(
            "sssssssssssssssssssssssssss",
            $admission_data['surname'],
            $admission_data['firstname'],
            $admission_data['middlename'],
            $admission_data['email'],
            $admission_data['dob'],
            $admission_data['gender'],
            $admission_data['nationalid'],
            $admission_data['phone'],
            $admission_data['residence'],
            $admission_data['origin'],
            $admission_data['traditional'],
            $admission_data['village'],
            $admission_data['address'],
            $admission_data['guardian'],
            $admission_data['guardianPhone'],
            $admission_data['disability'],
            $admission_data['firstChoice'],
            $admission_data['secondChoice'],
            $admission_data['tvBackground'],
            $admission_data['tvField'],
            $admission_data['boarding'],
            $admission_data['anyCollege'],
            $admission_data['applicationDate'],
            $admission_data['certificate_path'],
            $payment_status,
            $transaction_ref,
            $admission_data['subjects_grades']
        );

        if (!$stmt->execute()) {
            throw new Exception("Failed to save application: " . $stmt->error);
        }
        $stmt->close();

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = $config['smtp']['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['smtp']['username'];
            $mail->Password = $config['smtp']['password'];
            $mail->SMTPSecure = $config['smtp']['secure'];
            $mail->Port = $config['smtp']['port'];

            // Email details
            $mail->setFrom($config['smtp']['username'], 'MZTEC University Admissions');
            $mail->addAddress($admission_data['email'], $admission_data['firstname'] . ' ' . $admission_data['surname']);
            $mail->isHTML(true);
            $mail->Subject = 'Application Received - MZTEC University';
            $mail->Body = '
                <h2>Application Confirmation</h2>
                <p>Dear ' . htmlspecialchars($admission_data['firstname'] . ' ' . $admission_data['surname']) . ',</p>
                <p>Thank you for submitting your application to MZTEC University. We have successfully received your application and payment for the application fee.</p>
                <p>Your application is now under review by our admissions team. We will carefully assess your submission and contact you with the outcome or any further steps required. This process may take a few weeks, and we appreciate your patience.</p>
                <p><strong>Application Details:</strong></p>
                <ul>
                    <li><strong>Transaction Reference:</strong> ' . htmlspecialchars($transaction_ref) . '</li>
                    <li><strong>First Choice Course:</strong> ' . htmlspecialchars($admission_data['firstChoice']) . '</li>
                    <li><strong>Second Choice Course:</strong> ' . htmlspecialchars($admission_data['secondChoice']) . '</li>
                </ul>
                <p>If you have any questions or need further assistance, please contact us at admissions@mztec.ac.mw.</p>
                <p>Best regards,<br>MZTEC University Admissions Team</p>
            ';
            $mail->AltBody = 'Dear ' . htmlspecialchars($admission_data['firstname'] . ' ' . $admission_data['surname']) . ",\n\nThank you for submitting your application to MZTEC University. We have successfully received your application and payment for the application fee.\n\nYour application is now under review by our admissions team. We will carefully assess your submission and contact you with the outcome or any further steps required. This process may take a few weeks, and we appreciate your patience.\n\nApplication Details:\n- Transaction Reference: " . htmlspecialchars($transaction_ref) . "\n- First Choice Course: " . htmlspecialchars($admission_data['firstChoice']) . "\n- Second Choice Course: " . htmlspecialchars($admission_data['secondChoice']) . "\n\nIf you have any questions or need further assistance, please contact us at admissions@mztec.ac.mw.\n\nBest regards,\nMZTEC University Admissions Team";

            $mail->send();
            error_log("Email sent to " . $admission_data['email']);
        } catch (Exception $e) {
            error_log("Failed to send email: " . $mail->ErrorInfo);
            // Continue to success page even if email fails
        }

        // Clear session data
        unset($_SESSION['transaction_ref']);
        unset($_SESSION['admission_data']);
        header("Location: return.php?status=success");
        exit();
    } else {
        throw new Exception("Payment not successful or still pending.");
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    // Clean up uploaded file if payment fails
    if (file_exists($admission_data['certificate_path'])) {
        unlink($admission_data['certificate_path']);
    }
    header("Location: return.php?status=failed");
    exit();
} finally {
    $conn->close();
}
?>