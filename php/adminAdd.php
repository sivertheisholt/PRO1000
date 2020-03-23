<?php
// Initialize the session
session_start();
require_once "config.php";
$currentUser = "";
$user_id = $_SESSION["id"];

//Get admin status
$getsql = "SELECT admin FROM users where ID ='$user_id'";
$result = $link->query($getsql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($row['admin'] == 0) {
          header("location: ../php/accountpage.php");
          exit;
        }
    }
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

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page</title>
    <!--CSS Links-->
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" href="../css/mobile/adminAdd_mobile.css">
</head>

<body>
    <img class="banner_img" src="../storage/mobile/storymapbanner.png"></img>
    <p>Add attraction<p>
            <div class="attractionsAdd">
                <!--Form edit attraction!-->
                <form action="#" method="post">
                    <label class="label" for="lat">Attraction lat: </label>
                    <input class="input_box" type="text" name="lat" required><br>

                    <label class="label" for="lon">Attraction lon: </label>
                    <input class="input_box" type="text" name="lon" required><br>

                    <label class="label" for="headline">Attraction headline: </label>
                    <input class="input_box" type="text" name="headline" required><br>

                    <label class="label" for="text">Attraction text: </label>
                    <textarea id="input_box_text" class="input_box" type="text" name="text"></textarea><br>

                    <label class="label" for="url">Attraction url: </label>
                    <input class="input_box" type="text" name="url"><br>

                    <label class="label" for="caption">Attraction caption: </label>
                    <input class="input_box" type="text" name="caption"><br>

                    <label class="label" for="credit">Attraction credit: </label>
                    <input class="input_box" type="text" name="credit">

                    <input class="submit_button" type="submit">
                    <p class="back_button"><a href="adminPage.php">Back</a></p>
                </form>
            </div>

            <!-- Navigation bar -->
            <div class="navbar">
                <a href="../php/storymap.php">Home</a>
                <a href="../php/attractions.php">Attractions</a>
                <a href="../php/about.php">About</a>
                <a class="active" href="../php/accountpage.php">Account</a>
            </div>
</body>

</html>