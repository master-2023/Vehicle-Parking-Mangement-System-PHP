<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $slot = $_POST['slot'];
    $block = $_POST['block'];
    $fromTime = $_POST['fromTime'];
    $toTime = $_POST['toTime'];
    $amount = $_POST['amount'];
    $upiReference = $_POST['upiReference'];

    // Handling image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["paymentScreenshot"]["name"]);
    move_uploaded_file($_FILES["paymentScreenshot"]["tmp_name"], $target_file);

    // Check if slot is already booked for this time
    $checkBooking = "SELECT * FROM parking_bookings 
                     WHERE slot = ? AND block = ? 
                     AND ((from_time <= ? AND to_time >= ?) 
                     OR (from_time <= ? AND to_time >= ?))";
    
    $stmt = $conn->prepare($checkBooking);
    $stmt->bind_param("ssssss", $slot, $block, $fromTime, $fromTime, $toTime, $toTime);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Slot already booked!"]);
    } else {
        // Insert booking
        $insertBooking = "INSERT INTO parking_bookings (name, phone, slot, block, from_time, to_time, amount, upi_reference, payment_screenshot, status) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'booked')";

        $stmt = $conn->prepare($insertBooking);
        $stmt->bind_param("ssssssdss", $name, $phone, $slot, $block, $fromTime, $toTime, $amount, $upiReference, $target_file);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Booking successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error in booking!"]);
        }
    }
}
?>
