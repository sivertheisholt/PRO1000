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

//Get username
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
    <title>Storymap</title>
    <!--CSS Links-->
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/accountpage_mobile.css">
</head>

<body>
    <div id="main">
        <img class="banner_img" src="../storage/mobile/storymapbanner.png"></img>
        <div id="header">
            <header><?php echo $_SESSION["username"]?>'s Account</header>
        </div>
        <div id="content">
            <h1> Admin Tools </h1>
            <div id="overview">
                <p><a href="adminAdd.php">Add Attraction</li> </a> </p>
                <p><a href="adminEdit.php">Edit/Remove Attractions</li> </a> </p>
                <p><a href="adminUploadPicture.php">Upload attraction picture</li> </a> </p>
                <p><a href="adminChange.php">Change top 15 attractions</li> </a> </p>
                <p><a href="adminUsers.php">Manage users</li> </a> </p>
                <p class="back_button"><a href="accountpage.php">Back</a></p>
                <div id="footer">
                    <footer>
                        <p> <a href="contact.html"> Contact us!</li> </a> </p>
                    </footer>
                </div>
            </div>
        </div>
        <!-- Navigation bar -->
        <div class="navbar">
            <a href="../php/storymap.php">Home</a>
            <a href="../php/attractions.php">Attractions</a>
            <a href="../php/about.php">About</a>
            <a class="active" href="../php/accountpage.php">Account</a>
        </div>
</body>

</html>