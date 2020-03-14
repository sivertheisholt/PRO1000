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
    <title>StoryMap/Account Page/Change password</title>
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/hamburger.css">
    <link rel="stylesheet" href="../css/accountpage_mobile.css">
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
            <li><a href="../php/accountpage.php"><?php echo htmlspecialchars($currentUser); ?></a></li>
            <li><a href="../php/logout.php">Logout</a></li>
            <li><a href="../php/about.php">About</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<div id="content">
    <h1> Your information </h1>

<div id="overview">

  <form action="/action_page.php">

  <label for="fname">First Name:</label>
  <input type="text" id="fname" name="fname" value="André" size="25"><br><br>

  <label for="lname">Last Name:</label>
  <input type="text" id="lname" name="lname" value="Seljåsen" size="25"><br><br>

  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value="andreseljasen" size="25"><br><br>

  <label for="email">E-Mail: &nbsp; &nbsp; &nbsp;</label>
  <input type="text" id="email" name="email"value="andreseljasen@hotmail.com" size="25"><br><br>

  <input type="submit" value="Save">
  <br>
  <br>

</form>

        <br>
<div id="footer">
    <footer>
        <p> <a href="contact.php" style="color: white"> Contact us!</li> </a> </p>
        <p id="date"></p>      
    </footer>
</div>
</div>
</div>  
</body>
</html>