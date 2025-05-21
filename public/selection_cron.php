<?php
require_once('../config/db.php');
require_once('../vendor/autoload.php');

// Connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Get all paid applications that haven't been processed
$query = "SELECT * FROM admissions 
          WHERE payment_status = 'paid' 
          AND selection_status = 'pending'
          ORDER BY applicationDate ASC";
$result = $conn->query($query);

$maxSeats = 300; // Set your maximum seats
$acceptedCount = 0;
$applicants = [];

while ($row = $result->fetch_assoc()) {
    // Parse subjects and grades
    $subjectsGrades = json_decode($row['subjects_grades'], true);
    $totalScore = 0;
    $subjectCount = 0;
    
    foreach ($subjectsGrades as $sg) {
        // Convert grades to points (implement your grading scale)
        $points = gradeToPoints($sg['grade']);
        $totalScore += $points;
        $subjectCount++;
    }
    
    $averageScore = $subjectCount > 0 ? $totalScore / $subjectCount : 0;
    
    // Check program requirements (simplified example)
    $program1Match = checkProgramRequirements($row['firstChoice'], $subjectsGrades);
    $program2Match = checkProgramRequirements($row['secondChoice'], $subjectsGrades);
    
    $applicants[] = [
        'id' => $row['id'],
        'email' => $row['email'],
        'firstname' => $row['firstname'],
        'surname' => $row['surname'],
        'firstChoice' => $row['firstChoice'],
        'secondChoice' => $row['secondChoice'],
        'score' => $averageScore,
        'program1Match' => $program1Match,
        'program2Match' => $program2Match
    ];
}

// Sort applicants by score (descending)
usort($applicants, function($a, $b) {
    return $b['score'] <=> $a['score'];
});

// Process selection
foreach ($applicants as $applicant) {
    if ($acceptedCount >= $maxSeats) break;
    
    $selectedProgram = null;
    
    if ($applicant['program1Match']) {
        $selectedProgram = $applicant['firstChoice'];
    } elseif ($applicant['program2Match']) {
        $selectedProgram = $applicant['secondChoice'];
    }
    
    if ($selectedProgram) {
        // Update admission record
        $update = $conn->prepare("UPDATE admissions 
                                 SET selection_status = 'accepted', 
                                     final_program = ?,
                                     selection_date = NOW()
                                 WHERE id = ?");
        $update->bind_param("si", $selectedProgram, $applicant['id']);
        $update->execute();
        
        // Create user account
        $password = generateRandomPassword();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $userInsert = $conn->prepare("INSERT INTO users 
                                    (email, password, role, status) 
                                    VALUES (?, ?, 'student', 'active')");
        $userInsert->bind_param("ss", $applicant['email'], $hashedPassword);
        $userInsert->execute();
        $userId = $conn->insert_id;
        
        // Generate student ID
        $studentId = "MZT" . date("Y") . str_pad($userId, 5, "0", STR_PAD_LEFT);
        
        // Add to students table
        $studentInsert = $conn->prepare("INSERT INTO students 
                                       (user_id, admission_id, student_id, program_enrolled, enrollment_date) 
                                       VALUES (?, ?, ?, ?, CURDATE())");
        $studentInsert->bind_param("iiss", $userId, $applicant['id'], $studentId, $selectedProgram);
        $studentInsert->execute();
        
        // Send acceptance email
        sendAcceptanceEmail($applicant['email'], $applicant['firstname'], $studentId, $password, $selectedProgram);
        
        $acceptedCount++;
    } else {
        // Reject application
        $update = $conn->prepare("UPDATE admissions 
                                 SET selection_status = 'rejected',
                                     selection_date = NOW()
                                 WHERE id = ?");
        $update->bind_param("i", $applicant['id']);
        $update->execute();
        
        // Send rejection email
        sendRejectionEmail($applicant['email'], $applicant['firstname']);
    }
}

// Helper functions
function gradeToPoints($grade) {
    $gradeScale = [
        'A' => 12, 'B' => 10, 'C' => 8, 
        'D' => 6, 'E' => 4, 'F' => 2
    ];
    return $gradeScale[strtoupper($grade)] ?? 0;
}

function checkProgramRequirements($program, $subjects) {
    // Define program requirements (simplified example)
    $requirements = [
        'Computer Engineering' => ['Mathematics', 'Physics', 'English'],
        'Business Management' => ['Mathematics', 'English', 'Commerce'],
        // Add all other programs and their requirements
    ];
    
    // Find matching program
    foreach ($requirements as $prog => $reqSubjects) {
        if (strpos($program, $prog) !== false) {
            $subjectNames = array_column($subjects, 'subject');
            $matches = array_intersect($reqSubjects, $subjectNames);
            return count($matches) >= 2; // At least 2 required subjects
        }
    }
    
    return false;
}

function generateRandomPassword($length = 10) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($chars), 0, $length);
}

function sendAcceptanceEmail($email, $name, $studentId, $password, $program) {
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    // Configure mailer
    
    $mail->setFrom('admissions@mztec.edu', 'MZTEC University');
    $mail->addAddress($email);
    $mail->Subject = 'Congratulations! Your Application Has Been Accepted';
    
    $message = "Dear $name,\n\n";
    $message .= "We are pleased to inform you that your application to MZTEC University has been accepted!\n\n";
    $message .= "Program: $program\n";
    $message .= "Student ID: $studentId\n";
    $message .= "Temporary Password: $password\n\n";
    $message .= "You can now login to the student portal using your email and this temporary password.\n";
    $message .= "Please change your password after first login.\n\n";
    $message .= "Welcome to MZTEC University!";
    
    $mail->Body = $message;
    $mail->send();
}

function sendRejectionEmail($email, $name) {
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    // Configure mailer
    
    $mail->setFrom('admissions@mztec.edu', 'MZTEC University');
    $mail->addAddress($email);
    $mail->Subject = 'Your Application Status';
    
    $message = "Dear $name,\n\n";
    $message .= "Thank you for your application to MZTEC University.\n\n";
    $message .= "After careful consideration, we regret to inform you that your application was not successful for this intake.\n";
    $message .= "We encourage you to apply again in the future.\n\n";
    $message .= "Best regards,\n";
    $message .= "MZTEC University Admissions Team";
    
    $mail->Body = $message;
    $mail->send();
}
