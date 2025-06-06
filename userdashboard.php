<?php
session_start();
error_reporting(0);
include('db_connect.php');
if (strlen($_SESSION['vpmsuid']) == 0) {
    header('location:userlogout.php');
} else {
    ?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <title>PAYPARK - User Dashboard</title>
    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <!-- for mic and send option in chatbot -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    
    <style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform:translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes buttonBounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    .top-center {
        display: flex;
        justify-content: center;
        position: absolute;
        top: 5;
        width: 100%;
        text-align: center;
        padding: 30px 0;
        font-size: 2em;
    }

    html, body {
        background: #efefef;
        height: 100%;
    }

    #chat-circle {
        position: fixed;
        bottom: 50px;
        right: 50px;
        background: #5A5EB9 url('data:image/jpeg;base64,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') no-repeat center center;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        color: white;
        padding: 28px;
        cursor: pointer;
        box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.6);
        animation: fadeIn 1s ease-in-out;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #chat-circle:hover {
        transform: scale(1.1);
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.8);
    }

    .chat-box {
        display: none;
        background: #efefef;
        position: fixed;
        right: 30px;
        bottom: 50px;
        width: 350px;
        max-width: 85vw;
        max-height: 100vh;
        border-radius: 5px;
        box-shadow: 0px 5px 35px 9px rgba(0, 0, 0, 0.2);
        transform: perspective(1000px) rotateX(10deg);
        animation: slideInUp 0.5s ease-out;
    }

    .chat-box-header {
        background: #5A5EB9;
        height: 70px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        color: white;
        text-align: center;
        font-size: 20px;
        padding-top: 17px;
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.5s ease-in;
    }
    .chat-input {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 5px;
        background: #f5f5f5;
        border-radius: 8px;
    }

    .chat-input form {
        display: flex;
        width: 100%;
        align-items: center;
    }

    .chat-input input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .chat-speak, .chat-submit {
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
        border-radius: 50%;
    }

    .chat-speak {
        color: #28a745;
    }

    .chat-submit {
        color: #007bff;
    }

    .chat-speak i, .chat-submit i {
        font-size: 20px;
    }

    .chat-submit:hover, .chat-speak:hover {
        opacity: 0.7;
    }
    /*  */

    .chat-logs {
        padding: 15px;
        height: 370px;
        overflow-y: scroll;
    }

    .chat-msg {
        clear: both;
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 10px;
        animation: fadeIn 0.3s ease-in-out;
    }

    .chat-msg.self {
        justify-content: flex-end;
        background: #e0f7fa;
        color: #005662;
        align-items: flex-end;
        transform: perspective(800px) rotateY(-5deg);
    }

    .chat-msg.user {
        justify-content: flex-start;
        background: #ffffff;
        color: #555;
        transform: perspective(800px) rotateY(5deg);
    }

    .chat-msg .msg-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.5s ease-in;
    }

    .chat-msg.self .msg-avatar {
        margin-right: 0;
        margin-left: 10px;
    }

    .chat-msg .cm-msg-text {
        max-width: 70%;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.3s ease-in-out;
    }

    .chat-options button {
        background: #5A5EB9;
        color: white;
        padding: 8px 12px;
        margin: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease-in-out;
        transition:background 0.3s ease, transform 0.3s ease;
    }

    .chat-options button:hover {
        background: #4245a6;
        transform: scale(1.1);
        animation: buttonBounce 0.5s ease;
    }
    .slider-container {
            max-width: 900px;
            margin: auto;
            text-align: center;
            padding: 80px;
        }
        .slider-container img {
            width: 80%;
            height: 500px;
            object-fit: cover;
            border-radius: 50px;
        }
</style>

</style>

</head>
<body>

<?php include_once('usersidebar.php'); ?>
<?php include_once('userheader.php'); ?>

<!-- <div class="slider-container">
    <div class="owl-carousel">
        <img src="assets/img/mustang.jpg" alt="Parking Image 1">
        <img src="assets/img/back1.jpg" alt="Parking Image 2">
        <img src="images/slide3.jpg" alt="Parking Image 3">
    </div>
</div> -->

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <?php
                            session_start();
                            include 'db_connection.php'; // Ensure the DB connection is included

                            $uid = $_SESSION['vpmsuid'];
                            $ret = mysqli_query($conn, "SELECT * FROM tblregusers WHERE ID='$uid'");
                            while ($row = mysqli_fetch_array($ret)) {
                            ?>
                                <div class="stat-icon dib flat-color-1 top-center">
                                    Welcome to Your Profile !! <?php echo $row['FirstName']; ?> <?php echo $row['LastName']; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="slider-container">
    <div class="owl-carousel">
        <img src="assets/img/space.gif" alt="Parking Image 3">
        <img src="assets/img/logo1.jpg" alt="Parking Image 1">
        <img src="assets/img/download.gif" alt="Parking Image 2">
        <img src="assets/img/park1.gif" alt="Parking Image 3">
    </div>
</div>
<div class="clearfix"></div>
<?php include_once('footer.php'); ?>

<div id="body">
    <div id="chat-circle" class="btn btn-raised">
        <i class="material-icons"></i>
    </div>
    
    <div class="chat-box">
        <div class="chat-box-header">
            PAYPARK
            <span class="chat-box-toggle"><i class="material-icons">Chatbot</i></span>
        </div>
        <div class="chat-box-body">
            <div class="chat-logs"></div>
        </div>
        <div class="chat-input">
    <form>
        <input type="text" id="chat-input" placeholder="Send a message..."/>
        <button type="button" class="chat-speak" id="chat-speak">
        <i class="fas fa-microphone"></i>
        </button>
        <button type="submit" class="chat-submit" id="chat-submit">
        <i class="fas fa-paper-plane"></i>
        </button>
    </form>
   </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<!-- jQuery & Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(function () {
    var INDEX = 0;
    var botName = "Siri";
    var inactivityTimer; // Timer for inactivity
    var assistanceAsked = false; // Track if assistance question is asked
    var chatEnded = false; // Track if the chat has ended

    // Initialize the chat with a default message
    function initialize_chat() {
        generate_message(`Hello, my name is ${botName}. I am a bot. How can I help you today?`, 'user');
        display_options(["Help", "About Me", "Regarding Parking", "Contact Support"]);
    }

    // Function to reset the inactivity timer
    function reset_inactivity_timer() {
        if (chatEnded) return; // Do not reset timer if chat has ended
        clearTimeout(inactivityTimer);
        inactivityTimer = setTimeout(function () {
            if (!assistanceAsked) {
                assistanceAsked = true;
                generate_message("Do you need any more assistance?", 'user');
                display_options(["Yes", "No"]);
            }
        }, 15000); // 10 seconds of inactivity
    }

    // Handling chat submission
    $("#chat-submit").click(function (e) {
        e.preventDefault();
        if (chatEnded) return; // Ignore clicks after chat has ended

        var msg = $("#chat-input").val();
        if (msg.trim() == '') {
            return false;
        }
        generate_message(msg, 'self');

        // Reset inactivity timer on message submission
        reset_inactivity_timer();

        // Process the user's response
        setTimeout(function () {
            process_user_message(msg);
        }, 1000);
    });

    // Generate message function
    function generate_message(msg, type) {
        INDEX++;
        var str = "";
        str += "<div id='cm-msg-" + INDEX + "' class=\"chat-msg " + type + "\">";
        str += "          <span class=\"msg-avatar\">";
        if (type === 'self') {
            str += "            <img src='data:image/png;base64,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' alt='User Avatar' style='border-radius: 50%; width: 40px; height: 40px;'>";
        } else {
            str += "            <img src='data:image/jpeg;base64,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' alt='Bot Avatar' style='border-radius: 50%; width: 40px; height: 40px;'>";
        }
        str += "          </span>";
        str += "          <div class=\"cm-msg-text\">" + msg + "</div>";
        str += "        </div>";
        $(".chat-logs").append(str);
        $("#chat-input").val('');
        $(".chat-logs").stop().animate({
            scrollTop: $(".chat-logs")[0].scrollHeight,
        }, 300);
    }

    // Bot response logic
    function process_user_message(msg) {
        msg = msg.toLowerCase();

        if (assistanceAsked) {
            assistanceAsked = false;
            if (msg.includes("no")) {
                generate_message("We value your feedback! Please provide any suggestions to improve our user experience.", 'user');
                setTimeout(function () {
                    generate_message("Chat Ended. Thank you for interacting with us!", 'user');
                    chatEnded = true; // Mark chat as ended
                }, 5000); // Delay before ending the chat
            } else if (msg.includes("yes")) {
                generate_message("Great! How can I assist you further?", 'user');
                display_options(["Help", "About Me", "Regarding Parking", "Contact Support"]);
            } else {
                generate_message("Please respond with 'Yes' or 'No'.", 'user');
                assistanceAsked = true;
            }
            return;
        }

        if (msg.includes("hi") || msg.includes("hello") || msg.includes("hello siri")) {
            generate_message(`Hello My name is ${botName}. How can I assist you today?`, 'user');
            display_options(["Help", "About Me", "Regarding Parking", "Contact Support"]);
        } else if (msg.includes("help")) {
            generate_message("Here are some topics I can assist with:", 'user');
            display_options(["Profile Settings", "Regarding Parking", "Contact Support"]);
        } else if (msg.includes("profile settings")) {
            generate_message("Choose an option:", 'user');
            display_options(["Change Password", "Check Profile"]);
        } else if (msg.includes("change password")) {
            generate_message("To change your password, go to Account Settings and select 'Change Password'.", 'user');
        } else if (msg.includes("check profile")) {
            generate_message("Here is your profile: Name: KshitijPise, Email: mkshitj22@gmail.com", 'user');
        } else if (msg.includes("about me")) {
            generate_message("We are PayPark, a vehicle parking system designed to help customers manage their bookings with ease and flexibility. Let us know how we can assist you!", 'user');
        } else if (msg.includes("regarding parking")) {
            generate_message("Choose an option:", 'user');
            display_options(["Spot Booking", "View Vehicle"]);
        } else if (msg.includes("spot booking")) {
            generate_message("To book a parking spot, click on the 'Spot Booking' option in the sidebar.", 'user');
        } else if (msg.includes("view vehicle")) {
            generate_message("To view your vehicle, click on the 'View Vehicle' option in the sidebar.", 'user');
        } else if (msg.includes("contact support")) {
            generate_message("You can reach our support team at 8788345734.", 'user');
        } else {
            generate_message("I'm sorry, I didn't understand that. Try asking about parking or type 'Help'.", 'user');
        }
    }

    // Display options as buttons
    function display_options(options) {
        var str = "<div class='chat-options'>";
        options.forEach(option => {
            str += `<button class="chat-option">${option}</button>`;
        });
        str += "</div>";
        $(".chat-logs").append(str);

        $(".chat-option").click(function () {
            var selectedOption = $(this).text();
            $("#chat-input").val(selectedOption);
            $("#chat-submit").trigger("click");
        });

        $(".chat-logs").stop().animate({
            scrollTop: $(".chat-logs")[0].scrollHeight,
        }, 300);
    }

    // Toggle chat-box visibility
    $(".chat-box-toggle, #chat-circle").click(function () {
        $(".chat-box").toggle();
    });

    // Initialize chats
    initialize_chat();

    // Reset inactivity timer on user interaction
    $(document).on("click keyup", function () {
        reset_inactivity_timer();
    });
});
$(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            items: 1
        });
    });
</script>
<script>
    const chatInput = document.getElementById("chat-input");
    const chatSpeak = document.getElementById("chat-speak");

    chatSpeak.addEventListener("click", () => {
        const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.lang = "en-US";
        recognition.start();

        recognition.onresult = (event) => {
            chatInput.value = event.results[0][0].transcript;
        };

        recognition.onerror = (event) => {
            console.error("Speech recognition error:", event.error);
        };
    });
</script>


</body>
</html>

<?php } ?>
