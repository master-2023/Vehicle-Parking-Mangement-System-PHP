<?php
session_start();
error_reporting(0);
include('db_connect.php');
if (strlen($_SESSION['vpmsuid']==0)) {
  header('location:userlogout.php');
  } else{
   if(isset($_POST['submit']))
  {
    $uid=$_SESSION['vpmsuid'];
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $query=mysqli_query($conn, "update tblregusers set FirstName='$fname', LastName='$lname' where ID='$uid'");
    if ($query) {
 echo '<script>alert("Profile updated successully.")</script>';
echo '<script>window.location.href=profile.php</script>';
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}
  ?>
<!doctype html>
<html class="no-js" lang="">
<head>
    
    <title>PAYPARK- User Profile</title>
   

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

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<style>
    .user-profile-form {
    max-width: 500px; /* Adjust Form Width */
    margin: auto; /* Centering */
    padding: 20px;
}

.content {
    margin-left: 150px; /* Prevent merging with sidebar */
    padding-top: 20px;
}

@media (max-width: 992px) {
    .content {
        margin-left: 0; /* Fix for small screens */
        padding: 10px;
    }
}

</style>
<body>
   <?php include_once('usersidebar.php');?>
    <!-- Right Panel -->

   <?php include_once('userheader.php');?>

   <div class="breadcrumbs text-center"> <!-- Center align text -->
    <div class="breadcrumbs-inner">
        <div class="row justify-content-center m-0"> <!-- Center content -->
            <div class="col-sm-6"> <!-- Adjust column width -->
                <div class="page-header">
                    <div class="page-title">
                        <h1>User Login Details</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <div class="content">
            <div class="animated fadeIn">


                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            
                           
                        </div> <!-- .card -->

                    </div><!--/.col-->

              

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>User </strong> Profile
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                   
                                   <?php
$uid=$_SESSION['vpmsuid'];
$ret=mysqli_query($conn,"select * from tblregusers where ID='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?> 
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">First Name</label></div>
                                        <div class="col-12 col-md-9"> <input type="text" name="firstname" required="true" class="form-control" value="<?php  echo $row['FirstName'];?>">
                                            <br></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Last Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" name="lastname" required="true" class="form-control" value="<?php  echo $row['LastName'];?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Contact Number</label></div>
                                        <div class="col-12 col-md-9"> <input type="text" name="mobilenumber" maxlength="10" pattern="[0-9]{10}" readonly="true" class="form-control" value="<?php  echo $row['MobileNumber'];?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Email address</label></div>
                                        <div class="col-12 col-md-9"><input type="email" name="email" required="true" class="form-control" value="<?php  echo $row['Email'];?>"  readonly="true"></div>
                                    </div>
                                  
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Registration</label></div>
                                        <div class="col-12 col-md-9"><input type="text" name="regdate" value="<?php  echo $row['RegDate'];?>"  readonly="true" class="form-control"></div>
                                    </div>
                                    <?php } ?>
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Update</button></p>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        
                  
                </div>

           

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

   <?php include_once('footer.php');?>

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