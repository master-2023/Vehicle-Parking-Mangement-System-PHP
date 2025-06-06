<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Suppress error reporting (can be adjusted during development)
error_reporting(0);

// Include the database connection file
include('db_connect.php');

// Redirect to logout if session is invalid
if (strlen($_SESSION['login_id']) == 0)//error in name login name 
 { 
    header('location:logout.php');
} else {
    // Delete user if 'del' is set in the URL
    if (isset($_GET['del'])) {
        $catid = intval($_GET['del']); // Ensure ID is an integer
        $deleteQuery = "DELETE FROM tblregusers WHERE ID = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $catid);
        if ($stmt->execute()) {
            echo "<script>alert('Data Deleted Successfully');</script>";
        } else {
            echo "<script>alert('Error Deleting Data');</script>";
        }
        echo "<script>window.location.href='reg-users.php';</script>";
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VPMS - Manage Registered Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <style>
        /* Styles for print */
        @media print {
            body * {
                visibility: hidden;
            }
            .print-table, .print-table * {
                visibility: visible;
            }
            .print-table {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
            .print-table th:last-child,
            .print-table td:last-child {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h2 class="text-center">Registered Users</h2>

        <!-- Print Button -->
        <div class="text-right mb-3">
            <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print"></i>
        </button>
        </div>

        <div class="table-responsive print-table">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>S.NO</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all registered users
                    $query = "SELECT * FROM tblregusers";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        $cnt = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$cnt}</td>
                                    <td>{$row['FirstName']} {$row['LastName']}</td>
                                    <td>{$row['MobileNumber']}</td>
                                    <td>{$row['Email']}</td>
                                    <td>{$row['RegDate']}</td>
                                    <td>
                                        <a href='reg-users.php?del={$row['ID']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                                    </td>
                                </tr>";
                            $cnt++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No Records Found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php } ?>
