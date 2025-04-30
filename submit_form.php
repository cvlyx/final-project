<?php
session_start();

// Database connection (for potential validation or future use)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mztec_university";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collecting data from the form
$admission_data = [
    'surname' => filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING),
    'firstname' => filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING),
    'middlename' => filter_input(INPUT_POST, 'middlename', FILTER_SANITIZE_STRING),
    'dob' => filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING),
    'gender' => filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING),
    'nationalid' => filter_input(INPUT_POST, 'nationalid', FILTER_SANITIZE_STRING),
    'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING),
    'residence' => filter_input(INPUT_POST, 'residence', FILTER_SANITIZE_STRING),
    'origin' => filter_input(INPUT_POST, 'origin', FILTER_SANITIZE_STRING),
    'traditional' => filter_input(INPUT_POST, 'traditional', FILTER_SANITIZE_STRING),
    'village' => filter_input(INPUT_POST, 'village', FILTER_SANITIZE_STRING),
    'address' => filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING),
    'guardian' => filter_input(INPUT_POST, 'guardian', FILTER_SANITIZE_STRING),
    'guardianPhone' => filter_input(INPUT_POST, 'guardianPhone', FILTER_SANITIZE_STRING),
    'disability' => filter_input(INPUT_POST, 'disability', FILTER_SANITIZE_STRING),
    'firstChoice' => filter_input(INPUT_POST, 'firstChoice', FILTER_SANITIZE_STRING),
    'secondChoice' => filter_input(INPUT_POST, 'secondChoice', FILTER_SANITIZE_STRING),
    'tvBackground' => filter_input(INPUT_POST, 'tvBackground', FILTER_SANITIZE_STRING),
    'tvField' => filter_input(INPUT_POST, 'tvField', FILTER_SANITIZE_STRING),
    'boarding' => filter_input(INPUT_POST, 'boarding', FILTER_SANITIZE_STRING),
    'anyCollege' => filter_input(INPUT_POST, 'anyCollege', FILTER_SANITIZE_STRING),
    'applicationDate' => filter_input(INPUT_POST, 'applicationDate', FILTER_SANITIZE_STRING),
    'signature' => filter_input(INPUT_POST, 'signature', FILTER_SANITIZE_STRING)
];

// Basic validation
$required_fields = ['surname', 'firstname', 'dob', 'gender', 'phone', 'residence', 'origin', 'guardianPhone', 'firstChoice', 'secondChoice', 'boarding', 'anyCollege'];
foreach ($required_fields as $field) {
    if (empty($admission_data[$field])) {
        die("Please fill all required fields.");
    }
}

// Handle certificate upload to a temporary location
$certificate_tmp_path = "";
if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/tmp/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_name = time() . '_' . basename($_FILES['certificate']['name']);
    $certificate_tmp_path = $upload_dir . $file_name;
    if (!move_uploaded_file($_FILES['certificate']['tmp_name'], $certificate_tmp_path)) {
        die("Failed to upload certificate.");
    }
}

// Store data in session
$_SESSION['admission_data'] = $admission_data;
$_SESSION['certificate_tmp_path'] = $certificate_tmp_path;
$_SESSION['transaction_ref'] = 'MZTEC_' . rand(100000000, 999999999);

// Close connection
$conn->close();

// Redirect to payment page
header("Location: pay.php" );
exit();
?>