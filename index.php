<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrimony Website - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

</head>
<body>
     <style>
        body{
            background-image: url(./assets/images/back4.jpg);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }
    </style>
    <div class="container">
        <div class="welcomcard row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6 text-center">
                <h1 class="mb-4">Welcome to Our Matrimony Website</h1>
                <a href="login.php" class="btn btn-light btn-lg m-2 text-dark">Login</a>
                <a href="registration.php" class="btn btn-light btn-lg m-2 text-dark">Sign Up</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>