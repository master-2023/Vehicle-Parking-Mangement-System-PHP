<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* Styles for the payment form */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to bottom right, #4b0082, #000);
      color: #aaa;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      max-width: 500px;
      padding: 5px;
      background-color: rgba(0, 0, 0, 0.6);
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
      margin: 0 auto;
      display: block;
    }

    h2 {
      text-align: center;
      color: #fff;
      margin-bottom: 20px;
    }

    .recipient-details {
      text-align: center;
      margin-bottom: 20px;
    }

    .recipient-details p {
      margin: 0;
      padding: 0;
    }

    .verified-mark {
      color: green;
    }

    label {
      font-weight: bold;
      color: #ddd;
      margin-bottom: 8px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
      width: calc(100% - 20px);
      padding: 12px;
      border: 1px solid #444;
      border-radius: 5px;
      margin-bottom: 20px;
      transition: border-color 0.3s ease;
      background-color: rgba(0, 0, 0, 0);
      color: #fff;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
      border-color: #007bff;
    }

    button {
      background-color: transparent;
      color: #007bff;
      border: 1px solid #007bff;
      border-radius: 15px;
      padding: 12px 20px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
      margin-right: 10px;
    }

    button:hover {
      background-color: #007bff;
      color: #fff;
      border-color: #0056b3;
    }

    /* Styles for the QR code popup modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: rgba(0, 0, 0, 0.5);
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 290px;
      border-radius: 20px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      text-align: center;
      color: #fff;
    }

    .modal-close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .modal-close:hover,
    .modal-close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    #paymentQRCode {
      max-width: 100%;
      height: auto;
      margin: 0 auto;
      display: block;
    }

    .amount {
      margin-top: 20px;
      font-size: 18px;
      color: #fff;
    }
  </style>
</head>

<body>
  <form id="paymentForm">
    <div class="recipient-details">
      <p>You are Paying to-PayPark <i class="fas fa-check-circle verified-mark"></i></p>
    </div>
    <h2>Make a Payment</h2>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

    <label for="amountToPay">Amount to Pay:</label>
    <input type="number" id="amountToPay" name="amountToPay" placeholder="Enter amount" required>

    <label for="note">Note:</label>
    <textarea id="note" name="note" placeholder="Enter a note" required></textarea>

    <div style="text-align: center;">
      <button type="button" style="width: 100%;" id="showQRButton"><i class="fas fa-qrcode"></i> Show QR Code</button>
      <p></p>
      <button type="button" style="width: 100%;" id="razorpayButton"><i class="fas fa-credit-card"></i> Pay via Razorpay</button>
    </div>

    <div id="qrCodeModal" class="modal">
      <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Scan QR Code with Any UPI app</h2>
        <img id="paymentQRCode" src="" alt="Payment QR Code">
        <div class="amount" id="paymentAmount"></div>
      </div>
    </div>
  </form>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone');
    const amountInput = document.getElementById('amountToPay');
    const noteInput = document.getElementById('note');
    const showQRButton = document.getElementById('showQRButton');
    const razorpayButton = document.getElementById('razorpayButton');
    const qrCodeModal = document.getElementById('qrCodeModal');
    const modalClose = document.querySelector('.modal-close');

    showQRButton.addEventListener('click', () => {
      if (validateForm()) {
        const enteredName = nameInput.value;
        const enteredAmount = amountInput.value;
        const enteredNote = noteInput.value;
        const paymentLink = `upi://pay?pa=hshittij@oksbi&am=${enteredAmount}&tn=Paid by ${enteredName} with note ${enteredNote}`;
        const paymentQR = `https://quickchart.io/qr?text=${encodeURIComponent(paymentLink)}`;
        document.getElementById('paymentQRCode').src = paymentQR;
        document.getElementById('paymentAmount').textContent = `Amount: ${enteredAmount}`;
        qrCodeModal.style.display = 'block';
      }
    });

    modalClose.addEventListener('click', () => {
      qrCodeModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
      if (event.target == qrCodeModal) {
        qrCodeModal.style.display = 'none';
      }
    });

    razorpayButton.addEventListener('click', () => {
      if (validateForm()) {
        const enteredName = nameInput.value;
        const enteredPhone = phoneInput.value;
        const enteredAmount = amountInput.value * 100;
        const options = {
          key: "rzp_test_Qo8hBtTFO15YhF",
          amount: enteredAmount,
          currency: "INR",
          name: "PayPark",
          description: "Payment for parking",
          prefill: {
            name: enteredName,
            contact: enteredPhone
          },
          theme: {
            color: "#007bff"
          },
          handler: function(response) {
            alert(`Payment successful! Razorpay Payment ID: ${response.razorpay_payment_id}`);
          },
          modal: {
            ondismiss: function() {
              alert('Payment process was canceled.');
            }
          }
        };

        const rzp = new Razorpay(options);
        rzp.open();
      }
    });

    function validateForm() {
      if (nameInput.checkValidity() && phoneInput.checkValidity() && amountInput.checkValidity() && noteInput.checkValidity()) {
        return true;
      } else {
        alert("Please fill in all required fields.");
        return false;
      }
    }
  </script>
</body>

</html>
