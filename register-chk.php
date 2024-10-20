<?php
session_start();
include 'db_connection.php'; // assuming this file has the $conn object created using OOP method

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];

    // Insert data directly using the query method (OOP style)
    $add_user = "INSERT INTO users (name, email, password, dob, gender, religion) 
            VALUES ('$name', '$email', '$password', '$dob', '$gender', '$religion')";
    
    // Execute the query
    if ($conn->query($add_user) === TRUE) {
        $_SESSION['message'] = "Registration successful. Please log in.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>