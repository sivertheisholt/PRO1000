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

//Initialize variables
$select = '<select id="attractions" name="attractions">';
$select2 = '<select id="attractions2" name="attractions2">';

//Get all attractions
$sql = "SELECT storymap_slides_ID, storymap_slides_text_headline FROM attractions";
$result = $link->query($sql);
if(!mysqli_num_rows($result)==0){
  while($row=mysqli_fetch_array($result)){
    $select.='<option value="'.$row['storymap_slides_ID'].'">'.$row['storymap_slides_ID'].". ".$row['storymap_slides_text_headline'].'</option>';
    $select2.='<option value="'.$row['storymap_slides_ID'].'">'.$row['storymap_slides_ID'].". ".$row['storymap_slides_text_headline'].'</option>';
  }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Get chosen attraction ID
    $x = (int)$_POST['attractions'];
    $x2 = (int)$_POST['attractions2'];

    //First check for pictures
    $sql = "UPDATE attractionspicture SET storymap_slides_ID=999 WHERE storymap_slides_ID='$x'";
    $link->query($sql);
    $sql = "UPDATE attractionspicture SET storymap_slides_ID='$x' WHERE storymap_slides_ID='$x2'";
    $link->query($sql);
    $sql = "UPDATE attractionspicture SET storymap_slides_ID='$x2' WHERE storymap_slides_ID=999";
    $link->query($sql);

    //Get attraction details
    $sql = "UPDATE attractions SET storymap_slides_ID=9999 WHERE storymap_slides_ID='$x'";
    $link->query($sql);
    $sql = "UPDATE attractions SET storymap_slides_ID='$x' WHERE storymap_slides_ID = '$x2'";
    $link->query($sql);
    $sql = "UPDATE attractions SET storymap_slides_ID='$x2' WHERE storymap_slides_ID = 9999";
    $link->query($sql);
    $result = $link->query($sql);
}
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page</title>
    <!--CSS Links-->
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" href="../css/mobile/adminChange_mobile.css">
</head>

<body>
    <img class="banner_img" src="../storage/mobile/storymapbanner.png"></img>
    <div class="attractionsChange">
        <!--Form edit attraction!-->
        <form action="#" method="post">
            <h1>Choose attraction to replace</h1>
            <?php echo $select ?>;
            </select>
            <h1>Choose new attraction</h1>
            <?php echo $select2 ?>;
            </select>
            <input class="submit_button" type="submit">
            <p class="back_button"><a href="adminPage.php">Back</a></p>
        </form>
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