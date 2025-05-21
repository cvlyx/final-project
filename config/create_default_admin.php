<?php
// Step 1: Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Adjust if needed
$dbname = "mztec_university";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Define default admin credentials
$adminEmail = "admin@mzuzutec.edu.mw";
$adminPasswordPlain = "MztecAdmin@2025";
$adminName = "System Admin";
$adminRole = "admin";

// Step 3: Check if admin already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $adminEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Step 4: Admin does not exist, create it
    $hashedPassword = password_hash($adminPasswordPlain, PASSWORD_DEFAULT);

    $insertStmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("ssss", $adminName, $adminEmail, $hashedPassword, $adminRole);

    if ($insertStmt->execute()) {
        echo "✅ Default admin account created successfully.<br>";
        echo "Email: " . $adminEmail . "<br>";
        echo "Password: " . $adminPasswordPlain . "<br>";
    } else {
        echo "❌ Error creating admin account: " . $insertStmt->error;
    }

    $insertStmt->close();
} else {
    echo "ℹ️ Admin account already exists.";
}

$stmt->close();
$conn->close();
?>
