                                     <!-- report form using css  -->
                                     <?php
include('db_connect.php');
if ($_SESSION['login_id'] == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">

    <style>
        body {
            background-color:lightgray;
            font-family: 'Montserrat', sans-serif;
        }

        .panel {
            animation: fadeIn 0.8s ease-in-out;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .panel-heading {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #ddd;
        }

        .form-group label {
            font-weight: 500;
            color: #555;
            font-size: 16px;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
            border-radius: 6px;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            transition: border 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        .btn-primary {
            background: linear-gradient(to right, #007bff, #00c6ff);
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #0056b3, #0099ff);
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .center-btn {
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .panel {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-heading">Parking Reports</div>
                    <form method="POST" enctype="multipart/form-data" name="datereports" action="generate-reports.php">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="fromdate">From Date</label>
                                <input class="form-control" type="date" name="fromdate" id="fromdate" required>
                            </div>
                            <div class="form-group">
                                <label for="todate">To Date</label>
                                <input class="form-control" type="date" name="todate" id="todate" required>
                            </div>
                        </div>
                        <div class="center-btn">
                            <button type="submit" class="btn btn-primary" name="submit">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>
