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
    if (!mysqli_num_rows($resultlat) == 0) {
        while ($row = mysqli_fetch_array($resultlat)) {
            $lat[] = $row["storymap_slides_location_lat"];
        }
    }
    $sql = "SELECT storymap_slides_location_lon FROM attractions WHERE storymap_slides_ID =$x";
    $resultlon = $link->query($sql);
    if (!mysqli_num_rows($resultlon) == 0) {
        while ($row = mysqli_fetch_array($resultlon)) {
            $lon[] = $row["storymap_slides_location_lon"];
        }
    }
    $sql = "SELECT storymap_slides_text_headline FROM attractions WHERE storymap_slides_ID = $x";
    $resultheadline = $link->query($sql);
    if (!mysqli_num_rows($resultheadline) == 0) {
        while ($row = mysqli_fetch_array($resultheadline)) {
            $headline[] = $row["storymap_slides_text_headline"];
        }
    }
    $sql = "SELECT storymap_slides_text_text FROM attractions WHERE storymap_slides_ID = $x";
    $resulttext = $link->query($sql);
    if (!mysqli_num_rows($resulttext) == 0) {
        while ($row = mysqli_fetch_array($resulttext)) {
            $text[] = $row["storymap_slides_text_text"];
        }
    }
    $sql = "SELECT storymap_slides_media_url FROM attractions WHERE storymap_slides_ID = $x";
    $resulturl = $link->query($sql);
    if (!mysqli_num_rows($resulturl) == 0) {
        while ($row = mysqli_fetch_array($resulturl)) {
            $url[] = $row["storymap_slides_media_url"];
        }
    }
    $sql = "SELECT storymap_slides_media_caption FROM attractions WHERE storymap_slides_ID = $x";
    $resultcaption = $link->query($sql);
    if (!mysqli_num_rows($resultcaption) == 0) {
        while ($row = mysqli_fetch_array($resultcaption)) {
            $caption[] = $row["storymap_slides_media_caption"];
        }
    }
    $sql = "SELECT storymap_slides_media_credit FROM attractions WHERE storymap_slides_ID = $x";
    $resultcredit = $link->query($sql);
    if (!mysqli_num_rows($resultcredit) == 0) {
        while ($row = mysqli_fetch_array($resultcredit)) {
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
    <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
    <link rel="stylesheet" href="../css/desktop/storymap_desktop.css">
    <link rel="stylesheet" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/desktop/banner_desktop.css">
    <link rel="stylesheet" href="https://cdn.knightlab.com/libs/storymapjs/latest/css/storymap.css" />
    <!--Navigation bar desktop-->
    <link rel="stylesheet" href="../css/desktop/nav_desktop.css" />
    <script src="../script/nav_desktop.js"></script>
</head>
<!-- Start of BODY section -->

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
    <!-- Storymap -->
    <div id="map"></div>
    <!-- Load Facebook SDK for JavaScript -->
    <script src="../script/fb.js"></script>
    <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/nb_NO/sdk.js#xfbml=1&version=v6.0"></script>
    
    <!-- Navigation bar -->
    <div class="navbar" style="font-family: Arial, Helvetica, sans-serif;">
        <a class="active" href="../php/storymap.php">Home</a>
        <a href="../php/attractions.php">Attractions</a>
        <a href="../php/trips.php">Trips</a>
        <a href="../php/accountpage.php">Account</a>
    </div>

    <!--Storymap external script-->
    <script type="text/javascript" src="https://cdn.knightlab.com/libs/storymapjs/latest/js/storymap-min.js"></script>

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

        var type;
        var slides = [];
        for (let i = 0; i < lat.length; i++) {
            if (i == 0) {
                type = 'overview';
                slides.push({
                    type: type,
                    text: {
                        headline: headline[i],
                        text: text[i]
                    },
                    media: {
                        url: '../storage/attractions/' + url[i],
                        caption: caption[i],
                        credit: credit[i]
                    }
                });
            } else {
                type = 'slide';
                slides.push({
                    type: type,
                    location: {
                        lat: lat[i],
                        lon: lon[i]
                    },
                    text: {
                        headline: headline[i],
                        text: text[i]
                    },
                    media: {
                        url: '../storage/attractions/' + url[i],
                        caption: caption[i],
                        credit: credit[i]
                    }
                });
            }
        }
        console.log(slides);
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
                slides
            }
        };

        //Storymap extra options
        var storymap_options = {};

        //Load storymap
        var storymap = new VCO.StoryMap('map', storymap_data, storymap_options);
        window.onresize = function(event) {
            storymap.updateDisplay(); // this isn't automatic
        }
    </script>
</body>
<footer>
    <div class="footer__wrapper">
        <div class="footer__text">
            <p>Share our storymap with your friends!</p>
        </div>
        <div class="fb-button">
            <div class="fb-share-button" data-href="http://localhost/Prosjekt/PRO1000/php/login.php" data-layout="button" data-size="small">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2FProsjekt%2FPRO1000%2Fphp%2Fstorymap.php&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a>
            </div>
        </div>
    </div>
</footer>

</html>