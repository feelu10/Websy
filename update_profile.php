<?php
// Function to retrieve user data from the database
function getUserDataFromDatabase($user_id)
{
    // Replace this with your actual database query to fetch user data based on the user_id
    // For example using mysqli extension:
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "websy";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT first_name, last_name, birthday, profile_pic FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $row;
    } else {
        $stmt->close();
        $conn->close();
        return null;
    }
}

// Function to update user data in the database
function updateUserDataInDatabase($user_id, $first_name, $last_name, $birthday, $password, $profile_pic)
{
    // Replace this with your actual database update query
    // For example using mysqli extension:
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "websy";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, birthday=?, password=?, profile_pic=? WHERE id=?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $birthday, $password, $profile_pic, $user_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

$message = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user data from the database (You'll need to adjust this based on your database setup)
    $user_id = 1; // Replace 1 with the actual user ID of the logged-in user
    $existing_user_data = getUserDataFromDatabase($user_id);

    // Validate and process the form data
    $new_first_name = trim($_POST['first_name']);
    $new_last_name = trim($_POST['last_name']);
    $new_birthday = $_POST['birthday'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate first name and last name
    if ($existing_user_data !== null) {
        $new_first_name = !empty($existing_user_data['first_name']) ? $existing_user_data['first_name'] : $new_first_name;
        $new_last_name = !empty($existing_user_data['last_name']) ? $existing_user_data['last_name'] : $new_last_name;
    }

    // Validate password
    if (empty($new_password)) {
        $new_password = ($existing_user_data !== null) ? $existing_user_data['password'] : '';
    } else {
        // If the password is not empty, ensure that the confirm_password matches
        if ($new_password !== $confirm_password) {
            $message = "Password and Confirm Password do not match.";
        }
    }

    // Handle profile picture upload (if needed)
    if ($_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "profile_pics/"; // Replace with the appropriate directory path
        $target_file = $target_dir . basename($_FILES['profile_pic']['name']);

        // Perform additional checks on the uploaded file if necessary

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
            // File uploaded successfully, update the $new_profile_pic variable with the file path
            $new_profile_pic = $target_file;
        } else {
            // Error uploading the file
            $message = "Error uploading the profile picture.";
        }
    } else {
        // No new profile picture provided
        $new_profile_pic = ($existing_user_data !== null) ? $existing_user_data['profile_pic'] : null;
    }

    // Update user data in the database
    updateUserDataInDatabase($user_id, $new_first_name, $new_last_name, $new_birthday, $new_password, $new_profile_pic);

    $message = "Profile updated successfully!";
}

?>