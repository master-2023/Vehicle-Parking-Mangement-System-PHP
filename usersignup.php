 <?php
session_start();
error_reporting(0);
include('db_connect.php');

if(isset($_POST['submit']))
  {
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $contno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $ret=mysqli_query($conn, "select Email from tblregusers where Email='$email' || MobileNumber='$contno'");
    $result=mysqli_fetch_array($ret);
    if($result>0){

echo '<script>alert("This email or Contact Number already associated with another account")</script>';
    }
    else{
    $query=mysqli_query($conn, "insert into tblregusers(FirstName, LastName, MobileNumber, Email, Password) value('$fname', '$lname','$contno', '$email', '$password' )");
    if ($query) {
    
    echo '<script>alert("You have successfully registered")</script>';
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
}
  ?> 
<!doctype html>
 <html class="no-js" lang="">
<head>
    
    <title>PAYPARK-Signup Page</title>
   



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style1.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.repeatpassword.value)
{
alert('Password and Repeat Password field does not match');
document.signup.repeatpassword.focus();
return false;
}
return true;
} 
</script>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index1.php">
                        <h2 style="color: #fff"> Create Your account  at @PAYAPRK</h2>
                    </a>
                </div>

                <div class="login-form">
                <!-- <form action="usercode.php" method="post" onsubmit="return checkpass();"> -->
                <form action="usercode.php" method="post" onsubmit="return checkpass();">
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="firstname" placeholder="Your First Name..." required="true" class="form-control">
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lastname" placeholder="Your Last Name..." required="true" class="form-control">
    </div>
    <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" name="mobilenumber" maxlength="10" pattern="[0-9]{10}" placeholder="Mobile Number" required="true" class="form-control">
    </div>
    <div class="form-group">
        <label>Email address</label>
        <input type="email" name="email" placeholder="Email address" required="true" class="form-control">
    </div>
    <div class="form-group password-container">
        <label>Password</label>
        <div class="input-group">
            <input type="password" name="password" placeholder="Enter password" required="true" class="form-control" id="password">
            <span class="input-group-text" onclick="togglePasswordVisibility('password')">
                <i class="fa fa-eye" id="togglePasswordIconPassword"></i>
            </span>
        </div>
    </div>
    <div class="form-group password-container">
        <label>Repeat Password</label>
        <div class="input-group">
            <input type="password" name="repeatpassword" placeholder="Enter repeat password" required="true" class="form-control" id="repeatPassword">
            <span class="input-group-text" onclick="togglePasswordVisibility('repeatPassword')">
                <i class="fa fa-eye" id="togglePasswordIconRepeatPassword"></i>
            </span>
        </div>
    </div>
    <div class="checkbox">
        <label class="pull-right">
            <a href="userforgot-password.php">Forgotten Password?</a>
        </label>
        <label class="pull-left">
            <a href="userlogin.php">Signin</a>
        </label>
    </div>
    <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">REGISTER</button>
</form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
<script>
    function togglePasswordVisibility(inputId) {
        const passwordField = document.getElementById(inputId);
        const toggleIcon = document.getElementById(`togglePasswordIcon${inputId.charAt(0).toUpperCase() + inputId.slice(1)}`);
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
</html>
