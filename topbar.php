<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "parking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest feedback data
$feedbackQuery = "SELECT rating, review, created_at FROM feedback WHERE is_seen = 0 ORDER BY created_at DESC LIMIT 5";
$feedbackResult = $conn->query($feedbackQuery);
$unseenFeedbackCount = $feedbackResult->num_rows;

$bookingQuery = "SELECT name, phone, block, slot_number, created_at FROM notifications WHERE is_seen = 0 ORDER BY created_at DESC LIMIT 5";
$bookingResult = $conn->query($bookingQuery);
$unseenBookingCount = $bookingResult->num_rows;


$bookings = [];
if ($bookingResult && $bookingResult->num_rows > 0) {
    while ($row = $bookingResult->fetch_assoc()) {
        $bookings[] = [
            "name" => $row['name'],
            "phone" => $row['phone'],
            "block" => $row['block'],
            "slot_number" => $row['slot_number'],
            "time" => date("F j, Y, g:i a", strtotime($row['created_at']))
        ];
    }
}
// Initialize notifications array
$notifications = [];
if ($feedbackResult && $feedbackResult->num_rows > 0) {
    while ($row = $feedbackResult->fetch_assoc()) {
        $notifications[] = [
            "rating" => $row['rating'],
            "review" => $row['review'],
            "time" => date("F j, Y, g:i a", strtotime($row['created_at']))
        ];
    }
}




$conn->close();
?>


<!-- Custom styles for the navbar -->
<style>
  .notification-dropdown {
  display: none;
  position: absolute;
  right: 10px;
  top: 50px;
  width: 320px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  z-index: 1050;
  overflow: hidden;
}

.notification-header {
  padding: 15px;
  font-size: 16px;
  font-weight: bold;
  color: #fff;
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  text-align: center;
}

.notification-item {
  display: flex;
  padding: 15px;
  align-items: flex-start;
  transition: background 0.3s;
  cursor: pointer;
  border-bottom: 1px solid #f1f1f1;
}

.notification-item:hover {
  background: #f7f9fc;
}

.notification-item:last-child {
  border-bottom: none;
}

.notification-content {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.notification-title {
  font-size: 14px;
  font-weight: bold;
  color: #333;
}

.notification-text {
  font-size: 12px;
  color: #666;
  margin: 0;
}

.notification-time {
  font-size: 10px;
  color: #999;
  align-self: flex-end;
}

.notification-footer {
  text-align: center;
  padding: 12px;
  font-size: 14px;
  font-weight: bold;
  background: #f1f1f1;
  color: #007bff;
  cursor: pointer;
  transition: background 0.3s, color 0.3s;
}

.notification-footer:hover {
  background: #e9ecef;
  color: #0056b3;
}

.badge {
  display: inline-block;
  min-width: 20px;
  height: 20px;
  line-height: 20px;
  border-radius: 50%;
  font-size: 12px;
  background: #ff4757;
  color: #fff;
  text-align: center;
}

.navbar .ml-auto {
  display: flex;
  gap: 15px;
  align-items: center;
}
.navbar {
  height: 56px; /* Reduce height */
  padding: 5px 10px; /* Adjust padding */
}

.navbar .container-fluid {
  align-items: center;
}
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-blue" href="#">PAYPARK</a>

    <div class="ml-auto">
      <!-- Notification icon -->
      <!-- Feedback Notifications Dropdown -->
<div class="dropdown position-relative">
    <a href="#" id="feedbackNotificationIcon" class="text-white position-relative">
        <i class="fa fa-bell"></i>

       <!-- Feedback Badge -->
<span class="badge badge-danger position-absolute" style="top: -5px; right: -15px;">
    <?php echo ($unseenFeedbackCount > 0) ? $unseenFeedbackCount : ''; ?>
</span>
    </a>

    <div id="feedbackDropdown" class="notification-dropdown">
        <div class="notification-header">Feedback Notifications</div>
        <?php if (!empty($notifications)): ?>
            <?php foreach ($notifications as $notification): ?>
                <div class="notification-item">
                    <div class="notification-content">
                        <span class="notification-title"><strong>Rating:</strong> <?php echo str_repeat("⭐", $notification['rating']); ?></span>
                        <p class="notification-text"><strong>Review:</strong> <?php echo htmlspecialchars($notification['review']); ?></p>
                        <span class="notification-time"><?php echo $notification['time']; ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="notification-item">No new feedback available</div>
        <?php endif; ?>
        <a href="all_feedback.php" class="notification-footer">View All Feedback</a>
    </div>
</div>

<!-- Booking Notifications Dropdown -->
<!-- Booking Notifications Dropdown with Car Icon -->
<div class="dropdown position-relative" style="margin-left: 20px; margin-right: 10px;"> <!-- Added margin for spacing -->
    <a href="#" id="bookingNotificationIcon" class="text-white position-relative">
        <i class="fa fa-car"></i> <!-- Car icon instead of bell -->

        <span class="badge badge-danger position-absolute" style="top: -5px; right: -15px;">
    <?php echo ($unseenBookingCount > 0) ? $unseenBookingCount : ''; ?>
</span>
    </a>

    <div id="bookingDropdown" class="notification-dropdown">
        <div class="notification-header">New Booking Notifications</div>
        <?php if (!empty($bookings)): ?>
            <?php foreach ($bookings as $booking): ?>
                <div class="notification-item">
                    <div class="notification-content">
                        <span class="notification-title"><strong><?php echo $booking['name']; ?></strong></span>
                        <p class="notification-text">Phone: <?php echo $booking['phone']; ?></p>
                        <p class="notification-text">Block: <?php echo $booking['block']; ?> | Slot: <?php echo $booking['slot_number']; ?></p>
                        <span class="notification-time"><?php echo $booking['time']; ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="notification-item">No new bookings</div>
        <?php endif; ?>
        <a href="all_bookings.php" class="notification-footer">View All Bookings</a>
    </div>
</div>

<a href="ajax.php?action=logout" class="text-white">
        <?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i>
      </a>

    </div>
  </div>
</nav>
<!-- <a href="ajax.php?action=logout" class="text-white">
        <?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i>
      </a> -->

<script>
 $(document).ready(function () {
    $("#feedbackNotificationIcon").click(function (e) {
        e.preventDefault();
        $("#feedbackDropdown").fadeToggle(300);
        $("#bookingDropdown").fadeOut(300);

        // Mark Feedback Notifications as Seen
        $.post("mark_seen.php", { type: "feedback" }, function () {
            $("#feedbackNotificationIcon .badge").fadeOut();
        });
    });

    $("#bookingNotificationIcon").click(function (e) {
        e.preventDefault();
        $("#bookingDropdown").fadeToggle(300);
        $("#feedbackDropdown").fadeOut(300);

        // Mark Booking Notifications as Seen
        $.post("mark_seen.php", { type: "booking" }, function () {
            $("#bookingNotificationIcon .badge").fadeOut();
        });
    });

    $(document).click(function (e) {
        if (!$(e.target).closest("#feedbackNotificationIcon, #feedbackDropdown").length) {
            $("#feedbackDropdown").fadeOut(300);
        }
        if (!$(e.target).closest("#bookingNotificationIcon, #bookingDropdown").length) {
            $("#bookingDropdown").fadeOut(300);
        }
    });
});


</script>

