<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* Your CSS styles here... */
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
  max-width: 800px; /* Adjust the max-width to your desired size */
  margin: 0 auto; /* Center the slideshow container */
  background-color: rgba(0, 0, 0, 0.2); /* 20% transparent background */
  border-radius: 20px; /* Rounded square shape with 20px border radius */
}

/* Hide the images by default */
.mySlides {
  display: none;
  position: relative; /* Add positioning to the mySlides container */
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev {
left: 0;
border-right: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  bottom: 0; /* Place at the bottom */
  left: 50%; /* Center horizontally */
  transform: translateX(-50%); /* Adjust horizontally to center */
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: rgba(34, 34, 34, 0.8); /* 20% transparent background */
  padding: 2px 16px;
  color: white;
  border-radius: 20px; /* Rounded square shape with 20px border radius */
}

.row:after {
  content: "";
  display: table;
  clear: both;
  border-radius: 20px;
}

/* Six columns side by side */
.column {
  float: left;
  width: 15.8%;
  margin: 3px; /* Adjust the margin to create space between columns */
  background-color: transparent; /* Transparent background */
}

/* Add a transparency effect for thumbnail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

/* Set the image size for the slideshow */
.mySlides img {
  width: 100%;
  height: auto;
}
</style>
<body>
<div class="container">
  <?php
    // PHP code to generate the slideshow content dynamically
    $zodiacSigns = array(
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

    for ($i = 1; $i <= 12; $i++) {
      $sign = array_keys($zodiacSigns)[$i - 1];
      echo '<div class="mySlides">';
      echo '<div class="numbertext">' . $i . ' / 12</div>';
      echo '<img src="assets/images/' . $sign . '.png" alt="' . $sign . '">';
      echo '</div>';
    }
  ?>

   <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

  <div class="caption-container">
    <p id="caption"></p>
  </div>

  <div class="row">
    <?php
      // PHP loop to generate thumbnail images for the slideshow
      $i = 0;
      foreach ($zodiacSigns as $sign => $details) {
        $i++;
        echo '<div class="column">';
        echo '<img class="demo cursor" src="assets/images/' . $sign . '.png" style="width:100%" onclick="currentSlide(' . $i . ')" alt="' . $sign . '">';
        echo '</div>';
      }
    ?>
  </div>
</div>

<script>
let slideIndex = 1;
let zodiacSigns = <?php echo json_encode($zodiacSigns); ?>;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  let sign = dots[slideIndex-1].alt;
  let captionHTML = "<strong>" + sign + "</strong><br>";
  captionHTML += "<strong>Personality:</strong> " + zodiacSigns[sign]["Personality"] + "<br>";
  captionHTML += "<strong>Traits:</strong> " + zodiacSigns[sign]["Traits"] + "<br>";
  captionHTML += "<strong>Skills:</strong> " + zodiacSigns[sign]["Skills"] + "<br>";
  captionHTML += "<strong>Talent:</strong> " + zodiacSigns[sign]["Talent"] + "<br>";
  captionHTML += "<strong>Likes:</strong> " + zodiacSigns[sign]["Likes"] + "<br>";
  captionHTML += "<strong>Dislikes:</strong> " + zodiacSigns[sign]["Dislikes"];
  captionText.innerHTML = captionHTML;
}
</script>
    
</body>
</html>