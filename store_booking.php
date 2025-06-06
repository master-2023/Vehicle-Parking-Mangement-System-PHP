<?php
session_start();
include 'db_connect.php';

// Simulate login for testing (Remove this in production)
if (!isset($_SESSION['phone'])) {
    $_SESSION['phone'] = '8788345734'; // Replace with an actual phone number from tblregusers
}

// Debugging: Check if session is set
if (isset($_SESSION['phone'])) {
    echo "<p>✅ Logged in as: " . $_SESSION['phone'] . "</p>";
} else {
    die("<p>❌ You must be logged in to view this page.</p>");
}

$loggedInPhone = $_SESSION['phone']; // Get logged-in user's phone number

// Fetch unique blocks for the logged-in user
$blocksQuery = "SELECT DISTINCT block FROM parking_bookings WHERE phone = ?";
$stmtBlocks = $conn->prepare($blocksQuery);
$stmtBlocks->bind_param("s", $loggedInPhone);
$stmtBlocks->execute();
$blocksResult = $stmtBlocks->get_result();

// Fetch unique slots for the logged-in user
$slotsQuery = "SELECT DISTINCT slot_number FROM parking_bookings WHERE phone = ?";
$stmtSlots = $conn->prepare($slotsQuery);
$stmtSlots->bind_param("s", $loggedInPhone);
$stmtSlots->execute();
$slotsResult = $stmtSlots->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Parking Slot</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Search Parking Slot</h2>

    <!-- Form to Select Block and Slot -->
    <form method="GET" action="">
        <label for="block">Select Block:</label>
        <select name="block" id="block" required>
            <option value="">Choose Block</option>
            <?php while ($blockRow = $blocksResult->fetch_assoc()) { ?>
                <option value="<?= htmlspecialchars($blockRow['block']) ?>">
                    <?= htmlspecialchars($blockRow['block']) ?>
                </option>
            <?php } ?>
        </select>

        <label for="slot_number">Select Slot:</label>
        <select name="slot_number" id="slot_number" required>
            <option value="">Choose Slot</option>
            <?php while ($slotRow = $slotsResult->fetch_assoc()) { ?>
                <option value="<?= htmlspecialchars($slotRow['slot_number']) ?>">
                    <?= htmlspecialchars($slotRow['slot_number']) ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Search</button>
    </form>

    <hr>

    <?php
    // Display booking details in table format after selection
    if (isset($_GET['slot_number']) && isset($_GET['block'])) {
        $slot_number = $_GET['slot_number'];
        $block = $_GET['block'];

        $stmt = $conn->prepare("SELECT * FROM parking_bookings WHERE slot_number = ? AND block = ? AND phone = ?");
        $stmt->bind_param("sss", $slot_number, $block, $loggedInPhone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>Booking Details for Slot: $slot_number, Block: $block</h2>";
            echo "<table>";
            echo "<tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Block</th>
                    <th>From Time</th>
                    <th>To Time</th>
                    <th>Total Amount (₹)</th>
                    <th>UPI Reference</th>
                  </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['phone']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['block']) . "</td>
                        <td>" . htmlspecialchars($row['from_time']) . "</td>
                        <td>" . htmlspecialchars($row['to_time']) . "</td>
                        <td>" . htmlspecialchars($row['amount_paid']) . "</td>
                        <td>" . htmlspecialchars($row['upi_reference']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<h3>No booking found for Slot Number: $slot_number in Block: $block</h3>";
        }
        $stmt->close();
    }

    $conn->close();
    ?>

</body>
</html>
