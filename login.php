<?php
session_start(); // Start session at the very top
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="MZTEC University offers quality technical education with courses in Automotive Engineering, Electrical Engineering, and Information Technology. Discover our programs, faculty, events, news, and more.">
  <title>MZTEC University - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    :root {
      --primary-color: #002147;
      --secondary-color: #ffd700;
      --accent-color: #e63946;
      --text-color: #2d3748;
      --glass-bg: rgba(255, 255, 255, 0.15);
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background: linear-gradient(135deg, #002147 0%, #000913 100%);
      color: white;
      min-height: 100vh;
      overflow-x: hidden;
    }
    .nav-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      padding: 1.5rem 5%;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      transition: background 0.3s ease;
    }
    .logo {
      font-size: 2rem;
      font-weight: 700;
      color: var(--secondary-color);
    }
    .nav-links {
      display: flex;
      gap: 2rem;
      align-items: center;
    }
    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      padding: 0.5rem 1rem;
    }
    .nav-links a:hover,
    .nav-links a.active {
      color: var(--secondary-color);
    }
    .register-btn {
      background: var(--secondary-color);
      color: var(--primary-color);
      border-radius: 25px;
      padding: 0.8rem 2rem;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s ease, transform 0.3s ease;
    }
    .register-btn:hover {
      background: var(--accent-color);
      transform: scale(1.05);
    }
    .menu-toggle {
      display: none;
      background: var(--primary-color);
      padding: 0.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .menu-toggle:focus {
      outline: 2px solid var(--secondary-color);
    }
    .menu-toggle span {
      display: block;
      width: 25px;
      height: 2px;
      background: #fff;
      margin: 4px 0;
    }
    .menu-toggle:hover {
      background: var(--secondary-color);
    }
    .mobile-menu {
      display: none;
      flex-direction: column;
      align-items: center;
      position: absolute;
      top: 4rem;
      left: 0;
      right: 0;
      background: var(--primary-color);
      padding: 1rem 0;
      z-index: 1100;
    }
    .mobile-menu.active {
      display: flex;
    }
    .mobile-menu a {
      color: white;
      padding: 1rem;
      text-decoration: none;
      transition: background 0.3s ease;
      width: 100%;
      text-align: center;
    }
    .mobile-menu a:hover {
      background: var(--secondary-color);
    }
    .mosaic-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }
    .mosaic-tile {
      position: absolute;
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      animation: float 15s infinite linear;
    }
    @keyframes float {
      0% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
      100% { transform: translateY(0) rotate(0deg); }
    }
    .login-container {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 2rem;
      padding-top: 100px;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 3rem;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }
    .glass-card::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(
        to bottom right,
        rgba(255, 215, 0, 0.1) 0%,
        rgba(0, 33, 71, 0.2) 50%,
        rgba(230, 57, 70, 0.1) 100%
      );
      transform: rotate(30deg);
      z-index: -1;
    }
    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    .login-header h1 {
      font-size: 2.5rem;
      color: #ffd700;
      margin-bottom: 0.5rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    .login-header p {
      color: rgba(255, 255, 255, 0.8);
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      color: rgba(255, 255, 255, 0.9);
      font-weight: 500;
    }
    .form-control {
      width: 100%;
      padding: 1rem;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--secondary-color);
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
    }
    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }
    .login-btn {
      width: 100%;
      padding: 1rem;
      background: var(--secondary-color);
      color: var(--primary-color);
      border: none;
      border-radius: 8px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 1rem;
      box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }
    .login-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }
    .login-footer {
      margin-top: 2rem;
      text-align: center;
      color: rgba(255, 255, 255, 0.7);
    }
    .login-footer a {
      color: var(--secondary-color);
      text-decoration: none;
      font-weight: 600;
    }
    .alert {
      background: rgba(230, 57, 70, 0.2);
      color: white;
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    .alert.success {
      background: rgba(255, 215, 0, 0.2);
    }
    @media (max-width: 768px) {
      .glass-card {
        padding: 2rem;
      }
      .login-header h1 {
        font-size: 2rem;
      }
      .nav-links { display: none; }
      .menu-toggle { display: block; }
    }
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <header class="header">
    <nav class="nav-container" aria-label="Main Navigation">
      <div class="logo">MZTEC</div>
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="courses.php">Courses</a>
        <a href="admission.php">Admissions</a>
        <a href="#contact">Contact</a>
        <a href="register.php" class="register-btn">Register Now</a>
      </div>
      <button class="menu-toggle" aria-label="Toggle Navigation" aria-controls="mobile-menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
      <div class="mobile-menu" id="mobile-menu">
        <a href="index.php">Home</a>
        <a href="courses.php">Courses</a>
        <a href="admission.php">Admissions</a>
        <a href="#contact">Contact</a>
        <a href="register.php" class="register-btn">Register Now</a>
      </div>
    </nav>
  </header>

  <div class="login-container">
    <div class="glass-card">
      <div class="login-header">
        <h1>Log In</h1>
        <p>Sign in with your MZTEC credentials</p>
      </div>
      <?php
      if (isset($_SESSION['error'])) {
        echo '<div class="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
        unset($_SESSION['error']);
      }
      if (isset($_SESSION['success'])) {
        echo '<div class="alert success">' . htmlspecialchars($_SESSION['success']) . '</div>';
        unset($_SESSION['success']);
      }
      ?>
      <form id="loginForm" action="loginprocess.php" method="POST">
        <div class="form-group">
          <label for="email">College Email</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            class="form-control" 
            placeholder="student@mzuzutec.edu.mw" 
            required
            pattern="[a-zA-Z0-9._%+-]+@mzuzutec\.edu\.mw$"
            title="Please use your official college email"
          >
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input 
            type="password" 
            id="password" 
            name="password" 
            class="form-control" 
            placeholder="Enter your password" 
            required
            minlength="8"
          >
          <a href="forget.php" style="display: block; text-align: right; margin-top: 0.5rem; color: var(--secondary-color); font-size: 0.9rem;">Forgot Password?</a>
        </div>
        <button type="submit" class="login-btn">
          <i class="material-icons" style="vertical-align: middle;">login</i> Sign In
        </button>
      </form>
      <div class="login-footer">
        <p>New student? <a href="admission.html">Apply for admission</a> to get your credentials</p>
      </div>
    </div>
  </div>

  <footer class="footer">
    <p>© 2023 MZTEC University. All rights reserved.</p>
    <div class="social-links">
      <a href="#" aria-label="Facebook"><strong>Facebook</strong></a>
      <a href="#" aria-label="Twitter"><strong>Twitter</strong></a>
      <a href="#" aria-label="LinkedIn"><strong>LinkedIn</strong></a>
    </div>
  </footer>

  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    menuToggle.addEventListener('click', () => {
      const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !isExpanded);
      mobileMenu.classList.toggle('active');
    });
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
    window.addEventListener('scroll', () => {
      const nav = document.querySelector('.nav-container');
      nav.style.background = window.scrollY > 100 ? 'var(--primary-color)' : 'rgba(0, 33, 71, 0.95)';
    });
  </script>
</body>
</html>