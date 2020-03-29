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
$select= '<select id="attractions" name="attractions">';
$lat = ""; 
$lon = ""; 
$text = ""; 
$headline = ""; 
$url = ""; 
$caption = ""; 
$credit = ""; 

//Get all attractions
    $sql = "SELECT storymap_slides_ID, storymap_slides_text_headline FROM attractions";
    $result = $link->query($sql);
    if(!mysqli_num_rows($result)==0){
      while($row=mysqli_fetch_array($result)){
        $select.='<option value="'.$row['storymap_slides_ID'].'">'.$row['storymap_slides_ID'].". ".$row['storymap_slides_text_headline'].'</option>';
      }
    }

if($_SERVER["REQUEST_METHOD"] == "POST"){ 

  $x = (int)$_POST['attractions'];
  $_SESSION['attractionID'] = $x;

  //Get attraction details
  $sql = "SELECT storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit  FROM attractions WHERE storymap_slides_ID = $x";
  $result = $link->query($sql);
  if (!mysqli_num_rows($result)==0 ) { 
    while($row = mysqli_fetch_array($result)){
      $lat.='<label class="label" for="lat">Attraction lat: </label> <input class="input_box" type="text" name="lat" value="'.$row['storymap_slides_location_lat'].'">';
      $lon.='<label class="label" for="lon">Attraction lon: </label> <input class="input_box" type="text" name="lon" value="'.$row['storymap_slides_location_lon'].'">';
      $headline.='<label class="label" for="headline">Attraction headline: </label> <input class="input_box" type="text" name="headline" value="'.$row['storymap_slides_text_headline'].'">';
      $text.='<label class="label" for="text">Attraction text: </label> <textarea id="input_box_text" class="input_box" type="text" name="text">'.$row['storymap_slides_text_text'].'</textarea>';
      $url.='<label class="label" for="url">Attraction picture: </label> <input class="input_box" type="text" name="url" value="'.$row['storymap_slides_media_url'].'">';
      $caption.='<label class="label" for="caption">Attraction caption: </label> <input class="input_box" type="text" name="caption" value="'.$row['storymap_slides_media_caption'].'">';
      $credit.='<label class="label" for="credit">Attraction credit: </label> <input class="input_box" type="text" name="credit" value="'.$row['storymap_slides_media_credit'].'">';
    }
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
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" href="../css/mobile/adminEdit_mobile.css">
</head>

<body>
    <img class="banner_img" src="../storage/mobile/storymapbanner.png"></img>
    <!--Form edit/delete attraction!-->
    <div class="attractionsEdit">
        <form id="chooseList" action="#" method="post">
            <label class="label">Choose attraction</label>
            <?php echo $select ?>;
            <input class="submit_button" type="submit">
        </form>

        <form id="attractionsHandler" method="post">
            <?php echo $lat ?><br>
            <?php echo $lon ?><br>
            <?php echo $headline ?><br>
            <?php echo $text ?><br>
            <?php echo $url ?><br>
            <?php echo $caption ?><br>
            <?php echo $credit ?><br>
            <input class="submit_button" type="button" onclick='submitForm("adminEditHandler.php")' value="Save" />
            <input class="delete_button" type="button" onclick='submitForm("adminDeleteHandler.php")' value="Delete" />
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
    <script>
    function submitForm(action) {
        var form = document.getElementById('attractionsHandler');
        form.action = action;
        form.submit();
    }
    </script>
</body>

</html>