<?php
session_start();

// Simple auth check (you can replace with your own logic)
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin_login.php');
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "mztec_university";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all admissions
$sql = "SELECT * FROM admissions ORDER BY applicationDate DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin - Applications</title>
<style>
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { background-color: #333; color: white; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    button { padding: 5px 10px; cursor: pointer; }
</style>
</head>
<body>
<h1>Applications</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Phone</th>
            <th>First Choice</th>
            <th>Second Choice</th>
            <th>Payment Status</th>
            <th>Transaction Ref</th>
            <th>Approve Payment</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['surname'] . ' ' . $row['firstname']) ?></td>
                <td><?= htmlspecialchars($row['dob']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['firstChoice']) ?></td>
                <td><?= htmlspecialchars($row['secondChoice']) ?></td>
                <td><?= htmlspecialchars($row['payment_status']) ?></td>
                <td><?= htmlspecialchars($row['transaction_ref']) ?></td>
                <td>
                    <?php if ($row['payment_status'] === 'pending'): ?>
                        <form method="post" action="approve_payment.php" onsubmit="return confirm('Approve payment for this application?');">
                            <input type="hidden" name="transaction_ref" value="<?= htmlspecialchars($row['transaction_ref']) ?>" />
                            <button type="submit">Approve</button>
                        </form>
                    <?php else: ?>
                        Approved
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="9">No applications found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
