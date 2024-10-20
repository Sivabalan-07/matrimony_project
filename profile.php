<?php
session_start();
include 'db_connection.php'; // assuming this file contains the connection in OOP style

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// if(isset($_GET['id'])){
//     $user_id = $_GET['id'];
// }else{
//     $user_id = $_SESSION['user_id']
// }

// Determine if the profile is for the logged-in user or another user
$user_id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['user_id'];


$is_own_profile = $user_id == $_SESSION['user_id'];

// Sanitize user input (for security reasons)
$user_id = $user_id;

// Fetch user details
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}

// Handle form submission if it's the user's own profile
if ($_SERVER["REQUEST_METHOD"] == "POST" && $is_own_profile) {
    // Input validation and sanitization
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];

    // Check if all fields are filled
    if (!$name || !$email || !$dob || !$gender || !$religion) {
        $error_message = "All fields are required and must be valid.";
    } else {
        // Update the user's profile
        $update_sql = "UPDATE users SET name = '$name', email = '$email', dob = '$dob', gender = '$gender', religion = '$religion' WHERE id = '$user_id'";
        
        // Execute the update query
        if ($conn->query($update_sql) === TRUE) {
            $success_message = "Profile updated successfully.";
            // Update the $user array with the new values
            $user = array_merge($user, $_POST);
        } else {
            $error_message = "Failed to update profile: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <style>
        body{
            background-image: url(./assets/images/back9.jpg);
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }
    </style>
    <div class="container mt-5">
        <h2>User Profile</h2>
        <?php
        if (isset($success_message)) {
            echo "<div class='alert alert-success'>" . $success_message . "</div>";
        }
        if (isset($error_message)) {
            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>
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
                <input type="text" class="form-control" id="religion" name="religion" value="<?php echo htmlspecialchars($user['religion']); ?>" required>
            </div>
            <?php if ($is_own_profile): ?>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            <?php endif; ?>
        </form>
        <?php if ($is_own_profile) { ?>
            <a href="crud.php" class="btn btn-primary mt-3">Manage Profile</a>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>