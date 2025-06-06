<?php
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle delete request for parking bookings
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Ensure ID is an integer

    // Prepare and execute query to fetch payment screenshot
    $stmt = $conn->prepare("SELECT payment_screenshot FROM parking_bookings WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Delete the file if a screenshot exists
    if ($row && $row['payment_screenshot'] && file_exists($row['payment_screenshot'])) {
        unlink($row['payment_screenshot']);
    }

    // Close statements
    $stmt->close();

    // Redirect to avoid resubmission
    echo "<script>window.location.href='processbooking.php" . $_SERVER['PHP_SELF'] . "';</script>";
    exit();
}

// Fetch all bookings sorted by ID in ascending order
$result = $conn->query("SELECT * FROM parking_bookings ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spot Booking List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }
    th {
        background-color: skyblue;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .btn-danger {
        padding: 5px 10px;
        font-size: 14px;
    }
    @media print {
    body * {
        visibility: hidden;
    }
    #bookingTable, #bookingTable * {
        visibility: visible;
    }
    #bookingTable th:nth-child(11), #bookingTable td:nth-child(11), /* Hide Screenshot column */
    #bookingTable th:nth-child(13), #bookingTable td:nth-child(13)  /* Hide Action column */ {
        display: none;
    }
    #bookingTable {
        position: absolute;
        left: 0;
        top: 0;
    }
}

</style>

</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Spot Booking List</h3>
    
    <!-- Search Filter -->
    <div class="form-group mb-3">
    <label for="searchName" class="text-sm">Search by Name:</label>
    <input type="text" id="searchName" class="form-control" placeholder="Enter name...">
</div>

    
    <!-- Row Filter -->
    <div class="form-group mb-3">
        <label for="rowsToShow">Rows to Show:</label>
        <select id="rowsToShow" class="form-control w-auto d-inline-block">
            <option value="10">10</option>
            <option value="50" selected>50</option>
            <option value="100">100</option>
            <option value="200">200</option>
        </select>
    </div>
    
    <!-- Print Button -->
    <div class="text-center mb-3">
        <button class="btn btn-primary" onclick="printTable()">
            <i class="fas fa-print"></i> Print
        </button>
    </div>
    <!-- Export CSV Button -->
<div class="text-center mb-3">
    <button class="btn btn-success" onclick="exportToCSV()">
        <i class="fas fa-file-csv"></i> Export to CSV
    </button>
</div>

    
    <table class="table table-bordered" id="bookingTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Gmail</th>
                <th>Slot Number</th>
                <th>Block Number</th>
                <th>From Time (Hours)</th>
                <th>To Time (Hours)</th>
                <th>Amount Paid (₹)</th>
                <th>UPI Reference</th>
                <th>Screenshot</th>
                <th>Booking Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td class="name"><?= $row['name'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['slot_number'] ?></td>
                <td><?= $row['block'] ?></td>
                <td><?= $row['from_time'] ?></td>
                <td><?= $row['to_time'] ?></td>
                <td><?= $row['amount_paid'] ?></td>
                <td><?= $row['upi_reference'] ?></td>
                <td>
                    <?php if ($row['payment_screenshot']): ?>
                        <a href="<?= $row['payment_screenshot'] ?>" target="_blank">
                            <i class="fas fa-eye"></i>
                        </a>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
                <td><?= date('Y-m-d H:i:s', strtotime($row['booking_time'])) ?></td>
                <td>
                    <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchName').addEventListener('keyup', function () {
        let searchText = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#bookingTable tbody tr');
        
        tableRows.forEach(row => {
            let name = row.querySelector('.name').textContent.toLowerCase();
            row.style.display = name.includes(searchText) ? '' : 'none';
        });
    });

    function printTable() {
        window.print();
    }
    function exportToCSV() {
        let table = document.getElementById("bookingTable");
        let rows = table.querySelectorAll("tr");
        let csvContent = [];

        // Extract table data
        rows.forEach(row => {
            let cols = row.querySelectorAll("th, td");
            let rowData = [];
            cols.forEach((col, index) => {
                // Skip Screenshot and Action columns (Index 10 and 12 in zero-based index)
                if (index !== 10 && index !== 12) {
                    rowData.push(col.innerText.trim());
                }
            });
            csvContent.push(rowData.join(","));
        });

        // Convert to CSV format
        let csvString = csvContent.join("\n");
        let blob = new Blob([csvString], { type: "text/csv" });
        let url = window.URL.createObjectURL(blob);

        // Create download link
        let a = document.createElement("a");
        a.href = url;
        a.download = "Parking_Bookings.csv";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>