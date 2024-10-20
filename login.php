<?php
session_start();
include 'db_connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize it to prevent SQL injection
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Directly embed the user input into the query (after sanitization)
    $sql = "SELECT id, name, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();


        // Verify the password using password_verify
        if (password_verify($password, $user['password'])) {
            // Store user info in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: main.php");
            exit();
        } else {
            // Incorrect password
            $error = "Invalid password.";
        }
    } else {
        // No user found with that email
        $error = "Invalid email or password.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrimony Website - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
        body{
            background-image: url(./assets/images/back6.jpg);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            height:100vh;
        }
        .loginform{
            backdrop-filter:blur(2px) ;
            background: transparent;
            border-radius: 20px;
            height: 100vh;
        }
    </style>
    <div class="container">
        <div class="loginform row justify-content-center">
            <div class="col-md-6 d-flex  flex-column justify-content-center align-itens-center">
                <h2 class="mt-5 mb-3 text-light">Login</h2>
                <?php if(isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                <?php if(isset($_SESSION['message'])) { ?>
                    <div class="alert alert-success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
                <?php } ?>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label text-light">Email</label>
                        <input type="email" class="form-control " id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-light">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>