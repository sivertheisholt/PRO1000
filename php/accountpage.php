<?php
session_start();
require_once "config.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
} else {
    header("location: ../php/login.php");
    exit;
}

$user_id = $_SESSION["id"];

$getsql = "SELECT username FROM users WHERE id = '$user_id'";
$result = $link->query($getsql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $username = $row['username'];
  }
} else {
  echo "0 results";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page</title>
    <!--CSS Links-->
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/accountpage_mobile.css">
</head>
<body>
<div id="main">
<div id="header">
<header><?php echo $username?>'s Account</header>
</div>
<div id="navigation">
    <nav>
    </nav>
</div>

<div id="content">
    <h1> Dashboard</h1>

<div id="overview">
        <p> <a href="password.php"> Change password </li> </a> </p>
        
        <p> <a href="favourites.php"> Your favourites </li> </a> </p>
        
        <p> <a href="information.php"> Your information </li> </a> </p>

        <p><a href="logout.php">log out</a></p>
        <br>
<div id="footer">
    <footer>
        <p> <a href="contact.html" style="color: white"> Contact us!</li> </a> </p>    
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