<!-- Income report data -->
<?php
include('db_connect.php');
// Get date range from user input
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];

// Generate report data
$query = "SELECT 
            DATE(pt.date_created) AS report_date, 
            COUNT(DISTINCT ref_no) AS total_vehicles, 
            SUM(pt.amount_tendered) AS total_parking_fee
        FROM 
            parked_list pt
        WHERE 
            pt.date_created BETWEEN '$date_from' AND '$date_to'
        GROUP BY 
            DATE(pt.date_created)";

$result = $conn->query($query);

// Create report array and calculate totals
$report_data = array();
$total_vehicles = 0;
$total_parking_fee = 0;

while ($row = $result->fetch_assoc()) {
    $report_data[] = array(
        'report_date' => $row['report_date'],
        'total_vehicles' => $row['total_vehicles'],
        'total_parking_fee' => $row['total_parking_fee']
    );
    // Summing up totals
    $total_vehicles += $row['total_vehicles'];
    $total_parking_fee += $row['total_parking_fee'];
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Management System Report</title>
    <style>
        /* Add some basic styles for the report */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .print-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-button:hover {
            background-color: #45a049;
        }
        .total-row {
            font-weight: bold;
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <h2>Vehicles Parking Management System Report</h2>
    <button class="print-button" onclick="printReport()">Print Report</button>

    <table border='1'>
        <tr>
            <th>Date</th>
            <th>Total Vehicles</th>
            <th>Total Collection</th>
        </tr>
        <?php foreach ($report_data as $row): ?>
        <tr>
            <td><?php echo $row['report_date']; ?></td>
            <td><?php echo $row['total_vehicles']; ?></td>
            <td>Rs. <?php echo number_format($row['total_parking_fee'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- Calculation row for totals -->
        <tr class="total-row">
            <td>Total</td>
            <td><?php echo $total_vehicles; ?></td>
            <td>Rs. <?php echo number_format($total_parking_fee, 2); ?></td>
        </tr>
    </table>

    <script>
        // JavaScript function to print the report
        function printReport() {
            window.print();
        }
    </script>

</body>
</html>
