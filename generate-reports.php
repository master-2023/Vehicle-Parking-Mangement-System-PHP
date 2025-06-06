<?php
    session_start();
    error_reporting(0);
    include('db_connect.php');

    if ($_SESSION['login_id'] == 0) {
        header('location:logout.php');
    } else {
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vehicle Parking Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <style>
        .panel {
            animation: fadeIn 1s ease-in-out;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .alert {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            text-align: center;
        }
        .table {
            width: 100%;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: #28a745;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table th, .table td {
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
        .panel-heading {
            background-color: skyblue;
            color: white;
            text-align: center;
            font-size: 18px;
            padding: 10px 15px;
            border-radius: 10px 10px 0 0;
        }
        .print-button {
            display: block;
            width: 150px;
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
        .filter-section {
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-section select, .filter-section button {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        
        /* Hide filter section & print button when printing */
        @media print {
            .filter-section, .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Generate Reports</div>
            <div class="panel-body">
                <?php
                $fdate = $_POST['fromdate'];
                $tdate = $_POST['todate'];
                $block = isset($_POST['block']) ? $_POST['block'] : ''; 
                ?>

                <div class="alert bg-info" role="alert">
                    <em class="fa fa-lg fa-file">&nbsp;</em>
                    Displaying reports from <b><?php echo $fdate; ?></b> to <b><?php echo $tdate; ?></b>
                    <?php if ($block != '') { echo " for Block <b>$block</b>"; } ?>
                </div>

                <!-- Block Selection Form -->
                <form method="POST" class="filter-section">
                    <input type="hidden" name="fromdate" value="<?php echo $fdate; ?>">
                    <input type="hidden" name="todate" value="<?php echo $tdate; ?>">
                    <label for="block">Select Block:</label>
                    <select name="block" id="block">
                        <option value="">All Blocks</option>
                        <option value="1" <?php if ($block == "1") echo "selected"; ?>>Block 1</option>
                        <option value="2" <?php if ($block == "2") echo "selected"; ?>>Block 2</option>
                        <option value="3" <?php if ($block == "3") echo "selected"; ?>>Block 3</option>
                        <option value="4" <?php if ($block == "4") echo "selected"; ?>>Block 4</option>
                    </select>
                    <button type="submit">Submit</button>
                </form>

                <!-- Print Button -->
                <button class="print-button" onclick="printReport()">Print Report</button>

                <table id="example" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Vehicle Reg. No.</th>
                            <th>Block (Location)</th>
                            <th>Payment</th>
                            <th>Brand</th>
                            <th>Vehicle's Owner</th>
                            <th>Check-in Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM parked_list WHERE date(date_created) BETWEEN '$fdate' AND '$tdate'";

                        if (!empty($block)) {
                            $query .= " AND location_id = '$block'";
                        }

                        $ret = mysqli_query($conn, $query);
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row['vehicle_registration']; ?></td>
                            <td><?php echo $row['location_id']; ?></td>
                            <td><?php echo $row['amount_tendered']; ?></td>
                            <td><?php echo $row['vehicle_brand']; ?></td>
                            <td><?php echo $row['owner']; ?></td>
                            <td><?php echo $row['date_created']; ?></td>
                        </tr>
                        <?php $cnt++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function printReport() {
        window.print();
    }
</script>

</body>
</html>

<?php } ?>
