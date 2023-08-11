<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Add CSS styles for responsive layout */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center the screenshot grid horizontally */
            align-items: flex-start; /* Align the grid to the top of the container */
        }

        .screenshot {
            flex: 0 0 25%; /* This sets each screenshot to occupy 25% of the available width */
            max-width: 25%; /* This ensures each screenshot takes a maximum of 25% of the available width */
            box-sizing: border-box; /* This includes padding and border in the element's total width */
            padding: 10px; /* Add padding between screenshots */
        }

        .screenshot img {
            max-width: 100%; /* Make sure the images don't exceed their container's width */
            height: auto; /* Ensure images scale proportionally */
        }

        .footer {
            text-align: center;
            padding: 10px 0;
        }
        .h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- Replace the URLs in src attributes with the paths to your actual screenshots -->
        <div class="screenshot">
            <h1>Homepage</h1>
            <img src="assets/layout/p1.png" alt="Screenshot 1">
        </div>
        <div class="screenshot">
            <h1>Login Page</h1>
            <img src="assets/layout/p2.png" alt="Screenshot 2">
        </div>
        <div class="screenshot">
            <h1>Register Page</h1>
            <img src="assets/layout/p3.png" alt="Screenshot 3">
        </div>
        <div class="screenshot">
            <h1>Chinese Zodiac</h1>
            <img src="assets/layout/p4.png" alt="Screenshot 4">
        </div>
        <div class="screenshot">
        <h1>Chinese Zodiac Signs</h1>
            <img src="assets/layout/p5.png" alt="Screenshot 4">
        </div>
        <div class="screenshot">
            <h1>Site Layout</h1>
            <img src="assets/layout/p6.png" alt="Screenshot 4">
        </div>
        <div class="screenshot">
            <h1>Control Structure</h1>
            <img src="assets/layout/p7.png" alt="Screenshot 2">
        </div>
        <div class="screenshot">
            <h1>String Function</h1>
            <img src="assets/layout/p8.png" alt="Screenshot 3">
        </div>
        <div class="screenshot">
            <h1>String Function</h1>
            <img src="assets/layout/p9.png" alt="Screenshot 4">
        </div>
        <div class="screenshot">
            <h1>Web Forms</h1>
            <img src="assets/layout/p10.png" alt="Screenshot 3">
        </div>
        <div class="screenshot">
            <h1>Mid-term Assessment</h1>
            <img src="assets/layout/p11.png" alt="Screenshot 3">
        </div>
        <div class="screenshot">
            <h1>Quiz</h1>
            <img src="assets/layout/p12.png" alt="Screenshot 2">
        </div>
        <div class="screenshot">
            <h1>Quiz Result</h1>
            <img src="assets/layout/p13.png" alt="Screenshot 3">
        </div>
        <div class="screenshot">
            <h1>State Information</h1>
            <img src="assets/layout/p14.png" alt="Screenshot 4">
        </div>
        <div class="screenshot">
            <h1>User Template</h1>
            <img src="assets/layout/p15.png" alt="Screenshot 4">
        </div>
        <div class="screenshot">
            <h1>Account</h1>
            <img src="assets/layout/p16.png" alt="Screenshot 4">
        </div>

        <!-- Add more divs with the class "screenshot" and images for the remaining screenshots -->
    </div>

</body>
</html>
