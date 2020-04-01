<?php
// Initialize the session
session_start();
require_once "config.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
} else {
    header("location: ../php/login.php");
    exit;
}

//Variables
$user_id = $_SESSION["id"];
$admin = "";

//Get admin status
$getsql = "SELECT admin FROM users where ID ='$user_id'";
$result = $link->query($getsql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['admin'] == 1) {
            $admin = '<p><a href="adminPage.php">Admin</li> </a> </p>';
        }
    }
}

//Get username
$getsql = "SELECT username FROM users WHERE id = '$user_id'";
$result = $link->query($getsql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
    <title>StoryMap/Contact</title>
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/accountpage_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/contact_mobile.css">

</head>

<body>
    <!-- Banner -->
    <div class="logo">
        <img src="../storage/mobile/storymaplogo.png">
        <a href="#">Barcelona</a>
    </div>
    <div id="main">
        <img class="banner_img" src="../storage/mobile/storymapbanner.png"></img>
        <div id="header">
            <header><?php echo $_SESSION["username"] ?>'s Account</header>
        </div>
        <div id="content">
            <h1> Contact information</h1>
            <div id="overview">
                <p class="contact"> Mail Adress: </p>
                <p class="venstre"> Universitetet i Sørøst-Norge </p>
                <p class="venstre"> Postboks 235 </p>
                <p class="venstre"> 3603 Kongsberg </p>
                <p class="contact"> IT-support: </p>
                <li class="venstre"> E-post: it-support@usn.no </li>
                <li class="venstre"> Telefon: 31 00 82 00 </li>
                <p class="back_button"><a href="logout.php">Logout</a></p>
                <p class="back_button"><a href="accountpage.php">Back</a></p>
                <div id="footer">
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