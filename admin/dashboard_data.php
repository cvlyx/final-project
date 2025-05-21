<?php
require '../config/config.php';

header('Content-Type: application/json');

$data = [
    'totalEnrollment' => 0,
    'totalFees' => 'N/A',
    'pendingInternships' => 0,
    'recentApplications' => []
];

try {
    // Check available columns in admissions
    $columns = $conn->query("SHOW COLUMNS FROM admissions");
    $admissionsColumns = [];
    while ($column = $columns->fetch_assoc()) {
        $admissionsColumns[] = $column['Field'];
    }

    // Total Enrollment
    $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'student'");
    $data['totalEnrollment'] = $result ? $result->fetch_assoc()['count'] : 0;

    // Total Fees
    if (in_array('fee_amount', $admissionsColumns)) {
        $result = $conn->query("SELECT SUM(fee_amount) as total FROM admissions WHERE payment_status = 'paid'");
        $data['totalFees'] = $result ? ($result->fetch_assoc()['total'] ?? 0) : 0;
    }

    // Pending Internships
    $result = $conn->query("SELECT COUNT(*) as count FROM internships WHERE status = 'Pending'");
    $data['pendingInternships'] = $result ? $result->fetch_assoc()['count'] : 0;

    // Recent Applications
    $selectFields = ['id'];
    if (in_array('firstname', $admissionsColumns) && in_array('surname', $admissionsColumns)) {
        $selectFields[] = "CONCAT(firstname, ' ', surname) as name";
    } else {
        $selectFields[] = "'Unknown' as name";
    }
    if (in_array('email', $admissionsColumns)) {
        $selectFields[] = 'email';
    }
    if (in_array('status', $admissionsColumns)) {
        $selectFields[] = 'status';
    }
    if (in_array('created_at', $admissionsColumns)) {
        $selectFields[] = 'created_at';
    }
    $query = "SELECT " . implode(', ', $selectFields) . " FROM admissions ORDER BY " . (in_array('created_at', $admissionsColumns) ? 'created_at' : 'id') . " DESC LIMIT 5";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $data['recentApplications'][] = $row;
    }
} catch (mysqli_sql_exception $e) {
    $data['error'] = 'Database error: ' . $e->getMessage();
}

echo json_encode($data);

$conn->close();
?>