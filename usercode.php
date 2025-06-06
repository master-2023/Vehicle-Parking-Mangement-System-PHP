<?php
session_start();
error_reporting(0);
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('db_connect.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $contno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Check for duplicate email or mobile number
    $ret = mysqli_query($conn, "SELECT Email FROM tblregusers WHERE Email='$email' || MobileNumber='$contno'");
    $result = mysqli_fetch_array($ret);

    if ($result > 0) {
        echo '<script>alert("This email or contact number is already associated with another account")</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tblregusers(FirstName, LastName, MobileNumber, Email, Password) VALUES ('$fname', '$lname', '$contno', '$email', '$password')");
        
        if ($query) {
            // PHPMailer Configuration
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'mkshitij22@gmail.com'; // Replace with your email
            $mail->Password = 'aajh hpsg xvgm pjzd'; // Replace with your email password
            $mail->SMTPSecure = 'tls'; // Use 'ssl' if required by your SMTP
            $mail->Port = 587; // Adjust as per your SMTP

            $mail->setFrom('mkshitij22@gmail.com', 'PayPark');
            $mail->addAddress($email, "$fname $lname");
            $mail->isHTML(true);

            $mail->Subject = 'Welcome to PayPark';
$mail->Body    = "
    <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd;'>
        <div style='text-align: center; margin-bottom: 20px;'>
            <img src='assets/img/payparklogo.png' alt='PayPark Logo' style='width: 120px; height: auto; margin-bottom: 10px;'>
        </div>
        <h2 style='color: #007BFF; text-align: center; font-size: 24px;'>Welcome to PayPark, $fname!</h2>
        <p style='font-size: 16px; color: #333; text-align: center;'>Thank you for registering with us. We are excited to have you on board!</p>
        <div style='background-color: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #ddd; margin: 20px 0;'>
            <h3 style='color: #007BFF; font-size: 20px; text-align: center;'>Your Registration Details</h3>
            <table style='width: 100%; max-width: 500px; margin: 0 auto; font-size: 16px;'>
                <tr>
                    <td style='padding: 8px; font-weight: bold; color: #555;'>First Name:</td>
                    <td style='padding: 8px; color: #333;'>$fname</td>
                </tr>
                <tr>
                    <td style='padding: 8px; font-weight: bold; color: #555;'>Last Name:</td>
                    <td style='padding: 8px; color: #333;'>$lname</td>
                </tr>
                <tr>
                    <td style='padding: 8px; font-weight: bold; color: #555;'>Email:</td>
                    <td style='padding: 8px; color: #333;'>$email</td>
                </tr>
                <tr>
                    <td style='padding: 8px; font-weight: bold; color: #555;'>Mobile Number:</td>
                    <td style='padding: 8px; color: #333;'>$contno</td>
                </tr>
            </table>
        </div>
        <p style='font-size: 16px; color: #555; text-align: center;'>
            <strong>As a PayPark member, you now have access to seamless and hassle-free parking solutions.</strong>
        </p>
        <div style='text-align: center; margin: 20px 0;'>
            <a href='http://localhost/parkings/parkings/userlogin.php' style='display: inline-block; padding: 10px 20px; color: #fff; background-color: #007BFF; border-radius: 5px; text-decoration: none; font-size: 16px;'>Log in to Your Account</a>
        </div>
        <p style='font-size: 14px; color: #777; text-align: center;'>
            If you have any questions, feel free to contact us at 
            <a href='mailto:support@paypark.com' style='color: #007BFF;'>support@paypark.com</a>.
        </p>
        <hr style='border: none; border-top: 1px solid #ddd; margin: 20px 0;'>
        <p style='font-size: 14px; color: #aaa; text-align: center;'>
            &copy; 2024 PayPark. All rights reserved.
        </p>
    </div>
";


            if (!$mail->send()) {
                echo '<script>alert("Registration successful, but email could not be sent. Error: ' . $mail->ErrorInfo . '")</script>';
            } else {
                echo '<script>alert("Registration successful. A confirmation email has been sent to your email address.")</script>';
            }
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
} 
?>

