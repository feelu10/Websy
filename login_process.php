<?php

// Start a session
session_start();
// Include the database connection file
require_once('connection.php');

// Helper function to check if the user with provided email or username has already taken the quiz.
function hasUserTakenQuiz($email, $username)
{
    // Your custom logic here to check if the user with the provided email or username has already taken the quiz.
    // You can access the $email and $username variables to check against the database.
    // Return true if the user has already taken the quiz, otherwise false.
    return false; // Replace this with your actual validation logic.
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form input values
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Check if username and password are not empty
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=Username and password are required.");
        exit;
    }

    // Query the database to check if the username exists
    $query = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, login successful

            // Validate if the user has already taken the quiz
            if (hasUserTakenQuiz($username, $_POST["email"])) {
                header("Location: index.php?error=You have already taken the quiz. You cannot retake it.");
                exit;
            }

            
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id']; // Store the user ID in the session
            $_SESSION['message'] = 'You have successfully logged in!'; // set success message
            header("Location: index.php");
            exit;
        } else {
            // Password is incorrect
            header("Location: login.php?error=Invalid password. Please try again.");
            exit;
        }
    } else {
        // Username not found
        header("Location: login.php?error=Username not found. Please check your username.");
        exit;
    }

    // Close the database connection
    $conn->close();
}
?>