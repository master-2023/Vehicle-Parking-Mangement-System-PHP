<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include('db_connect.php'); // Include your database connectioncomposer require phpmailer/phpmailer

if (isset($_POST['verify_otp'])) {
    $userOtp = $_POST['otp'];
    $generatedOtp = $_SESSION['otp_code'];
    $otpExpiration = $_SESSION['otp_expiration'];

    if (time() > $otpExpiration) {
        echo "<script>alert('OTP has expired. Please request a new OTP.');</script>";
        unset($_SESSION['otp_code']);
        unset($_SESSION['otp_expiration']);
    } elseif ($userOtp == $generatedOtp) {
        header('location:userdashboard.php'); // Redirect to dashboard
    } else {
        echo "<script>alert('Invalid OTP.');</script>";
    }
}

// Send OTP if not already set
if (!isset($_SESSION['otp_code'])) {
    // Generate a random OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp_code'] = $otp;
    $_SESSION['otp_expiration'] = time() + 300; // Set OTP expiration to 5 minutes (300 seconds)

    // Fetch the registered email from the database
    $userId = $_SESSION['vpmsuid']; // Assuming user ID is stored in session
    $query = mysqli_query($conn, "SELECT Email FROM tblregusers WHERE ID = '$userId'");
    $user = mysqli_fetch_array($query);

    if ($user) {
        $registeredEmail = $user['Email'];

        // Send OTP via PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mkshitij22@gmail.com'; // Your Gmail address
            $mail->Password = 'aywq zjzr koti ezvp'; // Your Gmail app password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mkshitij22@gmail.com', 'PayPark'); // Your sender email
            $mail->addAddress($registeredEmail); // Send to registered email
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for PayPark Login';
            $mail->Body = "
    <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 10px; max-width: 500px; margin: auto;'>
        <h2 style='color: #2D89EF; text-align: center;'>PayPark - OTP Verification</h2>
        <p>Dear User,</p>
        <p>Thank you for using PayPark. To complete your verification, please use the OTP below:</p>
        <h1 style='text-align: center; font-size: 24px; color: #333; background: #f3f3f3; padding: 10px; border-radius: 5px;'>$otp</h1>
        <p>This OTP is valid for <strong>05 minutes</strong>. Please do not share it with anyone.</p>
        <p>If you did not request this verification, please ignore this email.</p>
        <br>
        <p>Best Regards,</p>
        <p><strong>PayPark Team</strong></p>
        <hr>
        <p style='font-size: 12px; color: #777;'>This is an automated email, please do not reply.</p>
    </div>";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('User not found. Please try again.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>PAYPARK - OTP Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border: none;
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transform: scale(0.9);
            animation: popIn 0.5s ease-out forwards;
        }

        @keyframes popIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .card-header {
            font-size: 22px;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            font-weight: bold;
            color: #495057;
            display: flex;
            align-items: center;
            animation: fadeInLabel 1s ease-in-out;
        }

        @keyframes fadeInLabel {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        #timer {
            font-weight: bold;
            color: #e63946;
            font-size: 18px;
            margin-left: 10px;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }
        }
    </style>
    <script>
        let timer = 300; // 5 minutes in seconds

        function startCountdown() {
            const timerElement = document.getElementById('timer');
            const interval = setInterval(() => {
                const minutes = Math.floor(timer / 60);
                const seconds = timer % 60;
                timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                timer--;

                if (timer < 0) {
                    clearInterval(interval);
                    timerElement.textContent = "Expired";
                    alert("OTP has expired. Please request a new OTP.");
                }
            }, 1000);
        }

        window.onload = startCountdown;
    </script>
</head>
<body>
    <div class="card">
        <div class="card-header">OTP Verification</div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="otp">Enter OTP:
                        <span id="timer">5:00</span>
                    </label>
                    <input type="text" name="otp" required placeholder="Enter OTP" class="form-control">
                </div>
                <button type="submit" name="verify_otp" class="btn btn-primary btn-block">Verify</button>
            </form>
        </div>
    </div>
</body>
</html>
