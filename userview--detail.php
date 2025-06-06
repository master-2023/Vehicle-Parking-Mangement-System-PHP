<?php
session_start();
error_reporting(0);
include('db_connect.php');
if (strlen($_SESSION['vpmsuid']==0)) {
  header('location:userlogout.php');
  } else{



  ?>
<!doctype html>

<html class="no-js" lang="">
<head>
   
    <title>PAYPARK- View Vehicle Detail</title>
   

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <!-- <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png"> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
    <!-- Left Panel -->

  <?php include_once('usersidebar.php');?>

    <!-- Left Panel -->

    <!-- Right Panel -->

     <?php include_once('userheader.php');?>

     <div class="breadcrumbs text-center"> <!-- Add text-center class -->
    <div class="breadcrumbs-inner">
        <div class="row justify-content-center"> <!-- Center the content -->
            <div class="col-sm-8"> <!-- Adjust column width -->
                <div class="page-header">
                    <div class="page-title">
                        <h1>Vehicle Recipent Details</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
        <div class="content">
    <div class="animated fadeIn">
        <div class="row justify-content-center"> <!-- Center the row -->
            <div class="col-lg-8"> <!-- Adjust column width for centering -->
                <div class="card mt-5"> <!-- Add top margin -->
                    <div class="card-header">
                        <strong class="card-title">View Vehicle Details</strong>
                    </div>
                    <div class="card-body">
                        <?php
                        $cid = $_GET['viewid'];
                        $ret = mysqli_query($conn, "select * from parked_list where id='$cid'");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Parking Number</th>
                                    <td><?php echo $row['location_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Vehicle Category</th>
                                    <td><?php echo $row['category_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Vehicle Company Name</th>
                                    <td><?php echo $packprice = $row['vehicle_brand']; ?></td>
                                </tr>
                                <tr>
                                    <th>Registration Number</th>
                                    <td><?php echo $row['vehicle_registration']; ?></td>
                                </tr>
                                <tr>
                                    <th>Owner Name</th>
                                    <td><?php echo $row['owner']; ?></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td><?php echo $row['amount_tendered']; ?></td>
                                </tr>
                                <tr>
                                    <th>In Time</th>
                                    <td><?php echo $row['date_created']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?php
                                        if ($row['Status'] == "1") {
                                            echo "Vehicle In";
                                        }
                                        if ($row['Status'] == "2") {
                                            echo "Vehicle Out";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Remark</th>
                                    <td><?php echo $row['Remark']; ?></td>
                                </tr>
                                <tr>
                                    <th>Parking Fee</th>
                                    <td><?php echo $row['amount_tendered']; ?></td>
                                </tr>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="clearfix"></div>

<!-- <?php include_once('footer.php');?> -->

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
<?php }  ?>