<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Reset your MZTEC University student portal password by entering your college email to receive a reset link." />
  <title>Forgot Password - MZTEC University</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <style>
    :root {
      --primary-color: #002147;
      --secondary-color: #ffd700;
      --accent-color: #e63946;
      --text-color: #ffffff;
      --glass-bg: rgba(255, 255, 255, 0.1);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body {
      background: linear-gradient(135deg, #002147 0%, #000913 100%);
      color: var(--text-color);
      min-height: 100vh;
      overflow-x: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    .glass-card {
      background: var(--glass-bg);
      -webkit-backdrop-filter: blur(15px);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 3rem;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
      text-align: center;
    }
    .glass-card h1 {
      font-size: 2.25rem;
      margin-bottom: 0.5rem;
      color: var(--secondary-color);
    }
    .glass-card p {
      margin-bottom: 2rem;
      color: rgba(255, 255, 255, 0.8);
      line-height: 1.6;
    }
    .form-group {
      margin-bottom: 1.5rem;
      text-align: left;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }
    .form-control {
      width: 100%;
      padding: 1rem;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 8px;
      color: white;
      font-size: 1rem;
      transition: border-color 0.3s ease, background 0.3s ease;
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
    .reset-btn {
      width: 100%;
      padding: 1rem;
      background: var(--secondary-color);
      color: var(--primary-color);
      border: none;
      border-radius: 8px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }
    .reset-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }
    .back-link {
      display: inline-block;
      margin-top: 1.5rem;
      color: var(--secondary-color);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    .back-link:hover {
      color: var(--accent-color);
    }
  </style>
</head>
<body>
  <div class="glass-card" role="main">
    <h1>Forgot Password</h1>
    <p>Enter your college email below and we'll send you a link to reset your password.</p>
    <form action="send-reset.php" method="POST">
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
        />
      </div>
      <button type="submit" class="reset-btn">Send Reset Link</button>
    </form>
    <a href="login.php" class="back-link">&larr; Back to Sign In</a>
  </div>
</body>
</html>
