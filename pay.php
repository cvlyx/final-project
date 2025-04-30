<?php
session_start();

// Check if session data exists
if (!isset($_SESSION['admission_data']) || !isset($_SESSION['transaction_ref'])) {
    header("Location: admission.php");
    exit();
}

$admission_data = $_SESSION['admission_data'];
$transaction_ref = $_SESSION['transaction_ref'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registration Payment - MZTEC University</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
      background: #f4f4f4;
      color: var(--text-color);
      padding: 2rem;
    }
    .payment-container {
      max-width: 600px;
      margin: 3rem auto;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .payment-title {
      text-align: center;
      font-size: 2rem;
      color: var(--primary-color);
      margin-bottom: 1.5rem;
    }
    .fee-structure {
      margin-bottom: 2rem;
    }
    .fee-structure table {
      width: 100%;
      border-collapse: collapse;
    }
    .fee-structure th,
    .fee-structure td {
      border: 1px solid #ddd;
      padding: 1rem;
      text-align: left;
    }
    .fee-structure th {
      background: var(--primary-color);
      color: white;
    }
    .terms {
      margin-top: 1.5rem;
      font-size: 0.9rem;
      line-height: 1.5;
    }
    .pay-btn {
      display: block;
      width: 100%;
      background: var(--secondary-color);
      color: var(--primary-color);
      text-align: center;
      padding: 1rem;
      font-size: 1.1rem;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.3s ease;
      text-decoration: none;
      margin-top: 1.5rem;
    }
    .pay-btn:hover {
      background: var(--accent-color);
      color: white;
      transform: scale(1.05);
    }
    .note {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #555;
      text-align: center;
    }
    .disabled {
      opacity: 0.6;
      pointer-events: none;
    }
  </style>
</head>
<body>
  <div class="payment-container">
    <h1 class="payment-title">Application Fee Payment</h1>
    <div class="fee-structure">
      <table>
        <thead>
          <tr>
            <th>Description</th>
            <th>Amount (MWK)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Application Fee</td>
            <td>10,000</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="terms">
      <label>
        <input type="checkbox" id="agreeTerms" />
        I agree to the <a href="terms.html" target="_blank">Terms and Conditions</a> of MZTEC University. I understand that fees paid are non-refundable once the application is processed.
      </label>
      <div id="wrapper"></div>
      <button class="pay-btn disabled" id="payNowBtn" disabled type="button" onClick="makePayment()">Pay Now</button>
    <p class="note">You will be redirected to our secure payment gateway to complete the transaction.</p>
  </div>

  <script src="https://in.paychangu.com/js/popup.js"></script>
  <script>
    const payNowBtn = document.getElementById('payNowBtn');
    const agreeTerms = document.getElementById('agreeTerms');

    agreeTerms.addEventListener('change', () => {
      payNowBtn.disabled = !agreeTerms.checked;
      payNowBtn.classList.toggle('disabled', !agreeTerms.checked);
    });

    function makePayment(){
      PaychanguCheckout({
        "public_key": "pub-test-62kpNbCXil1OeQWZSSh02oRkMQiqQFVJ",
        "tx_ref": '' + Math.floor((Math.random() * 1000000000) + 1),
        "amount": 10000,
        "currency": "MWK",
        "callback_url": "http://localhost/MZTEC/callback.php",
        "return_url": "http://example.com/returnurl",
        "customer":{
          "email": "yourmail@example.com",
          "first_name":"Mac",
          "last_name":"Phiri",
        },
        "customization": {
          "title": "Test Payment",
          "description": "Payment Description",
        },
        "meta": {
          "uuid": "uuid",
          "response": "Response"
        }
      });
    }
    </script>
</body>
</html>
