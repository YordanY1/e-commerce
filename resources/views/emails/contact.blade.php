<!DOCTYPE html>
<html>
<head>
    <title>Запитване</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 7px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px; /* Adjust as needed */
        }
        h1 {
            color: #007bff; /* Your primary blue color */
        }
        p {
            font-size: 16px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">

        <img src="https://i.imgur.com/Z3IT6TQ.jpg" alt="Logo" class="logo">

        <p><strong>Име:</strong> {{ $details['name'] }}</p>
        <p><strong>Email:</strong> {{ $details['email'] }}</p>
        <p><strong>Съобщение:</strong> {{ $details['message'] }}</p>

        <div class="footer">
            <p>Благодарим Ви, че се свързахте с нас!</p>
        </div>

    </div>
</body>
</html>
