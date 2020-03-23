<?php
// Initialize the session
session_start();

//Storymap load info from database
require_once "../php/config.php";

//Initialize arrays
$lat = []; 
$lon = []; 
$text = []; 
$headline = []; 
$url = []; 
$caption = []; 
$credit = []; 

//Put data in arrays
for ($x = 1; $x <= 16; $x++) {
    $sql = "SELECT storymap_slides_location_lat FROM attractions WHERE storymap_slides_ID = $x";
    $resultlat = $link->query($sql);
    if (!mysqli_num_rows($resultlat)==0 ) { 
      while($row = mysqli_fetch_array($resultlat)){
        $lat[] = $row["storymap_slides_location_lat"];
      }
    }
    $sql = "SELECT storymap_slides_location_lon FROM attractions WHERE storymap_slides_ID =$x";
    $resultlon = $link->query($sql);
    if (!mysqli_num_rows($resultlon)==0) { 
      while($row = mysqli_fetch_array($resultlon)){
        $lon[] = $row["storymap_slides_location_lon"];
      }
    }
    $sql = "SELECT storymap_slides_text_headline FROM attractions WHERE storymap_slides_ID = $x";
    $resultheadline = $link->query($sql);
    if (!mysqli_num_rows($resultheadline)==0) {
      while($row = mysqli_fetch_array($resultheadline)){
        $headline[] = $row["storymap_slides_text_headline"];
      }
    }
    $sql = "SELECT storymap_slides_text_text FROM attractions WHERE storymap_slides_ID = $x";
    $resulttext = $link->query($sql);
    if (!mysqli_num_rows($resulttext)==0) {
      while($row = mysqli_fetch_array($resulttext)){
        $text[] = $row["storymap_slides_text_text"];
      }
    }
    $sql = "SELECT storymap_slides_media_url FROM attractions WHERE storymap_slides_ID = $x";
    $resulturl = $link->query($sql);
    if (!mysqli_num_rows($resulturl)==0) {
      while($row = mysqli_fetch_array($resulturl)){
        $url[] = $row["storymap_slides_media_url"];
      }
    }
    $sql = "SELECT storymap_slides_media_caption FROM attractions WHERE storymap_slides_ID = $x";
    $resultcaption = $link->query($sql);
    if (!mysqli_num_rows($resultcaption)==0) {
      while($row = mysqli_fetch_array($resultcaption)){
        $caption[] = $row["storymap_slides_media_caption"];
      }
    }
    $sql = "SELECT storymap_slides_media_credit FROM attractions WHERE storymap_slides_ID = $x";
    $resultcredit = $link->query($sql);
    if (!mysqli_num_rows($resultcredit)==0) {
      while($row = mysqli_fetch_array($resultcredit)){
        $credit[] = $row["storymap_slides_media_credit"];
      }
    }
}

//Encode to json
$code_lat = json_encode($lat);
$code_lon = json_encode($lon);
$code_text = json_encode($text);
$code_headline = json_encode($headline);
$code_url = json_encode($url);
$code_caption = json_encode($caption);
$code_credit = json_encode($credit);


mysqli_close($link);
?>


<!DOCTYPE html>
<html>
  <!-- Start of HEAD section -->
  <head>
    <title>PRO1000</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/mobile/storymap_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link
      rel="stylesheet"
      href="https://cdn.knightlab.com/libs/storymapjs/latest/css/storymap.css"
    />
  </head>
  <!-- Start of BODY section -->
  <body>
    <!-- Storymap -->
    <div id="map" style="width: 100%; height: calc(100vh - 50px); z-index: 0;"></div>
    <!-- Navigation bar -->
    <div class="navbar" style="font-family: Arial, Helvetica, sans-serif;">
      <a class ="active" href="../php/storymap.php">Home</a>
      <a href="../php/attractions.php">Attractions</a>
      <a href="../php/about.php">About</a>
      <a href="../php/accountpage.php">Account</a>
    </div>

  <!--Storymap external script-->
    <script
      type="text/javascript"
      src="https://cdn.knightlab.com/libs/storymapjs/latest/js/storymap-min.js"
    ></script>

  <!--Storymap script-->
    <script>

      //Get array from php
      var lat = <?php echo $code_lat; ?>;
      var lon = <?php echo $code_lon; ?>;
      var text = <?php echo $code_text; ?>;
      var headline = <?php echo $code_headline; ?>;
      var url = <?php echo $code_url; ?>;
      var caption = <?php echo $code_caption; ?>;
      var credit = <?php echo $code_credit; ?>;

    //Storymap data path, contains slides info and storymap configurations
    var storymap_data = {
    "calculate_zoom": true,
    "storymap": {
      "language": "en",
      "calculate_zoom": true,
      "map_type": "osm:standard",
      "map_background_color": "white",
      "map_as_image": false,
      "font_css": "'PT Sans', sans-serif",
      "slides": [
        {
          "type": "overview",
          "location": {
            "lat": Number(lat[0]),
            "lon": Number(lon[0])
          },
          "text": {
            "headline": headline[0],
            "text": text[0]
          },
          "media": {
            "url": '../storage/attractions/' + url[0],
            "caption": caption[0],
            "credit": credit[0]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[1]),
            "lon": Number(lon[1])
          },
          "text": {
            "headline": headline[1],
            "text": text[1]
          },
          "media": {
            "url": '../storage/attractions/' + url[1],
            "caption": caption[1],
            "credit": credit[1]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[2]),
            "lon": Number(lon[2])
          },
          "text": {
            "headline": headline[2],
            "text": text[2]
          },
          "media": {
            "url": '../storage/attractions/' + url[2],
            "caption": caption[2],
            "credit": credit[2]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[3]),
            "lon": Number(lon[3])
          },
          "text": {
            "headline": headline[3],
            "text": text[3]
          },
          "media": {
            "url": '../storage/attractions/' + url[3],
            "caption": caption[3],
            "credit": credit[3]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[4]),
            "lon": Number(lon[4])
          },
          "text": {
            "headline": headline[4],
            "text": text[4]
          },
          "media": {
            "url": '../storage/attractions/' + url[4],
            "caption": caption[4],
            "credit": credit[4]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[5]),
            "lon": Number(lon[5])
          },
          "text": {
            "headline": headline[5],
            "text": text[5]
          },
          "media": {
            "url": '../storage/attractions/' + url[5],
            "caption": caption[5],
            "credit": credit[5]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[6]),
            "lon": Number(lon[6])
          },
          "text": {
            "headline": headline[6],
            "text": text[6]
          },
          "media": {
            "url": '../storage/attractions/' + url[6],
            "caption": caption[6],
            "credit": credit[6]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[7]),
            "lon": Number(lon[7])
          },
          "text": {
            "headline": headline[7],
            "text": text[7]
          },
          "media": {
            "url": '../storage/attractions/' + url[7],
            "caption": caption[7],
            "credit": credit[7]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[8]),
            "lon": Number(lon[8])
          },
          "text": {
            "headline": headline[8],
            "text": text[8]
          },
          "media": {
            "url": '../storage/attractions/' + url[8],
            "caption": caption[8],
            "credit": credit[8]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[9]),
            "lon": Number(lon[9])
          },
          "text": {
            "headline": headline[9],
            "text": text[9]
          },
          "media": {
            "url": '../storage/attractions/' + url[9],
            "caption": caption[9],
            "credit": credit[9]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[10]),
            "lon": Number(lon[10])
          },
          "text": {
            "headline": headline[10],
            "text": text[10]
          },
          "media": {
            "url": '../storage/attractions/' + url[10],
            "caption": caption[10],
            "credit": credit[10]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[11]),
            "lon": Number(lon[11])
          },
          "text": {
            "headline": headline[11],
            "text": text[11]
          },
          "media": {
            "url": '../storage/attractions/' + url[11],
            "caption": caption[11],
            "credit": credit[11]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[12]),
            "lon": Number(lon[12])
          },
          "text": {
            "headline": headline[12],
            "text": text[12]
          },
          "media": {
            "url": '../storage/attractions/' + url[12],
            "caption": caption[12],
            "credit": credit[12]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[13]),
            "lon": Number(lon[13])
          },
          "text": {
            "headline": headline[13],
            "text": text[13]
          },
          "media": {
            "url": '../storage/attractions/' + url[13],
            "caption": caption[13],
            "credit": credit[13]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[14]),
            "lon": Number(lon[14])
          },
          "text": {
            "headline": headline[14],
            "text": text[14]
          },
          "media": {
            "url": '../storage/attractions/' + url[14],
            "caption": caption[14],
            "credit": credit[14]
          }
        },
        {
          "type": "slide",
          "location": {
            "lat": Number(lat[15]),
            "lon": Number(lon[15])
          },
          "text": {
            "headline": headline[15],
            "text": text[15]
          },
          "media": {
            "url": '../storage/attractions/' + url[15],
            "caption": caption[15],
            "credit": credit[15]
          }
        }
      ]
    }
  };

      //Storymap extra options
      var storymap_options = {};

      //Load storymap
      var storymap = new VCO.StoryMap('map', storymap_data, storymap_options);
      window.onresize = function (event) {
          storymap.updateDisplay(); // this isn't automatic
      }
    </script>
  </body>
</html>
