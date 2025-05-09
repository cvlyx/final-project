<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Apply for admission at MZTEC University and join our quality technical education programs.">
  <title>MZTEC University - Admission Form</title>
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
      padding: 0.5rem 1rem;
      transition: all 0.3s ease;
    }
    .nav-links a:hover, .nav-links a.active {
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
                  url('/speedlight photography_3.jpg') no-repeat center/cover;
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
    .admission-form {
      max-width: 800px;
      margin: 0 auto;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .admission-form h2 {
      text-align: center;
      margin-bottom: 1rem;
      color: var(--primary-color);
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group input {
      width: 100%;
      padding: 0.8rem;
      border: 2px solid #ddd;
      border-radius: 8px;
    }
    .admission-form button {
      background: var(--secondary-color);
      color: var(--primary-color);
      border: none;
      padding: 1rem 2rem;
      border-radius: 25px;
      font-weight: 600;
      display: block;
      margin: 0 auto;
      cursor: pointer;
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
    /* Admission Form Styles */
    .admission-form {
      max-width: 800px;
      margin: 0 auto;
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .admission-form h2, 
    .admission-form h3 {
      text-align: center;
      margin-bottom: 1rem;
      color: var(--primary-color);
    }
    .admission-form p {
      text-align: center;
      margin-bottom: 2rem;
      font-size: 1rem;
      color: var(--text-color);
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="date"],
    .form-group input[type="file"],
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 0.8rem;
      border: 2px solid #ddd;
      border-radius: 8px;
    }
    .form-group input[type="radio"] {
      margin-right: 0.5rem;
    }
    .form-group label span {
      margin-right: 1rem;
    }
    .admission-form button {
      background: var(--secondary-color);
      color: var(--primary-color);
      border: none;
      padding: 1rem 2rem;
      border-radius: 25px;
      font-weight: 600;
      display: block;
      margin: 0 auto;
      cursor: pointer;
      transition: opacity 0.3s ease;
    }
    .admission-form button:hover {
      opacity: 0.9;
    }
    hr {
      margin: 2rem 0;
      border: none;
      border-top: 1px solid #ddd;
    }
    /* Footer Styles */
    .footer {
      background: var(--primary-color);
      color: white;
      padding: 2rem 5%;
      text-align: center;
    }
    .social-links a {
      color: white;
      margin: 0 0.5rem;
      text-decoration: none;
    }
    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }
      .section-title {
        font-size: 2rem;
      }
      .nav-links {
        display: none;
      }
      .hamburger {
        display: flex;
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
  }
  </style>
</head>
<body>
  <header class="header" id="home">
    <nav class="nav-container animate__animated animate__fadeInDown" aria-label="Main Navigation">
      <div class="logo">MZTEC</div>
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="courses.php">Courses</a>
        <a href="admission.php" class="active">Admissions</a>
        <a href="#contact">Contact</a>
      
      </div>
      <button class="menu-toggle" aria-label="Toggle Navigation">
        <span></span><span></span><span></span>
      </button>
      <div class="mobile-menu" id="mobile-menu">
        <a href="index.php">Home</a>
        <a href="courses.php">Courses</a>
        <a href="admission.php" class="active">Admissions</a>
        <a href="#contact">Contact</a>
   
      </div>
    </nav>
    <div class="hero">
      <h1>Apply for Admission</h1>
      <p>Join MZTEC University for Quality Technical Education</p>
      <a href="#admission-form" class="cta-button">Get Started</a>
    </div>
  </header>

   <!-- Admission Form Section -->
   <section class="section" id="admission-form">
    <h2 class="section-title">Admission Form</h2>
    <div class="admission-form">
      <h3>Mzuzu Technical College Admission Form</h3>
      <p>Please complete the form below in <strong>block letters</strong>. Fields marked with an asterisk (*) are compulsory.</p>
      <form action="submit_form.php" method="POST" enctype="multipart/form-data">
        <!-- Personal Information -->
        <div class="form-group">
          <label for="surname">Applicant’s Surname: *</label>
          <input type="text" id="surname" name="surname" required>
        </div>
        <div class="form-group">
          <label for="firstname">Applicant’s First Name: *</label>
          <input type="text" id="firstname" name="firstname" required>
        </div>
        <div class="form-group">
          <label for="middlename">Applicant’s Middle Name:</label>
          <input type="text" id="middlename" name="middlename">
        </div>
        <div class="form-group">
          <label for="dob">Date of Birth: *</label>
          <input type="date" id="dob" name="dob" required>
        </div>
        <div class="form-group">
          <label>Gender: *</label>
          <span>
            <input type="radio" id="male" name="gender" value="Male" required>
            <label for="male">Male</label>
          </span>
          <span>
            <input type="radio" id="female" name="gender" value="Female" required>
            <label for="female">Female</label>
          </span>
        </div>
        <div class="form-group">
          <label for="nationalid">National ID No.:</label>
          <input type="text" id="nationalid" name="nationalid">
        </div>
        <div class="form-group">
          <label for="phone">Telephone/Cell: *</label>
          <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
          <label for="residence">District/City of Residence: *</label>
          <input type="text" id="residence" name="residence" required>
        </div>
        <div class="form-group">
          <label for="origin">District of Origin: *</label>
          <input type="text" id="origin" name="origin" required>
        </div>
        <div class="form-group">
          <label for="traditional">Traditional Authority:</label>
          <input type="text" id="traditional" name="traditional">
        </div>
        <div class="form-group">
          <label for="village">Village:</label>
          <input type="text" id="village" name="village">
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <textarea id="address" name="address" rows="2"></textarea>
        </div>
        <div class="form-group">
          <label for="guardian">Guardian Name:</label>
          <input type="text" id="guardian" name="guardian">
        </div>
        <div class="form-group">
          <label for="guardianPhone">Guardian Telephone/Cell: *</label>
          <input type="tel" id="guardianPhone" name="guardianPhone" required>
        </div>
        <div class="form-group">
          <label for="disability">If you are a person with a disability, please indicate the type of disability:</label>
          <textarea id="disability" name="disability" rows="2"></textarea>
        </div>
        
        <hr>
        
        <!-- Course & College Choices -->
        <h3>Course and College Choices</h3>
        <!-- First Choice Dropdown -->
        <div class="form-group">
          <label for="firstChoice">First Choice (Course & College): *</label>
          <select id="firstChoice" name="firstChoice" required>
            <option value="">-- Select your First Choice --</option>
            <optgroup label="Commercial Department">
              <option value="Administrative Studies (First Year) - ACU | MK70,000/term">
                Administrative Studies (First Year) - MK70,000 per term
              </option>
              <option value="Certificate in Financial Accounting - ICAM | MK115,000/Sem">
                Certificate in Financial Accounting - MK115,000 per Semester
              </option>
              <option value="Diploma in Accounting - ICAM | MK125,000/Sem">
                Diploma in Accounting - MK125,000 per Semester
              </option>
              <option value="Business Management - Foundation Level 4 - ABE | MK115,000/Sem">
                Business Management - Foundation Level 4 - MK115,000 per Semester
              </option>
              <option value="Business Management – Diploma Level 4 - ABE | MK125,000/Sem">
                Business Management – Diploma Level 4 - MK125,000 per Semester
              </option>
              <option value="Business Management – Diploma Level 5 - ABE | MK135,000/Sem">
                Business Management – Diploma Level 5 - MK135,000 per Semester
              </option>
              <option value="Business Management – Diploma Level 6 - ABE | MK145,000/Sem">
                Business Management – Diploma Level 6 - MK145,000 per Semester
              </option>
              <option value="Human Resource Management – Foundation Level 4 - ABE | MK115,000/Sem">
                Human Resource Management – Foundation Level 4 - MK115,000 per Semester
              </option>
              <option value="Human Resource Management – Diploma Level 4 - ABE | MK125,000/Sem">
                Human Resource Management – Diploma Level 4 - MK125,000 per Semester
              </option>
              <option value="Human Resource Management – Diploma Level 5 - ABE | MK135,000/Sem">
                Human Resource Management – Diploma Level 5 - MK135,000 per Semester
              </option>
              <option value="Human Resource Management – Diploma Level 6 - ABE | MK145,000/Sem">
                Human Resource Management – Diploma Level 6 - MK145,000 per Semester
              </option>
              <option value="Community Development Diploma Level 4 - ABMA | MK125,000/Sem">
                Community Development Diploma Level 4 - MK125,000 per Semester
              </option>
              <option value="Community Development Diploma Level 5 - ABMA | MK135,000/Sem">
                Community Development Diploma Level 5 - MK135,000 per Semester
              </option>
              <option value="Community Development Diploma Level 6 - ABMA | MK145,000/Sem">
                Community Development Diploma Level 6 - MK145,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK130,000/Sem">
                Diploma in Computer Engineering – Level 4 - MK130,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 5 - ABMA | MK140,000/Sem">
                Diploma in Computer Engineering – Level 5 - MK140,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 6 - ABMA | MK145,000/Sem">
                Diploma in Computer Engineering – Level 6 - MK145,000 per Semester
              </option>
            </optgroup>
            <optgroup label="Construction Department">
              <option value="Solar Photovoltaic Installation (First Year - Level 1) - ACU | MK70,000/term">
                Solar Photovoltaic Installation (First Year - Level 1) - MK70,000 per term
              </option>
              <option value="Electrical Installation (First Year - Level 1) - ACU | MK70,000/term">
                Electrical Installation (First Year - Level 1) - MK70,000 per term
              </option>
              <option value="Brick Laying (First Year) - ACU | MK70,000/term">
                Brick Laying (First Year) - MK70,000 per term
              </option>
              <option value="Carpentry & Joinery (First Year – Level 1) - ACU | MK70,000/term">
                Carpentry & Joinery (First Year – Level 1) - MK70,000 per term
              </option>
              <option value="Plumbing (First Year - Level 1) - ACU | MK70,000/term">
                Plumbing (First Year - Level 1) - MK70,000 per term
              </option>
            </optgroup>
            <optgroup label="Automobile Department">
              <option value="Automobile Mechanics (AMM) (Level 1) - ACU | MK70,000/term">
                Automobile Mechanics (AMM) (Level 1) - MK70,000 per term
              </option>
            </optgroup>
            <optgroup label="Weekend Programs">
              <option value="Diploma in Professional Business Management – Level 4 - ABMA | MK125,000/Sem">
                Diploma in Professional Business Management – Level 4 - MK125,000 per Semester
              </option>
              <option value="Diploma in Professional Business Management – Level 5 - ABMA | MK135,000/Sem">
                Diploma in Professional Business Management – Level 5 - MK135,000 per Semester
              </option>
              <option value="Diploma in Professional Business Management – Level 6 - ABMA | MK145,000/Sem">
                Diploma in Professional Business Management – Level 6 - MK145,000 per Semester
              </option>
              <option value="Diploma in Professional Human Resource Management - Level 4 - ABMA | MK125,000/Sem">
                Diploma in Professional Human Resource Management - Level 4 - MK125,000 per Semester
              </option>
              <option value="Diploma in Professional Human Resource Management – Level 5 - ABMA | MK135,000/Sem">
                Diploma in Professional Human Resource Management – Level 5 - MK135,000 per Semester
              </option>
              <option value="Diploma in Professional Human Resource Management – Level 6 - ABMA | MK145,000/Sem">
                Diploma in Professional Human Resource Management – Level 6 - MK145,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK135,000/Sem">
                Diploma in Computer Engineering – Level 4 - MK135,000 per Semester
              </option>
            </optgroup>
          </select>
        </div>
        <!-- Second Choice Dropdown -->
        <div class="form-group">
          <label for="secondChoice">Second Choice (Course & College): *</label>
          <select id="secondChoice" name="secondChoice" required>
            <option value="">-- Select your Second Choice --</option>
            <optgroup label="Commercial Department">
              <option value="Administrative Studies (First Year) - ACU | MK70,000/term">
                Administrative Studies (First Year) - MK70,000 per term
              </option>
              <option value="Certificate in Financial Accounting - ICAM | MK115,000/Sem">
                Certificate in Financial Accounting - MK115,000 per Semester
              </option>
              <option value="Diploma in Accounting - ICAM | MK125,000/Sem">
                Diploma in Accounting - MK125,000 per Semester
              </option>
              <option value="Business Management - Foundation Level 4 - ABE | MK115,000/Sem">
                Business Management - Foundation Level 4 - MK115,000 per Semester
              </option>
              <option value="Business Management – Diploma Level 4 - ABE | MK125,000/Sem">
                Business Management – Diploma Level 4 - MK125,000 per Semester
              </option>
              <option value="Business Management – Diploma Level 5 - ABE | MK135,000/Sem">
                Business Management – Diploma Level 5 - MK135,000 per Semester
              </option>
              <option value="Business Management – Diploma Level 6 - ABE | MK145,000/Sem">
                Business Management – Diploma Level 6 - MK145,000 per Semester
              </option>
              <option value="Human Resource Management – Foundation Level 4 - ABE | MK115,000/Sem">
                Human Resource Management – Foundation Level 4 - MK115,000 per Semester
              </option>
              <option value="Human Resource Management – Diploma Level 4 - ABE | MK125,000/Sem">
                Human Resource Management – Diploma Level 4 - MK125,000 per Semester
              </option>
              <option value="Human Resource Management – Diploma Level 5 - ABE | MK135,000/Sem">
                Human Resource Management – Diploma Level 5 - MK135,000 per Semester
              </option>
              <option value="Human Resource Management – Diploma Level 6 - ABE | MK145,000/Sem">
                Human Resource Management – Diploma Level 6 - MK145,000 per Semester
              </option>
              <option value="Community Development Diploma Level 4 - ABMA | MK125,000/Sem">
                Community Development Diploma Level 4 - MK125,000 per Semester
              </option>
              <option value="Community Development Diploma Level 5 - ABMA | MK135,000/Sem">
                Community Development Diploma Level 5 - MK135,000 per Semester
              </option>
              <option value="Community Development Diploma Level 6 - ABMA | MK145,000/Sem">
                Community Development Diploma Level 6 - MK145,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK130,000/Sem">
                Diploma in Computer Engineering – Level 4 - MK130,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 5 - ABMA | MK140,000/Sem">
                Diploma in Computer Engineering – Level 5 - MK140,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 6 - ABMA | MK145,000/Sem">
                Diploma in Computer Engineering – Level 6 - MK145,000 per Semester
              </option>
            </optgroup>
            <optgroup label="Construction Department">
              <option value="Solar Photovoltaic Installation (First Year - Level 1) - ACU | MK70,000/term">
                Solar Photovoltaic Installation (First Year - Level 1) - MK70,000 per term
              </option>
              <option value="Electrical Installation (First Year - Level 1) - ACU | MK70,000/term">
                Electrical Installation (First Year - Level 1) - MK70,000 per term
              </option>
              <option value="Brick Laying (First Year) - ACU | MK70,000/term">
                Brick Laying (First Year) - MK70,000 per term
              </option>
              <option value="Carpentry & Joinery (First Year – Level 1) - ACU | MK70,000/term">
                Carpentry & Joinery (First Year – Level 1) - MK70,000 per term
              </option>
              <option value="Plumbing (First Year - Level 1) - ACU | MK70,000/term">
                Plumbing (First Year - Level 1) - MK70,000 per term
              </option>
            </optgroup>
            <optgroup label="Automobile Department">
              <option value="Automobile Mechanics (AMM) (Level 1) - ACU | MK70,000/term">
                Automobile Mechanics (AMM) (Level 1) - MK70,000 per term
              </option>
            </optgroup>
            <optgroup label="Weekend Programs">
              <option value="Diploma in Professional Business Management – Level 4 - ABMA | MK125,000/Sem">
                Diploma in Professional Business Management – Level 4 - MK125,000 per Semester
              </option>
              <option value="Diploma in Professional Business Management – Level 5 - ABMA | MK135,000/Sem">
                Diploma in Professional Business Management – Level 5 - MK135,000 per Semester
              </option>
              <option value="Diploma in Professional Business Management – Level 6 - ABMA | MK145,000/Sem">
                Diploma in Professional Business Management – Level 6 - MK145,000 per Semester
              </option>
              <option value="Diploma in Professional Human Resource Management - Level 4 - ABMA | MK125,000/Sem">
                Diploma in Professional Human Resource Management - Level 4 - MK125,000 per Semester
              </option>
              <option value="Diploma in Professional Human Resource Management – Level 5 - ABMA | MK135,000/Sem">
                Diploma in Professional Human Resource Management – Level 5 - MK135,000 per Semester
              </option>
              <option value="Diploma in Professional Human Resource Management – Level 6 - ABMA | MK145,000/Sem">
                Diploma in Professional Human Resource Management – Level 6 - MK145,000 per Semester
              </option>
              <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK135,000/Sem">
                Diploma in Computer Engineering – Level 4 - MK135,000 per Semester
              </option>
            </optgroup>
          </select>
        </div>
        
        <!-- Previous Technical & Vocational Skills -->
        <div class="form-group">
          <label>Previous Technical & Vocational Skills Background:</label>
          <span>
            <input type="radio" id="tvYes" name="tvBackground" value="Yes">
            <label for="tvYes">Yes</label>
          </span>
          <span>
            <input type="radio" id="tvNo" name="tvBackground" value="No" checked>
            <label for="tvNo">No</label>
          </span>
          <input type="text" id="tvField" name="tvField" placeholder="If yes, please specify the field">
        </div>
        <div class="form-group">
          <label>If boarding space is not available, would you accept a non-residential option?</label>
          <span>
            <input type="radio" id="boardingYes" name="boarding" value="Yes" required>
            <label for="boardingYes">Yes</label>
          </span>
          <span>
            <input type="radio" id="boardingNo" name="boarding" value="No" required>
            <label for="boardingNo">No</label>
          </span>
        </div>
        <div class="form-group">
          <label>If not selected for your preferred college, will you accept training at any college allocated?</label>
          <span>
            <input type="radio" id="anyCollegeYes" name="anyCollege" value="Yes" required>
            <label for="anyCollegeYes">Yes</label>
          </span>
          <span>
            <input type="radio" id="anyCollegeNo" name="anyCollege" value="No" required>
            <label for="anyCollegeNo">No</label>
          </span>
        </div>
        <div class="form-group">
          <label for="certificate">Attach a copy of your Malawi School Certificate of Education or its equivalent:</label>
          <input type="file" id="certificate" name="certificate" accept=".pdf,.jpg,.png">
        </div>
        
        <!-- Confirmation & Signature -->
        <div class="form-group">
          <label>
            <input type="checkbox" name="confirm" required>
            I hereby confirm that the information given above is true to the best of my knowledge.
          </label>
        </div>
        <div class="form-group">
          <label for="applicationDate">Date:</label>
          <input type="date" id="applicationDate" name="applicationDate">
        </div>
        <div class="form-group">
          <label for="signature">Signature:</label>
          <input type="text" id="signature" name="signature" placeholder="Type your full name as signature">
        </div>
        
        <button type="submit" class="register-btn">Submit Application</button>
      </form>
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