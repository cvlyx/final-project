<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Explore the courses offered at MZTEC University.">
  <title>MZTEC University - Courses</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    :root {
      --primary-color: #002147;
      --secondary-color: #ffd700;
      --accent-color: #e63946;
      --text-color: #2d3748;
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
      background: #f0f0f0;
    }
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
    .menu-toggle {
      display: none;
      background: var(--primary-color);
      padding: 0.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .menu-toggle span {
      display: block;
      width: 25px;
      height: 2px;
      background: #fff;
      margin: 4px 0;
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
      width: 100%;
      text-align: center;
    }
    .mobile-menu a:hover {
      background: var(--secondary-color);
    }
    .header {
      background: linear-gradient(rgba(0, 33, 71, 0.9), rgba(0, 33, 71, 0.9)),
                  url('/speedlight photography_3.JPG') no-repeat center/cover;
      min-height: 100vh;
      color: white;
      position: relative;
      clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
    }
    .hero {
      padding-top: 15rem;
      text-align: center;
    }
    .hero h1 {
      font-size: 4rem;
      margin-bottom: 1.5rem;
    }
    .hero p {
      font-size: 1.25rem;
      margin-bottom: 2rem;
    }
    .cta-button {
      background: var(--secondary-color);
      color: var(--primary-color);
      border-radius: 25px;
      padding: 1rem 2rem;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s ease, transform 0.3s ease;
    }
    .cta-button:hover {
      background: var(--accent-color);
      transform: scale(1.05);
    }
    .section {
      padding: 5rem 5%;
    }
    .section-title {
      text-align: center;
      margin-bottom: 3rem;
      font-size: 2.5rem;
      color: var(--primary-color);
    }
    .courses-section {
      padding: 4rem 5%;
      background: #fff;
    }
    .courses-section h2 {
      text-align: center;
      margin-bottom: 2rem;
      color: #002147;
      font-size: 2.5rem;
    }
    .department {
      margin-bottom: 4rem;
    }
    .department h3 {
      color: #002147;
      margin-bottom: 1rem;
      font-size: 2rem;
      border-bottom: 2px solid #ffd700;
      display: inline-block;
      padding-bottom: 0.5rem;
    }
    .course-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
    }
    .course-card {
      background: #f9f9f9;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .course-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .course-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .course-card .course-info {
      padding: 1rem;
    }
    .course-card .course-info h4 {
      margin-bottom: 0.5rem;
      color: #e63946;
    }
    .course-card .course-info p {
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }
    

    .footer {
      background: var(--primary-color);
      color: white;
      padding: 3rem 5%;
      text-align: center;
    }
    @media (max-width: 768px) {
      .nav-links { display: none; }
      .menu-toggle { display: block; }
      .hero h1 { font-size: 2.5rem; }
    }
  </style>
</head>
<body>
  <header class="header" id="home">
    <nav class="nav-container animate__animated animate__fadeInDown" aria-label="Main Navigation">
      <div class="logo">MZTEC</div>
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="courses.php" class="active">Courses</a>
        <a href="admission.php">Admissions</a>
        <a href="#contact">Contact</a>
       
      </div>
      <button class="menu-toggle" aria-label="Toggle Navigation">
        <span></span><span></span><span></span>
      </button>
      <div class="mobile-menu" id="mobile-menu">
        <a href="index.php">Home</a>
        <a href="courses.php" class="active">Courses</a>
        <a href="admission.php">Admissions</a>
        <a href="#contact">Contact</a>
     
      </div>
    </nav>
    <div class="hero">
      <h1>Our Courses</h1>
      <p>Discover Your Path at MZTEC University</p>
      <a href="admission.php" class="cta-button">Apply Now</a>
    </div>
  </header>

  <section class="courses-section" id="courses">
    <h2 class="animate__animated animate__fadeInUp">Explore Our Courses</h2>
    
    <!-- Commercial Department -->
    <div class="department">
      <h3 class="animate__animated animate__fadeInLeft">Commercial Department</h3>
      <div class="course-grid">
        <!-- Administrative Studies -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Administrative Studies">
          <div class="course-info">
            <h4>Administrative Studies (First Year)</h4>
            <p><strong>Exam Board:</strong> ACU</p>
            <p><strong>Tuition Fees:</strong> MK70,000 per term</p>
          </div>
        </div>
        <!-- Certificate in Financial Accounting -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1599949899643-6b8c8a2c4b3b?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Certificate in Financial Accounting">
          <div class="course-info">
            <h4>Certificate in Financial Accounting</h4>
            <p><strong>Exam Board:</strong> ICAM</p>
            <p><strong>Tuition Fees:</strong> MK115,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Accounting -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Diploma in Accounting">
          <div class="course-info">
            <h4>Diploma in Accounting</h4>
            <p><strong>Exam Board:</strong> ICAM</p>
            <p><strong>Tuition Fees:</strong> MK125,000 per Semester</p>
          </div>
        </div>
        <!-- Business Management - Foundation Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1556740749-887f6717d7e4?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Business Management - Foundation Level 4">
          <div class="course-info">
            <h4>Business Management - Foundation Level 4</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK115,000 per Semester</p>
          </div>
        </div>
        <!-- Business Management – Diploma Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Business Management – Diploma Level 4">
          <div class="course-info">
            <h4>Business Management – Diploma Level 4</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK125,000 per Semester</p>
          </div>
        </div>
        <!-- Business Management – Diploma Level 5 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Business Management – Diploma Level 5">
          <div class="course-info">
            <h4>Business Management – Diploma Level 5</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK135,000 per Semester</p>
          </div>
        </div>
        <!-- Business Management – Diploma Level 6 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Business Management – Diploma Level 6">
          <div class="course-info">
            <h4>Business Management – Diploma Level 6</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK145,000 per Semester</p>
          </div>
        </div>
        <!-- Human Resource Management – Foundation Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1550511457-5c3bff5a65f6?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="HRM Foundation Level 4">
          <div class="course-info">
            <h4>Human Resource Management – Foundation Level 4</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK115,000 per Semester</p>
          </div>
        </div>
        <!-- Human Resource Management – Diploma Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1515165562835-9a4824c2e75b?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="HRM Diploma Level 4">
          <div class="course-info">
            <h4>Human Resource Management – Diploma Level 4</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK125,000 per Semester</p>
          </div>
        </div>
        <!-- Human Resource Management – Diploma Level 5 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="HRM Diploma Level 5">
          <div class="course-info">
            <h4>Human Resource Management – Diploma Level 5</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK135,000 per Semester</p>
          </div>
        </div>
        <!-- Human Resource Management – Diploma Level 6 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="HRM Diploma Level 6">
          <div class="course-info">
            <h4>Human Resource Management – Diploma Level 6</h4>
            <p><strong>Exam Board:</strong> ABE</p>
            <p><strong>Tuition Fees:</strong> MK145,000 per Semester</p>
          </div>
        </div>
        <!-- Community Development Diploma Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1581091012184-2a5c6eaf7fa6?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Community Development Diploma Level 4">
          <div class="course-info">
            <h4>Community Development Diploma Level 4</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK125,000 per Semester</p>
          </div>
        </div>
        <!-- Community Development Diploma Level 5 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Community Development Diploma Level 5">
          <div class="course-info">
            <h4>Community Development Diploma Level 5</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK135,000 per Semester</p>
          </div>
        </div>
        <!-- Community Development Diploma Level 6 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1573164574397-df1f4f7f1b3b?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Community Development Diploma Level 6">
          <div class="course-info">
            <h4>Community Development Diploma Level 6</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK145,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Computer Engineering – Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1593642532400-2682810df593?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Computer Engineering – Level 4">
          <div class="course-info">
            <h4>Diploma in Computer Engineering – Level 4</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK130,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Computer Engineering – Level 5 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1573497019413-3c4950ac203d?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Computer Engineering – Level 5">
          <div class="course-info">
            <h4>Diploma in Computer Engineering – Level 5</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK140,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Computer Engineering – Level 6 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Computer Engineering – Level 6">
          <div class="course-info">
            <h4>Diploma in Computer Engineering – Level 6</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK145,000 per Semester</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Construction Department -->
    <div class="department">
      <h3 class="animate__animated animate__fadeInLeft">Construction Department</h3>
      <div class="course-grid">
        <!-- Solar Photovoltaic Installation -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1561484936-f9ad50eac090?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Solar Photovoltaic Installation">
          <div class="course-info">
            <h4>Solar Photovoltaic Installation (First Year - Level 1)</h4>
            <p><strong>Exam Board:</strong> ACU</p>
            <p><strong>Tuition Fees:</strong> MK70,000 per term</p>
          </div>
        </div>
        <!-- Electrical Installation -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1600722142824-7d3b31b2da1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Electrical Installation">
          <div class="course-info">
            <h4>Electrical Installation (First Year - Level 1)</h4>
            <p><strong>Exam Board:</strong> ACU</p>
            <p><strong>Tuition Fees:</strong> MK70,000 per term</p>
          </div>
        </div>
        <!-- Brick Laying -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1598300050447-8e1ddff9a8b9?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Brick Laying">
          <div class="course-info">
            <h4>Brick Laying (First Year)</h4>
            <p><strong>Exam Board:</strong> ACU</p>
            <p><strong>Tuition Fees:</strong> MK70,000 per term</p>
          </div>
        </div>
        <!-- Carpentry & Joinery -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1567016545809-5b43c4f7e59b?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Carpentry & Joinery">
          <div class="course-info">
            <h4>Carpentry & Joinery (First Year – Level 1)</h4>
            <p><strong>Exam Board:</strong> ACU</p>
            <p><strong>Tuition Fees:</strong> MK70,000 per term</p>
          </div>
        </div>
        <!-- Plumbing -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1600718372062-7bcaac9a18ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Plumbing">
          <div class="course-info">
            <h4>Plumbing (First Year - Level 1)</h4>
            <p><strong>Exam Board:</strong> ACU</p>
            <p><strong>Tuition Fees:</strong> MK70,000 per term</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Automobile Department -->
    <div class="department">
      <h3 class="animate__animated animate__fadeInLeft">Automobile Department</h3>
      <div class="course-grid">
        <!-- Automobile Mechanics -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1581012772227-bcbf77339f72?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Automobile Mechanics">
          <div class="course-info">
            <h4>Automobile Mechanics (AMM) (Level 1)</h4>
            <p><strong>Exam Board:</strong> ACU</p>
            <p><strong>Tuition Fees:</strong> MK70,000 per term</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Weekend Programs -->
    <div class="department">
      <h3 class="animate__animated animate__fadeInLeft">Weekend Programs</h3>
      <div class="course-grid">
        <!-- Diploma in Professional Business Management – Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Business Management – Level 4">
          <div class="course-info">
            <h4>Diploma in Professional Business Management – Level 4</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK125,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Professional Business Management – Level 5 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Business Management – Level 5">
          <div class="course-info">
            <h4>Diploma in Professional Business Management – Level 5</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK135,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Professional Business Management – Level 6 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Business Management – Level 6">
          <div class="course-info">
            <h4>Diploma in Professional Business Management – Level 6</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK145,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Professional Human Resource Management - Level 4 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="HRM Professional – Level 4">
          <div class="course-info">
            <h4>Diploma in Professional Human Resource Management - Level 4</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK125,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Professional Human Resource Management – Level 5 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1532619187608-9d087c9c71ee?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="HRM Professional – Level 5">
          <div class="course-info">
            <h4>Diploma in Professional Human Resource Management – Level 5</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK135,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Professional Human Resource Management – Level 6 -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1558871660-d1bb237b51d0?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="HRM Professional – Level 6">
          <div class="course-info">
            <h4>Diploma in Professional Human Resource Management – Level 6</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK145,000 per Semester</p>
          </div>
        </div>
        <!-- Diploma in Computer Engineering – Level 4 (Weekend) -->
        <div class="course-card animate__animated animate__fadeInUp">
          <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Computer Engineering – Level 4">
          <div class="course-info">
            <h4>Diploma in Computer Engineering – Level 4</h4>
            <p><strong>Exam Board:</strong> ABMA</p>
            <p><strong>Tuition Fees:</strong> MK135,000 per Semester</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer" id="contact">
    <p>© 2023 MZTEC University. All rights reserved.</p>
  </footer>

  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('active');
    });

    const nav = document.querySelector('.nav-container');
    window.addEventListener('scroll', () => {
      nav.style.background = window.scrollY > 100 ? 'var(--primary-color)' : 'rgba(0, 33, 71, 0.95)';
    });
  </script>
</body>
</html>