<?php
// Initialize the session
session_start();
$currentUser = "";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
} else {
  header("location: ../php/login.php");
  exit;
}

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  $currentUser = "Login";
} else {
  $currentUser = $_SESSION["username"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page/Your favourites</title>
    <!--CSS Links-->
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/accountpage_mobile.css">
    <script type="text/javascript" src="../script/yourFavourites.js"></script>
</head>
<body>

<div id="content"> <h1> Your favourites </h1>

<div id="overview">
    <p><a id="yourFavourites"> Click to see your favourite attractions </a>
        <br>
        <br>
        
<div id="footer">
    <footer>
        <p> <a href="contact.php" style="color: white"> Contact us!</li> </a> </p>
        <p id="date"></p>      
    </footer>
</div>
</div>
</div>
  <!-- Navigation bar -->
  <div class="navbar">
    <a href="../php/storymap.php">Home</a>
    <a href="../php/attractions.php">Attractions</a>
    <a href="../php/about.php">About</a>
    <a class ="active" href="../php/accountpage.php">Account</a>
  </div>
</body>
</html>