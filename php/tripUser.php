<?php
// Initialize the session
session_start();
require_once "config.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
} else {
    header("location: ../php/register.php");
    exit;
}

$user_id = $_SESSION["id"];
$errorMsg = "";

//Initialize variables
$lat = [];
$lon = [];
$text = [];
$headline = [];
$url = [];
$caption = [];
$credit = [];
$select = '<select id="attractions" name="attractions">';
$startMap = "";

//Get all lists
$sql = "SELECT ID, userID, tripname FROM trips WHERE userID = $user_id";
$result = $link->query($sql);
if (!mysqli_num_rows($result) == 0) {
    while ($row = mysqli_fetch_array($result)) {
        $select .= '<option value="' . $row['ID'] . '">' . $row['tripname'] . '</option>';
    }
}

if (!empty($_POST['data'])) {

    $attractions = "";

    //Get attractions
    $sql = "SELECT attractions FROM trips WHERE userID = $user_id";
    $result = $link->query($sql);
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attractions = $row['attractions'];
        }
    }
    $attractionsArray = explode(",", $attractions);

    for ($i = 0; $i < sizeof($attractionsArray); $i++) {
        $sql = "SELECT storymap_slides_location_lat, 
        storymap_slides_location_lon, 
        storymap_slides_text_headline, 
        storymap_slides_text_text, 
        storymap_slides_media_url, 
        storymap_slides_media_caption, 
        storymap_slides_media_credit FROM attractions WHERE storymap_slides_text_headline = '$attractionsArray[$i]'";
        $resultlat = $link->query($sql);
        if (!mysqli_num_rows($resultlat) == 0) {
            while ($row = mysqli_fetch_array($resultlat)) {
                $lat[] = $row["storymap_slides_location_lat"];
                $lon[] = $row["storymap_slides_location_lon"];
                $text[] = $row["storymap_slides_text_text"];
                $headline[] = $row["storymap_slides_text_headline"];
                $url[] = $row["storymap_slides_media_url"];
                $caption[] = $row["storymap_slides_media_caption"];
                $credit[] = $row["storymap_slides_media_credit"];
            }
        }
    }
    $startMap = 'startMap()';
    $code_lat = json_encode($lat);
    $code_lon = json_encode($lon);
    $code_text = json_encode($text);
    $code_headline = json_encode($headline);
    $code_url = json_encode($url);
    $code_caption = json_encode($caption);
    $code_credit = json_encode($credit);
}




mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" href="../css/mobile/tripUser_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/desktop/banner_desktop.css">
    <link rel="stylesheet" type="text/css" href="../css/desktop/tripUser_desktop.css">
    <!--Navigation bar desktop-->
    <link rel="stylesheet" href="../css/desktop/nav_desktop.css" />
    <link rel="stylesheet" href="https://cdn.knightlab.com/libs/storymapjs/latest/css/storymap.css" />
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
                <li><a href="../php/about.php">About us</a></li>
            </ul>
        </div>
    </nav>
    <!-- Banner -->
    <div class="logo">
        <img src="../storage/mobile/storymaplogo.png">
        <a href="#">Barcelona</a>
    </div>
    <div class="tripUser">
        <form action="#" method="post">
            <h1>Choose trip to see</h1>
            <?php echo $select ?>
            </select>
            <div class="button_wrapper">
                <input class="submit_button" type="submit" name="data">
                <a href="accountpage.php"><p class="back_button">Back</a></p>
            </div>
        </form>

        <!-- messages -->
        <?PHP
        if (isset($errorMsg) && $errorMsg) {
            echo "<p style=\"color: red;\">", htmlspecialchars($errorMsg), "</p>\n\n";
        }
        ?>
        <!-- Storymap -->
        <div id="map" style="width: 100%; height: calc(100vh - 50px); z-index: 0;"></div>
    </div>

    <!-- Navigation bar -->
    <div class="navbar">
        <a href="../php/storymap.php">Home</a>
        <a href="../php/attractions.php">Attractions</a>
        <a href="../php/trips.php">Trips</a>
        <a class="active" href="../php/accountpage.php">Account</a>
    </div>
    <!--Storymap external script-->
    <script type="text/javascript" src="https://cdn.knightlab.com/libs/storymapjs/latest/js/storymap-min.js"></script>

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
        function startMap() {
            var storymap = new VCO.StoryMap('map', storymap_data, storymap_options);
            window.onresize = function(event) {
                storymap.updateDisplay(); // this isn't automatic
            }
        }
        <?php echo $startMap ?>
    </script>
</body>

</html>