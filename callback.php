<?php
session_start();

// Database connection
require_once('vendor/autoload.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mztec_university";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$client = new \GuzzleHttp\Client();

$transaction_ref = $_SESSION['transaction_ref'];
$response = $client->request('GET', "https://api.paychangu.com/mobile-money/payments/{$transaction_ref}/verify", [
  'headers' => [
    'Authorization' => 'Bearer pub-test-62kpNbCXil1OeQWZSSh02oRkMQiqQFVJ',
    'accept' => 'application/json',
  ],
]);

echo $response->getBody();

// Check session data
if (!isset($_SESSION['transaction_ref']) || !isset($_SESSION['admission_data'])) {
    die("Invalid session data.");                                                               
}

$tx_ref = $_SESSION['transaction_ref'];
$admission_data = $_SESSION['admission_data'];
$certificate_tmp_path = isset($_SESSION['certificate_tmp_path']) ? $_SESSION['certificate_tmp_path'] : "";

// Verify payment with PayChangu API
$secret_key = "sec-test-yFCnTzWhLgbxXVRmpJ7ii15FfNbGpdr7"; // Replace with your PayChangu secret key
$api_url = "https://api.paychangu.com/transactions/verify/$tx_ref";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $secret_key",
    "Content-Type: application/json"
]);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$payment_data = json_decode($response, true);

if ($http_code === 200 && $payment_data && isset($payment_data['status']) && $payment_data['status'] === 'success') {
    // Move certificate to permanent location
    $certificate_path = "";
    if (!empty($certificate_tmp_path) && file_exists($certificate_tmp_path)) {
        $upload_dir = 'Uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_name = basename($certificate_tmp_path);
        $certificate_path = $upload_dir . $file_name;
        if (!rename($certificate_tmp_path, $certificate_path)) {
            die("Failed to move certificate.");
        }
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO admissions (surname, firstname, middlename, dob, gender, nationalid, phone, residence, origin, traditional, village, address, guardian, guardianPhone, disability, firstChoice, secondChoice, tvBackground, tvField, boarding, anyCollege, applicationDate, signature, certificate_path, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $payment_status = 'paid';
    $stmt->bind_param("sssssssssssssssssssssssss", 
        $admission_data['surname'],
        $admission_data['firstname'],
        $admission_data['middlename'],
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
        $admission_data['signature'],
        $certificate_path,
        $payment_status
    );

    if ($stmt->execute()) {
        // Clear session data
        unset($_SESSION['admission_data']);
        unset($_SESSION['certificate_tmp_path']);
        unset($_SESSION['transaction_ref']);
    } else {
        die("Database insertion failed: " . $stmt->error);
    }
    $stmt->close();
} else {
    // Payment verification failed, redirect to retry
    header("Location: pay.php");
    exit();
}

$conn->close();

// Redirect to return.php with success status
header("Location: return.php?status=success");
exit();
?>