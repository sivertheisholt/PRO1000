<?php
// Initialize the session
session_start();
$currentUser = "";
$loginornot = "";

//Storymap load info from database
require_once "../php/config.php";

//Initialize arrays
$headline = [];
$image = [];
$text = [];

$roadDesc = [];
$fee = [];
$visitors = [];
$notices = [];

$extraPictures = array();
$counterMain = 2;
$counterSub = 0;

//Get number of attractions
$rowAttractions = mysqli_fetch_array($link->query("SELECT COUNT(*) AS Number FROM attractions"));
$numberOfAttractions = $rowAttractions["Number"];

//Put data in arrays
for ($x = 1; $x <= $numberOfAttractions; $x++) {
  $sql = "SELECT storymap_slides_text_headline FROM attractions WHERE storymap_slides_ID = $x";
  $resultheadline = $link->query($sql);
  if (!mysqli_num_rows($resultheadline) == 0) {
    while ($row = mysqli_fetch_array($resultheadline)) {
      $headline[] = $row["storymap_slides_text_headline"];
    }
  }
  $sql = "SELECT storymap_slides_media_url FROM attractions WHERE storymap_slides_ID = $x";
  $resultimage = $link->query($sql);
  if (!mysqli_num_rows($resultimage) == 0) {
    while ($row = mysqli_fetch_array($resultimage)) {
      $image[] = '../storage/attractions/' . $row["storymap_slides_media_url"];
    }
  }
  $sql = "SELECT storymap_slides_text_text FROM attractions WHERE storymap_slides_ID = $x";
  $resulttext = $link->query($sql);
  if (!mysqli_num_rows($resulttext) == 0) {
    while ($row = mysqli_fetch_array($resulttext)) {
      $text[] = $row["storymap_slides_text_text"];
    }
  }
  $sql = "SELECT storymap_slides_road_description FROM attractions WHERE storymap_slides_ID = $x";
  $resultroadDesc = $link->query($sql);
  if (!mysqli_num_rows($resultroadDesc) == 0) {
    while ($row = mysqli_fetch_array($resultroadDesc)) {
      $roadDesc[] = $row["storymap_slides_road_description"];
    }
  }
  $sql = "SELECT storymap_slides_entrance_fee FROM attractions WHERE storymap_slides_ID = $x";
  $resultfee = $link->query($sql);
  if (!mysqli_num_rows($resultfee) == 0) {
    while ($row = mysqli_fetch_array($resultfee)) {
      $fee[] = $row["storymap_slides_entrance_fee"];
    }
  }
  $sql = "SELECT storymap_slides_visitors FROM attractions WHERE storymap_slides_ID = $x";
  $resultvisitors = $link->query($sql);
  if (!mysqli_num_rows($resultvisitors) == 0) {
    while ($row = mysqli_fetch_array($resultvisitors)) {
      $visitors[] = $row["storymap_slides_visitors"];
    }
  }
  $sql = "SELECT storymap_slides_notices FROM attractions WHERE storymap_slides_ID = $x";
  $resultnotices = $link->query($sql);
  if (!mysqli_num_rows($resultnotices) == 0) {
    while ($row = mysqli_fetch_array($resultnotices)) {
      $notices[] = $row["storymap_slides_notices"];
    }
  }
}

//Get multiple pictures, multidimentional array
while ($numberOfAttractions >= $counterMain) {
  $sql = "SELECT storymap_slides_media_url FROM attractionspicture WHERE storymap_slides_ID = $counterMain";
  $result = $link->query($sql);
  if (!mysqli_num_rows($result) == 0) {
    while ($row = mysqli_fetch_array($result)) {
      $extraPictures[$counterMain][$counterSub] = '../storage/attractions/' . $row['storymap_slides_media_url']; //The array is structures as this: $extraPictures[ID of attraction][Picture index]
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
$code_roadDesc = json_encode($roadDesc);
$code_fee = json_encode($fee);
$code_visitors = json_encode($visitors);
$code_notices = json_encode($notices);

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PRO1000</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--CSS Links Mobile-->
  <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
  <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
  <link rel="stylesheet" type="text/css" href="../css/mobile/attractions_mobile.css">
  <!--CSS Links Desktop-->
  <link rel="stylesheet" href="../css/desktop/attractions_desktop.css" />
  <link rel="stylesheet" type="text/css" href="../css/desktop/banner_desktop.css">
  <!--Navigation bar desktop-->
  <link rel="stylesheet" href="../css/desktop/nav_desktop.css" />
  <script src="../script/nav_desktop.js"></script>
  <!--CSS Links both-->
  <link rel="stylesheet" type="text/css" href="../css/attractions_both.css">
  <!--Scripts-->
  <script type="text/javascript" src="../script/attractions.js"></script>
</head>

<body>
  <!--Navigation bar desktop-->
  <nav class="desktop-nav">
    <div id="btn-toggle-nav" onclick="meny()"></div>
    <img src="../storage/mobile/storymapbanner.jpg">
    <p class="logo_text">Enjoy a storymap of Barcelona's most beautiful places</p>
    <div id="desktop-links" class="nav-inactive">
      <div id="btn-toggle-nav-links" onclick="meny()"></div>
      <ul>
        <li><a href="../php/storymap.php">Home</a></li>
        <li><a href="../php/attractions.php">Attractions</a></li>
        <li><a href="../php/trips.php">Trips</a></li>
        <li><a href="../php/accountpage.php">Account</a></li>
        <li><a href="../php/about.php">About us</a></li>
      </ul>
    </div>
  </nav>
  <!-- Banner -->
  <div class="logo">
    <img src="../storage/mobile/storymaplogo.png">
    <a href="#">Barcelona</a>
  </div>
  <div id="main">
    <div id="content">
      <h1>Attractions</h1>
      <p id="rec_days"><a id="all">All</a> | <a id="recommended">Recommended</a></p>
      <div id="overlay">
        <div id="overlayText"></div>
      </div>
      <div id="rec_container">
      </div>

      <div id="footer">
        <footer>
          <p id="date"></p>
        </footer>
      </div>
    </div>
  </div>
  <!-- Navigation bar -->
  <div class="navbar">
    <a href="../php/storymap.php">Home</a>
    <a class="active" href="../php/attractions.php">Attractions</a>
    <a href="../php/trips.php">Trips</a>
    <a href="../php/accountpage.php">Account</a>
  </div>

  <script>
    //Get array from php
    var headline = <?php echo $code_headline; ?>;
    var image = <?php echo $code_image; ?>;
    var text = <?php echo $code_text; ?>;
    var roadDesc = <?php echo $code_roadDesc ?>;
    var fee = <?php echo $code_fee ?>;
    var visitors = <?php echo $code_visitors ?>;
    var notices = <?php echo $code_notices ?>;

    //This is for the multidimentional images array
    var images = <?php echo $code_images; ?>;

    create_array(headline, image, text);
    create_image_array(image, images);
  </script>
</body>

</html>