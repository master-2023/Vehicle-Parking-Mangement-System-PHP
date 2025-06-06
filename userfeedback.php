<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emoji Feedback Form</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .feedback-container {
      background: #fff;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      text-align: center;
      max-width: 400px;
      width: 90%;
      animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #333;
    }

    p {
      color: #777;
      margin-bottom: 20px;
    }

    .emoji-container {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 15px;
    }

    .emoji {
      font-size: 2.5rem;
      cursor: pointer;
      transition: transform 0.3s, filter 0.3s;
    }

    .emoji:hover {
      transform: scale(1.2);
      filter: brightness(1.2);
    }

    .emoji.selected {
      transform: scale(1.3);
      filter: brightness(1.4);
    }

    .hearts {
      margin: 15px 0;
      font-size: 1.8rem;
      color: #ff5252;
      animation: bounce 0.6s infinite alternate;
    }

    @keyframes bounce {
      from {
        transform: translateY(0);
      }
      to {
        transform: translateY(-5px);
      }
    }

    textarea {
      width: 100%;
      height: 100px;
      margin-top: 15px;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      font-size: 1rem;
      outline: none;
      transition: border-color 0.3s;
    }

    textarea:focus {
      border-color: #007BFF;
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    button {
      margin-top: 15px;
      background: #007BFF;
      color: #fff;
      border: none;
      padding: 12px 20px;
      border-radius: 25px;
      cursor: pointer;
      font-size: 1rem;
      transition: background 0.3s, box-shadow 0.3s;
    }

    button:hover {
      background: #0056b3;
      box-shadow: 0 5px 15px rgba(0, 91, 187, 0.4);
    }

    button:active {
      transform: scale(0.98);
    }

    /* Notification Styles */
    .notification {
      position: fixed;
      top: 20px;
      right: -300px;
      background: #333;
      color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
      font-size: 1rem;
      opacity: 0;
      transition: transform 0.6s ease-out, opacity 0.6s ease-out;
      display: flex;
      align-items: center;
    }

    .notification.show {
      transform: translateX(-310px);
      opacity: 1;
    }

    .notification .smiley {
      font-size: 2rem;
      margin-right: 10px;
    }

    .notification.success {
      background: #28a745; /* Success green */
    }

    .notification.error {
      background: #dc3545; /* Error red */
    }
  </style>
</head>
<body>
  <?php include 'usersidebar.php'; ?>

  <div class="feedback-container">
    <h1>We Value Your Feedback!</h1>
    <p>Let us know how your experience was.</p>
    <div class="emoji-container">
      <span class="emoji" data-rating="1">😡</span>
      <span class="emoji" data-rating="2">😟</span>
      <span class="emoji" data-rating="3">😐</span>
      <span class="emoji" data-rating="4">😊</span>
      <span class="emoji" data-rating="5">😍</span>
    </div>
    <div class="hearts" id="hearts-display"></div>
    <textarea id="review" placeholder="Write your review here..."></textarea>
    <button id="submit-button">Submit Feedback</button>
  </div>

  <div id="notification" class="notification">
    <span class="smiley">😊</span>
    <span id="notification-message"></span>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const emojis = document.querySelectorAll('.emoji');
    const reviewBox = document.getElementById('review');
    const submitButton = document.getElementById('submit-button');
    const heartsDisplay = document.getElementById('hearts-display');
    const notification = document.getElementById('notification');
    const notificationMessage = document.getElementById('notification-message');
    let selectedRating = null;

    // Highlight selected emoji and update hearts
    emojis.forEach(emoji => {
      emoji.addEventListener('click', () => {
        emojis.forEach(e => e.classList.remove('selected'));
        emoji.classList.add('selected');
        selectedRating = emoji.dataset.rating;

        // Display hearts based on the selected rating
        heartsDisplay.innerHTML = '❤️'.repeat(selectedRating);
      });
    });

    // Show notification
    function showNotification(message, type = 'success') {
      notificationMessage.textContent = message;
      notification.classList.remove('success', 'error');
      notification.classList.add(type);
      notification.classList.add('show');

      setTimeout(() => {
        notification.classList.remove('show');
      }, 3000);
    }

    // Handle form submission
    submitButton.addEventListener('click', () => {
      if (!selectedRating) {
        showNotification('Please select a rating!', 'error');
        return;
      }

      const review = reviewBox.value.trim();
      if (review === '') {
        showNotification('Please write a review!', 'error');
        return;
      }

      // Send data to backend via AJAX
      fetch('save_feedback.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `rating=${selectedRating}&review=${encodeURIComponent(review)}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showNotification('Thank you for your feedback!');
          emojis.forEach(e => e.classList.remove('selected'));
          reviewBox.value = '';
          heartsDisplay.innerHTML = '';
          selectedRating = null;
        } else {
          showNotification('Error submitting feedback!', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showNotification('Server error. Try again later!', 'error');
      });
    });
  });
</script>

</body>
</html>
