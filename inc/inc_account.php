<!DOCTYPE html>
<html>
<head>
    <title>Chinese Zodiac Sign</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin-bottom: 20px;
            padding: 10px;
            color: #fff;
            text-align: center;
        }

        .containers {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        .container {
           display: none;
        }

        /* Style for individual animal names with their respective colors */
        .animal {
            font-size: 20px;
            font-weight: bold;
            margin: 5px;
        }

        .profile-pic {
            margin-top: 20px;
            max-width: 200px;
            display: block;
            margin: 0 auto;
            border-radius: 45%;
            border: 1px solid white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .zodiac-image-container {
            margin-top: 30px;
            text-align: center;
        }

        .zodiac-image {
            margin: 0 auto;
        }

        .description {
            font-size: 16px;
            margin-top: 30px;
            text-align: center;
        }

        .user-details {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .user-name {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
            color: #34495e;
        }
        p{
            color: white;
        }
    </style>
</head>
<body>
    <h2>Chinese Zodiac Sign</h2>

    <?php
    
    // Retrieve user data from the database based on the user_id (assuming you have stored the user_id in the session upon login)
    $user_id = $_SESSION['user_id'];

    // Fetch the user data from the database based on the user_id (Replace this with your actual implementation)
        function getUserDataFromDatabase($user_id)
        {
            // Fetch the user data from the database based on the user_id
            // and return the data as an associative array
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

        // Add this line to define $zodiacImagesDir and $zodiacImage before the conditional block
        $zodiacImagesDir = 'assets/images/';
        $zodiacAnimal = '';

        $user_data = getUserDataFromDatabase($user_id);

        if ($user_data) {
            $first_name = $user_data['first_name'];
            $last_name = $user_data['last_name'];
            $birthday = $user_data['birthday'];

            if (!empty($birthday)) {
            // Calculate the Chinese Zodiac sign based on the birthdate
            $year = (int) date('Y', strtotime($birthday));
            $zodiacSign = array(
                'Rat', 'Ox', 'Tiger', 'Rabbit', 'Dragon', 'Snake',
                'Horse', 'Goat', 'Monkey', 'Rooster', 'Dog', 'Pig'
            );
            $zodiacAnimalIndex = ($year - 1900) % 12;
            $zodiacAnimal = $zodiacSign[$zodiacAnimalIndex];

            echo "<div class='containers'>";
            echo "<div class='user-details'>";
            echo "<img src='" . ($user_data['profile_pic'] ?? 'assets/uploads/default.jpg') . "' alt='Profile Picture' class='profile-pic'>";
            echo "<div class='user-name'>$first_name $last_name</div>";
            echo "</div>";
            echo "<div class='zodiac-image'>";
            echo "<img src='$zodiacImagesDir" . strtolower($zodiacAnimal) . ".png' alt='$zodiacAnimal'>";
            echo "</div>";  

            // Display description for the user's sign
            $zodiacAnimals = array(
        "Rat" => array(
            "Personality" => "Intelligent, adaptable, quick-witted",
            "Traits" => "Resourceful, charming, creative",
            "Skills" => "Problem-solving, social skills",
            "Talent" => "Academic pursuits, art",
            "Likes" => "Reading, music, nature",
            "Dislikes" => "Inactivity, criticism"
        ),
        "Ox" => array(
            "Personality" => "Dependable, strong, determined",
            "Traits" => "Patient, hardworking, trustworthy",
            "Skills" => "Leadership, organizing",
            "Talent" => "Agriculture, carpentry",
            "Likes" => "Gardening, cooking",
            "Dislikes" => "Haste, laziness"
        ),
        "Tiger" => array(
            "Personality" => "Courageous, assertive, competitive",
            "Traits" => "Confident, charismatic, adventurous",
            "Skills" => "Risk-taking, strategizing",
            "Talent" => "Performing arts, athletics",
            "Likes" => "Exploring, challenges",
            "Dislikes" => "Monotony, being controlled"
        ),
        "Rabbit" => array(
            "Personality" => "Caring, gentle, compassionate",
            "Traits" => "Elegant, considerate, diplomatic",
            "Skills" => "Negotiating, problem-solving",
            "Talent" => "Art, literature",
            "Likes" => "Harmony, cleanliness",
            "Dislikes" => "Conflict, harshness"
        ),
        "Dragon" => array(
            "Personality" => "Dominant, ambitious, confident",
            "Traits" => "Charismatic, energetic, independent",
            "Skills" => "Innovation, leading",
            "Talent" => "Entertainment, public speaking",
            "Likes" => "Recognition, excitement",
            "Dislikes" => "Inefficiency, boredom"
        ),
        "Snake" => array(
            "Personality" => "Mysterious, intuitive, wise",
            "Traits" => "Charming, insightful, strategic",
            "Skills" => "Persuasion, research",
            "Talent" => "Occult sciences, healing",
            "Likes" => "Meditation, luxury",
            "Dislikes" => "Disorder, criticism"
        ),
        "Horse" => array(
            "Personality" => "Adaptable, loyal, courageous",
            "Traits" => "Energetic, sociable, optimistic",
            "Skills" => "Communication, sports",
            "Talent" => "Horsemanship, entertainment",
            "Likes" => "Freedom, travel",
            "Dislikes" => "Restriction, idleness"
        ),
        "Goat" => array(
            "Personality" => "Tasteful, crafty, warm",
            "Traits" => "Artistic, compassionate, gentle",
            "Skills" => "Creativity, caregiving",
            "Talent" => "Music, handicrafts",
            "Likes" => "Nature, harmony",
            "Dislikes" => "Conflict, roughness"
        ),
        "Monkey" => array(
            "Personality" => "Quick-witted, charming, lucky",
            "Traits" => "Inventive, enthusiastic, agile",
            "Skills" => "Problem-solving, entertainment",
            "Talent" => "Humor, mimicry",
            "Likes" => "Socializing, challenges",
            "Dislikes" => "Boredom, routine"
        ),
        "Rooster" => array(
            "Personality" => "Honest, energetic, intelligent",
            "Traits" => "Confident, punctual, organized",
            "Skills" => "Alertness, planning",
            "Talent" => "Public speaking, organizing",
            "Likes" => "Attention, precision",
            "Dislikes" => "Injustice, disorganization"
        ),
        "Dog" => array(
            "Personality" => "Loyal, faithful, courageous",
            "Traits" => "Reliable, protective, empathetic",
            "Skills" => "Guarding, caregiving",
            "Talent" => "Service, problem-solving",
            "Likes" => "Loyalty, honesty",
            "Dislikes" => "Dishonesty, disloyalty"
        ),
        "Pig" => array(
            "Personality" => "Compassionate, generous, diligent",
            "Traits" => "Gentle, kind-hearted, cooperative",
            "Skills" => "Negotiating, problem-solving",
            "Talent" => "Culinary arts, hospitality",
            "Likes" => "Peace, good company",
            "Dislikes" => "Conflict, rudeness"
        )
        );

            $Personality = $zodiacAnimals[$zodiacAnimal]['Personality'];
            $Traits = $zodiacAnimals[$zodiacAnimal]['Traits'];
            $Skills = $zodiacAnimals[$zodiacAnimal]['Skills'];
            $Talent = $zodiacAnimals[$zodiacAnimal]['Talent'];
            $Likes = $zodiacAnimals[$zodiacAnimal]['Likes'];
            $Dislikes = $zodiacAnimals[$zodiacAnimal]['Dislikes'];
            echo "<div class='description'>";
            echo "<p style='color:white;'><strong>Your Personality Chinese Zodiac sign  is $zodiacAnimal:</strong></p>";
            echo "<p>$Personality</p>";
            echo "<p>$Traits</p>";
            echo "<p>$Skills</p>";
            echo "<p>$Likes</p>";
            echo "<p>$Dislikes</p>";
            echo "</div>";
            echo "</div>";
            } else {
                echo "<div class='containers'>";
                echo "<a href='index.php?page=web_forms' style='font-size:50px; color:red; text-decoration:none;'><p>No birthday entry was found Please set it first here</p=></a>";
                echo "</div>";
            }
        } else {
            echo "<div class='containers'>";
            echo "<p style='font-size:50px; color:red;'>No user data found.</p>";
            echo "</div>";
        }
        ?>
</body>
</html>
