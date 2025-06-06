<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Form</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background:lightgray;
            display:grid;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Styling */
        form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            width: 200%;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        label {
            display: block;
            margin: 20px 0 10px;
            font-weight: bold;
            color: #333;
            font-size: 18px;
        }

        input[type="date"] {
            width: calc(100% - 20px);
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 18px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="date"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 20px;
            width: 100%;
            margin-top: 25px;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <form action="income1.php" method="post">
        <h2 style="margin-bottom: 25px; color: #333; font-size: 24px;">Generate Report</h2>
        <label for="date_from">From:</label>
        <input type="date" id="date_from" name="date_from" required>

        <label for="date_to">To:</label>
        <input type="date" id="date_to" name="date_to" required>

        <button type="submit">Generate Report</button>
    </form>
</body>
</html>
