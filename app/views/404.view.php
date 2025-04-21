<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #ffffff;
            color: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .container {
            text-align: center;
            animation: fadeIn 1.5s ease forwards;
            opacity: 0;
        }

        .container h1 {
            font-size: 8rem;
            color: #0ea5e9;
            margin-bottom: 20px;
        }

        .container p {
            font-size: 1.4rem;
            color: #64748b;
            margin-bottom: 30px;
        }

        .home-btn {
            background: #0ea5e9;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .home-btn:hover {
            background: #0284c7;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(2,132,199,0.3);
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        @media (max-width: 600px) {
            .container h1 {
                font-size: 4rem;
            }
            .container p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! The page you’re looking for doesn’t exist.</p>
        <a href="home" class="home-btn">Take Me Home</a>
    </div>
</body>
</html>
