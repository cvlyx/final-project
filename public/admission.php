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
                  url('assets/images/speedlight photography_3.jpg') no-repeat center/cover;
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
    .admission-form h2, .admission-form h3 {
      text-align: center;
      margin-bottom: 1rem;
      color: var(--primary-color);
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
    .footer {
      background: var(--primary-color);
      color: white;
      padding: 2rem 5%;
      text-align: center;
    }
    .form-sections {
      position: relative;
      min-height: 500px;
    }
    .form-section {
      display: none;
      animation: fadeIn 0.5s ease;
    }
    .form-section.active {
      display: block;
    }
    .form-navigation {
      display: flex;
      justify-content: space-between;
      margin-top: 2rem;
      gap: 1rem;
    }
    .nav-button {
      background: var(--secondary-color);
      color: var(--primary-color);
      padding: 0.8rem 2rem;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
    }
    .nav-button:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }
    .progress-indicator {
      text-align: center;
      margin-bottom: 2rem;
    }
    .progress-bar {
      height: 4px;
      background: #ddd;
      border-radius: 2px;
      margin: 1rem auto;
      width: 80%;
    }
    .progress {
      height: 100%;
      background: var(--secondary-color);
      transition: width 0.3s ease;
    }
    .review-summary {
      background: #f8f9fa;
      padding: 1.5rem;
      border-radius: 8px;
      margin: 1rem 0;
    }
    .review-item {
      margin-bottom: 0.5rem;
    }
    .subject-entry {
      display: flex;
      gap: 1rem;
      margin-bottom: 0.5rem;
    }
    .subject-entry input {
      flex: 1;
    }
    @media (max-width: 768px) {
      .nav-links { display: none; }
      .menu-toggle { display: block; }
      .hero h1 { font-size: 2.5rem; }
      .form-navigation { flex-direction: column; }
      .nav-button { width: 100%; }
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
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

  <section class="section" id="admission-form">
    <h2 class="section-title">Admission Form</h2>
    <div class="admission-form">
      <div class="progress-indicator">
        <div class="progress-bar">
          <div class="progress" id="form-progress"></div>
        </div>
        <span id="current-step">Section 1 of 5</span>
      </div>

      <form action="submit_form.php" method="POST" enctype="multipart/form-data">
        <div class="form-sections">
          <!-- Section 1: Personal Information -->
          <div class="form-section active" id="section1">
            <h3>Personal Information</h3>
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
              <label for="email">Applicant’s Email: *</label>
              <input type="email" id="email" name="email" required>
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
            <div class="form-navigation">
              <button type="button" class="nav-button" onclick="showSection(2)">Next</button>
            </div>
          </div>

          <!-- Section 2: Course Selection -->
          <div class="form-section" id="section2">
            <h3>Course Selection</h3>
            <div class="form-group">
              <label for="firstChoice">First Choice (Course & College): *</label>
              <select id="firstChoice" name="firstChoice" required>
                <option value="">-- Select your First Choice --</option>
                <optgroup label="Commercial Department">
                  <option value="Administrative Studies (First Year) - ACU | MK70,000/term">Administrative Studies (First Year) - MK70,000 per term</option>
                  <option value="Certificate in Financial Accounting - ICAM | MK115,000/Sem">Certificate in Financial Accounting - MK115,000 per Semester</option>
                  <option value="Diploma in Accounting - ICAM | MK125,000/Sem">Diploma in Accounting - MK125,000 per Semester</option>
                  <option value="Business Management - Foundation Level 4 - ABE | MK115,000/Sem">Business Management - Foundation Level 4 - MK115,000 per Semester</option>
                  <option value="Business Management – Diploma Level 4 - ABE | MK125,000/Sem">Business Management – Diploma Level 4 - MK125,000 per Semester</option>
                  <option value="Business Management – Diploma Level 5 - ABE | MK135,000/Sem">Business Management – Diploma Level 5 - MK135,000 per Semester</option>
                  <option value="Business Management – Diploma Level 6 - ABE | MK145,000/Sem">Business Management – Diploma Level 6 - MK145,000 per Semester</option>
                  <option value="Human Resource Management – Foundation Level 4 - ABE | MK115,000/Sem">Human Resource Management – Foundation Level 4 - MK115,000 per Semester</option>
                  <option value="Human Resource Management – Diploma Level 4 - ABE | MK125,000/Sem">Human Resource Management – Diploma Level 4 - MK125,000 per Semester</option>
                  <option value="Human Resource Management – Diploma Level 5 - ABE | MK135,000/Sem">Human Resource Management – Diploma Level 5 - MK135,000 per Semester</option>
                  <option value="Human Resource Management – Diploma Level 6 - ABE | MK145,000/Sem">Human Resource Management – Diploma Level 6 - MK145,000 per Semester</option>
                  <option value="Community Development Diploma Level 4 - ABMA | MK125,000/Sem">Community Development Diploma Level 4 - MK125,000 per Semester</option>
                  <option value="Community Development Diploma Level 5 - ABMA | MK135,000/Sem">Community Development Diploma Level 5 - MK125,000 per Semester</option>
                  <option value="Community Development Diploma Level 6 - ABMA | MK145,000/Sem">Community Development Diploma Level 6 - MK145,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK130,000/Sem">Diploma in Computer Engineering – Level 4 - MK130,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 5 - ABMA | MK140,000/Sem">Diploma in Computer Engineering – Level 5 - MK140,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 6 - ABMA | MK145,000/Sem">Diploma in Computer Engineering – Level 6 - MK145,000 per Semester</option>
                </optgroup>
                <optgroup label="Construction Department">
                  <option value="Solar Photovoltaic Installation (First Year - Level 1) - ACU | MK70,000/term">Solar Photovoltaic Installation (First Year - Level 1) - MK70,000 per term</option>
                  <option value="Electrical Installation (First Year - Level 1) - ACU | MK70,000/term">Electrical Installation (First Year - Level 1) - MK70,000 per term</option>
                  <option value="Brick Laying (First Year) - ACU | MK70,000/term">Brick Laying (First Year) - MK70,000 per term</option>
                  <option value="Carpentry & Joinery (First Year – Level 1) - ACU | MK70,000/term">Carpentry & Joinery (First Year – Level 1) - MK70,000 per term</option>
                  <option value="Plumbing (First Year - Level 1) - ACU | MK70,000/term">Plumbing (First Year - Level 1) - MK70,000 per term</option>
                </optgroup>
                <optgroup label="Automobile Department">
                  <option value="Automobile Mechanics (AMM) (Level 1) - ACU | MK70,000/term">Automobile Mechanics (AMM) (Level 1) - MK70,000 per term</option>
                </optgroup>
                <optgroup label="Weekend Programs">
                  <option value="Diploma in Professional Business Management – Level 4 - ABMA | MK125,000/Sem">Diploma in Professional Business Management – Level 4 - MK125,000 per Semester</option>
                  <option value="Diploma in Professional Business Management – Level 5 - ABMA | MK135,000/Sem">Diploma in Professional Business Management – Level 5 - MK135,000 per Semester</option>
                  <option value="Diploma in Professional Business Management – Level 6 - ABMA | MK145,000/Sem">Diploma in Professional Business Management – Level 6 - MK145,000 per Semester</option>
                  <option value="Diploma in Professional Human Resource Management - Level 4 - ABMA | MK125,000/Sem">Diploma in Professional Human Resource Management - Level 4 - MK125,000 per Semester</option>
                  <option value="Diploma in Professional Human Resource Management – Level 5 - ABMA | MK135,000/Sem">Diploma in Professional Human Resource Management – Level 5 - MK135,000 per Semester</option>
                  <option value="Diploma in Professional Human Resource Management – Level 6 - ABMA | MK145,000/Sem">Diploma in Professional Human Resource Management – Level 6 - MK145,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK135,000/Sem">Diploma in Computer Engineering – Level 4 - MK135,000 per Semester</option>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="secondChoice">Second Choice (Course & College): *</label>
              <select id="secondChoice" name="secondChoice" required>
                <option value="">-- Select your Second Choice --</option>
                <optgroup label="Commercial Department">
                  <option value="Administrative Studies (First Year) - ACU | MK70,000/term">Administrative Studies (First Year) - MK70,000 per term</option>
                  <option value="Certificate in Financial Accounting - ICAM | MK115,000/Sem">Certificate in Financial Accounting - MK115,000 per Semester</option>
                  <option value="Diploma in Accounting - ICAM | MK125,000/Sem">Diploma in Accounting - MK125,000 per Semester</option>
                  <option value="Business Management - Foundation Level 4 - ABE | MK115,000/Sem">Business Management - Foundation Level 4 - MK115,000 per Semester</option>
                  <option value="Business Management – Diploma Level 4 - ABE | MK125,000/Sem">Business Management – Diploma Level 4 - MK125,000 per Semester</option>
                  <option value="Business Management – Diploma Level 5 - ABE | MK135,000/Sem">Business Management – Diploma Level 5 - MK135,000 per Semester</option>
                  <option value="Business Management – Diploma Level 6 - ABE | MK145,000/Sem">Business Management – Diploma Level 6 - MK145,000 per Semester</option>
                  <option value="Human Resource Management – Foundation Level 4 - ABE | MK115,000/Sem">Human Resource Management – Foundation Level 4 - MK115,000 per Semester</option>
                  <option value="Human Resource Management – Diploma Level 4 - ABE | MK125,000/Sem">Human Resource Management – Diploma Level 4 - MK125,000 per Semester</option>
                  <option value="Human Resource Management – Diploma Level 5 - ABE | MK135,000/Sem">Human Resource Management – Diploma Level 5 - MK135,000 per Semester</option>
                  <option value="Human Resource Management – Diploma Level 6 - ABE | MK145,000/Sem">Human Resource Management – Diploma Level 6 - MK145,000 per Semester</option>
                  <option value="Community Development Diploma Level 4 - ABMA | MK125,000/Sem">Community Development Diploma Level 4 - MK125,000 per Semester</option>
                  <option value="Community Development Diploma Level 5 - ABMA | MK135,000/Sem">Community Development Diploma Level 5 - MK125,000 per Semester</option>
                  <option value="Community Development Diploma Level 6 - ABMA | MK145,000/Sem">Community Development Diploma Level 6 - MK145,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK130,000/Sem">Diploma in Computer Engineering – Level 4 - MK130,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 5 - ABMA | MK140,000/Sem">Diploma in Computer Engineering – Level 5 - MK140,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 6 - ABMA | MK145,000/Sem">Diploma in Computer Engineering – Level 6 - MK145,000 per Semester</option>
                </optgroup>
                <optgroup label="Construction Department">
                  <option value="Solar Photovoltaic Installation (First Year - Level 1) - ACU | MK70,000/term">Solar Photovoltaic Installation (First Year - Level 1) - MK70,000 per term</option>
                  <option value="Electrical Installation (First Year - Level 1) - ACU | MK70,000/term">Electrical Installation (First Year - Level 1) - MK70,000 per term</option>
                  <option value="Brick Laying (First Year) - ACU | MK70,000/term">Brick Laying (First Year) - MK70,000 per term</option>
                  <option value="Carpentry & Joinery (First Year – Level 1) - ACU | MK70,000/term">Carpentry & Joinery (First Year – Level 1) - MK70,000 per term</option>
                  <option value="Plumbing (First Year - Level 1) - ACU | MK70,000/term">Plumbing (First Year - Level 1) - MK70,000 per term</option>
                </optgroup>
                <optgroup label="Automobile Department">
                  <option value="Automobile Mechanics (AMM) (Level 1) - ACU | MK70,000/term">Automobile Mechanics (AMM) (Level 1) - MK70,000 per term</option>
                </optgroup>
                <optgroup label="Weekend Programs">
                  <option value="Diploma in Professional Business Management – Level 4 - ABMA | MK125,000/Sem">Diploma in Professional Business Management – Level 4 - MK125,000 per Semester</option>
                  <option value="Diploma in Professional Business Management – Level 5 - ABMA | MK135,000/Sem">Diploma in Professional Business Management – Level 5 - MK135,000 per Semester</option>
                  <option value="Diploma in Professional Business Management – Level 6 - ABMA | MK145,000/Sem">Diploma in Professional Business Management – Level 6 - MK145,000 per Semester</option>
                  <option value="Diploma in Professional Human Resource Management - Level 4 - ABMA | MK125,000/Sem">Diploma in Professional Human Resource Management - Level 4 - MK125,000 per Semester</option>
                  <option value="Diploma in Professional Human Resource Management – Level 5 - ABMA | MK135,000/Sem">Diploma in Professional Human Resource Management – Level 5 - MK135,000 per Semester</option>
                  <option value="Diploma in Professional Human Resource Management – Level 6 - ABMA | MK145,000/Sem">Diploma in Professional Human Resource Management – Level 6 - MK145,000 per Semester</option>
                  <option value="Diploma in Computer Engineering – Level 4 - ABMA | MK135,000/Sem">Diploma in Computer Engineering – Level 4 - MK135,000 per Semester</option>
                </optgroup>
              </select>
            </div>
            <div class="form-navigation">
              <button type="button" class="nav-button" onclick="showSection(1)">Previous</button>
              <button type="button" class="nav-button" onclick="showSection(3)">Next</button>
            </div>
          </div>

          <!-- Section 3: Academic Background -->
          <div class="form-section" id="section3">
            <h3>Academic Background</h3>
            <div class="form-group">
              <label>Subjects and Grades: *</label>
              <div id="subjects-container">
                <div class="subject-entry">
                  <input type="text" name="subjects[]" placeholder="Subject (e.g., Mathematics)" required>
                  <input type="text" name="grades[]" placeholder="Grade (e.g., A)" required>
                  <button type="button" onclick="removeSubject(this)">Remove</button>
                </div>
              </div>
              <button type="button" onclick="addSubject()">Add Another Subject</button>
            </div>
            <div class="form-group">
              <label for="certificate">Attach a copy of your Malawi School Certificate of Education or its equivalent: *</label>
              <input type="file" id="certificate" name="certificate" accept=".pdf,.jpg,.png" required>
            </div>
            <div class="form-navigation">
              <button type="button" class="nav-button" onclick="showSection(2)">Previous</button>
              <button type="button" class="nav-button" onclick="showSection(4)">Next</button>
            </div>
          </div>

          <!-- Section 4: Additional Information -->
          <div class="form-section" id="section4">
            <h3>Additional Information</h3>
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
            <div class="form-navigation">
              <button type="button" class="nav-button" onclick="showSection(3)">Previous</button>
              <button type="button" class="nav-button" onclick="showSection(5)">Next</button>
            </div>
          </div>

          <!-- Section 5: Review & Submit -->
          <div class="form-section" id="section5">
            <h3>Review & Submit</h3>
            <div class="review-summary" id="review-summary">
              <!-- Dynamically populated -->
            </div>
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
            <div class="form-navigation">
              <button type="button" class="nav-button" onclick="showSection(4)">Previous</button>
              <button type="submit" class="nav-button">Submit Application</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

  <footer class="footer" id="contact">
    <p>© 2023 MZTEC University. All rights reserved.</p>
  </footer>

  <script>
    let currentSection = 1;
    const totalSections = 5;

    function showSection(sectionNumber) {
      if (sectionNumber < 1 || sectionNumber > totalSections) return;
      if (sectionNumber > currentSection && !validateSection(currentSection)) return;

      document.querySelectorAll('.form-section').forEach(section => section.classList.remove('active'));
      document.getElementById(`section${sectionNumber}`).classList.add('active');
      currentSection = sectionNumber;
      updateProgress();
      if (sectionNumber === totalSections) updateReviewSummary();
    }

    function validateSection(sectionNumber) {
      const section = document.getElementById(`section${sectionNumber}`);
      const requiredFields = section.querySelectorAll('[required]');
      let isValid = true;

      requiredFields.forEach(field => {
        if (!field.checkValidity()) {
          isValid = false;
          field.classList.add('invalid');
          field.reportValidity();
        } else {
          field.classList.remove('invalid');
        }
      });

      if (sectionNumber === 3) {
        const subjects = section.querySelectorAll('input[name="subjects[]"]');
        const grades = section.querySelectorAll('input[name="grades[]"]');
        if (subjects.length === 0) {
          alert('Please add at least one subject and grade.');
          isValid = false;
        } else {
          subjects.forEach((subject, index) => {
            if (!subject.value || !grades[index].value) {
              alert('Please fill in all subject and grade fields.');
              isValid = false;
            }
          });
        }
      }

      return isValid;
    }

    function updateProgress() {
      const progress = (currentSection / totalSections) * 100;
      document.getElementById('form-progress').style.width = `${progress}%`;
      document.getElementById('current-step').textContent = `Section ${currentSection} of ${totalSections}`;
    }

    function updateReviewSummary() {
      const summary = document.getElementById('review-summary');
      let html = '';

      // Personal Information
      html += `<div class="review-item"><strong>Surname:</strong> ${document.getElementById('surname').value}</div>`;
      html += `<div class="review-item"><strong>First Name:</strong> ${document.getElementById('firstname').value}</div>`;
      html += `<div class="review-item"><strong>Middle Name:</strong> ${document.getElementById('middlename').value || 'N/A'}</div>`;
      html += `<div class="review-item"><strong>Email:</strong> ${document.getElementById('email').value}</div>`;
      html += `<div class="review-item"><strong>Date of Birth:</strong> ${document.getElementById('dob').value}</div>`;
      html += `<div class="review-item"><strong>Gender:</strong> ${document.querySelector('input[name="gender"]:checked').value}</div>`;
      html += `<div class="review-item"><strong>National ID:</strong> ${document.getElementById('nationalid').value || 'N/A'}</div>`;
      html += `<div class="review-item"><strong>Phone:</strong> ${document.getElementById('phone').value}</div>`;
      html += `<div class="review-item"><strong>Residence:</strong> ${document.getElementById('residence').value}</div>`;
      html += `<div class="review-item"><strong>Origin:</strong> ${document.getElementById('origin').value}</div>`;
      html += `<div class="review-item"><strong>Traditional Authority:</strong> ${document.getElementById('traditional').value || 'N/A'}</div>`;
      html += `<div class="review-item"><strong>Village:</strong> ${document.getElementById('village').value || 'N/A'}</div>`;
      html += `<div class="review-item"><strong>Address:</strong> ${document.getElementById('address').value || 'N/A'}</div>`;
      html += `<div class="review-item"><strong>Guardian Name:</strong> ${document.getElementById('guardian').value || 'N/A'}</div>`;
      html += `<div class="review-item"><strong>Guardian Phone:</strong> ${document.getElementById('guardianPhone').value}</div>`;
      html += `<div class="review-item"><strong>Disability:</strong> ${document.getElementById('disability').value || 'None'}</div>`;

      // Course Selection
      html += `<div class="review-item"><strong>First Choice:</strong> ${document.getElementById('firstChoice').value}</div>`;
      html += `<div class="review-item"><strong>Second Choice:</strong> ${document.getElementById('secondChoice').value}</div>`;

      // Subjects and Grades
      const subjects = document.querySelectorAll('input[name="subjects[]"]');
      const grades = document.querySelectorAll('input[name="grades[]"]');
      html += '<div class="review-item"><strong>Subjects and Grades:</strong><ul>';
      subjects.forEach((subject, index) => {
        html += `<li>${subject.value}: ${grades[index].value}</li>`;
      });
      html += '</ul></div>';

      // Additional Information
      html += `<div class="review-item"><strong>Previous TV Skills:</strong> ${document.querySelector('input[name="tvBackground"]:checked').value}${document.getElementById('tvField').value ? ' - ' + document.getElementById('tvField').value : ''}</div>`;
      html += `<div class="review-item"><strong>Non-Residential Option:</strong> ${document.querySelector('input[name="boarding"]:checked').value}</div>`;
      html += `<div class="review-item"><strong>Any College Allocation:</strong> ${document.querySelector('input[name="anyCollege"]:checked').value}</div>`;

      // Certificate
      const certificate = document.getElementById('certificate').files[0];
      html += `<div class="review-item"><strong>Certificate:</strong> ${certificate ? certificate.name : 'No file uploaded'}</div>`;

      summary.innerHTML = html;
    }

    function addSubject() {
      const container = document.getElementById('subjects-container');
      const entry = document.createElement('div');
      entry.className = 'subject-entry';
      entry.innerHTML = `
        <input type="text" name="subjects[]" placeholder="Subject (e.g., Mathematics)" required>
        <input type="text" name="grades[]" placeholder="Grade (e.g., A)" required>
        <button type="button" onclick="removeSubject(this)">Remove</button>
      `;
      container.appendChild(entry);
    }

    function removeSubject(button) {
      button.parentElement.remove();
    }

    // Initialize form
    updateProgress();

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('active');
    });

    // Navbar scroll effect
    const nav = document.querySelector('.nav-container');
    window.addEventListener('scroll', () => {
      nav.style.background = window.scrollY > 100 ? 'var(--primary-color)' : 'rgba(0, 33, 71, 0.95)';
    });
  </script>
</body>
</html>