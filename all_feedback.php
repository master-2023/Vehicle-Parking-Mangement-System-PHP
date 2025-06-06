<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "parking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all feedback data
$feedbackQuery = "SELECT rating, review, created_at FROM feedback ORDER BY created_at DESC";
$feedbackResult = $conn->query($feedbackQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Feedback - PayPark</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <style>
        /* Smooth fade-in animation */
        body {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .container {
            margin-top: 50px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease-in-out forwards;
        }

        /* Feedback Card Styling */
        .feedback-card {
            border: none;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feedback-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
        }

        .rating-stars {
            color: #fbc531;
            font-size: 18px;
        }

        .date-time {
            font-size: 12px;
            color: gray;
        }

        /* Dark Mode */
        .dark-mode {
            background-color: #121212;
            color: #f8f9fa;
        }

        .dark-mode .feedback-card {
            background: #1e1e1e;
            color: #f8f9fa;
        }

        .dark-mode .feedback-card:hover {
            box-shadow: 0px 10px 20px rgba(255, 255, 255, 0.1);
        }

        .dark-mode-toggle {
            position: fixed;
            top: 15px;
            right: 15px;
            background: #333;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .dark-mode-toggle:hover {
            background: #555;
        }

        /* Keyframe Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <!-- Dark Mode Toggle Button -->
    <button id="darkModeToggle" class="dark-mode-toggle">
        <i class="fas fa-moon"></i> Dark Mode
    </button>

    <div class="container">
        <h2 class="text-center my-4">All Feedback</h2>

        <?php if ($feedbackResult && $feedbackResult->num_rows > 0): ?>
            <?php while ($row = $feedbackResult->fetch_assoc()): ?>
                <div class="feedback-card mb-3">
                    <p><strong>Rating:</strong> <span class="rating-stars"><?php echo str_repeat("⭐", $row['rating']); ?></span></p>
                    <p><strong>Review:</strong> <?php echo htmlspecialchars($row['review']); ?></p>
                    <p class="date-time"><strong>Submitted on:</strong> <?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No feedback available.</p>
        <?php endif; ?>

        <div class="text-center">
            <a href="index.php?page=home" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>

    <script>
        // Dark Mode Toggle
        $(document).ready(function () {
            $("#darkModeToggle").click(function () {
                $("body").toggleClass("dark-mode");
                let isDarkMode = $("body").hasClass("dark-mode");
                localStorage.setItem("darkMode", isDarkMode);
                $("#darkModeToggle i").toggleClass("fa-moon fa-sun");
            });

            // Load Dark Mode Preference
            if (localStorage.getItem("darkMode") === "true") {
                $("body").addClass("dark-mode");
                $("#darkModeToggle i").removeClass("fa-moon").addClass("fa-sun");
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
