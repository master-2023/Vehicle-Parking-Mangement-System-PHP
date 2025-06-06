<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db_connect.php');

if (!isset($_SESSION['vpmsuid'])) {
    header('location:userlogout.php');
    exit();
}

$nameFilter = isset($_POST['name']) ? $_POST['name'] : '';

$query = "SELECT * FROM parking_bookings WHERE name = '$nameFilter'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Parking Booking Report</h2>
    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo htmlspecialchars($nameFilter); ?>" required>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Slot Number</th>
                <th>Block</th>
                <th>From Time</th>
                <th>To Time</th>
                <th>Amount Paid</th>
                <th>UPI Reference</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['slot_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['block']); ?></td>
                    <td><?php echo htmlspecialchars($row['from_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['to_time']); ?></td>
                    <td>₹<?php echo htmlspecialchars($row['amount_paid']); ?></td>
                    <td><?php echo htmlspecialchars($row['upi_reference']); ?></td>
                    <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
