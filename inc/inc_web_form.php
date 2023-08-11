<?php
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Include the database connection file
require_once('connection.php');

// Function to retrieve user data from the database
function getUserDataFromDatabase($user_id)
{
    // Replace this with your actual database query to fetch user data based on the user_id
    // For example using PDO:
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "websy";

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $stmt = $pdo->prepare("SELECT first_name, last_name, birthday, profile_pic FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

    function updateUserDataInDatabase($user_id, $first_name, $last_name, $birthday, $password, $profile_pic)
    {
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "websy";

        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

            // Prepare the SQL statement and bind parameters
            $stmt = $pdo->prepare('UPDATE users SET first_name = :first_name, last_name = :last_name, birthday = :birthday, profile_pic = :profile_pic ' . 
                                ($password ? ', password = :password' : '') . ' WHERE id = :user_id');

            // Bind the parameters
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);

            // Check if birthday is empty, if yes, set it to NULL in the database
            if (empty($birthday)) {
                $stmt->bindValue(':birthday', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindParam(':birthday', $birthday);
            }

            // Check if profile_pic is empty, if yes, set it to NULL in the database
            if (empty($profile_pic)) {
                $stmt->bindValue(':profile_pic', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindParam(':profile_pic', $profile_pic);
            }

            // Check if password is empty, if yes, do not update the password field in the database
            if (!empty($password)) {
                // Hash the new password before updating in the database
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $hashed_password);
            }

            // Execute the update query
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
$message = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user data from the database (You'll need to adjust this based on your database setup)
    $user_id = $_SESSION['user_id']; // Use the stored user ID from the session
    $existing_user_data = getUserDataFromDatabase($user_id);

    // Validate and process the form data
    $new_first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : ($existing_user_data['first_name'] ?? '');
    $new_last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : ($existing_user_data['last_name'] ?? '');
    $new_birthday = isset($_POST['birthday']) ? $_POST['birthday'] : ($existing_user_data['birthday'] ?? '');
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    

    // Initialize variables to avoid undefined variable warnings
    $new_first_name = isset($_POST['first_name']) ? $_POST['first_name'] : $existing_user_data['first_name'] ?? '';
    $new_last_name = isset($_POST['last_name']) ? $_POST['last_name'] : $existing_user_data['last_name'] ?? '';
    $new_birthday = isset($_POST['birthday']) ? $_POST['birthday'] : $existing_user_data['birthday'] ?? '';

    // Validate first name and last name
    $existing_first_name = $existing_user_data['first_name'] ?? '';
    $existing_last_name = $existing_user_data['last_name'] ?? '';

    // Check if last name is not empty, if yes, enable first name input
    if (!empty($existing_last_name)) {
        $first_name_disabled = '';
    } else {
        $first_name_disabled = 'disabled';
    }

    if (empty($new_first_name)) {
        $new_first_name = null; // Set to NULL if left blank
    }

    if (empty($new_last_name)) {
        $new_last_name = null; // Set to NULL if left blank
    }

    // Validate password
    if (empty($new_password)) {
        // If the new password is empty, keep the old password from the database
        $new_password = ($existing_user_data !== null && isset($existing_user_data['password'])) ? $existing_user_data['password'] : '';
    } else {
        // If the password is not empty, ensure that the confirm_password matches
        if ($new_password !== $confirm_password) {
            $message = "Password and Confirm Password do not match.";
        } else {
            // Hash the new password before updating in the database
            $new_password = password_hash($new_password, PASSWORD_BCRYPT);
        }
    }

    // Handle profile picture upload (if needed)
    if ($_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "assets/uploads"; // Replace with the appropriate directory path
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

// Retrieve user data from the database (You'll need to adjust this based on your database setup)
$user_id = $_SESSION['user_id']; // Use the stored user ID from the session
$existing_user_data = getUserDataFromDatabase($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="date"], 
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 2rem;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
       /* Style for error and success messages */
        .message {
            position: fixed;
            top: -50px; /* Set to a negative value to hide the message initially */
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            animation: messageAnimation 3s ease-out;
            background-color: rgba(143, 136, 136, 0.801);
        }

        /* Keyframes for message animation */
        @keyframes messageAnimation {
            0% {
                top: -50px;
                opacity: 0;
            }
            20% {
                top: 10px; /* Set to a positive value to display the message on top */
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <?php if (!empty($message)): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>    <h2>Update User Profile</h2>
    <form action="index.php?page=web_forms" method="post" enctype="multipart/form-data">
    <label for="profile_pic">Profile Picture:</label>
    <input type="file" id="profile_pic" name="profile_pic">
    
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" placeholder="Enter first name" value="<?php echo htmlspecialchars(isset($_POST['first_name']) ? $_POST['first_name'] : $existing_user_data['first_name'] ?? ''); ?>" <?php echo isset($existing_user_data['first_name']) ? 'disabled' : ''; ?>>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" placeholder="Enter last name" value="<?php echo htmlspecialchars(isset($_POST['last_name']) ? $_POST['last_name'] : $existing_user_data['last_name'] ?? ''); ?>" <?php echo isset($existing_user_data['last_name']) ? 'disabled' : ''; ?>>

    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars(isset($_POST['birthday']) ? $_POST['birthday'] : $existing_user_data['birthday'] ?? ''); ?>" <?php echo isset($existing_user_data['birthday']) ? 'disabled' : ''; ?> >

    <label for="password">New Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter new password" <?php echo isset($existing_user_data['password']) ? 'disabled' : ''; ?>>

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" <?php echo isset($existing_user_data['password']) ? 'disabled' : ''; ?>>

    <input type="submit" value="Update Profile">
</form>
</body>
</html>
