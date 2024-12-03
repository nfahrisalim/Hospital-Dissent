<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://www.example.com/background.jpg'); /* Gambar latar belakang */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.85); /* Transparan */
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            color: #2c3e50;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-out;
        }

        p {
            font-size: 18px;
            color: #34495e;
            margin: 20px 0;
            font-weight: 300;
            opacity: 0.8;
            animation: fadeInUp 1.5s ease-out;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: inline-block;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-5px);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .button-container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
            animation: fadeInUp 2s ease-out;
        }

        .btn-container {
            display: inline-flex;
            flex-direction: column;
        }

        /* Animasi fadeInUp */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Footer Section */
        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: #ecf0f1;
            font-size: 14px;
            opacity: 0.7;
        }

        .footer a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #3498db;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to Our Hospital</h1>
        <p>Your health is our priority. Choose an option below to get started with your care and consultation.</p>
        
        <div class="button-container">
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
        </div>
    </div>

    <div class="footer">
        <p>© 2024 Hospital Dissent | <a href="privacy-policy.html">Privacy Policy</a></p>
    </div>

</body>
</html>
