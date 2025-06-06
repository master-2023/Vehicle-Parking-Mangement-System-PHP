<?php
session_start();
include('db_connect.php');

if (isset($_POST['login'])) {
    $emailcon = $_POST['emailcont'];
    $password = md5($_POST['password']);
    $captcha = trim($_POST['captcha']); // Get user input
    $generatedCaptcha = $_SESSION['captcha_code']; // Get stored correct answer

    if ($captcha !== $generatedCaptcha) {
        echo "<script>alert('Invalid CAPTCHA.');</script>";
    } else {
        $query = mysqli_query($conn, "SELECT ID, MobileNumber FROM tblregusers WHERE (Email='$emailcon' OR MobileNumber='$emailcon') AND Password='$password'");
        $ret = mysqli_fetch_array($query);
        if ($ret > 0) {
            $_SESSION['vpmsuid'] = $ret['ID'];
            $_SESSION['vpmsumn'] = $ret['MobileNumber'];
            header('location:verify_otp.php'); // Redirect to OTP page
        } else {
            echo "<script>alert('Invalid Details.');</script>";
        }
    }
}

// Generate different CAPTCHA types
$captchaType = rand(1, 3); // 1 = Text, 2 = Math, 3 = Alphanumeric

if ($captchaType == 1) {
    // Text-based CAPTCHA
    $captcha_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);
    $_SESSION['captcha_code'] = $captcha_code;
} elseif ($captchaType == 2) {
    // Math-based CAPTCHA (e.g., 7 + 4 = ?)
    $num1 = rand(1, 9);
    $num2 = rand(1, 9);
    $_SESSION['captcha_code'] = (string)($num1 + $num2); // Store the correct numeric answer
    $captcha_code = "$num1 + $num2 = ?";
} else {
    // Alphanumeric CAPTCHA
    $captcha_code = strtoupper(substr(str_shuffle("ABCD1234WXYZ5678EFGH"), 0, 5));
    $_SESSION['captcha_code'] = $captcha_code;
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYPARK - Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            overflow: auto;
        }

        .login-container {
            width: 600px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            display: flex;
            margin: auto; /* Center the login container */
            margin-top: 100px; /* Add space at the top */
        }

        .login-content {
            flex: 1.5;
            padding-right: 20px;
            border-right: 2px solid #ddd;
        }

        .signup-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background-image: url('https://randomuser.me/api/portraits/men/32.jpg');
            background-size: cover;
            background-position: center;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input {
            padding-left: 40px;
        }

        .form-group .form-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #007bff;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #007bff;
            font-size: 18px;
        }
        .not-robot-container {
        display: flex;
        align-items: center;
        background: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
        border: 2px solid #007bff;
        width: fit-content;
        margin: auto;
        cursor: pointer;
        transition: 0.3s;
        user-select: none;
    }

    .not-robot-container:hover {
        background: #e9ecef;
    }

    .not-robot-checkbox {
        display: none; /* Hide the default checkbox */
    }

    .not-robot-box {
        width: 22px;
        height: 22px;
        border: 2px solid #007bff;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        margin-right: 10px;
        font-size: 16px;
        font-weight: bold;
        color: transparent;
        transition: 0.2s;
    }

    /* When checkbox is checked, show a tick inside the box */
    .not-robot-checkbox:checked + .not-robot-box::after {
        content: "✔"; 
        font-size: 16px;
        color: white;
        font-weight: bold;
    }

    .not-robot-checkbox:checked + .not-robot-box {
        background: #007bff;
        border-color: #007bff;
    }

    .not-robot-text {
        font-size: 16px;
        color: #333;
        font-weight: bold;
    }

    .parking-logo {
        font-size: 22px;
        font-weight: bold;
        color: #007bff;
        margin-left: 10px;
    }

    .captcha-container {
        display: none;
        flex-direction: column;
        margin-top: 10px;
    }
        .captcha-code {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 10px;
            flex-grow: 1;
            text-align: center;
        }

        .captcha-input {
            flex-grow: 2;
        }

        .btn-block {
            font-size: 16px;
            padding: 10px;
        }

        /* Helpdesk Container */
        .helpdesk-container {
            margin-top: 100px; /* Space between the login form and helpdesk container */
            background: rgba(135, 206, 235, 0.9); /* Sky blue with transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Adjust position */
            z-index: 1; /* Ensures it stays on top */
        }

        .helpdesk-title {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
        }

        .helpdesk-info {
            font-size: 16px;
            margin-bottom: 10px;
            
        }

        .helpdesk-numbers {
            font-weight: bold;
        }
        .register-info-container {
    margin: 20px auto; /* Center the container */
    background: rgba(255, 255, 255, 0.8); /* Light background with some transparency */
    padding: 2px;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 30%; /* Adjust the width as needed */
    text-align: center; /* Center the text */
}


    </style>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</head>
<body>
<marquee behavior="scroll" direction="left" style="background: #007bff; color: white; padding: 10px; font-weight: bold;">
    Welcome to PayPark! 🚗 Secure your parking spot now. New users must register before logging in. For assistance, contact our helpdesk.
</marquee>

    <div class="login-container">
        <div class="login-content">
            <div class="user-avatar"></div>
            <div class="login-logo">
                <h2>PAYPARK - Login</h2>
            </div>
            <form method="post">
                <div class="form-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input type="text" name="emailcont" required placeholder="Email or Contact Number" class="form-control">
                </div>
                <div class="form-group">
                    <i class="fas fa-key form-icon"></i>
                    <input type="password" name="password" id="password" required placeholder="Password" class="form-control">
                    <i class="fas fa-eye toggle-password" id="togglePassword" onclick="togglePassword()"></i>
                </div>
                <label class="not-robot-container">
    <input type="checkbox" id="notRobotCheckbox" class="not-robot-checkbox">
    <div class="not-robot-box"></div>
    <span class="not-robot-text">I'm not a robot</span>
    <span class="parking-logo">🅿️</span>
</label>

<!-- CAPTCHA section (Initially Hidden) -->
<!-- CAPTCHA section -->
<div class="form-group captcha-container" id="captcha-section">
    <div class="captcha-code"><?php echo $captcha_code; ?></div>
    <input type="text" name="captcha" required placeholder="Enter CAPTCHA" class="form-control captcha-input">
</div>

                <div class="checkbox">
                    <label class="pull-right">
                        <a href="userforgot-password.php">I forgot my password?</a>
                    </label>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
        <div class="signup-content">
            <h4>New User?</h4>
            <a href="usersignup.php" class="btn btn-success">Register</a>
        </div>
    </div>
    <!--  -->
    <div class="register-info-container">
    <h5>How to Register</h5>
    <p><a href="user_manual.pdf">User Manual</a> | <a href="tutorial_video.php">Tutorial Video</a></p>
</div>
<!-- helpdesk -->
    <div class="helpdesk-container">
    <div class="helpdesk-title">PayPark Helpdesk Information:</div>
    <div class="helpdesk-info">
        To use PayPark services, please register and complete your profile to access parking management features.<br>
        If you encounter any issues with your registration or have questions about our services, please contact our helpdesk at the numbers below:
    </div>
    <div class="helpdesk-numbers">
        1)+91-8788345734   2)+91-8010081787   3)+91-7045232620<br>
       
    </div>
    <div class="helpdesk-info">
        <br>
        <h5><b>Helpdesk Timings: 09:00 am to 06:00 pm (All Days except Public Holidays)<b></b></h5>
    </div>
</div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const notRobotCheckbox = document.getElementById("notRobotCheckbox");
        const captchaSection = document.getElementById("captcha-section");

        notRobotCheckbox.addEventListener("change", function () {
            if (this.checked) {
                captchaSection.style.display = "flex"; // Show CAPTCHA
            } else {
                captchaSection.style.display = "none"; // Hide CAPTCHA
            }
        });
    });
</script>
</html>
