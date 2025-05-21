<?php
session_start();

// Include database configuration
require '../config/config.php';

// Debug: Verify $conn
if (!isset($conn) || $conn->connect_error) {
    die("Database connection failed: " . ($conn ? $conn->connect_error : 'Connection not initialized'));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = 'Invalid request method.';
    header('Location: login.php');
    exit();
}

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'Email and password are required.';
    header('Location: login.php');
    exit();
}

// CSRF protection
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = 'Invalid CSRF token.';
    header('Location: login.php');
    exit();
}

$stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        switch ($user['role']) {
            case 'admin':
                header('Location: ../admin/admin.php');
                break;
            case 'student':
                header('Location: ../student/student.php');
                break;
            case 'supervisor':
                header('Location: ../supervisor/supervisor.php');
                break;
            case 'onfield_supervisor':
                header('Location: ../supervisor/onfield_supervisor.php');
                break;
            default:
                $_SESSION['error'] = 'Invalid user role.';
                header('Location: login.php');
        }
        exit();
    } else {
        $_SESSION['error'] = 'Incorrect password.';
        header('Location: login.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'No user found with that email.';
    header('Location: login.php');
    exit();
}

$stmt->close();
$conn->close();
?>