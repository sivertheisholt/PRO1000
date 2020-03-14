<?php
session_start();
require_once "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    $id = $_SESSION['id'];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
  
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id='$id'";
  
    if ($link->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $link->error;
    }
  }
  mysqli_close($link);
?>