<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Header with Cloud Widget</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #333;
      color: white;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .logo {
      font-size: 1.5em;
      font-weight: bold;
    }

    .contact a {
      display: inline-block;
      background: linear-gradient(145deg, #444, #222);
      padding: 10px 20px;
      border-radius: 8px;
      color: white;
      text-decoration: none;
      font-size: 1em;
      font-weight: bold;
      box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
    }

    .contact a:hover {
      background: linear-gradient(145deg, #555, #333);
      transform: translateY(-2px);
      box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.4);
    }

    .menu-icon, .cloud-icon {
      font-size: 1.5em;
      cursor: pointer;
      margin-left: 15px;
      transition: transform 0.2s ease;
    }

    .menu-icon:hover, .cloud-icon:hover {
      transform: scale(1.1);
    }

    .icons {
      display: flex;
      align-items: center;
    }

    /* Widget Styles - Larger Size */
    .widget-container {
      display: none;
      position: fixed;
      top: 80px;
      right: 20px;
      width: 400px;  /* Increased Width */
      height: 500px; /* Increased Height */
      background: white;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
      padding: 15px;
      border-radius: 10px;
      z-index: 100;
    }

    .widget-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #ddd;
      padding-bottom: 5px;
      margin-bottom: 10px;
    }

    .widget-header h3 {
      margin: 0;
      font-size: 1.2em;
      color: #333;
    }

    .close-widget {
      cursor: pointer;
      font-size: 1.3em;
      color: #888;
      transition: color 0.3s ease;
    }

    .close-widget:hover {
      color: #333;
    }

    iframe {
      width: 100%;
      height: 90%;  /* Increased iframe height */
      border: none;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="logo">PayPark</div>
    <div class="contact">
      <a href="tel:+918788345734">📞 Customer Care: +91 8788345734</a>
    </div>
    <div class="icons">
      <div class="cloud-icon" id="cloud-icon"><i class="fas fa-cloud"></i></div>
    </div>
  </header>

  <!-- Cloud Widget Container -->
  <div class="widget-container" id="widget-container">
    <div class="widget-header">
      <h3>Cloud Widget</h3>
      <span class="close-widget" id="close-widget">&times;</span>
    </div>
    <iframe id="widget-frame" src=""></iframe>
  </div>

  <script>
    // Toggle Cloud Widget
    document.getElementById('cloud-icon').addEventListener('click', () => {
      let widget = document.getElementById('widget-container');
      let frame = document.getElementById('widget-frame');

      if (widget.style.display === 'block') {
        widget.style.display = 'none';
        frame.src = ""; // Unload PHP file when closed
      } else {
        widget.style.display = 'block';
        frame.src = "cloud-widget.php"; // Load PHP file when opened
      }
    });

    // Close Widget
    document.getElementById('close-widget').addEventListener('click', () => {
      document.getElementById('widget-container').style.display = 'none';
      document.getElementById('widget-frame').src = "";
    });
  </script>
</body>
</html>
