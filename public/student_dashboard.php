<?php
session_start();
require_once('../auth/check_login.php'); // Verify student is logged in

// Get student data
$studentId = $_SESSION['user_id'];
$query = "SELECT s.*, a.* FROM students s 
          JOIN admissions a ON s.admission_id = a.id
          WHERE s.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Get fees
$feesQuery = "SELECT * FROM fees WHERE student_id = ? ORDER BY due_date";
$feesStmt = $conn->prepare($feesQuery);
$feesStmt->bind_param("i", $student['id']);
$feesStmt->execute();
$fees = $feesStmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Get attachment info
$attachmentQuery = "SELECT a.*, 
                   fs.firstname as fs_firstname, fs.surname as fs_surname,
                   ms.firstname as ms_firstname, ms.surname as ms_surname
                   FROM attachments a
                   LEFT JOIN users fs ON a.field_supervisor_id = fs.id
                   LEFT JOIN users ms ON a.main_supervisor_id = ms.id
                   WHERE a.student_id = ?";
$attachmentStmt = $conn->prepare($attachmentQuery);
$attachmentStmt->bind_param("i", $student['id']);
$attachmentStmt->execute();
$attachment = $attachmentStmt->get_result()->fetch_assoc();

// Get logbook entries if attachment exists
$logbookEntries = [];
if ($attachment) {
    $logbookQuery = "SELECT * FROM logbook_entries 
                    WHERE attachment_id = ? 
                    ORDER BY entry_date DESC";
    $logbookStmt = $conn->prepare($logbookQuery);
    $logbookStmt->bind_param("i", $attachment['id']);
    $logbookStmt->execute();
    $logbookEntries = $logbookStmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - MZTEC University</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #002147;
            --secondary: #ffd700;
            --accent: #e63946;
            --light: #f8f9fa;
            --dark: #343a40;
        }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .dashboard {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        .sidebar {
            background: var(--primary);
            color: white;
            padding: 1rem;
        }
        .main-content {
            padding: 2rem;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .card-title {
            color: var(--primary);
            margin-top: 0;
            border-bottom: 2px solid var(--secondary);
            padding-bottom: 0.5rem;
        }
        .fee-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }
        .fee-item:last-child {
            border-bottom: none;
        }
        .paid {
            color: green;
        }
        .pending {
            color: var(--accent);
        }
        .btn {
            background: var(--secondary);
            color: var(--primary);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-pay {
            background: var(--primary);
            color: white;
        }
        .logbook-entry {
            margin-bottom: 1rem;
            padding: 1rem;
            background: var(--light);
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>MZTEC Student Portal</h2>
            <p>Welcome, <?= htmlspecialchars($student['firstname']) ?></p>
            <nav>
                <ul>
                    <li><a href="#overview">Overview</a></li>
                    <li><a href="#fees">Fees Payment</a></li>
                    <li><a href="#attachment">Attachment</a></li>
                    <li><a href="#profile">Profile</a></li>
                    <li><a href="../auth/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="main-content">
            <section id="overview" class="card">
                <h3 class="card-title">Student Overview</h3>
                <p><strong>Student ID:</strong> <?= htmlspecialchars($student['student_id']) ?></p>
                <p><strong>Program:</strong> <?= htmlspecialchars($student['final_program']) ?></p>
                <p><strong>Enrollment Date:</strong> <?= htmlspecialchars($student['enrollment_date']) ?></p>
            </section>
            
            <section id="fees" class="card">
                <h3 class="card-title">Fees Payment</h3>
                <?php foreach ($fees as $fee): ?>
                <div class="fee-item">
                    <div>
                        <strong><?= htmlspecialchars($fee['fee_type']) ?></strong>
                        <p>Due: <?= htmlspecialchars($fee['due_date']) ?></p>
                    </div>
                    <div>
                        <span>MWK <?= number_format($fee['amount'], 2) ?></span>
                        <span class="<?= $fee['status'] === 'paid' ? 'paid' : 'pending' ?>">
                            <?= ucfirst($fee['status']) ?>
                        </span>
                        <?php if ($fee['status'] !== 'paid'): ?>
                        <button class="btn btn-pay" onclick="payFee(<?= $fee['id'] ?>)">Pay Now</button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>
            
            <section id="attachment" class="card">
                <h3 class="card-title">Industrial Attachment</h3>
                <?php if ($attachment): ?>
                    <p><strong>Company:</strong> <?= htmlspecialchars($attachment['company_name']) ?></p>
                    <p><strong>Period:</strong> <?= htmlspecialchars($attachment['start_date']) ?> to <?= htmlspecialchars($attachment['end_date']) ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($attachment['status']) ?></p>
                    <p><strong>Field Supervisor:</strong> 
                        <?= $attachment['fs_firstname'] ? htmlspecialchars($attachment['fs_firstname'] . ' ' . $attachment['fs_surname']) : 'Not assigned' ?>
                    </p>
                    <p><strong>Final Grade:</strong> <?= $attachment['final_grade'] ?? 'Pending' ?></p>
                    
                    <h4>Logbook</h4>
                    <?php if ($attachment['status'] === 'ongoing'): ?>
                        <button class="btn" onclick="showLogbookForm()">Add Logbook Entry</button>
                    <?php endif; ?>
                    
                    <div id="logbook-form" style="display:none;">
                        <form id="new-entry-form">
                            <input type="hidden" name="attachment_id" value="<?= $attachment['id'] ?>">
                            <div>
                                <label>Date:</label>
                                <input type="date" name="entry_date" required>
                            </div>
                            <div>
                                <label>Activities:</label>
                                <textarea name="activities" required></textarea>
                            </div>
                            <div>
                                <label>Skills Acquired:</label>
                                <textarea name="skills_acquired"></textarea>
                            </div>
                            <div>
                                <label>Challenges:</label>
                                <textarea name="challenges"></textarea>
                            </div>
                            <button type="submit" class="btn">Submit Entry</button>
                        </form>
                    </div>
                    
                    <div id="logbook-entries">
                        <?php foreach ($logbookEntries as $entry): ?>
                        <div class="logbook-entry">
                            <p><strong>Date:</strong> <?= htmlspecialchars($entry['entry_date']) ?></p>
                            <p><strong>Activities:</strong> <?= htmlspecialchars($entry['activities']) ?></p>
                            <?php if ($entry['skills_acquired']): ?>
                                <p><strong>Skills Acquired:</strong> <?= htmlspecialchars($entry['skills_acquired']) ?></p>
                            <?php endif; ?>
                            <?php if ($entry['challenges']): ?>
                                <p><strong>Challenges:</strong> <?= htmlspecialchars($entry['challenges']) ?></p>
                            <?php endif; ?>
                            <?php if ($entry['supervisor_comments']): ?>
                                <p><strong>Supervisor Comments:</strong> <?= htmlspecialchars($entry['supervisor_comments']) ?></p>
                            <?php endif; ?>
                            <?php if ($entry['supervisor_rating']): ?>
                                <p><strong>Rating:</strong> <?= str_repeat('★', $entry['supervisor_rating']) ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>You have not been assigned an attachment yet.</p>
                <?php endif; ?>
            </section>
        </div>
    </div>

    <script>
        function showLogbookForm() {
            document.getElementById('logbook-form').style.display = 'block';
        }
        
        document.getElementById('new-entry-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('../api/add_logbook_entry.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        });
        
        function payFee(feeId) {
            // Implement payment integration
            window.location.href = `pay_fee.php?fee_id=${feeId}`;
        }
    </script>
</body>
</html>