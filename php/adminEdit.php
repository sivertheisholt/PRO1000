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
  $sql = "SELECT storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit  FROM attractions WHERE storymap_slides_ID = $x";
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

  $sql = "UPDATE attractions SET storymap_slides_location_lat='$latUpdate',
    storymap_slides_location_lon='$lonUpdate',
    storymap_slides_text_headline='$headlineUpdate',
    storymap_slides_text_text='$textUpdate',
    storymap_slides_media_url='$urlUpdate',
    storymap_slides_media_caption='$captionUpdate',
    storymap_slides_media_credit='$creditUpdate'
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
</head>

<body>
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
      <p class="back_button"><a href="adminPage.php">Back</a></p>
    </form>

    <form id="attractionsHandler" method="post">
      <?php echo $lat ?><br>
      <?php echo $lon ?><br>
      <?php echo $headline ?><br>
      <?php echo $text ?><br>
      <?php echo $url ?><br>
      <?php echo $caption ?><br>
      <?php echo $credit ?><br>
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