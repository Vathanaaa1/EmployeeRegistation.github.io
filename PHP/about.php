<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f6fc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        .container {
            background-color: white;
            width: 60%;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .info {
            text-align: left;
            font-size: 18px;
            line-height: 1.8;
            color: #555;
        }

        .info strong {
            color: #000;
        }

        footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>About This Project</h1>
    </header>

    <div class="container">
        <h2>Project & Team Information</h2>
        <div class="info">
            <p><strong>Lecturer:</strong> Meng Hann</p>
            <p><strong>Name:</strong> Chang Huychhing</p>
            <p><strong>Class:</strong> M1</p>
            <p><strong>Purpose:</strong> Employee Management Web Form using PHP, MySQL, HTML, CSS, and JavaScript.</p>
        </div>
    </div>

    <footer>
        &copy; 2025 - Developed by Chang Huychhing | Class M1
    </footer>

</body>
</html>
