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
<html>
  <head>
    <title>PRO1000</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/hamburger.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css" />
    <link
      rel="stylesheet"
      href="https://cdn.knightlab.com/libs/storymapjs/latest/css/storymap.css"
    />
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
  <!--Navigation bar!-->
  <div class="topnav">
    <a class="active" href="storymap.php">Home</a>
    <a href="../php/login.php">Login</a>
    <a href="../php/register.php">Register</a>
    <a href="../php/recommendations.php">Recommendations</a>
  </div>
  <!--The storymap-->
  <div id="map" style="width: 100%; height: 720px; z-index: 0;"></div>

    <!--Storymap scripts-->
    <script
      type="text/javascript"
      src="https://cdn.knightlab.com/libs/storymapjs/latest/js/storymap-min.js"
    ></script>
    <script src="../script/map.js"></script>
  </body>
</html>
