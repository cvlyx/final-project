<?php
session_start();

$message = "Processing your payment...";
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $message = "Payment successful. Your application has been submitted and is under review. You will receive a confirmation email shortly.";
} elseif (isset($_GET['status']) && $_GET['status'] === 'failed') {
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : "Payment failed. Please try again or contact support.";
} else {
    $message = "Invalid payment response.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Result</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .popup {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .popup h2 {
            color: #002147;
            margin-bottom: 1rem;
        }
        .popup p {
            color: #2d3748;
        }
    </style>
</head>
<body>
    <div class="popup">
        <h2>Payment Status</h2>
        <p><?php echo $message; ?></p>
    </div>
</body>
</html>