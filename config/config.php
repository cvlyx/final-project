<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mztec_university";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return [
    'smtp' => [
        'host' => 'smtp.gmail.com',
        'username' => 'calyxchisiza@gmail.com', // Your Gmail address
        'password' => 'mssgzidxmgcilpwe', // Your App Password
        'port' => 587,
        'secure' => 'tls'
    ]
];
?>