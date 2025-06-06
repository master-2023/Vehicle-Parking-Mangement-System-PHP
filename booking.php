<?php
session_start();
error_reporting(0);
include('db_connect.php');
if (strlen($_SESSION['vpmsuid']==0)) {
  header('location:userlogout.php');
  } else{
    $vpmsuid = $_SESSION['vpmsuid'];
// Fetch parking locations and available spaces
$locations = $conn->query("SELECT * FROM parking_locations ORDER BY location ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parking Slot Booking</title>
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

* {
    box-sizing: border-box;
}

body {
    background-color: #242333;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    height: 100vh;
    font-family: 'Lato', sans-serif;
    margin: 0;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
}

.parking-slot {
    background-color: #444451;
    height: 80px;
    width: 80px;
    margin: 10px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.3s;
}

.parking-slot.selected {
    background-color: #6feaf6;
}

.parking-slot.occupied {
    background-color: #fff;
    cursor: not-allowed;
}

.parking-slot:hover {
    transform: scale(1.1);
}

.parking-slot.occupied:hover {
    transform: none;
}

.showcase {
    background: rgba(0, 0, 0, 0.1);
    padding: 5px 10px;
    border-radius: 5px;
    color: #777;
    list-style-type: none;
    display: flex;
    justify-content: space-between;
}

.showcase li {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 10px;
}

.showcase li small {
    margin-left: 2px;
}

.form-container {
    display: none;
    background-color: #333;
    padding: 20px;
    margin-top: 20px;
    width: 300px;
    border-radius: 8px;
}

input, select, button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    background-color: #6feaf6;
    color: black;
    cursor: pointer;
}

button:hover {
    background-color: #4dcae8;
}

  </style>
</head>
<body>

<div class="showcase">
    <li>
        <div class="parking-slot"></div>
        <small>Available</small>
    </li>
    <li>
        <div class="parking-slot selected"></div>
        <small>Selected</small>
    </li>
    <li>
        <div class="parking-slot occupied"></div>
        <small>Occupied</small>
    </li>
</div>

<div class="container">
    <div class="parking-slot" data-slot="1"></div>
    <div class="parking-slot occupied" data-slot="2"></div>
    <div class="parking-slot" data-slot="3"></div>
    <div class="parking-slot" data-slot="4"></div>
    <div class="parking-slot occupied" data-slot="5"></div>
    <div class="parking-slot" data-slot="6"></div>
    <div class="parking-slot" data-slot="7"></div>
    <div class="parking-slot" data-slot="8"></div>
</div>

<div class="form-container" id="form-container">
    <h2>Fill in Your Details</h2>
    <form id="booking-form">
        <input type="text" id="name" placeholder="Enter Name" required>
        <input type="tel" id="phone" placeholder="Enter Phone Number" required>
        <input type="text" id="slot" readonly placeholder="Slot Number" required>
        <input type="number" id="price" readonly placeholder="Price" required>
        <input type="number" id="total" readonly placeholder="Total Amount" required>
        <input type="text" id="upi" placeholder="Enter UPI Reference" required>
        <input type="file" id="img" placeholder="Upload Image" required>
        <button type="submit">Submit</button>
    </form>
</div>

<script>
    const slots = document.querySelectorAll('.parking-slot');
    const formContainer = document.getElementById('form-container');
    const bookingForm = document.getElementById('booking-form');
    const slotInput = document.getElementById('slot');
    const priceInput = document.getElementById('price');
    const totalInput = document.getElementById('total');

    let selectedSlot = null;
    let ticketPrice = 100; // Set the price for each slot (change if needed)

    slots.forEach(slot => {
        slot.addEventListener('click', () => {
            if (slot.classList.contains('occupied')) return;

            // If already selected, unselect
            if (selectedSlot === slot) {
                slot.classList.remove('selected');
                selectedSlot = null;
                formContainer.style.display = 'none';
            } else {
                // Mark this slot as selected
                if (selectedSlot) {
                    selectedSlot.classList.remove('selected');
                }
                slot.classList.add('selected');
                selectedSlot = slot;
                slotInput.value = slot.dataset.slot; // Set the slot number in the form
                priceInput.value = ticketPrice; // Set price in the form
                totalInput.value = ticketPrice; // Set total amount
                formContainer.style.display = 'block';
            }
        });
    });

    bookingForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Handle form submission logic here (e.g., send data to a server, store in local storage, etc.)
        alert('Booking Successful!');
        
        // Reset form and UI after submission
        bookingForm.reset();
        formContainer.style.display = 'none';
        if (selectedSlot) {
            selectedSlot.classList.add('occupied');
            selectedSlot.classList.remove('selected');
        }
    });
</script>

</body>
</html>
<?php }?>