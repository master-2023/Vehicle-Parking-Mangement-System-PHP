<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_type'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details (use database if needed)
$username = $_SESSION['username'] ?? 'Admin';
$password = $_SESSION['password'] ?? '********'; // Placeholder for password
$loginType = $_SESSION['login_type'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">User Profile</h2>
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="assets/img/images1.png" alt="User Avatar" class="rounded-circle" style="width: 100px; height: 100px;">
                </div>
                <h5 class="card-title text-center"><?php echo htmlspecialchars($username); ?></h5>
                <p class="card-text text-center">Password: <?php echo htmlspecialchars($password); ?></p> <!-- Display password as a placeholder -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Role:</strong> <?php echo $loginType == 1 ? 'Admin' : 'User'; ?></li>
                </ul>
                <div class="text-center mt-3">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
