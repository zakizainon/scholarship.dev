<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Application</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .logo {
            max-width: 200px; /* Adjust size as needed */
            margin-bottom: 50px; /* Adds space between logo and text */
            position: absolute;
            top: 10%; /* Moves logo higher */
        }
        .message {
            font-size: 20px;
            font-weight: bold;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <img src="{{ url('/images/PNB_Logo_Blue_RGB.png') }}" alt="Logo" class="logo">
    <div class="message">
        Application for our scholarship(s) are currently closed.
    </div>
</body>
</html>
