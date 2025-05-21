<?php
// students.php
session_start();
// (Optional) enforce only admins can view
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'mztec_university');
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Fetch all users where role = 'student'
$stmt = $mysqli->prepare("SELECT id, full_name, email, program, created_at FROM users WHERE role = ? ORDER BY created_at DESC");
$role = 'student';
$stmt->bind_param('s', $role);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Students - MZTEC-EMS Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Container & Layout */
    body { margin:0; font-family: Arial, sans-serif; background:#f3f4f6; color:#1f2937; }
    .container { display:flex; height:100vh; overflow:hidden; }
    .sidebar {
      width: 220px;
      background: linear-gradient(180deg,#1e3a8a,#6d28d9);
      padding:20px;
      color:#fff;
    }
    .sidebar h2 { font-size:20px; margin-bottom:30px; }
    .sidebar a {
      display:block; color:#fff; text-decoration:none;
      padding:10px; margin-bottom:8px; border-radius:4px;
      transition:background .2s;
    }
    .sidebar a:hover { background: rgba(255,255,255,0.2); }
    .main { flex:1; overflow-y:auto; }
    .navbar {
      background:#fff; padding:15px 20px;
      display:flex; justify-content:space-between;
      align-items:center; box-shadow:0 1px 4px rgba(0,0,0,0.1);
    }
    .navbar .profile img {
      width:40px; height:40px; border-radius:50%; cursor:pointer;
    }
    .content { padding:20px; }

    /* Table */
    table {
      width:100%; border-collapse:collapse;
      background:#fff; border-radius:8px; overflow:hidden;
      box-shadow:0 2px 6px rgba(0,0,0,0.1);
    }
    th, td { padding:12px; border:1px solid #ddd; text-align:left; }
    th { background:#e5e7eb; }
    tr:hover { background:#f9fafb; }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>MZTEC-EMS</h2>
      <nav>
        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="students.php" class="active"><i class="fas fa-user-graduate"></i> Students</a>
        <a href="applications.php"><i class="fas fa-file-alt"></i> Applications</a>
        <a href="internships.php"><i class="fas fa-briefcase"></i> Internships</a>
        <a href="payments.php"><i class="fas fa-money-bill"></i> Payments</a>
        <a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="notifications.php"><i class="fas fa-bell"></i> Notifications</a>
        <a href="settings.php"><i class="fas fa-cogs"></i> Settings</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="main">
      <!-- Navbar -->
      <div class="navbar">
        <div class="search">
          <input type="text" placeholder="Search students...">
        </div>
        <div class="profile">
          <img src="https://i.pravatar.cc/40?img=5" alt="Admin Profile" id="profileImg">
        </div>
      </div>

      <!-- Page Content -->
      <div class="content">
        <h1>All Students</h1>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Program</th>
              <th>Enrolled On</th>
            </tr>
          </thead>
          <tbody>
            <?php while($user = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($user['id']) ?></td>
              <td><?= htmlspecialchars($user['full_name']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><?= htmlspecialchars($user['program']) ?></td>
              <td><?= date('Y-m-d', strtotime($user['created_at'])) ?></td>
            </tr>
            <?php endwhile; ?>
            <?php if($result->num_rows === 0): ?>
            <tr>
              <td colspan="5" style="text-align:center; padding:20px;">No students found.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Optional: profile dropdown / dark mode scripts -->
  <script>
    document.getElementById('profileImg').addEventListener('click', ()=>{
      // toggle dropdown...
    });
  </script>
</body>
</html>
