<?php
session_start();
require_once "config.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location: register.php");
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

    <link rel="stylesheet" href="accountpage.css">
</head>
<body>
<div id="main">
    <a href="../../index.html"> <img src="hom.png" alt="logo" height="50"> </a>
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
        <p> <a href="password.php" style="color: black"> Change password </li> </a> </p>
        
        <p> <a href="favourites.php" style="color: black"> Your favourites </li> </a> </p>
        
        <p> <a href="information.php" style="color: black"> Your information </li> </a> </p>

        <p><a href="logout.php">log out </a></p>
        <br>
<div id="footer">
    <footer>
        <p> <a href="contact.html" style="color: white"> Contact us!</li> </a> </p>    
    </footer>
</div>
</div>
</div>  
</body>
</html>