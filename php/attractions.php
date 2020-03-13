<?php
// Initialize the session
session_start();
$currentUser = "";
$loginornot = "";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  $currentUser = "Login";
  $loginornot = "login.php";
} else {
  $currentUser = $_SESSION["username"];
}

//Storymap load info from database
require_once "../php/config.php";

//Initialize arrays
$headline = []; 
$image = []; 
$text = []; 
$extraPictures = array();
$counterMain = 2;
$counterSub = 0;

//Get number of attractions
$rowAttractions = mysqli_fetch_array($link->query("SELECT COUNT(*) AS Number FROM attractions"));
$numberOfAttractions = $rowAttractions["Number"];

//Put data in arrays
for ($x = 1; $x <= 16; $x++) {
    $sql = "SELECT storymap_slides_text_headline FROM attractions WHERE storymap_slides_ID = $x";
    $resultheadline = $link->query($sql);
    if (!mysqli_num_rows($resultheadline)==0) {
      while($row = mysqli_fetch_array($resultheadline)){
        $headline[] = $row["storymap_slides_text_headline"];
      }
    }
    $sql = "SELECT storymap_slides_media_url FROM attractions WHERE storymap_slides_ID = $x";
    $resultimage = $link->query($sql);
    if (!mysqli_num_rows($resultimage)==0) {
      while($row = mysqli_fetch_array($resultimage)){
        $image[] = $row["storymap_slides_media_url"];
      }
    }
    $sql = "SELECT storymap_slides_text_text FROM attractions WHERE storymap_slides_ID = $x";
    $resulttext = $link->query($sql);
    if (!mysqli_num_rows($resulttext)==0) {
      while($row = mysqli_fetch_array($resulttext)){
        $text[] = $row["storymap_slides_text_text"];
      }
    }
}

//Get multiple pictures, multidimentional array
while ($numberOfAttractions >= $counterMain) {
  $sql = "SELECT storymap_slides_media_url FROM attractionspicture WHERE storymap_slides_ID = $counterMain";
  $result = $link->query($sql);
  if (!mysqli_num_rows($result)==0) {
    while($row = mysqli_fetch_array($result)){
      $extraPictures[$counterMain][$counterSub] = $row['storymap_slides_media_url']; //The array is structures as this: $extraPictures[ID of attraction][Picture index]
      $counterSub++;
    }
  }
  $counterMain++;
  $counterSub = 0;
}

//Encode to json
$code_headline = json_encode($headline);
$code_image = json_encode($image);
$code_text = json_encode($text);
$code_images = json_encode($extraPictures);

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRO1000</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/hamburger.css">
    <script type="text/javascript" src="../script/attractions.js"></script>
</head>
<body>
<div id="main">
<div id="header">
<header>Barcelona</header>	
</div>
<!--Hamburger meny!-->
<div class="menu-wrap">
    <input type="checkbox" class="toggler">
    <div class="hamburger"><div></div></div>
    <div class="menu">
      <div>
        <div>
          <ul>
            <li><a href="../php/storymap.php">Home</a></li>
            <li><a href="../php/attractions.php">Attractions</a></li>
            <li><a href="../php/login.php"><?php echo htmlspecialchars($currentUser); ?></a></li>
            <li><a href="../php/logout.php">Logout</a></li>
            <li><a href="../php/about.php">About</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--Navigation bar!-->
  <div class="topnav">
    <a class="active" href="storymap.php">Home</a>
    <a href="../php/login.php">Login</a>
    <a href="../php/register.php">Register</a>
    <a href="../php/attractions.php">Recommendations</a>
  </div>

  <div id="content">
    <h1>Attractions</h1>
    <p id = "rec_days"><a id="all">All</a> | <a id="threedays">3 days</a> | <a id="fivedays">5 days</a></p>
    <div id ="overlay"><div id="overlayText"></div></div>
<div id="rec_container">
</div>

<div id="footer">
    <footer>
        <p><a href="" target="_blank">test</a></p>
        <p><a href="" target="_blank">test_2</a></p>
        <p id="date"></p>      
    </footer>
</div>
</div> 

<script>
  //Get array from php
  var headline = <?php echo $code_headline; ?>;
  var image = <?php echo $code_image; ?>;
  var text = <?php echo $code_text; ?>;

  //This is for the multidimentional images array
  var images = <?php echo $code_images; ?>;

  create_array(headline, image, text);
  create_image_array(image, images);
</script>
</body>
</html>