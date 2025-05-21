<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = ""; // Update if needed
$dbname = "mztec_university";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$surname = $_POST['surname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$middlename = $_POST['middlename'] ?? '';
$email = $_POST['email'] ?? '';
$dob = $_POST['dob'] ?? '';
$gender = $_POST['gender'] ?? '';
$nationalid = $_POST['nationalid'] ?? '';
$phone = $_POST['phone'] ?? '';
$residence = $_POST['residence'] ?? '';
$origin = $_POST['origin'] ?? '';
$traditional = $_POST['traditional'] ?? '';
$village = $_POST['village'] ?? '';
$address = $_POST['address'] ?? '';
$guardian = $_POST['guardian'] ?? '';
$guardianPhone = $_POST['guardianPhone'] ?? '';
$disability = $_POST['disability'] ?? '';
$firstChoice = $_POST['firstChoice'] ?? '';
$secondChoice = $_POST['secondChoice'] ?? '';
$tvBackground = $_POST['tvBackground'] ?? '';
$tvField = $_POST['tvField'] ?? '';
$boarding = $_POST['boarding'] ?? '';
$anyCollege = $_POST['anyCollege'] ?? '';
$applicationDate = date("Y-m-d"); // Server-side date for reliability
$payment_status = 'pending';

// Validate required fields
$required_fields = [
    'surname' => $surname,
    'firstname' => $firstname,
    'email' => $email,
    'dob' => $dob,
    'gender' => $gender,
    'phone' => $phone,
    'residence' => $residence,
    'origin' => $origin,
    'guardianPhone' => $guardianPhone,
    'firstChoice' => $firstChoice,
    'secondChoice' => $secondChoice,
    'boarding' => $boarding,
    'anyCollege' => $anyCollege
];
foreach ($required_fields as $field => $value) {
    if (empty($value)) {
        die("Error: Required field '$field' is missing.");
    }
}

// Handle subjects and grades
$subjects = $_POST['subjects'] ?? [];
$grades = $_POST['grades'] ?? [];
if (empty($subjects) || count($subjects) !== count($grades)) {
    die("Error: Subjects and grades must be provided and match in number.");
}
$subjects_grades = [];
for ($i = 0; $i < count($subjects); $i++) {
    if (!empty($subjects[$i]) && !empty($grades[$i])) {
        $subjects_grades[] = ['subject' => $subjects[$i], 'grade' => $grades[$i]];
    }
}
$subjects_grades_json = json_encode($subjects_grades);

// Handle file upload
$certificate_path = '';
if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = "Uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $fileName = time() . "_" . basename($_FILES["certificate"]["name"]);
    $targetFile = $uploadDir . $fileName;

    // Validate file type and size (e.g., max 5MB, only PDF/JPG/PNG)
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    if (!in_array($_FILES['certificate']['type'], $allowedTypes) || $_FILES['certificate']['size'] > $maxSize) {
        die("Error: Invalid file type or size. Only PDF, JPG, PNG up to 5MB allowed.");
    }

    if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetFile)) {
        $certificate_path = $targetFile;
    } else {
        die("Error: Failed to upload certificate.");
    }
} else {
    die("Error: Certificate file is required.");
}

// Generate transaction reference
$transaction_ref = uniqid("MZTEC-");

// Insert into database
$sql = "INSERT INTO admissions (
    surname, firstname, middlename, email, dob, gender, nationalid, phone, residence, origin, 
    traditional, village, address, guardian, guardianPhone, disability, firstChoice, secondChoice, 
    tvBackground, tvField, boarding, anyCollege, applicationDate, certificate_path, payment_status, 
    transaction_ref, subjects_grades
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error: Failed to prepare SQL statement - " . $conn->error);
}

$stmt->bind_param(
    "sssssssssssssssssssssssssss",
    $surname, $firstname, $middlename, $email, $dob, $gender, $nationalid, $phone, $residence, $origin,
    $traditional, $village, $address, $guardian, $guardianPhone, $disability, $firstChoice, $secondChoice,
    $tvBackground, $tvField, $boarding, $anyCollege, $applicationDate, $certificate_path, $payment_status,
    $transaction_ref, $subjects_grades_json
);

if ($stmt->execute()) {
    // Store in session and redirect to payment
    $_SESSION['transaction_ref'] = $transaction_ref;
    $_SESSION['admission_data'] = [
        'surname' => $surname,
        'firstname' => $firstname,
        'email' => $email
    ];
    $stmt->close();
    $conn->close();
    header("Location: pay.php");
    exit();
} else {
    $stmt->close();
    $conn->close();
    die("Error: Failed to save application - " . $stmt->error);
}
?>