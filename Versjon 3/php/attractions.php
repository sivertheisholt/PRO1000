<?php
// Initialize the session
session_start();
$currentUser = "";
$loginornot = "";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  $currentUser = "Login";
  $loginornot = "login.php";
} else {
  $currentUser = $_SESSION["username"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRO1000</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/hamburger.css">
    <script type="text/javascript" src="../script/attractions.js"></script>
</head>
<body>
<div id="main">
<div id="header">
<header>Barcelona</header>	
</div>
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
            <li><a href="../php/login.php"><?php echo htmlspecialchars($currentUser); ?></a></li>
            <li><a href="../php/logout.php">Logout</a></li>
            <li><a href="../php/about.php">About</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--Navigation bar!-->
  <div class="topnav">
    <a class="active" href="storymap.php">Home</a>
    <a href="../php/login.php">Login</a>
    <a href="../php/register.php">Register</a>
    <a href="../php/attractions.php">Recommendations</a>
  </div>

<div id="content">
    <h1>Attractions</h1>
    <p id = "rec_days"><a id="tredager">3 dager</a> | <a id="femdager">5 dager</a></p>
    <div id ="overlay"><div id="overlayText"></div></div>
<div id="rec_container">
</div>

<div id="footer">
    <footer>
        <p><a href="" target="_blank">test</a></p>
        <p><a href="" target="_blank">test_2</a></p>
        <p id="date"></p>      
    </footer>
</div>
</div>   
</body>
</html>