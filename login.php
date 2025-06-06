<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Vehicle Parking Management System</title>

  <?php include('./header.php'); ?>
  <?php include('./db_connect.php'); ?>
  <?php 
  session_start();
  if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
  ?>

</head>
<style>
  body {
    width: 100%;
    height: calc(100%);
  }

  main#main {
    width: 100%;
    height: calc(100%);
    background: white;
  }

  #login-right {
    position: absolute;
    right: 0;
    width: 40%;
    height: calc(100%);
    background: white;
    display: flex;
    align-items: center;
  }

  #login-left {
    position: absolute;
    left: 0;
    width: 90%;
    height: calc(100%);
    background: url('assets/img/cover.jpg') no-repeat center center;
    background-size: cover;
    display: flex;
    align-items: center;
  }

  #login-right .card {
    margin: auto;
    z-index: 1;
    background: rgba(255, 255, 255, 0.3); /* Fully transparent form */
    backdrop-filter: blur(10px); /* Glass effect with blur */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Light shadow for contrast */
    border-radius: 8px; /* Rounded corners */
    transform: translateY(50px); /* Start position for animation */
    opacity: 0; /* Hidden initially */
    animation: fadeInSlide 1s ease forwards; /* Smooth animation */
  }


  div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
    background:rgba(109, 156, 134, 0.88);
  }

  .form-logo {
    text-align: center;
    margin-bottom: 10px;
  }

  .form-logo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 2px solid #007bff;
  }

  .form-title {
    text-align: center;
    color: #007bff;
    font-weight: bold;
    font-size: 24px;
    margin-bottom: 10px;
  }

  .form-subtitle {
    text-align: center;
    color: #333;
    font-size: 18px;
    margin-bottom: 20px;
  }

  @keyframes fadeInSlide {
    from {
      opacity: 0;
      transform: translateY(50px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .input-group {
    position: relative;
    display: flex;
    align-items: center;
  }

  .input-group .input-icon {
    position: absolute;
    left: 10px;
    color: #007bff;
    font-size: 18px;
  }

  .input-group input {
    padding-left: 35px; /* Space for the icon */
  }

  .input-group .toggle-password {
    position: absolute;
    right: 10px;
    color: #007bff;
    cursor: pointer;
    font-size: 18px;
  }
  .toggle-password {
    font-size: 18px;
    color: #007bff;
    cursor: pointer;
    margin-left: 10px;
  }

  .toggle-password:hover {
    color: #0056b3;
  }
</style>


<body>
  <main id="main" class="bg-dark">
    <div id="login-left">
      <!-- The left side background is replaced with the uploaded image -->
    </div>

    <div id="login-right">
      <div class="card col-md-8">
        <div class="card-body">
          <!-- Welcome Title -->
          <div class="form-title">Welcome to PAYPARK</div>
          
          <!-- Logo Section -->
          <div class="form-logo">
            <img src="assets/img/images1.png" alt="User Icon">
          </div>
          
          <!-- Admin Login Subtitle -->
          <div class="form-subtitle">Admin Login</div>
          
          <!-- Login Form -->
          <form id="login-form">
            <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
               <label for="password" class="control-label">
                 Password
                <i class="toggle-password icofont-eye" id="togglePassword"></i>
             </label>
              <input type="password" id="password" name="password" class="form-control">
          </div>
          <div class="checkbox">
                    <label class="pull-right">
                        <a href="AdminResetPassword.php">I forgot my password?</a>
                    </label>
                </div>
            <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
          </form>
        </div>
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>
<script>
  $('#login-form').submit(function(e){
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else if(resp == 2){
          location.href ='voting.php';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
        }
      }
    })
  })
  const togglePassword = document.querySelector("#togglePassword");
  const passwordField = document.querySelector("#password");

  togglePassword.addEventListener("click", function () {
    // Toggle the type attribute
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);

    // Toggle the icon class
    this.classList.toggle("icofont-eye");
    this.classList.toggle("icofont-eye-blocked");
  });
</script>
</html>
