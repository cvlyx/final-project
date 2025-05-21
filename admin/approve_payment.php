<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['error'] = 'Unauthorized access.';
    header('Location: ../auth/login.php');
    exit();
}

require '../config/config.php';

// Check if status column exists
$columns = $conn->query("SHOW COLUMNS FROM admissions LIKE 'status'");
$hasStatus = $columns && $columns->num_rows > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['application_id'])) {
    $application_id = filter_input(INPUT_POST, 'application_id', FILTER_VALIDATE_INT);
    if ($application_id) {
        if ($hasStatus) {
            $stmt = $conn->prepare("UPDATE admissions SET status = 'Approved', payment_status = 'paid' WHERE id = ?");
        } else {
            $stmt = $conn->prepare("UPDATE admissions SET payment_status = 'paid' WHERE id = ?");
        }
        $stmt->bind_param("i", $application_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Application approved successfully.';
        } else {
            $_SESSION['error'] = 'Failed to approve application.';
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Invalid application ID.';
    }
}

header('Location: admin.php');
exit();
?>