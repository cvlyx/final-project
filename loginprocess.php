<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    // Check admin table
    $query = "SELECT id, username, email, password FROM admins WHERE email = ?";
    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $email, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'admin';
                header('Location: admin.php');
                exit();
            }
        }
        $stmt->close();
    }

    // Check student table
    $query = "SELECT student_id, admission_id, username, email, password FROM students WHERE email = ?";
    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($student_id, $admission_id, $username, $email, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $student_id;
                $_SESSION['admission_id'] = $admission_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'student';
                header('Location: student.php');
                exit();
            }
        }
        $stmt->close();
    }

    $_SESSION['error'] = 'Invalid email or password';
    header('Location: login.php');
    exit();
}
?>