<?php
// Initialize the session
session_start();
require_once "config.php";
$user_id = $_SESSION["id"];
$errorMsg = "";

//Get admin status
if ($user_id == null) {
  header("location: ../php/login.php");
  exit;
}
$getsql = "SELECT admin FROM users where ID ='$user_id'";
$result = $link->query($getsql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if ($row['admin'] == 0) {
      header("location: ../php/accountpage.php");
      exit;
    }
  }
}

//Initialize variables
$select = '<select id="attractions" name="attractions">';
$lat = "";
$lon = "";
$text = "";
$headline = "";
$url = "";
$caption = "";
$credit = "";

$roadDesc = "";
$fee = "";
$visitors = "";
$notices = "";

$script = "style='visibility:hidden'";

//Get all attractions
$sql = "SELECT storymap_slides_ID, storymap_slides_text_headline FROM attractions";
$result = $link->query($sql);
if (!mysqli_num_rows($result) == 0) {
  while ($row = mysqli_fetch_array($result)) {
    $select .= '<option value="' . $row['storymap_slides_ID'] . '">' . $row['storymap_slides_ID'] . ". " . $row['storymap_slides_text_headline'] . '</option>';
  }
}

//Confirm selected attraction
if (!empty($_POST['confirm'])) {

  $x = (int) $_POST['attractions'];
  $_SESSION['attractionID'] = $x;

  //Get attraction details
  $sql = "SELECT storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit, storymap_slides_road_description, storymap_slides_entrance_fee, storymap_slides_visitors, storymap_slides_notices  FROM attractions WHERE storymap_slides_ID = $x";
  $result = $link->query($sql);
  if (!mysqli_num_rows($result) == 0) {
    while ($row = mysqli_fetch_array($result)) {
      $lat .= '<label class="label" for="lat">Attraction lat: </label> <input class="input_box" type="text" name="lat" value="' . $row['storymap_slides_location_lat'] . '">';
      $lon .= '<label class="label" for="lon">Attraction lon: </label> <input class="input_box" type="text" name="lon" value="' . $row['storymap_slides_location_lon'] . '">';
      $headline .= '<label class="label" for="headline">Attraction headline: </label> <input class="input_box" type="text" name="headline" value="' . $row['storymap_slides_text_headline'] . '">';
      $text .= '<label class="label" for="text">Attraction text: </label> <textarea id="input_box_text" class="input_box" type="text" name="text">' . $row['storymap_slides_text_text'] . '</textarea>';
      $url .= '<label class="label" for="url">Attraction picture: </label> <input class="input_box" type="text" name="url" value="' . $row['storymap_slides_media_url'] . '">';
      $caption .= '<label class="label" for="caption">Attraction caption: </label> <input class="input_box" type="text" name="caption" value="' . $row['storymap_slides_media_caption'] . '">';
      $credit .= '<label class="label" for="credit">Attraction credit: </label> <input class="input_box" type="text" name="credit" value="' . $row['storymap_slides_media_credit'] . '">';
      $roadDesc .= '<label class="label" for="roadDesc">How to get there: </label> <input class="input_box" type="text" name="roadDesc" value="' . $row['storymap_slides_road_description'] . '">';
      $fee .= '<label class="label" for="fee">Entrance fee: </label> <input class="input_box" type="text" name="fee" value="' . $row['storymap_slides_entrance_fee'] . '">';
      $visitors .= '<label class="label" for="visitors">Yearly visitors: </label> <input class="input_box" type="text" name="visitors" value="' . $row['storymap_slides_visitors'] . '">';
      $notices .= '<label class="label" for="notices">Notices: </label> <input class="input_box" type="text" name="notices" value="' . $row['storymap_slides_notices'] . '">';
    }
  }
  $script = "style='visibility:visible'";
}

//Delete attraction
if (!empty($_POST['delete'])) {

  $idDelete = $_SESSION['attractionID'];

  $sql = "DELETE FROM attractions WHERE storymap_slides_ID=$idDelete";
  if ($link->query($sql) === TRUE) {
    $errorMsg = "Attraction deleted!";
  } else {
    $errorMsg = "Error: " . $sql . "<br>" . $link->error;
  }
}

//Update attraction
if (!empty($_POST['update'])) {
  $idUpdate = $_SESSION['attractionID'];
  $latUpdate = $_POST["lat"];
  $lonUpdate = $_POST["lon"];
  $headlineUpdate = str_replace("'", '', $_POST["headline"]);
  $textUpdate = str_replace("'", '', $_POST["text"]);
  $urlUpdate = str_replace("'", '', $_POST["url"]);
  $captionUpdate = str_replace("'", '', $_POST["caption"]);
  $creditUpdate = str_replace("'", '', $_POST["credit"]);
  $roadDescUpdate = str_replace("'", '', $_POST["roadDesc"]);
  $feeUpdate = str_replace("'", '', $_POST["fee"]);
  $visitorsUpdate = str_replace("'", '', $_POST["visitors"]);
  $noticesUpdate = str_replace("'", '', $_POST["notices"]);

  $sql = "UPDATE attractions SET storymap_slides_location_lat='$latUpdate',
    storymap_slides_location_lon='$lonUpdate',
    storymap_slides_text_headline='$headlineUpdate',
    storymap_slides_text_text='$textUpdate',
    storymap_slides_media_url='$urlUpdate',
    storymap_slides_media_caption='$captionUpdate',
    storymap_slides_media_credit='$creditUpdate',
    storymap_slides_road_description='$roadDescUpdate',
    storymap_slides_entrance_fee='$feeUpdate',
    storymap_slides_visitors='$visitorsUpdate',
    storymap_slides_notices='$noticesUpdate'
    WHERE storymap_slides_ID = $idUpdate";

  if ($link->query($sql) === TRUE) {
    $errorMsg = "Sucessfully updated attraction!";
  } else {
    $errorMsg = "Error: " . $sql . "<br>" . $link->error;
  }
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
  <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
  <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
  <link rel="stylesheet" href="../css/mobile/adminEdit_mobile.css">
  <!--Desktop-->
  <link rel="stylesheet" href="../css/desktop/adminEdit_desktop.css">
  <link rel="stylesheet" type="text/css" href="../css/desktop/banner_desktop.css">

    <!--Navigation bar desktop-->
    <link rel="stylesheet" href="../css/desktop/nav_desktop.css" />
    <script src="../script/nav_desktop.js"></script>
</head>

<body>
<nav class="desktop-nav">
        <div id="btn-toggle-nav" onclick="meny()"></div>
        <img src="../storage/mobile/storymapbanner.jpg">
        <p class="logo_text">Enjoy a storymap of Barcelona's most beautiful places</p>
        <div id="desktop-links" class="nav-inactive">
            <div id="btn-toggle-nav-links" onclick="meny()"></div>
            <ul>
                <li><a href="../php/storymap.php">Home</a></li>
                <li><a href="../php/attractions.php">Attractions</a></li>
                <li><a href="../php/trips.php">Trips</a></li>
                <li><a href="../php/accountpage.php">Account</a></li>
            </ul>
        </div>
    </nav>
    <!-- Banner -->
    <div class="logo">
        <img src="../storage/mobile/storymaplogo.png">
        <a href="#">Barcelona</a>
    </div>
  <!--Form edit/delete attraction!-->
  <div class="attractionsEdit">
    <?PHP
    if (isset($errorMsg) && $errorMsg) {
      echo "<p style=\"color: red;\">", htmlspecialchars($errorMsg), "</p>\n\n";
    }
    ?>
    <form id="chooseList" action="#" method="post">
      <label class="label">Choose attraction</label>
      <?php echo $select ?>;
      <input class="submit_button" name="confirm" type="submit">
      <a href="adminPage.php"><p class="back_button">Back</p></a>
    </form>

    <form id="attractionsHandler" method="post">
      <?php echo $lat ?><br>
      <?php echo $lon ?><br>
      <?php echo $headline ?><br>
      <?php echo $text ?><br>
      <?php echo $url ?><br>
      <?php echo $caption ?><br>
      <?php echo $credit ?><br>
      <?php echo $roadDesc ?><br>
      <?php echo $fee ?><br>
      <?php echo $visitors ?><br>
      <?php echo $notices ?><br>
      <input id="save" <?php echo $script ?> class="submit_button" type="submit" name="update" value="Save" />
      <input id="delete" <?php echo $script ?> class="delete_button" type="submit" name="delete" value="Delete" />
    </form>
  </div>
  <!-- Navigation bar -->
  <div class="navbar">
    <a href="../php/storymap.php">Home</a>
    <a href="../php/attractions.php">Attractions</a>
    <a href="../php/trips.php">Trips</a>
    <a class="active" href="../php/accountpage.php">Account</a>
  </div>
</body>

</html>