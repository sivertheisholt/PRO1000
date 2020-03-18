<?php
session_start();
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    $id = $_SESSION['id'];
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $headline = $_POST["headline"];
    $text = $_POST["text"];
    $url = $_POST["url"];
    $caption = $_POST["caption"];
    $credit = $_POST["credit"];
  
    $sql = "UPDATE attractions SET storymap_slides_location_lat='$lat',
    storymap_slides_location_lon='$lon',
    storymap_slides_text_headline='$headline',
    storymap_slides_text_text='$text',
    storymap_slides_media_url='$url',
    storymap_slides_media_caption='$caption',
    storymap_slides_media_credit='$credit'
    WHERE storymap_slides_ID = $id";
  
    if ($link->query($sql) === TRUE) {
      header("location: ../php/accountpage.php");
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $link->error;
    }
  }
  mysqli_close($link);
?>