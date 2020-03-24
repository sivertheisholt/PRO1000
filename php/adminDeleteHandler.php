<?php
// Initialize the session
session_start();
require_once "config.php";
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

if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    $id = $_SESSION['attractionID'];
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