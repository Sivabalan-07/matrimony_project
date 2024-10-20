<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Read operation
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Update operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];

    $update_sql = "UPDATE users SET name = ?, email = ?, dob = ?, gender = ?, religion = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $name, $email, $dob, $gender, $religion, $user_id);
    
    if ($update_stmt->execute()) {
        $success_message = "Profile updated successfully.";
        $user = array_merge($user, $_POST);
    } else {
        $error_message = "Failed to update profile. Please try again.";
    }
}

// Delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $user_id);
    
    if ($delete_stmt->execute()) {
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Failed to delete profile. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrimony Website - Manage Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <style>
        body{
            background-image: url(./assets/images/back10.jpg);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            /* height:100vh; */
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Matrimony</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="main.php">Home</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Manage Your Profile</h2>
        
        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } ?>
        
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>
        
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user['dob']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="male" <?php echo $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                    <option value="other" <?php echo $user['gender'] == 'other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="religion" class="form-label">Religion</label>
                <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $user['religion']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
        </form>
        
        <hr class="mt-4 mb-4">
        
        <h3>Delete Your Profile</h3>
        <p class="text-danger">Warning: This action cannot be undone.</p>
        <form method="post" action="" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
            <button type="submit" name="delete" class="btn btn-danger">Delete Profile</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>