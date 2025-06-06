<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Razorpay Payment</title>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    body {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      font-family: 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      overflow: hidden;
    }

    .container {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      padding: 30px;
      max-width: 500px;
      width: 100%;
      animation: slideIn 1s ease-out;
      color: #333;
    }

    h2 {
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
      color: #2575fc;
    }

    label {
      font-weight: 600;
      margin-bottom: 8px;
    }

    input {
      height: 45px;
      border-radius: 5px;
      border: 1px solid #ccc;
      padding: 0 15px;
      transition: 0.3s ease;
    }

    input:focus {
      outline: none;
      border-color: #2575fc;
      box-shadow: 0 0 5px #2575fc;
    }

    .btn {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      border: none;
      color: #fff;
      width: 100%;
      font-size: 18px;
      padding: 12px 0;
      border-radius: 30px;
      cursor: pointer;
      margin-top: 15px;
      transition: 0.4s;
    }

    .btn:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      transform: translateY(-3px);
    }

    @keyframes slideIn {
      from {
        transform: translateY(50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .form-control {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
<?php include 'usersidebar.php';?>
  <div class="container">
    <h2>Paypark Payment</h2>
    <form id="payment-form">
      <div class="form-group">
        <label for="amount">Enter Amount (₹):</label>
        <input
          type="number"
          id="amount"
          class="form-control"
          placeholder="Enter amount"
          required
          min="1"
        />
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input
          type="text"
          id="name"
          class="form-control"
          placeholder="Enter your name"
          required
        />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input
          type="email"
          id="email"
          class="form-control"
          placeholder="Enter your email"
          required
        />
      </div>
      <div class="form-group">
        <label for="contact">Contact:</label>
        <input
          type="tel"
          id="contact"
          class="form-control"
          placeholder="Enter your contact number"
          required
        />
      </div>
      <button type="submit" class="btn">
        <i class="fas fa-money-bill"></i> Payment 
      </button>
    </form>
  </div>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    // Payment Form Submit Handler
    document.getElementById("payment-form").addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent form submission

      // Get form values
      const amount = document.getElementById("amount").value;
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const contact = document.getElementById("contact").value;

      if (amount < 1) {
        alert("Please enter a valid amount!");
        return;
      }

      // Razorpay options
      const options = {
        key: "rzp_test_Qo8hBtTFO15YhF", // Replace with your API Key (test or live)
        name: "PAYPARK.",
        image: "",
        amount: amount * 100, // Convert to paise
        currency: "INR",
        description: "Dynamic Razorpay Payment",
        handler: function (response) {
          alert(`Payment Successful! Payment ID: ${response.razorpay_payment_id}`);
        },
        prefill: {
          name: name,
          email: email,
          contact: contact,
        },
        notes: {
          address: ":Near MIDC Police Station, Solapur, Maharashtra",
        },
      };

      // Create Razorpay instance and open checkout
      const rzp1 = new Razorpay(options);
      rzp1.open();
    });
  </script>
</body>
</html>
