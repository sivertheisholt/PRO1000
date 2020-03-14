<?php
// Initialize the session
session_start();
require_once "config.php";
$currentUser = "";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  $currentUser = "Login";
} else {
  $currentUser = $_SESSION["username"];
}

$lat = "";
$lon = "";
$headline = "";
$text = "";
$url = "";
$caption = "";
$credit = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $headline = $_POST["headline"];
    $text = $_POST["text"];
    $url = $_POST["url"];
    $caption = $_POST["caption"];
    $credit = $_POST["credit"];

    $sql = "INSERT INTO attractions (storymap_slides_location_lat, 
    storymap_slides_location_lon, 
    storymap_slides_text_headline, 
    storymap_slides_text_text, 
    storymap_slides_media_url, 
    storymap_slides_media_caption, 
    storymap_slides_media_credit)
    VALUES ('$lat', '$lon', '$headline', '$text', '$url', '$caption', '$credit')";

    if ($link->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page</title>
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/hamburger.css">
    <link rel="stylesheet" href="../css/accountpage_mobile.css">
</head>
<body>
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
            <li><a href="../php/" + $loginornot><?php echo htmlspecialchars($currentUser); ?></a></li>
            <li><a href="../php/logout.php">Logout</a></li>
            <li><a href="../php/about.php">About</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!--Form edit attraction!-->
<div class="attractionsEdit">
    <form action="#" method="post">
        Attraction lat: <input type="text" name="lat" require><br>
        Attraction lon: <input type="text" name="lon" require><br>
        Attraction headline: <input type="text" name="headline" require><br>
        Attraction text: <input type="text" name="text" require><br>
        Attraction url: <input type="text" name="url"><br>
        Attraction caption: <input type="text" name="caption"><br>
        Attraction credit: <input type="text" name="credit"><br>
    <input type="submit">
</form>
<div>
</body>
</html>
