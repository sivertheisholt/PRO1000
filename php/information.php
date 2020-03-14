<?php
// Initialize the session
session_start();
$currentUser = "";
require_once "config.php";

//Checks if user is logged in, if not return to login page
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

$id = $_SESSION["id"];
$firstname = "";
$lastname = "";
$email = "";

//Get user data
//Firstname
$sql = "SELECT firstname FROM users WHERE id = $id";
$resultfirstname = $link->query($sql);
if (!mysqli_num_rows($resultfirstname)==0 ) { 
  while($row = mysqli_fetch_array($resultfirstname)){
    $firstname = $row["firstname"];
  }
}

//Lastname
$sql = "SELECT lastname FROM users WHERE id = $id";
$resultlastname = $link->query($sql);
if (!mysqli_num_rows($resultlastname)==0 ) { 
  while($row = mysqli_fetch_array($resultlastname)){
    $lastname = $row["lastname"];
  }
}

//email
$sql = "SELECT email FROM users WHERE id =  $id";
$resultemail = $link->query($sql);
if (!mysqli_num_rows($resultemail)==0 ) { 
  while($row = mysqli_fetch_array($resultemail)){
    $email = $row["email"];
  }
}
mysqli_close($link);
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

  <form action="accountpageHandler.php" method="post">

  <label for="fname">First Name:</label>
  <input type ="text" id="firstname" name="firstname" value='<?php echo $firstname?>' size="25"><br><br>

  <label for="lname">Last Name:</label>
  <input type ="text" id="lastname" name="lastname" value='<?php echo $lastname;?>' size="25"><br><br>

  <label for="email">E-Mail: &nbsp; &nbsp; &nbsp;</label>
  <input type ="text" id="email" name="email" value='<?php echo $email;?>' size="25"><br><br>

  <input type="submit" value="Save"><br><br>

</form>
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