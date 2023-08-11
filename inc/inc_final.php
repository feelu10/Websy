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
            margin: 1rem 0 4rem 0;
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
    <h1 class="h1"> Kirk Final Project </h1>
    <div class="main-content">
        <!-- Replace the URLs in src attributes with the paths to your actual screenshots -->
        <div class="screenshot">
            <img src="assets/layout/k1.png" alt="Screenshot 1">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k2.png" alt="Screenshot 2">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k3.png" alt="Screenshot 3">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k4.png" alt="Screenshot 4">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k5.png" alt="Screenshot 5">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k6.png" alt="Screenshot 6">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k7.png" alt="Screenshot 7">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k8.png" alt="Screenshot 8">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k9.png" alt="Screenshot 9">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k10.png" alt="Screenshot 10">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k11.png" alt="Screenshot 11">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k12.png" alt="Screenshot 12">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k13.png" alt="Screenshot 13">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k14.png" alt="Screenshot 14">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k15.png" alt="Screenshot 14">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k16.png" alt="Screenshot 15">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k17.png" alt="Screenshot 16">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k18.png" alt="Screenshot 17">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k19.png" alt="Screenshot 18">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k20.png" alt="Screenshot 19">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k21.png" alt="Screenshot 20">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k22.png" alt="Screenshot 21">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k23.png" alt="Screenshot 22">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k24.png" alt="Screenshot 23">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k25.png" alt="Screenshot 24">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k26.png" alt="Screenshot 25">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k27.png" alt="Screenshot 26">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k28.png" alt="Screenshot 27">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k29.png" alt="Screenshot 28">
        </div>
        <div class="screenshot">
            <img src="assets/layout/k30.png" alt="Screenshot 29">
        </div>

        <!-- Add more divs with the class "screenshot" and images for the remaining screenshots -->
    </div>

    
</body>
</html>
