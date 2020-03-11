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
  
    $sql = "DELETE FROM attractions WHERE storymap_slides_ID=$id";
  
    if ($link->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $link->error;
    }
  }
  mysqli_close($link);
?>