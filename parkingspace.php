<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db_connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if (strlen($_SESSION['vpmsuid']==0)) 
{
  header('location:userlogout.php');
} else
{
    $vpmsuid = $_SESSION['vpmsuid'];
    $locations = $conn->query("SELECT * FROM parking_locations ORDER BY location ASC");

function generateUPIQR($amount, $upi_id) 
{
    $upi_link = "upi://pay?pa={$upi_id}&pn=PayPark&am={$amount}&cu=INR";
    $qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($upi_link);
    return $qr_code_url;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   $id=null;
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $slot_number = $_POST['slot'];
    $block = $_POST['block'];
    $from_time = $_POST['fromTime'];
    $to_time= $_POST['toTime'];
    $amount_paid = $_POST['amount'];
    $upi_reference =$_POST['upiReference'];
    $payment_screenshot = null;
    $payment_screenshot = null;
if (isset($_FILES['paymentScreenshot']) && $_FILES['paymentScreenshot']['error'] == 0) {
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
    }
    $payment_screenshot = $upload_dir . basename($_FILES['paymentScreenshot']['name']);
    move_uploaded_file($_FILES['paymentScreenshot']['tmp_name'], $payment_screenshot);
}
    $date = date('Y-m-d H:i:s');
    //echo $date;
    $query = "INSERT INTO parking_bookings VALUES('$id','$name', '$phone', '$email','$slot_number', '$block','$from_time', '$to_time', '$amount_paid', '$upi_reference', '$payment_screenshot','$date')";
    $res = $conn->query($query);
    if ($conn->query($query) === TRUE) { 
        // Insert notification with block and slot number
        $slotBlockQuery = "SELECT slot_number, block FROM parking_bookings WHERE id='$id'";
        $slotBlockResult = $conn->query($slotBlockQuery);
        if ($slotBlockResult->num_rows > 0) {
            $slotBlockData = $slotBlockResult->fetch_assoc();
            $slot_number = $slotBlockData['slot_number'];
            $block = $slotBlockData['block'];
        }
        $notificationMsg = "New Booking: $name ($phone), Slot: $slot_number, Block: $block";
        $insertNotification = "INSERT INTO notifications (name, phone, message, slot_number, block) VALUES ('$name', '$phone', '$notificationMsg', '$slot_number', '$block')";
        $conn->query($insertNotification);
    
        // Send email confirmation
        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'mkshitij22@gmail.com'; // Replace with your Gmail
            $mail->Password = 'aywq zjzr koti ezvp'; // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email details
            $mail->setFrom('mkshitij22@gmail.com', 'PayPark Support');
            $mail->addAddress($email, $name);
            $mail->Subject = 'Parking Booking Confirmation';
            $mail->isHTML(true);

            // Email body
            $mail->Body = "
    <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;'>
        <h2 style='color: #4CAF50; text-align: center;'>PayPark - Booking Confirmation</h2>
        <p>Dear <strong>$name</strong>,</p>
        <p>We are pleased to inform you that your parking booking has been successfully confirmed. Here are your booking details:</p>
        <table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>
            <tr>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'><strong>Slot Number:</strong></td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$slot_number</td>
            </tr>
            <tr>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'><strong> Block:</strong></td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$block</td>
            </tr>
            <tr>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'><strong>Start Time:</strong></td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$from_time</td>
            </tr>
            <tr>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'><strong>End Time:</strong></td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>$to_time</td>
            </tr>
            <tr>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'><strong>Amount Paid:</strong></td>
                <td style='padding: 10px; border-bottom: 1px solid #ddd;'>₹$amount_paid</td>
            </tr>
        </table>
        
        <p style='margin-top: 15px;'><strong>Important Notes:</strong></p>
        <ul>
            <li>Please ensure you arrive on time to avoid any inconvenience.</li>
            <li>Keep this email as proof of your booking.</li>
            <li>For any queries, contact our support team.</li>
        </ul>
        
        <p>Thank you for choosing <strong>PayPark</strong>! We appreciate your trust in our services.</p>
        
        <p style='text-align: center;'>
            <a href='https://paypark.com' style='display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Visit PayPark</a>
        </p>
        
        <p style='text-align: center; color: #777; font-size: 12px;'>This is an automated email, please do not reply.</p>
    </div>
";

                

            $mail->send();
            echo "<script>alert('Booking confirmed and email sent successfully!');</script>";
        } catch (Exception $e) 
        {
            echo "<script>alert('Booking saved, but email could not be sent. Error: {$mail->ErrorInfo}');</script>";
        }
    } else 
    {
        echo "Error: " . mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Spots</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .parking-spot {
            display: inline-block;
            width: 100px;
            height: 100px;
            background-color: #28a745;
            color: white;
            font-size: 1rem;
            text-align: center;
            line-height: 100px;
            margin: 10px;
            position: relative;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .parking-spot:hover {
            transform: scale(1.1);
        }
        .parking-spot .icon {
            font-size: 2rem;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .parking-spot span {
            display: block;
            font-size: 0.8rem;
            font-weight: bold;
            margin-top: 10px;
        }
        .modal-header, .modal-footer {
            background-color: #f8f9fa;
        }
        .modal-body {
            padding: 20px;
        }
        .modal-content {
            border-radius: 10px;
            overflow: hidden;
        }
        .block-section {
            margin-top: 20px;
            text-align: center;
        }
        #bookingForm .form-control {
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        #bookingForm label {
            font-weight: bold;
            color: #343a40;
        }
        #bookingForm button[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #bookingForm button[type="submit"]:hover {
            background-color: #218838;
        }
        #upi-qr-code img {
            margin-top: 20px;
        }
        /*  */
        .status-checkboxes {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}

.checkbox-label input {
    display: none;
}

.checkbox-custom {
    width: 20px;
    height: 20px;
    display: inline-block;
    border-radius: 50%;
    margin-right: 8px;
}

.available {
    background-color: green;
    border: 2px solid darkgreen;
}

.booked {
    background-color: red;
    border: 2px solid darkred;
}

    </style>
</head>
<body>

<?php include 'userheader.php';?>
<?php include 'usersidebar.php';?>

<div class="container mt-5">
<div class="status-checkboxes text-right">
    <label class="checkbox-label">
        <input type="checkbox" disabled checked>
        <span class="checkbox-custom available"></span> Not Available
    </label>
    <label class="checkbox-label">
        <input type="checkbox" disabled checked>
        <span class="checkbox-custom available"></span> Available Parking
    </label>
    <label class="checkbox-label">
        <input type="checkbox" disabled>
        <span class="checkbox-custom booked"></span> Booked Parking
    </label>
   
</div>
  <h3 class="text-center">Available Parking Space</h3>
  
    <div class="row justify-content-center">
        <?php while ($location = $locations->fetch_assoc()): ?>
            <?php
                // Determine the vehicle type based on block number
                $vehicle_type = '';
                switch ($location['id']) {
                    case 1:
                        $vehicle_type = '2 Wheeler';
                        break;
                    case 2:
                        $vehicle_type = '3 Wheeler';
                        break;
                    case 3:
                        $vehicle_type = '4 Wheeler';
                        break;
                    case 4:
                        $vehicle_type = 'VIP Parking';
                        break;
                    default:
                        $vehicle_type = 'General Parking';
                        break;
                }
            ?>
            <div class="parking-spot" data-id="<?= $location['id'] ?>" data-location="<?= $location['location'] ?>" data-capacity="<?= $location['capacity'] ?>" data-toggle="modal" data-target="#blockModal">
                <div class="icon"><i class="fa fa-parking"></i></div>
                <span><?= $location['location'] ?></span>
                <!-- <small><?= $location['capacity'] ?> total spots</small> -->
                
                <strong><?= $vehicle_type ?></strong>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Block Modal -->
<div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="blockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blockModalLabel"> Parking Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="block-section">
                    <!-- Dynamically populated parking spots -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="bookingForm" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Parking Slot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="slot_id" id="slotId">

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>

                    <!-- Phone Number Field -->
                    <div class="form-group">
                        <label for="userPhone">Phone Number</label>
                        <input type="tel" class="form-control" id="userPhone" name="phone" pattern="\d{10}" maxlength="10" required title="Phone number must be 10 digits" oninput="this.value = this.value.replace(/[^0-9+]/g, '').slice(0, 10)">
                    </div>

                    <!-- Email Field for Gmail -->
                    <div class="form-group">
                         <label for="userEmail">Email (Gmail)</label>
                        <input type="email" class="form-control" id="userEmail" name="email" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Only Gmail addresses are allowed" placeholder="Enter your Gmail address" required>
                    </div>

                    <!-- Slot Number Field -->
                    <div class="form-group">
                        <label for="slotNumber">Slot Number</label>
                        <input type="text" class="form-control" id="slotNumber" name="slot" readonly>
                    </div>

                    <!-- Block Number Field -->
                    <div class="form-group">
                        <label for="blockNumber">Block Number</label>
                        <input type="text" class="form-control" id="blockNumber" name="block" readonly>
                    </div>

                    <!-- Booking Time -->
                    <div class="form-group">
                        <label for="fromTime">From Time</label>
                        <input type="time" class="form-control" id="fromTime" name="fromTime" required>
                    </div>
                    <div class="form-group">
                        <label for="toTime">To Time</label>
                        <input type="time" class="form-control" id="toTime" name="toTime" required>
                    </div>

                    <!-- Total Amount Field -->
                    <div class="form-group">
                        <label for="totalAmount">Total Amount (₹)</label>
                        <input type="text" class="form-control" id="totalAmount" name="amount" readonly>
                    </div>

                    <!-- Razorpay Payment Button -->
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" id="rzp-button">Pay with Razorpay</button>
                    </div>

                    <!-- UPI Reference Number Field -->
                    <div class="form-group mt-3">
                        <label for="upiReference">UPI Reference Number</label>
                        <input type="text" class="form-control" id="upiReference" name="upiReference" placeholder="Enter UPI Reference Number" required>
                    </div>

                    <!-- Payment Screenshot Upload -->
                    <div class="form-group">
                        <label for="paymentScreenshot">Upload Payment Screenshot</label>
                        <input type="file" class="form-control-file" id="paymentScreenshot" name="paymentScreenshot" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
        </div>
    </div>
</div>



<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        disableExpiredSlots(); // Disable expired slots on page load
    });

    document.querySelectorAll('.parking-spot').forEach(function (spot) {
        spot.addEventListener('click', function () {
            const locationId = this.getAttribute('data-id');
            const locationName = this.getAttribute('data-location'); // Get block name
            const capacity = this.getAttribute('data-capacity');
            const blockSection = document.querySelector('.block-section');
            blockSection.innerHTML = ''; // Clear previous slots

            // Generate parking spots based on capacity
            for (let i = 1; i <= capacity; i++) {
                const slotDiv = document.createElement('div');
                slotDiv.classList.add('parking-spot');
                slotDiv.innerHTML = `
                    <div class="icon"><i class="fa fa-parking"></i></div>
                    <span>Spot ${i}</span>
                `;
                slotDiv.dataset.slotId = i;
                slotDiv.dataset.blockName = locationName; // Add block name to dataset

                // Check if the slot is disabled
                let blockedSlot = localStorage.getItem(`blocked_${locationName}_${i}`);
                if (blockedSlot && new Date().getTime() < blockedSlot) {
                    disableSlot(slotDiv); // Disable slot if still blocked
                } else {
                    slotDiv.addEventListener('click', function () {
                        document.getElementById('slotId').value = i;
                        document.getElementById('slotNumber').value = `Spot ${i}`;
                        document.getElementById('blockNumber').value = locationName;
                        $('#bookingModal').modal('show');
                    });
                }

                blockSection.appendChild(slotDiv);
            }
        });
    });

    document.getElementById('bookingForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default submission

        const phoneField = document.getElementById('userPhone');
        const phoneValue = phoneField.value;

        if (!/^\d{10}$/.test(phoneValue)) {
            alert('Phone number must be exactly 10 digits.');
            return false;
        }

        // Disable booked slot for 10 minutes
        let slotId = document.getElementById('slotId').value;
        let blockName = document.getElementById('blockNumber').value;
        let expiryTime = new Date().getTime() + 30 * 60 * 1000; // 10 minutes from now
        localStorage.setItem(`blocked_${blockName}_${slotId}`, expiryTime);
        disableSlot(document.querySelector(`.parking-spot[data-slot-id="${slotId}"]`));

        alert("Booking confirmed! The slot is booked for the Time Period.");
        this.submit(); // Allow form submission
    });

    function disableSlot(slotElement) {
    if (slotElement) {
        slotElement.classList.add("disabled");
        slotElement.style.pointerEvents = "none";
        slotElement.style.opacity = "0.8";  // Slightly visible
        slotElement.style.backgroundColor = "#8B0000"; // Dark red
        slotElement.style.color = "white"; // Change text color for visibility
    }
}


    function disableExpiredSlots() {
        let currentTime = new Date().getTime();
        Object.keys(localStorage).forEach(key => {
            if (key.startsWith("blocked_")) {
                let expiryTime = localStorage.getItem(key);
                let [_, blockName, slotId] = key.split("_");

                if (currentTime >= expiryTime) {
                    localStorage.removeItem(key);
                } else {
                    let slotElement = document.querySelector(`.parking-spot[data-slot-id="${slotId}"]`);
                    disableSlot(slotElement);
                }
            }
        });
    }

    function calculateAmount() {
        const fromTime = document.getElementById('fromTime').value;
        const toTime = document.getElementById('toTime').value;
        const totalAmountField = document.getElementById('totalAmount');
        const qrCodeImage = document.getElementById('qrCodeImage');

        if (fromTime && toTime) {
            const start = new Date(`1970-01-01T${fromTime}:00`);
            const end = new Date(`1970-01-01T${toTime}:00`);
            const diffInHours = (end - start) / (1000 * 60 * 60);

            if (diffInHours > 0) {
                const ratePerHour = 20;
                totalAmountField.value = (diffInHours * ratePerHour).toFixed(2);

                // Generate UPI QR code dynamically
                const upiId = "hshittij@oksbi"; // Replace with actual UPI ID
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=${upiId}&pn=PayPark&am=${totalAmount}&cu=INR`;
                qrCodeImage.src = qrUrl;
                qrCodeImage.style.display = "block";
            } else {
                totalAmountField.value = "0.00";
                qrCodeImage.style.display = "none";
                alert("Invalid time range. Please ensure 'To Time' is later than 'From Time'.");
            }
        }
    }

    document.getElementById('fromTime').addEventListener('change', calculateAmount);
    document.getElementById('toTime').addEventListener('change', calculateAmount);
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById("rzp-button").onclick = function (e) {
        e.preventDefault();
        var amount = document.getElementById("totalAmount").value * 100; // Convert to paise

        var options = {
            key: "rzp_test_Qo8hBtTFO15YhF", // Replace with your Razorpay Key
            amount: amount,
            currency: "INR",
            name: "PayPark",
            description: "Parking Slot Booking",
            handler: function (response) {
                document.getElementById("upiReference").value = response.razorpay_payment_id;
                alert("Payment Successful! Reference ID: " + response.razorpay_payment_id);
            },
            prefill: {
                name: document.getElementById("userName").value,
                contact: document.getElementById("userPhone").value
            },
            theme: {
                color: "#28a745"
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    };
</script>

</body>
</html>
<?php }?>