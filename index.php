<?php
// index.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="MZTEC University offers quality technical education with courses in Automotive Engineering, Electrical Engineering, and Information Technology. Discover our programs, faculty, events, news, and more.">
  <title>MZTEC University - Quality Technical Education</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Favicon (if available) -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <style>
    /* Base Styles */
    :root {
      --primary-color: #002147;       /* Deep blue */
      --secondary-color: #ffd700;     /* Gold */
      --accent-color: #e63946;        /* Red */
      --text-color: #2d3748;          /* Dark gray for text */
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      line-height: 1.6;
      color: var(--text-color);
    }
    /* Header (Hero) Styles */
    .header {
      background: linear-gradient(rgba(0, 33, 71, 0.9), rgba(0, 33, 71, 0.9)),
                  url('public/assets/images/speedlight photography_3.jpg') no-repeat center/cover;
      min-height: 100vh;
      color: white;
      position: relative;
      clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
    }
    /* Navigation Bar */
    .nav-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.5rem 5%;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      background: rgba(0, 33, 71, 0.95);
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
    /* Mobile Menu Toggle */
    .menu-toggle {
      display: none;
      background: var(--primary-color);
      padding: 0.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
   
    .menu-toggle span {
      display: block;
      width: 25px;
      height: 2px;
      background: #fff;
      margin: 4px 0;
    }
  
    /* Mobile Menu */
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
    /* Hero Section */
    .hero {
      padding-top: 15rem;
      text-align: center;
    }
    .hero h1 {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      animation: fadeInDown 1s ease-in-out;
    }
    .hero p {
      font-size: 1.25rem;
      margin-bottom: 2rem;
      animation: fadeInUp 1s ease-in-out;
    }
    .cta-button {
      background: var(--secondary-color);
      color: var(--primary-color);
      border-radius: 25px;
      padding: 1rem 2rem;
      font-weight: 600;
      text-decoration: none;
      animation: fadeInUp 1s ease-in-out;
      transition: background 0.3s ease, transform 0.3s ease;
    }
    .cta-button:hover {
      background: var(--accent-color);
      transform: scale(1.05);
    }
    /* Sections */
    .section {
      padding: 5rem 5%;
    }
    .section-title {
      text-align: center;
      margin-bottom: 3rem;
      font-size: 2.5rem;
      color: var(--primary-color);
    }
    /* Admissions Process */
    .process-steps {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      margin-top: 3rem;
    }
    .process-card {
      text-align: center;
      padding: 2rem;
      background: #f8f9fa;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }
    .process-card:hover {
      transform: translateY(-5px);
    }
    /* Courses Section */
    .courses {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }
    .course-card {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .course-card:hover {
      transform: translateY(-5px);
    }
    .course-card img {
      width: 100%;
      border-radius: 10px;
    }
    .course-card h3 {
      margin-top: 1rem;
      font-size: 1.5rem;
    }
    .course-card p {
      margin-top: 0.5rem;
      font-size: 1rem;
    }
    /* Faculty Section */
    .faculty-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
    }
    .faculty-card {
      text-align: center;
      background: #f8f9fa;
      padding: 2rem;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }
    .faculty-card:hover {
      transform: translateY(-5px);
    }
    .faculty-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 1rem;
    }
    /* Events Section */
    .events-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
    }
    .event-card {
      background: white;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .event-card:hover {
      transform: translateY(-5px);
    }
    /* News Section */
    .news-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }
    .news-card {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .news-card:hover {
      transform: translateY(-5px);
    }
    .news-card h3 {
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }
    .news-card p {
      font-size: 1rem;
    }
    /* Gallery Section */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }
    .gallery-grid img {
      width: 100%;
      border-radius: 10px;
      object-fit: cover;
    }
    /* FAQ Section */
    .faq-item {
      margin-bottom: 1.5rem;
    }
    .faq-item h4 {
      font-size: 1.25rem;
      color: var(--primary-color);
      margin-bottom: 0.5rem;
    }
    .faq-item p {
      font-size: 1rem;
      padding-left: 1rem;
      border-left: 3px solid var(--secondary-color);
    }
    /* Testimonials */
    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }
    .testimonial-card {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    /* Contact Form */
    .contact-form {
      max-width: 600px;
      margin: 0 auto;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-control {
      width: 100%;
      padding: 1rem;
      border: 2px solid #ddd;
      border-radius: 8px;
    }
    /* Footer */
    .footer {
      background: var(--primary-color);
      color: white;
      padding: 3rem 5%;
      text-align: center;
    }
    .social-links a {
      color: white;
      margin: 0 0.5rem;
      text-decoration: none;
    }
    .course-card img,
  .gallery-grid img {
    width: 300px; /* Set a fixed width */
    height: 200px; /* Set a fixed height */
    object-fit: cover; /* Ensure the image fits within the dimensions */
    border-radius: 10px; /* Keep the rounded corners */
  }
    /* Responsive Rules */
    @media (max-width: 768px) {
      .nav-links { display: none; }
      .menu-toggle { display: block; }
      .hero h1 { font-size: 2.5rem; }
      .section-title { font-size: 2rem; }
    }
    /* Animations */
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Header Section -->
  <header class="header" id="home">
    <nav class="nav-container" aria-label="Main Navigation">
      <!-- LOGO -->
      <div class="logo">MZTEC</div>
      <!-- Desktop Nav Links -->
      <div class="nav-links">
        <a href="public/index.php" class="active">Home</a>
        <a href="public/courses.php">Courses</a>
        <a href="public/admission.php">Admissions</a>
        <a href="#contact">Contact</a>
        <a href="auth/login.php" class="register-btn">Sign in Now</a>
      </div>
      <!-- Mobile Menu Toggle -->
      <button class="menu-toggle" aria-label="Toggle Navigation" aria-controls="mobile-menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <!-- Mobile Dropdown Menu -->
      <div class="mobile-menu" id="mobile-menu">
        <a href="public/index.php" class="active">Home</a>
        <a href="public/courses.php">Courses</a>
        <a href="public/admission.php">Admissions</a>
        <a href="#contact">Contact</a>
        <a href="auth/login.php" class="register-btn">Sign in Now</a>
      </div>
    </nav>
    <div class="hero">
      <h1>Transform Your Future With Technical Education</h1>
      <p>Join Malawi's Premier Technical College for Hands-On Learning</p>
      <a href="admission.php" class="cta-button">Apply Now</a>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Admissions Process Section -->
    <section class="section" id="admissions">
      <h2 class="section-title">Admission Process</h2>
      <div class="process-steps">
        <div class="process-card">
          <h3>1. Application</h3>
          <p>Submit your online application form.</p>
        </div>
        <div class="process-card">
          <h3>2. Review</h3>
          <p>Document verification and approval.</p>
        </div>
        <div class="process-card">
          <h3>3. Enrollment</h3>
          <p>Complete registration and payment.</p>
        </div>
      </div>
    </section>

    <!-- About Us Section -->
    <section class="section" id="about">
      <h2 class="section-title">About Us</h2>
      <p style="max-width:800px; margin: 0 auto; text-align: center;">
        MZTEC University is dedicated to providing quality technical education that empowers students with the skills needed in today's competitive world.
        Our commitment to hands-on learning and industry collaboration ensures that graduates are ready to excel in their chosen fields.
      </p>
    </section>

    <!-- Courses Section -->
    <section class="section" id="courses">
      <h2 class="section-title">Our Courses</h2>
      <div class="courses">
        <div class="course-card">
          <img src="https://th.bing.com/th/id/R.8f67a0e890d6a109a4091ca5cbb44511?rik=vTlIcipFMpaiEw&pid=ImgRaw&r=0&sres=1&sresct=1" alt="Automotive Engineering">
          <h3>Automotive Engineering</h3>
          <p>Learn the latest in automotive technology and repair.</p>
        </div>
        <div class="course-card">
          <img src="https://th.bing.com/th/id/OIP.fU2_Gtqapytv1hi0o6ECqgHaEK?rs=1&pid=ImgDetMain" alt="Electrical Engineering Course">
          <h3>Electrical Engineering</h3>
          <p>Master the skills needed for a career in electrical engineering.</p>
        </div>
        <div class="course-card">
          <img src="https://images.unsplash.com/photo-1593642532400-2682810df593?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Information Technology">
          <h3>Information Technology</h3>
          <p>Get hands-on experience with the latest IT tools and techniques.</p>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section class="section" id="gallery">
      <h2 class="section-title">Campus Gallery</h2>
      <div class="gallery-grid">
        <img src="https://tse3.mm.bing.net/th/id/OIP.NhnVxc2cA5mrmXOKmjQMAAHaFj?rs=1&pid=ImgDetMain" alt="Campus Image">
        <img src="public/assets/images/speedlight photography_3.jpg" alt="Campus Image">
        <img src="public/assets/images/speedlight photography_8.JPG" alt="Campus Image">
        <img src="public/assets/images/speedlight photography_16.JPG" alt="Campus Image">
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section" id="testimonials">
      <h2 class="section-title">Student Testimonials</h2>
      <div class="testimonial-grid">
        <div class="testimonial-card">
          <p>"MZTEC transformed my career prospects with practical training and industry connections."</p>
          <h4>- John Banda, Automotive Engineering</h4>
        </div>
        <!-- Additional testimonials can be added here -->
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="section" id="faq">
      <h2 class="section-title">Frequently Asked Questions</h2>
      <div class="faq-item">
        <h4>What courses do you offer?</h4>
        <p>We offer a wide range of courses in technical fields including Engineering, Information Technology, and more.</p>
      </div>
      <div class="faq-item">
        <h4>How do I apply?</h4>
        <p>You can apply online through our admissions page by filling out the application form.</p>
      </div>
      <div class="faq-item">
        <h4>Are scholarships available?</h4>
        <p>Yes, we offer a variety of scholarships for eligible students based on merit and need.</p>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="section" id="contact">
      <h2 class="section-title">Contact Us</h2>
      <form class="contact-form">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Your Name" required />
        </div>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Your Email" required />
        </div>
        <div class="form-group">
          <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
        </div>
        <button class="register-btn" type="submit">Send Message</button>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2023 MZTEC University. All rights reserved.</p>
    <div class="social-links">
      <a href="#" aria-label="Facebook"><strong>Facebook</strong></a>
      <a href="#" aria-label="Twitter"><strong>Twitter</strong></a>
      <a href="#" aria-label="LinkedIn"><strong>LinkedIn</strong></a>
    </div>
  </footer>

  <script>
    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
      const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !isExpanded);
      mobileMenu.classList.toggle('active');
    });

    // Smooth Scrolling for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });

    // Change Navigation Background on Scroll
    window.addEventListener('scroll', () => {
      const nav = document.querySelector('.nav-container');
      nav.style.background = window.scrollY > 100 ? 'var(--primary-color)' : 'rgba(0, 33, 71, 0.95)';
    });

    // Highlight current page in navigation (desktop)
    const currentLocation = location.href;
    document.querySelectorAll('.nav-links a').forEach(link => {
      if (link.href === currentLocation) {
        link.classList.add('active');
      }
    });
  
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('payment') === 'success') {
      Swal.fire({
        icon: 'success',
        title: 'Payment Successful!',
        text: 'Thank you for your payment. Your admission application has been submitted.',
        confirmButtonText: 'OK',
        timer: 5000,
        timerProgressBar: true
      }).then(() => {
        // Remove query param from URL so popup won't show on reload
        window.history.replaceState({}, document.title, window.location.pathname);
      });
    }
  
  </script>
</body>
</html>
