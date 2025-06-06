<?php
session_start();
error_reporting(0); // Suppress minor errors. Use only in production.
include('db_connect.php'); // Ensure this file correctly connects to the database.

if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:userlogout.php');
} else {
    ?>
    <!doctype html>
    <html class="no-js" lang="">

    <head>
        <title>PAYPARK - View Vehicle Parking Details</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <!-- Custom CSS (if any) -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <?php include_once('usersidebar.php'); ?>


    <body>
        <div class="container-fluid d-flex justify-content-center align-items-center vh-100"
            style="display:grid; place-items:center;">
            <div class="row w-100">
                <div class="col-md-3 col-lg-7 px-4" style="margin-left:300px;">
                    <div class="breadcrumbs mt-3">
                        <div class="breadcrumbs-inner">
                            <div class="row m-0">
                                <div class="col-sm-5 mx-auto text-center"> <!-- Center the content -->
                                    <div class="page-header"style="margin-left:-20px;margin-top:10px;">
                                        <div class="page-title">
                                            <h1>Vehicle Parking Information</h1>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-8">
                                <div class="page-header float-right">
                                    <div class="page-title">
                                        <ol class="breadcrumb text-right">
                                            <li><a href="userdashboard.php">Dashboard</a></li>
                                            <li><a href="userview-vehicle.php">View Vehicle Parking Details</a></li>
                                            <li class="active">View Vehicle Parking Details</li>
                                        </ol>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="content" style="margin-left:400px;margin-top:10px;">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">View Vehicle Parking Details (Registered Mobile
                                            No)</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.NO</th>
                                                    <th>Parking Number</th>
                                                    <th>Owner Name</th>
                                                    <th>Vehicle Reg Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Get owner mobile number from session
                                                $ownerno = $_SESSION['vpmsumn'];

                                                // Query to fetch vehicle details using prepared statements
                                                $sql = "SELECT 
                                                            ru.FirstName,
                                                            ru.LastName,
                                                            ru.MobileNumber,
                                                            ru.Email,
                                                            pl.ref_no,
                                                            pl.category_id,
                                                            pl.vehicle_brand,
                                                            pl.vehicle_registration,
                                                            pl.owner,
                                                            pl.id as vehid,
                                                            pl.phone_number,
                                                            pl.date_created
                                                        FROM 
                                                            parked_list pl
                                                        INNER JOIN 
                                                            tblregusers ru
                                                        ON 
                                                            ru.MobileNumber = pl.phone_number
                                                        WHERE 
                                                            pl.phone_number = ?";

                                                // Prepare statement
                                                if ($stmt = $conn->prepare($sql)) {
                                                    $stmt->bind_param('s', $ownerno); // Bind parameter (string)
                                            
                                                    // Execute the statement
                                                    $stmt->execute();

                                                    // Get the result
                                                    $result = $stmt->get_result();

                                                    // Check if any records are returned
                                                    if ($result->num_rows > 0) {
                                                        $cnt = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $cnt; ?></td>
                                                                <td><?php echo htmlspecialchars($row['ref_no']); ?></td>
                                                                <td><?php echo htmlspecialchars($row['owner']); ?></td>
                                                                <td><?php echo htmlspecialchars($row['vehicle_registration']); ?>
                                                                </td>
                                                                <td>
                                                                    <a href="userview--detail.php?viewid=<?php echo urlencode($row['vehid']); ?>"
                                                                        class="btn btn-primary">View</a>
                                                                    <a href="userprint.php?vid=<?php echo urlencode($row['vehid']); ?>"
                                                                        target="_blank" class="btn btn-warning">Print</a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $cnt++;
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='5' class='text-center'>No Records Found</td></tr>";
                                                    }

                                                    // Close the statement
                                                    $stmt->close();
                                                } else {
                                                    // Handle SQL prepare error
                                                    echo "<tr><td colspan='5' class='text-center'>Database Error: Unable to prepare statement.</td></tr>";
                                                }

                                                // Close the connection if not needed further
                                                // $conn->close(); // Uncomment if you are done with the connection
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .animated -->
                </div><!-- .content -->
            </div><!-- .col -->
        </div><!-- .row -->
        </div><!-- .container-fluid -->

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>

    </html>
<?php } ?>