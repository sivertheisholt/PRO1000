<?php
// Initialize the session
session_start();
$currentUser = "";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  $currentUser = "Login";
} else {
  $currentUser = $_SESSION["username"];
}

//Start connection to database
require_once "config.php";

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
  $_SESSION['id'] = $x;

  //Lat
  $sql = "SELECT storymap_slides_location_lat FROM attractions WHERE storymap_slides_ID = $x";
  $resultlat = $link->query($sql);
  if (!mysqli_num_rows($resultlat)==0 ) { 
    while($row = mysqli_fetch_array($resultlat)){
      $lat.='<input type="text" name="lat" value="'.$row['storymap_slides_location_lat'].'">'.'</option>';
    }
  }

  //Lon
  $sql = "SELECT storymap_slides_location_lon FROM attractions WHERE storymap_slides_ID = $x";
  $resultlon = $link->query($sql);
  if (!mysqli_num_rows($resultlon)==0 ) { 
    while($row = mysqli_fetch_array($resultlon)){
      $lon.='<input type="text" name="lon" value="'.$row['storymap_slides_location_lon'].'">'.'</option>';
    }
  }

  //Headline
  $sql = "SELECT storymap_slides_text_headline FROM attractions WHERE storymap_slides_ID = $x";
  $resultheadline = $link->query($sql);
  if (!mysqli_num_rows($resultheadline)==0 ) { 
    while($row = mysqli_fetch_array($resultheadline)){
      $headline.='<input type="text" name="headline" value="'.$row['storymap_slides_text_headline'].'">'.'</option>';
    }
  }

  //Text
  $sql = "SELECT storymap_slides_text_text FROM attractions WHERE storymap_slides_ID = $x";
  $resulttext = $link->query($sql);
  if (!mysqli_num_rows($resulttext)==0 ) { 
    while($row = mysqli_fetch_array($resulttext)){
      $text.='<input type="text" name="text" value="'.$row['storymap_slides_text_text'].'">'.'</option>';
    }
  }

  //URL
  $sql = "SELECT storymap_slides_media_url FROM attractions WHERE storymap_slides_ID = $x";
  $resulturl = $link->query($sql);
  if (!mysqli_num_rows($resulturl)==0 ) { 
    while($row = mysqli_fetch_array($resulturl)){
      $url.='<input type="text" name="url" value="'.$row['storymap_slides_media_url'].'">'.'</option>';
    }
  }
  
  //Caption
  $sql = "SELECT storymap_slides_media_caption FROM attractions WHERE storymap_slides_ID = $x";
  $resultcaption = $link->query($sql);
  if (!mysqli_num_rows($resultcaption)==0 ) { 
    while($row = mysqli_fetch_array($resultcaption)){
      $caption.='<input type="text" name="caption" value="'.$row['storymap_slides_media_caption'].'">'.'</option>';
    }
  }

  //Credit
  $sql = "SELECT storymap_slides_media_credit FROM attractions WHERE storymap_slides_ID = $x";
  $resultcredit = $link->query($sql);
  if (!mysqli_num_rows($resultcredit)==0 ) { 
    while($row = mysqli_fetch_array($resultcredit)){
      $credit.='<input type="text" name="credit" value="'.$row['storymap_slides_media_credit'].'">'.'</option>';
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
    <link rel="stylesheet" href="../css/mobile/accountpage_mobile.css">
</head>
<body>
  <!--Form edit/delete attraction!-->
  <div class="attractionsEdit">
    <form action="#" method="post">
      <label for="attractions">Choose an attraction:</label>
      <?php echo $select ?>;
      <input type="submit">
    </form>
    <form id="attractionsHandler" method="post">
      Attraction lat: <?php echo $lat ?><br>
      Attraction lon: <?php echo $lon ?><br>
      Attraction headline: <?php echo $headline ?><br>
      Attraction text: <?php echo $text ?><br>
      Attraction url: <?php echo $url ?><br>
      Attraction caption: <?php echo $caption ?><br>
      Attraction credit: <?php echo $credit ?><br>
      <input type="button" onclick="submitForm('adminEditHandler.php')" value="Save"/>
      <input type="button" onclick="submitForm('adminDeleteHandler.php')" value="Delete"/>
    </form>
  <div>
  <script> 
    function submitForm(action) {
      var form = document.getElementById('attractionsHandler');
      form.action = action;
      form.submit();
    }
    </script>
<!-- Navigation bar -->
<div class="navbar">
  <a href="../php/storymap.php">Home</a>
  <a href="../php/attractions.php">Attractions</a>
  <a href="../php/about.php">About</a>
  <a class ="active" href="../php/accountpage.php">Account</a>
</div>
</body>
</html>