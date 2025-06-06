<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sidebar Menu</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap'><link rel="stylesheet">


<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

:root {
  /* ===== Colors ===== */
  --body-color: #e4e9f7;
  --sidebar-color:black; 
  --primary-color: #dc143c;
  --primary-color-light: #f6f5ff;
  --toggle-color: #ddd;
  --text-color: #707070;

  /* ====== Transition ====== */
  --tran-03: all 0.2s ease;
  --tran-03: all 0.3s ease;
  --tran-04: all 0.3s ease;
  --tran-05: all 0.3s ease;
}

body {
  min-height: 100vh;
  background-color: var(--body-color);
  transition: var(--tran-05);
}

::selection {
  background-color: var(--primary-color);
  color: #fff;
}

body.dark {
  --body-color: #18191a;
  --sidebar-color: #242526;
  --primary-color: #3a3b3c;
  --primary-color-light: #3a3b3c;
  --toggle-color: #fff;
  --text-color: #ccc;
}

/* ===== Sidebar ===== */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 250px;
  padding: 10px 14px;
  background: var(--sidebar-color);
  transition: var(--tran-05);
  z-index: 100;
}
.sidebar.close {
  width: 88px;
}

/* ===== Reusable code - Here ===== */
.sidebar li {
  height: 50px;
  list-style: none;
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.sidebar header .image,
.sidebar .icon {
  min-width: 60px;
  border-radius: 6px;
}

.sidebar .icon {
  min-width: 60px;
  border-radius: 6px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
}

.sidebar .text,
.sidebar .icon {
  color: var(--text-color);
  transition: var(--tran-03);
}

.sidebar .text {
  font-size: 17px;
  font-weight: 500;
  white-space: nowrap;
  opacity: 1;
}
.sidebar.close .text {
  opacity: 0;
}
/* =========================== */

.sidebar header {
  position: relative;
}

.sidebar header .image-text {
  display: flex;
  align-items: center;
}
.sidebar header .logo-text {
  display: flex;
  flex-direction: column;
}
header .image-text .name {
  margin-top: 2px;
  font-size: 18px;
  font-weight: 600;
}

header .image-text .profession {
  font-size: 16px;
  margin-top: -2px;
  display: block;
}

.sidebar header .image {
  display: flex;
  align-items: center;
  justify-content: center;
}

.sidebar header .image img {
  width: 50px;
  border-radius: 40px;
}

.sidebar header .toggle {
  position: absolute;
  top: 50%;
  right: -25px;
  transform: translateY(-50%) rotate(180deg);
  height: 25px;
  width: 25px;
  background-color: var(--primary-color);
  color: var(--sidebar-color);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  cursor: pointer;
  transition: var(--tran-05);
}

body.dark .sidebar header .toggle {
  color: var(--text-color);
}

.sidebar.close .toggle {
  transform: translateY(-50%) rotate(0deg);
}

.sidebar .menu {
  margin-top: 40px;
}

.sidebar li.search-box {
  border-radius: 6px;
  background-color: var(--primary-color-light);
  cursor: pointer;
  transition: var(--tran-05);
}

.sidebar li.search-box input {
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  background-color: var(--primary-color-light);
  color: var(--text-color);
  border-radius: 6px;
  font-size: 17px;
  font-weight: 500;
  transition: var(--tran-05);
}
.sidebar li a {
  list-style: none;
  height: 100%;
  background-color: transparent;
  display: flex;
  align-items: center;
  height: 100%;
  width: 100%;
  border-radius: 6px;
  text-decoration: none;
  transition: var(--tran-03);
}

.sidebar li a:hover {
  background-color: var(--primary-color);
}
.sidebar li a:hover .icon,
.sidebar li a:hover .text {
  color: var(--sidebar-color);
}
body.dark .sidebar li a:hover .icon,
body.dark .sidebar li a:hover .text {
  color: var(--text-color);
}

.sidebar .menu-bar {
  height: calc(100% - 55px);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow-y: scroll;
}
.menu-bar::-webkit-scrollbar {
  display: none;
}
.sidebar .menu-bar .mode {
  border-radius: 6px;
  background-color: var(--primary-color-light);
  position: relative;
  transition: var(--tran-05);
}

.menu-bar .mode .sun-moon {
  height: 50px;
  width: 60px;
}

.mode .sun-moon i {
  position: absolute;
}
.mode .sun-moon i.sun {
  opacity: 0;
}
body.dark .mode .sun-moon i.sun {
  opacity: 1;
}
body.dark .mode .sun-moon i.moon {
  opacity: 0;
}

.menu-bar .bottom-content .toggle-switch {
  position: absolute;
  right: 0;
  height: 100%;
  min-width: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  cursor: pointer;
}
.toggle-switch .switch {
  position: relative;
  height: 22px;
  width: 40px;
  border-radius: 25px;
  background-color: var(--toggle-color);
  transition: var(--tran-05);
}

.switch::before {
  content: "";
  position: absolute;
  height: 15px;
  width: 15px;
  border-radius: 50%;
  top: 50%;
  left: 5px;
  transform: translateY(-50%);
  background-color: var(--sidebar-color);
  transition: var(--tran-04);
}

body.dark .switch::before {
  left: 20px;
}

.home {
  position: absolute;
  top: 0;
  top: 0;
  left: 250px;
  height: 100vh;
  width: calc(100% - 250px);
  background-color: var(--body-color);
  transition: var(--tran-05);
}
.home .text {
  font-size: 30px;
  font-weight: 500;
  color: var(--text-color);
  padding: 12px 60px;
}

.sidebar.close ~ .home {
  left: 78px;
  height: 100vh;
  width: calc(100% - 78px);
}
body.dark .home .text {
  color: var(--text-color);
}
/*  */
.avatar-selection {
    display: flex;
    gap: 10px;
    padding: 10px;
    flex-wrap: wrap;
}

.avatar-option {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    transition: transform 0.2s;
}

.avatar-option:hover {
    transform: scale(1.2);
}

</style>
</head>
<body>
<!-- partial:index.partial.html -->
<nav class="sidebar close">
  <header>
    <div class="image-text">
    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="assets/img/images1.png" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                             <a class="nav-link" href="userprofile.php"><i class="fa fa-user"></i>My Profile</a>
                              <a class="nav-link" href="userchange-password.php"><i class="fa fa-cog"></i>Change Password</a>
                                <a class="nav-link" href="userlogout.php"><i class="fa fa-power-off"></i>Logout</a>
      
                               <hr>
                              <h6 class="dropdown-header">Select Avatar</h6>
                           <div class="avatar-selection">
                        <img class="avatar-option" src="https://i.pravatar.cc/50?img=1" alt="Avatar 1" title="Avatar 1">
                        <img class="avatar-option" src="https://i.pravatar.cc/50?img=2" alt="Avatar 2" title="Avatar 2">
                        <img class="avatar-option" src="https://i.pravatar.cc/50?img=3" alt="Avatar 3" title="Avatar 3">
                          <img class="avatar-option" src="https://i.pravatar.cc/50?img=4" alt="Avatar 4" title="Avatar 4">
                      <img class="avatar-option" src="https://i.pravatar.cc/50?img=5" alt="Avatar 5" title="Avatar 5">
                   </div>
                </div>


                        <!-- <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="userprofile.php"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="userchange-password.php"><i class="fa fa -cog"></i>Change Password</a>

                            <a class="nav-link" href="userlogout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div> -->


      <div class="text logo-text">
        <span class="name">PAYPARK</span>
        <span class="profession">USER</span>
      </div>
    </div>

    <i class='bx bx-chevron-right toggle'></i>
  </header>

  <div class="menu-bar">
    <div class="menu">

      <!-- <li class="search-box">
        <i class='bx bx-search icon'></i>
        <input type="text" placeholder="Search...">
      </li> -->

      <ul class="menu-links">
        <li class="nav-link">
          <a href="userdashboard.php">
            <i class='bx bx-home-alt icon'></i>
            <span class="text nav-text">Dashboard</span>
          </a>
        </li>

        <li class="nav-link">
          <a href="userview-vehicle.php">
            <i class='bx bx-bar-chart-alt-2 icon'></i>
            <span class="text nav-text">View Vehicle</span>
          </a>
        </li>

        <li class="nav-link">
           <a href="store_booking.php">           <!--   //  userparking.php" -->
            <i class='bx bx-bell icon'></i>
            <span class="text nav-text">Reports</span>
          </a>
        </li>

        <li class="nav-link">
          <a href="parkingspace.php">
            <i class='bx bx-pie-chart-alt icon'></i>
            <span class="text nav-text">Spot Booking</span>
          </a>
        </li>

        <li class="nav-link">
          <a href="userfeedback.php">
            <i class='bx bx-heart icon'></i>
            <span class="text nav-text">Feedback</span>
          </a>
        </li>

      </ul>
      <div class="bottom-content">
      <li class="">
        <a href="userlogout.php">
          <i class='bx bx-log-out icon'></i>
          <span class="text nav-text">Logout</span>
        </a>
      </li>

      <li class="mode">
        <div class="sun-moon">
          <i class='bx bx-moon icon moon'></i>
          <i class='bx bx-sun icon sun'></i>
        </div>
        <span class="mode-text text">Dark mode</span>

        <div class="toggle-switch">
          <span class="switch"></span>
        </div>
      </li>

    </div>
    </div>
  </div>

</nav>


<!-- partial -->
  
<script>
   const body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  toggle = body.querySelector(".toggle"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text"),
  avatarOptions = document.querySelectorAll(".avatar-option"),
  userAvatar = document.querySelector(".user-avatar");

// Check if an avatar is already saved in localStorage
const savedAvatar = localStorage.getItem("selectedAvatar");
if (savedAvatar) {
  userAvatar.setAttribute("src", savedAvatar);
}

// Add event listener to avatar options
avatarOptions.forEach((avatar) => {
  avatar.addEventListener("click", () => {
    const selectedAvatar = avatar.getAttribute("src");
    userAvatar.setAttribute("src", selectedAvatar);

    // Save the selected avatar to localStorage
    localStorage.setItem("selectedAvatar", selectedAvatar);
  });
});

// Toggle sidebar
toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

// Dark Mode Logic
const savedTheme = localStorage.getItem("theme");
if (savedTheme) {
  body.classList.add(savedTheme);
  modeText.innerText = savedTheme === "dark" ? "Light mode" : "Dark mode";
}

modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");
  const isDarkMode = body.classList.contains("dark");

  // Update mode text and save the theme to localStorage
  modeText.innerText = isDarkMode ? "Light mode" : "Dark mode";
  localStorage.setItem("theme", isDarkMode ? "dark" : "");
});


</script>

</body>
</html>
