<?php

session_start();

// Check if user is logged in
// Check if user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in - redirect to index.php with a message
    $_SESSION['message'] = 'You are already logged in.';
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_website-design/ChineseZodiac.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<style>
    .header-image {
    width: 100%;
    max-height: 200px; Adjust this to the desired height
    object-fit: cover;
    position: fixed;
    top: 0;
    left: 0;
}
body {
    padding-top: 90px; /* Adjust this to match the max-height of the image */
    /* The rest of your body styles */
}

</style>
<body style="background-color: black; height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column; background-image: url('https://img.freepik.com/free-vector/chinese-new-year-animals-vector-gold-animal-zodiac-sign-stickers-set_53876-136014.jpg?w=740&t=st=1690986822~exp=1690987422~hmac=6b48dc1fa30d9ce11acdb7bec70de068aa5abfd5048bc637e78d78011f998d7a');background-size:cover;">
    
    <div class="container" style="padding: 100px; height: 1000vh; display: flex; justify-content: center; align-items: center; flex-direction: column;">
    <img src="assets/zodiacs_imgs/Chinese.png" alt="Chinese Zodiac: a code demonstration for PHP" title="Chinese Zodiac: a code demonstration for PHP" />
        <h2>REGISTER</h2>
        <?php
        // Check if the "error" query parameter is present and display the error message
        if (isset($_GET['error'])) {
            echo '<div class="message">' . $_GET['error'] . '</div>';
        }

        // Check if the "message" query parameter is present and display the success message
        if (isset($_GET['message'])) {
            echo '<div class="message success">' . $_GET['message'] . '</div>';
        }
        ?>
        <form class="form" action="register_process.php" method="post">
            <label style="font-weight:900">Username:</label>
            <input type="text" name="username" style="font-weight:900;padding:.4rem;border-radius:4px;">
            <label style="font-weight:900">Email:</label>
            <input type="email" name="email" style="font-weight:900;padding:.4rem;border-radius:4px;">
            <label style="font-weight:900">Password:</label>
            <input type="password" name="password" style="font-weight:900;padding:.4rem;border-radius:4px;">
            <input type="submit" value="Register" style="font-weight:900;padding:.2rem">
            <p style="margin-top:2rem; font-weight:900; color:black;">Already have an account? <a href="login.php" id="link" style="text-decoration:none;font-weight:bolder;color:blue;">Login here</a></p>
        </form>
    </div>
    <div class="footer" style="text-align:center">
        <?php include("inc/inc_footer.php");?>
    </div>
    <script src="assets/js/popupMsg.js"></script>
</body>
</html>
