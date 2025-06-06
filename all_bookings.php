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

// Pagination setup
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

// Fetch total number of bookings for pagination
$totalQuery = "SELECT COUNT(*) as total FROM notifications";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalBookings = $totalRow['total'];
$totalPages = ceil($totalBookings / $limit); // Total pages

// Fetch bookings for the current page
$bookingQuery = "SELECT name, phone, block, slot_number, created_at FROM notifications ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$bookingResult = $conn->query($bookingQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        table {
            margin-top: 20px;
        }
        .print-container {
            display: none; /* Hide during normal display */
        }
        @media print {
            .no-print {
                display: none; /* Hide elements during print */
            }
            .print-container {
                display: block; /* Show print container */
            }
            .pagination, .btn {
                display: none; /* Hide pagination and button */
            }
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
    <h1 class="text-center">All Spot Parkings Bookings</h1>

      
        <div class="no-print" style="display: flex; justify-content: flex-end;">
            <button onclick="printPage()" class="btn btn-primary mb-3">Print</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Block</th>
                    <th>Slot Number</th>
                    <th>Booking Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($bookingResult && $bookingResult->num_rows > 0): ?>
                    <?php while ($row = $bookingResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['block']); ?></td>
                            <td><?php echo htmlspecialchars($row['slot_number']); ?></td>
                            <td><?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No bookings found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

        <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
