<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 
$sql = "SELECT * FROM users WHERE id != $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrimony Website - Main Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <style>
        body{
            background-image: url(./assets/images/back8.jpg);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            height: 100vh;

        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Matrimony</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link " href="profile.php">My Profile</a>
                <a class="nav-link" href="logout.php">Logout</a>
                <a class="nav-link" href="crud.php">Manage Profile</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
        <h3 class="mt-4">Potential Matches</h3>
        <div class="row">
            <?php while ($user = $result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $user['name']; ?></h5>
                            <p class="card-text">Age: <?php echo calculateAge($user['dob']); ?></p>
                            <p class="card-text">Gender: <?php echo ucfirst($user['gender']); ?></p>
                            <p class="card-text">Religion: <?php echo ucfirst($user['religion']); ?></p>
                            <a href="profile.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">View Profile</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
function calculateAge($dob) {
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $birthdate->diff($today)->y;
    return $age;
}
?>