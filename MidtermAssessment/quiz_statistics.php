<style>
#content1, #content2{
    display: none;
}

#content3{
    display: block;
}
</style>
<?php
// Replace these with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "websy";

// Establish a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch quiz statistics from the database
$sql = "SELECT user_name, user_email, score FROM quiz_results";
$result = $conn->query($sql);

// Process the results and calculate statistics
$highestScores = array();
$totalAttempts = 0;
$totalCorrect = 0;

while ($row = $result->fetch_assoc()) {
    $totalAttempts++;
    $userEmail = $row['user_email'];
    $userScore = $row['score'];

    // Check if the user already has a recorded highest score
    if (isset($highestScores[$userEmail])) {
        // If the current score is higher than the recorded highest score, update the highest score
        if ($userScore > $highestScores[$userEmail]['score']) {
            $highestScores[$userEmail]['score'] = $userScore;
        }
    } else {
        // If it's the first record for the user, add it to the highestScores array
        $highestScores[$userEmail] = array(
            'user_name' => $row['user_name'],
            'user_email' => $userEmail,
            'score' => $userScore
        );
    }

    if ($userScore == 10) { // If the user scored 10, increment totalCorrect
        $totalCorrect++;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Statistics</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome CSS link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/quiz_statistic.css">
</head>
<body >

    <div class="container">
        <h1>Quiz Statistics</h1>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display only the highest scores and their emails
                foreach ($highestScores as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['user_name'] . "</td>";
                    echo "<td>" . $row['user_email'] . "</td>";
                    echo "<td>" . $row['score'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <p>Total attempts: <?php echo $totalAttempts; ?></p>
        <p>Total correct: <?php echo $totalCorrect; ?></p>
    </div>
    <h6 id="links" style="text-align:center;">
        Back to <a href='index.php?page=midterm_assessment&quiz'><i class="fas fa-arrow-left"></i>Quiz</a> to retake it again.
    </h6>
    <h6 id="links" style="text-align:center;">
    Go to <a href='index.php?page=midterm_assessment'><i class="fas fa-arrow-right"></i>Midterm Assessment</a> to view source code.
    </h6>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

