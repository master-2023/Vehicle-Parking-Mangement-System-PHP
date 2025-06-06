

<style>
.collapse a {
    text-indent: 10px;
}
nav .profile-usertitle {
    font-size: 20px;
    font-weight: 700;
    color: var(--blue);
    text-decoration: none;
}
.sidebar-list a {
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
.sidebar-list li a:hover {
    background-color: var(--primary-color);
}
.sidebar-list a:hover .icon,
.sidebar-list a:hover .text {
    color: var(--sidebar-color);
}
body.dark .sidebar-list li a:hover .icon,
body.dark .sidebar-list li a:hover .text {
    color: var(--text-color);
}
.user-avatar {
    font-size: 0; /* Hide text, only show image */
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer; /* Change cursor to pointer for better UX */
}
.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image covers the circle without distortion */
}

.calculator-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #fff;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    padding: 15px;
    border-radius: 8px;
    z-index: 1050;
}
.calculator-container.hidden {
    display: none;
}
.calculator-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.hidden {
    display: none;
}

.user-avatar img {
    cursor: pointer;
}
.user-status {
    margin-top: 10px; /* Space above the button */
    text-align: center; /* Center align the text and button */
}

.user-name {
    display: block; /* Make it a block element */
    margin-top: 5px; /* Space between button and name */
    font-weight: 600; /* Bold font */
    color:skyblue; /* Change to your desired text color */
}

	
</style> 
<nav id="sidebar" class="mx-lt-5 bg-secondary">
    <div class="sidebar-list">
        <?php if ($_SESSION['login_type'] == 1):?>
            <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <!-- User Icon with Dropdown -->
    <div class="user-dropdown">
        <button class="btn btn-light dropdown-toggle user-avatar" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            <img src="assets/img/images1.png" alt="User Avatar">
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">Profile Details</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
            <button class="btn btn-secondary w-100 mt-2" id="openCalculator">Open Calculator</button>
        </div>
    </div>
    <div class="user-status">
        <button class="btn btn-success btn-sm w-200">Active</button>
        <span class="user-name">Admin</span>
    </div>


            <!-- Calculator -->
            <div id="calculator" class="calculator-container hidden">
                <div class="calculator-header">
                    <h5>Calculator</h5>
                    <button class="btn btn-sm btn-danger" id="closeCalculator">&times;</button>
                </div>
                <input type="text" class="form-control mb-2" id="calcInput" placeholder="0" readonly>
                <div class="btn-group btn-group-sm d-flex">
                    <button class="btn btn-secondary" onclick="appendCalc('7')">7</button>
                    <button class="btn btn-secondary" onclick="appendCalc('8')">8</button>
                    <button class="btn btn-secondary" onclick="appendCalc('9')">9</button>
                    <button class="btn btn-danger" onclick="clearCalc()">C</button>
                </div>
                <div class="btn-group btn-group-sm d-flex">
                    <button class="btn btn-secondary" onclick="appendCalc('4')">4</button>
                    <button class="btn btn-secondary" onclick="appendCalc('5')">5</button>
                    <button class="btn btn-secondary" onclick="appendCalc('6')">6</button>
                    <button class="btn btn-secondary" onclick="appendCalc('+')">+</button>
                </div>
                <div class="btn-group btn-group-sm d-flex">
                    <button class="btn btn-secondary" onclick="appendCalc('1')">1</button>
                    <button class="btn btn-secondary" onclick="appendCalc('2')">2</button>
                    <button class="btn btn-secondary" onclick="appendCalc('3')">3</button>
                    <button class="btn btn-secondary" onclick="appendCalc('-')">-</button>
                </div>
                <div class="btn-group btn-group-sm d-flex">
                    <button class="btn btn-secondary" onclick="appendCalc('0')">0</button>
                    <button class="btn btn-secondary" onclick="appendCalc('.')">.</button>
                    <button class="btn btn-success" onclick="calculate()">=</button>
                    <button class="btn btn-secondary" onclick="appendCalc('*')">×</button>
                </div>
            </div>
        </div>

            
            <a href="index.php?page=home" class="nav-item nav-home"><span class="icon-field"><i class="fa fa-home"></i></span> Dashboard</a>
            <a class="nav-item nav-manage_park nav-collapse" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <span class="icon-field"><i class="fa fa-map"></i></span> Parking <span class="float-right"><i class="fa fa-angle-down"></i></span>
            </a>
            <div class="collapse" id="collapseExample">
                <a href="index.php?page=manage_park" class="nav-item nav-manage_park"> Check-In</a>
                <a href="index.php?page=park_list" class="nav-item nav-park_list"> List</a>
            </div>
            <a href="index.php?page=category" class="nav-item nav-category"><span class="icon-field"><i class="fa fa-list"></i></span> Category</a>
            <a href="index.php?page=location" class="nav-item nav-location"><span class="icon-field"><i class="fa fa-map"></i></span> Parking Area</a>
            <a href="index.php?page=users" class="nav-item nav-users"><span class="icon-field"><i class="fa fa-users"></i></span> Users</a>
            <a href="index.php?page=reports" class="nav-item nav-reports"><span class="icon-field"><i class="fa fa-file"></i></span> Reports</a>
            <a href="index.php?page=income2" class="nav-item nav-income2"><span class="icon-field"><i class="fa fa-user"></i></span>Total Income</a>
		    <a href="index.php?page=payment" class="nav-item nav-payment"><span class="icon-field"><i class="fa fa-credit-card"></i></span>Payment</a>
            <a href="index.php?page=reg-users" class="nav-item nav-reg-users"><span class="icon-field"><i class="fa fa-user"></i></span>Reg Users</a>
            <a href="index.php?page=processbooking" class="nav-item nav-processbooking"><span class="icon-field"><i class="fa fa-user"></i></span>Booking List</a>
        <?php else: ?>
            <a href="index.php?page=home" class="nav-item nav-home"><span class="icon-field"><i class="fa fa-home"></i></span> Home</a>
        <?php endif; ?>
    </div>
</nav>

<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
	
  // 
  const calculator = document.getElementById('calculator');
const openCalculatorButton = document.getElementById('openCalculator');
const closeCalculatorButton = document.getElementById('closeCalculator');
const calcInputElement = document.getElementById('calcInput');

let calcInput = '';

// Calculator Button Functions
function appendCalc(value) {
    calcInput += value;
    calcInputElement.value = calcInput;
}

function clearCalc() {
    calcInput = '';
    calcInputElement.value = calcInput;
}

function calculate() {
    try {
        calcInput = eval(calcInput).toString();
        calcInputElement.value = calcInput;
    } catch {
        alert('Invalid calculation!');
        clearCalc();
    }
}

// Keyboard Accessibility for Calculator
document.addEventListener('keydown', (event) => {
    if (calculator.classList.contains('hidden')) return;

    const validKeys = '0123456789+-*/.=C'.split('');
    if (validKeys.includes(event.key)) {
        if (event.key === 'C') clearCalc();
        else if (event.key === '=') calculate();
        else appendCalc(event.key);
    }
});

// Toggle Calculator
openCalculatorButton.addEventListener('click', () => {
    calculator.classList.toggle('hidden');
});

closeCalculatorButton.addEventListener('click', () => {
    calculator.classList.add('hidden');
});


</script>


