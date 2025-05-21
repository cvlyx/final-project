<?php
session_start();
require_once('../auth/check_login.php'); // Verify supervisor is logged in

// Get supervisor's students
$supervisorId = $_SESSION['user_id'];
$role = $_SESSION['role']; // field_supervisor or main_supervisor

$query = "SELECT s.id as student_id, s.student_id as student_number, 
          a.firstname, a.surname, a.email, 
          att.id as attachment_id, att.company_name, att.start_date, att.end_date, att.status
          FROM attachments att
          JOIN students s ON att.student_id = s.id
          JOIN admissions a ON s.admission_id = a.id
          WHERE att.{$role}_id = ?";
          
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $supervisorId);
$stmt->execute();
$students = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard - MZTEC University</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Similar styling to student dashboard */
        .student-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>MZTEC Supervisor Portal</h2>
            <p>Welcome, <?= htmlspecialchars($_SESSION['firstname']) ?></p>
            <nav>
                <ul>
                    <li><a href="#" onclick="showTab('students')">My Students</a></li>
                    <li><a href="#" onclick="showTab('reports')">Reports</a></li>
                    <li><a href="../auth/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="main-content">
            <div id="students" class="tab-content active">
                <h2>My Students</h2>
                
                <?php foreach ($students as $student): ?>
                <div class="student-card">
                    <h3><?= htmlspecialchars($student['firstname'] . ' ' . $student['surname']) ?></h3>
                    <p>Student ID: <?= htmlspecialchars($student['student_number']) ?></p>
                    <p>Company: <?= htmlspecialchars($student['company_name']) ?></p>
                    <p>Attachment Period: <?= htmlspecialchars($student['start_date']) ?> to <?= htmlspecialchars($student['end_date']) ?></p>
                    <p>Status: <?= ucfirst($student['status']) ?></p>
                    
                    <button onclick="viewLogbook(<?= $student['attachment_id'] ?>)">View Logbook</button>
                    <?php if ($student['status'] === 'completed' && $role === 'main_supervisor'): ?>
                        <button onclick="showGradeForm(<?= $student['attachment_id'] ?>)">Assign Final Grade</button>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div id="logbook-view" class="tab-content">
                <h2>Student Logbook</h2>
                <button onclick="showTab('students')">Back to Students</button>
                <div id="logbook-entries-container"></div>
            </div>
            
            <div id="grade-form" style="display:none;">
                <h3>Assign Final Grade</h3>
                <form id="grade-form-content">
                    <input type="hidden" id="attachment-id" name="attachment_id">
                    <div>
                        <label>Grade:</label>
                        <select name="grade" required>
                            <option value="A">A - Excellent</option>
                            <option value="B">B - Good</option>
                            <option value="C">C - Satisfactory</option>
                            <option value="D">D - Needs Improvement</option>
                            <option value="F">F - Failed</option>
                        </select>
                    </div>
                    <div>
                        <label>Comments:</label>
                        <textarea name="comments"></textarea>
                    </div>
                    <button type="submit">Submit Grade</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(tabId).classList.add('active');
        }
        
        function viewLogbook(attachmentId) {
            fetch(`../api/get_logbook_entries.php?attachment_id=${attachmentId}`)
                .then(response => response.json())
                .then(entries => {
                    const container = document.getElementById('logbook-entries-container');
                    container.innerHTML = '';
                    
                    if (entries.length === 0) {
                        container.innerHTML = '<p>No logbook entries found.</p>';
                        return;
                    }
                    
                    entries.forEach(entry => {
                        const entryDiv = document.createElement('div');
                        entryDiv.className = 'logbook-entry';
                        entryDiv.innerHTML = `
                            <h4>${entry.entry_date}</h4>
                            <p><strong>Activities:</strong> ${entry.activities}</p>
                            ${entry.skills_acquired ? `<p><strong>Skills Acquired:</strong> ${entry.skills_acquired}</p>` : ''}
                            ${entry.challenges ? `<p><strong>Challenges:</strong> ${entry.challenges}</p>` : ''}
                            <div>
                                <label>Supervisor Comments:</label>
                                <textarea id="comments-${entry.id}">${entry.supervisor_comments || ''}</textarea>
                                <button onclick="saveComments(${entry.id})">Save Comments</button>
                            </div>
                            <div>
                                <label>Rating:</label>
                                <select id="rating-${entry.id}">
                                    <option value="1" ${entry.supervisor_rating === 1 ? 'selected' : ''}>★</option>
                                    <option value="2" ${entry.supervisor_rating === 2 ? 'selected' : ''}>★★</option>
                                    <option value="3" ${entry.supervisor_rating === 3 ? 'selected' : ''}>★★★</option>
                                    <option value="4" ${entry.supervisor_rating === 4 ? 'selected' : ''}>★★★★</option>
                                    <option value="5" ${entry.supervisor_rating === 5 ? 'selected' : ''}>★★★★★</option>
                                </select>
                            </div>
                        `;
                        container.appendChild(entryDiv);
                    });
                    
                    showTab('logbook-view');
                });
        }
        
        function saveComments(entryId) {
            const comments = document.getElementById(`comments-${entryId}`).value;
            const rating = document.getElementById(`rating-${entryId}`).value;
            
            fetch('../api/update_logbook_entry.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    entry_id: entryId,
                    comments: comments,
                    rating: rating
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Comments and rating saved successfully');
                } else {
                    alert('Error: ' + data.message);
                }
            });
        }
        
        function showGradeForm(attachmentId) {
            document.getElementById('attachment-id').value = attachmentId;
            document.getElementById('grade-form').style.display = 'block';
        }
        
        document.getElementById('grade-form-content').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('../api/assign_final_grade.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Grade submitted successfully');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        });
    </script>
</body>
</html>