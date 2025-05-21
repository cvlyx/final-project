<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['error'] = 'Unauthorized access.';
    header('Location: ../auth/login.php');
    exit();
}
?>
<!-- Rest of admin.php unchanged -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhanced MZTEC-EMS Admin Dashboard</title>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/kTc3+1gxK7+6urvYFUl/zJx2Q0uz1HbFegK9ZzUc1AdgC7zP9R+7T5hbV+o2icTt0kYwDb3rU5Pqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Chart.js for charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <style>
    /* Basic Reset */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: Arial, sans-serif; background-color: #f3f4f6; color: #1f2937; transition: background-color 0.3s, color 0.3s; }
    body.dark { background-color: #1f2937; color: #f9fafb; }
    a { text-decoration: none; }
    
    /* Layout */
    .container { display: flex; height: 100vh; overflow: hidden; }
    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #1e3a8a, #6d28d9);
      padding: 20px;
      color: #fff;
      overflow-y: auto;
    }
    .sidebar header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 30px;
    }
    .sidebar header img { 
      width: 40px; 
      height: 40px; 
      border-radius: 50%; 
      border: 2px solid #fff;
    }
    .sidebar header h1 { font-size: 24px; font-weight: bold; }
    .sidebar nav a {
      display: flex;
      align-items: center;
      padding: 10px;
      margin-bottom: 10px;
      color: #fff;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .sidebar nav a:hover { background: rgba(255,255,255,0.2); }
    .sidebar nav a i { margin-right: 10px; }
    .sidebar .toggle-btn {
      background: #fff;
      color: #1e3a8a;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }
    .main { flex: 1; display: flex; flex-direction: column; overflow: auto; }
    .navbar {
      background: #fff;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      transition: background 0.3s;
    }
    
    body.dark .navbar { background: #374151; }
    .navbar .search input {
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .navbar .profile { position: relative; }
    .navbar .profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
      border: 2px solid #ccc;
    }
    .dropdown {
      position: absolute;
      right: 0;
      top: 50px;
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 150px;
      display: none;
    }
    .dropdown a {
      display: block;
      padding: 10px;
      color: #1f2937;
    }
    .dropdown a:hover { background: #f0f0f0; }
    body.dark .dropdown { background: #374151; border-color: #4b5563; }
    body.dark .dropdown a { color: #f9fafb; }
    body.dark .dropdown a:hover { background: #4b5563; }
    .content { padding: 20px; }

    /* Summary Cards */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }
    .card {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      display: flex;
      align-items: center;
    }
    .card:hover { transform: translateY(-5px); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
    body.dark .card { background: #374151; }
    .card h3 { margin-bottom: 5px; font-size: 18px; }
    .card p { font-size: 24px; font-weight: bold; }
    .card .radial-progress {
      --size: 64px;
      --progress: 0.8;
      --thickness: 8px;
      width: var(--size);
      height: var(--size);
      border-radius: 50%;
      background: conic-gradient(#4ade80 calc(var(--progress)*1%), #e5e7eb 0);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #1f2937;
      margin-right: 15px;
    }
    body.dark .card .radial-progress { color: #f9fafb; }

    /* Charts Section */
    .charts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }
    .chart-card {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    body.dark .chart-card { background: #374151; }

    /* Data Table */
    .table-container {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      overflow-x: auto;
    }
    body.dark .table-container { background: #374151; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    th { background: #f3f4f6; }
    body.dark th { background: #4b5563; }
    tr:hover { background: #f9fafb; }
    body.dark tr:hover { background: #4b5563; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .sidebar { display: none; }
      .container { flex-direction: column; }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <header>
        <!-- Online logo image from Unsplash (replace with your logo) -->
        <img src="https://source.unsplash.com/collection/888146/40x40" alt="Logo">
        <h1>MZTEC-EMS</h1>
      </header>
      <nav>
        <a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        <a href="/students.php"><i class="fas fa-user-graduate"></i>Students</a>
        <a href="applications.php"><i class="fas fa-file-alt"></i>Applications</a>
        <a href="#"><i class="fas fa-briefcase"></i>Internships</a>
        <a href="#"><i class="fas fa-money-bill-wave"></i>Payments</a>
        <a href="#"><i class="fas fa-chart-line"></i>Reports</a>
        <a href="#"><i class="fas fa-bell"></i>Notifications</a>
        <a href="#"><i class="fas fa-cogs"></i>Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </nav>
      <button id="toggleDark" class="toggle-btn">Toggle Dark</button>
    </aside>

    <!-- Main Content -->
    <div class="main">
      <!-- Navbar -->
      <div class="navbar">
        <div class="search">
          <input type="text" placeholder="Search...">
        </div>
        <div class="profile">
          <!-- Online profile picture -->
          <img src="https://i.pravatar.cc/40?img=3" alt="Profile" id="profileImg">
          <div class="dropdown" id="profileDropdown">
            <a href="#"><i class="fas fa-user"></i> Profile</a>
            <a href="#"><i class="fas fa-sliders-h"></i> Settings</a>
            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="content">
        <!-- Summary Cards -->
        <div class="cards">
          <div class="card">
            <div class="radial-progress" style="--progress: 0.8;">80%</div>
            <div>
              <h3>Student Enrollment</h3>
              <p>350</p>
            </div>
          </div>
          <div class="card">
            <div class="radial-progress" style="--progress: 0.65;">65%</div>
            <div>
              <h3>Applications Reviewed</h3>
              <p>25</p>
            </div>
          </div>
          <div class="card">
            <div class="radial-progress" style="--progress: 0.90;">90%</div>
            <div>
              <h3>Fee Collection</h3>
              <p>$45,000</p>
            </div>
          </div>
          <div class="card">
            <div class="radial-progress" style="--progress: 0.75;">75%</div>
            <div>
              <h3>Internship Tracking</h3>
              <p>78</p>
            </div>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="charts">
          <div class="chart-card">
            <h3>Enrollment Trends</h3>
            <canvas id="enrollmentChart"></canvas>
          </div>
          <div class="chart-card">
            <h3>Fee Collection Trends</h3>
            <canvas id="feesChart"></canvas>
          </div>
        </div>

        <!-- Data Table -->
        <div class="table-container">
          <h3>Recent Student Applications</h3>
          <table>
            <thead>
              <tr>
                <th>App ID</th>
                <th>Name</th>
                <th>Program</th>
                <th>Status</th>
                <th>Submitted</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>A1001</td>
                <td>Alice Mwale</td>
                <td>Diploma in IT Systems</td>
                <td style="color: orange;">Pending</td>
                <td>2024-11-01</td>
              </tr>
              <tr>
                <td>A1002</td>
                <td>Brian Phiri</td>
                <td>Certificate in Electrical Installation</td>
                <td style="color: green;">Approved</td>
                <td>2024-10-28</td>
              </tr>
              <tr>
                <td>A1003</td>
                <td>Chikondi Banda</td>
                <td>Diploma in Business Management</td>
                <td style="color: red;">Rejected</td>
                <td>2024-10-25</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Dark mode toggle
    document.getElementById('toggleDark').addEventListener('click', function() {
      document.body.classList.toggle('dark');
    });

    // Profile dropdown toggle
    document.getElementById('profileImg').addEventListener('click', function() {
      var dropdown = document.getElementById('profileDropdown');
      dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
    });

    // Chart: Enrollment Trends
    var ctxEnrollment = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(ctxEnrollment, {
      type: 'line',
      data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
          label: 'Enrollments',
          data: [50, 75, 65, 80, 95, 110, 105, 100, 115, 130, 140, 150],
          borderColor: '#4ade80',
          borderWidth: 3,
          tension: 0.4,
          fill: false
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
      }
    });

    // Chart: Fee Collection Trends
    var ctxFees = document.getElementById('feesChart').getContext('2d');
    new Chart(ctxFees, {
      type: 'bar',
      data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
          label: 'Fees ($)',
          data: [5000, 6800, 6200, 7500, 8200, 9000, 8700, 9200, 9800, 10200, 10800, 11500],
          backgroundColor: 'rgba(59, 130, 246, 0.7)',
          borderColor: 'rgba(59, 130, 246, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
      }
    });
    
  </script>
</body>
</html>
