<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Supervisor Dashboard - MZTEC-EMS</title>
  <!-- Font Awesome -->
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        crossorigin="anonymous" />
  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <style>
    /* Reset & Base */
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:Arial,sans-serif;background:#f3f4f6;color:#1f2937;transition:background .3s,color .3s}
    body.dark{background:#1f2937;color:#f9fafb}
    a{text-decoration:none;color:inherit}

    /* Layout */
    .container{display:flex;height:100vh;overflow:hidden}
    .sidebar{width:250px;background:linear-gradient(180deg,#1e3a8a,#6d28d9);padding:20px;color:#fff;overflow-y:auto;flex-shrink:0;transition:left .3s}
    .sidebar.closed{left:-250px;position:fixed;top:0;bottom:0;z-index:100}
    .sidebar header{display:flex;align-items:center;justify-content:space-between;margin-bottom:30px}
    .sidebar header img{width:40px;height:40px;border-radius:50%;border:2px solid #fff}
    .sidebar header h1{font-size:24px;font-weight:bold}
    .sidebar nav a{display:flex;align-items:center;padding:10px;margin-bottom:10px;color:#fff;border-radius:4px;transition:background .3s}
    .sidebar nav a:hover{background:rgba(255,255,255,.2)}
    .sidebar nav a i{margin-right:10px}
    .sidebar .toggle-btn{background:#fff;color:#1e3a8a;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;font-size:14px;margin-top:20px}

    .main{flex:1;display:flex;flex-direction:column;overflow:auto}
    .navbar{background:#fff;padding:15px 20px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 1px 4px rgba(0,0,0,.1);transition:background .3s}
    body.dark .navbar{background:#374151}
    .navbar .menu-toggle{display:none;font-size:24px;cursor:pointer}
    .navbar .search input{padding:8px 12px;border:1px solid #ccc;border-radius:4px;width:200px;max-width:100%}
    .navbar .profile{position:relative}
    .navbar .profile img{width:40px;height:40px;border-radius:50%;cursor:pointer;border:2px solid #ccc}
    .dropdown{position:absolute;right:0;top:50px;background:#fff;border:1px solid #ccc;border-radius:4px;width:150px;display:none;z-index:10}
    .dropdown a{display:block;padding:10px;color:#1f2937}
    .dropdown a:hover{background:#f0f0f0}
    body.dark .dropdown{background:#374151;border-color:#4b5563}
    body.dark .dropdown a{color:#f9fafb}
    body.dark .dropdown a:hover{background:#4b5563}

    .content{padding:20px;overflow:auto}
    .cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:20px}
    .card{background:#fff;padding:20px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,.1);display:flex;align-items:center;transition:transform .3s,box-shadow .3s}
    .card:hover{transform:translateY(-5px);box-shadow:0 4px 12px rgba(0,0,0,.2)}
    body.dark .card{background:#374151}
    .card h3{margin-bottom:5px;font-size:18px}
    .card p{font-size:24px;font-weight:bold}
    .card .radial-progress{--size:64px;--progress:0.5;--thickness:8px;width:var(--size);height:var(--size);border-radius:50%;background:conic-gradient(#4ade80 calc(var(--progress)*1%),#e5e7eb 0);display:flex;align-items:center;justify-content:center;font-weight:bold;color:#1f2937;margin-right:15px}
    body.dark .card .radial-progress{color:#f9fafb}

    .charts{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px;margin-bottom:20px}
    .chart-card{background:#fff;padding:20px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,.1)}
    body.dark .chart-card{background:#374151}

    .table-container{background:#fff;border-radius:8px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,.1);overflow-x:auto}
    body.dark .table-container{background:#374151}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;border:1px solid #ccc;text-align:left}
    th{background:#f3f4f6}
    body.dark th{background:#4b5563}
    tr:hover{background:#f9fafb}
    body.dark tr:hover{background:#4b5563}

    @media(max-width:768px){
      .sidebar{position:fixed;left:-250px;top:0;bottom:0;z-index:100}
      .sidebar.open{left:0}
      .navbar .menu-toggle{display:block}
      .navbar .search,input{display:none}
      .container{flex-direction:column}
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar closed" id="sidebar">
      <header>
        <img src="https://source.unsplash.com/collection/888146/40x40" alt="Logo">
        <h1>MZTEC‑EMS</h1>
      </header>
      <nav>
        <a href="#"><i class="fas fa-home"></i>Dashboard</a>
        <a href="#"><i class="fas fa-user-graduate"></i>My Students</a>
        <a href="#"><i class="fas fa-file-alt"></i>Internship Logs</a>
        <a href="#"><i class="fas fa-check-circle"></i>Approvals</a>
        <a href="#"><i class="fas fa-chart-line"></i>Reports</a>
        <a href="#"><i class="fas fa-bell"></i>Notifications</a>
        <a href="#"><i class="fas fa-cog"></i>Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </nav>
      <button id="toggleDark" class="toggle-btn">Toggle Dark</button>
    </aside>

    <!-- Main -->
    <div class="main">
      <!-- Navbar -->
      <div class="navbar">
        <i class="fas fa-bars menu-toggle" id="menuToggle"></i>
        <div class="search">
          <input type="text" placeholder="Search...">
        </div>
        <div class="profile">
          <img src="https://i.pravatar.cc/40?img=12" alt="Profile" id="profileImg">
          <div class="dropdown" id="profileDropdown">
            <a href="#"><i class="fas fa-user"></i> Profile</a>
            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="content">
        <!-- Summary Cards -->
        <div class="cards">
          <div class="card">
            <div class="radial-progress" style="--progress:0.6">60%</div>
            <div><h3>Total Students</h3><p>15</p></div>
          </div>
          <div class="card">
            <div class="radial-progress" style="--progress:0.2">20%</div>
            <div><h3>Pending Approvals</h3><p>3</p></div>
          </div>
          <div class="card">
            <div class="radial-progress" style="--progress:0.5">50%</div>
            <div><h3>Active Internships</h3><p>8</p></div>
          </div>
          <div class="card">
            <div class="radial-progress" style="--progress:0.3">30%</div>
            <div><h3>New Reports</h3><p>5</p></div>
          </div>
        </div>

        <!-- Charts -->
        <div class="charts">
          <div class="chart-card">
            <h3>Approval Trends</h3>
            <canvas id="approvalChart"></canvas>
          </div>
          <div class="chart-card">
            <h3>Internship Status</h3>
            <canvas id="internshipChart"></canvas>
          </div>
        </div>

        <!-- Table -->
        <div class="table-container">
          <h3>My Students</h3>
          <table>
            <thead>
              <tr><th>ID</th><th>Name</th><th>Program</th><th>Status</th><th>Last Update</th></tr>
            </thead>
            <tbody>
              <tr><td>S1001</td><td>Alice Mwale</td><td>IT</td><td style="color:green">Ongoing</td><td>2024-11-05</td></tr>
              <tr><td>S1002</td><td>Brian Phiri</td><td>Automotive</td><td style="color:orange">Pending</td><td>2024-11-04</td></tr>
              <tr><td>S1003</td><td>Chikondi Banda</td><td>Electrical</td><td style="color:blue">Completed</td><td>2024-10-30</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script>
    // Sidebar toggle
    const sidebar = document.getElementById('sidebar');
    document.getElementById('menuToggle')
      .addEventListener('click', ()=> sidebar.classList.toggle('open'));
      // Close sidebar when clicking outside or pressing escape
      document.addEventListener('click', (event) => {
        if (!sidebar.contains(event.target) && !event.target.matches('#menuToggle')) {
        sidebar.classList.remove('open');
        }
      });

      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
        sidebar.classList.remove('open');
        }
      });
    // Dark mode toggle
    document.getElementById('toggleDark')
      .addEventListener('click', ()=> document.body.classList.toggle('dark'));

    // Profile dropdown
    document.getElementById('profileImg')
      .addEventListener('click', ()=>{
        const dd = document.getElementById('profileDropdown');
        dd.style.display = dd.style.display==='block'?'none':'block';
      });

    // Charts
    new Chart(document.getElementById('approvalChart').getContext('2d'), {
      type:'line',
      data:{
        labels:['Week 1','Week 2','Week 3','Week 4'],
        datasets:[{label:'Approvals',data:[2,3,1,4],borderColor:'#4ade80',tension:0.4}]
      },
      options:{responsive:true}
    });

    new Chart(document.getElementById('internshipChart').getContext('2d'), {
      type:'bar',
      data:{
        labels:['Ongoing','Pending','Completed'],
        datasets:[{label:'Count',data:[8,3,5],backgroundColor:['#4ade80','#f59e0b','#3b82f6']}]
      },
      options:{responsive:true}
    });
  </script>
</body>
</html>
