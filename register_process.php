<?php
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $email = $conn->real_escape_string($_POST["email"]);

    // Validate username length (at least 6 characters)
    if (strlen($username) < 6) {
        header("Location: register.php?error=Username must be at least 6 characters long.");
        exit;
    }

    // Validate password length (at least 6 characters)
    if (strlen($password) < 6) {
        header("Location: register.php?error=Password must be at least 6 characters long.");
        exit;
    }

    // Validate password contains at least 1 uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        header("Location: register.php?error=Password must contain at least 1 uppercase letter.");
        exit;
    }

    // Check if the username already exists
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        header("Location: register.php?error=Username already exists. Please choose another username.");
        exit;
    }

    // Check if the email already exists
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        header("Location: register.php?error=Email already exists. Please use another email address.");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "register successful. You can now log in.";
        header("Location: register.php?message=register successful. You can now log in.");      
        exit; // Make sure to exit after the redirect
    } else {
        echo "Error during register. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
