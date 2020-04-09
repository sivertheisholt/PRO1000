<?php
// Initialize the session
session_start();
require_once "config.php";
$user_id = $_SESSION["id"];
$errorMsg = "";

//Initialize variables
$table = "";
$select = '<select id="tripID" name="tripID">';

//Get all lists
$sql = "SELECT ID, userID, tripname FROM trips";
$result = $link->query($sql);
if (!mysqli_num_rows($result) == 0) {
    while ($row = mysqli_fetch_array($result)) {
        $select .= '<option value="' . $row['ID'] . '">' . $row['tripname'] . '</option>';
    }
}

if (!empty($_POST['save'])) {

    $tripJS = $_POST['save'];
    $sqlID = $_SESSION['currentSelected'];

    $sql = "UPDATE trips SET attractions = '$tripJS' WHERE ID = $sqlID";
    print_r($sql);
    if ($link->query($sql) === TRUE) {
        print_r("Success!");
    } else {
        print_r($link->error);
    }
    exit();
}

if (!empty($_POST['selectId'])) {

    $table = " <table id='table'> <tr> <th></th> </tr> ";
    $attractions = "";
    $sqlID = (int) $_POST['tripID'];
    $_SESSION['currentSelected'] = $sqlID;
    $attractionsIds = [];
    $counter = 0;

    //Get attractions from trip
    $sql = "SELECT attractions FROM trips WHERE ID = $sqlID";
    $result = $link->query($sql);
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
            $attractions = $row['attractions'];
        }
    }
    $attractionsArray = explode(",", $attractions);

    //Get ID for each attraction
    for ($i = 0; $i < sizeof($attractionsArray); $i++) {
        //Get attractions from trip
        $sql = "SELECT storymap_slides_ID FROM attractions WHERE storymap_slides_text_headline = '$attractionsArray[$i]'";
        $result = $link->query($sql);
        if (!mysqli_num_rows($result) == 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($attractionsIds, $row['storymap_slides_ID']);
            }
        }
    }

    //Get all attractions
    $sql = "SELECT storymap_slides_ID, storymap_slides_text_headline, storymap_slides_media_url FROM attractions";
    $result = $link->query($sql);
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row['storymap_slides_ID'] == 1) {
                //Do nothing, skip overview slide
            } else {
                if (sizeof($attractionsIds) > $counter) {
                    if ((int) $row['storymap_slides_ID'] == (int) $attractionsIds[$counter]) {
                        $table .= "<tr class='selected'><td style='height: 200px;'> <p style='text-align: center;'>" . $row['storymap_slides_text_headline'] . "</p><img src='" . "../storage/attractions/" . $row['storymap_slides_media_url'] . "'" . " alt='' style='width: 100%; max-width: 400px; height: 200px; margin-left: auto; margin-right: auto;'></img></td></tr>";
                        $counter++;
                    } else {
                        $table .= "<tr><td style='height: 200px;'> <p style='text-align: center;'>" . $row['storymap_slides_text_headline'] . "</p><img src='" . "../storage/attractions/" . $row['storymap_slides_media_url'] . "'" . " alt='' style='width: 100%; max-width: 400px; height: 200px; margin-left: auto; margin-right: auto;'></img></td></tr>";
                    }
                } else {
                    $table .= "<tr><td style='height: 200px;'> <p style='text-align: center;'>" . $row['storymap_slides_text_headline'] . "</p><img src='" . "../storage/attractions/" . $row['storymap_slides_media_url'] . "'" . " alt='' style='width: 100%; max-width: 400px; height: 200px; margin-left: auto; margin-right: auto;'></img></td></tr>";
                }
            }
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Mobile -->
    <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" href="../css/mobile/tripEdit_mobile.css">
    <!-- Desktop -->
    <link rel="stylesheet" href="../css/desktop/tripCreate_desktop.css">
    <link rel="stylesheet" type="text/css" href="../css/desktop/banner_desktop.css">

    <!--Navigation bar desktop-->
    <link rel="stylesheet" href="../css/desktop/nav_desktop.css" />
    <script src="../script/nav_desktop.js"></script>

</head>

<body>
    <!-- Banner -->
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
    <div class="tripEdit">
        <form action="#" method="post">
            <h1>Choose trip to see</h1>
            <?php echo $select ?>
            </select>
            <input class="submit_button" type="submit" name="selectId">
        </form>
        <?php echo $table ?>
        </table>
        <div id='response'></div>
        <div class="button_wrapper">
            <input class="submit_button" type="button" value="Save" id="save">
            <p class="back_button"><a href="accountpage.php">Back</a></p>
        </div>

        <!-- messages -->
        <?PHP
        if (isset($errorMsg) && $errorMsg) {
            echo "<p style=\"color: red;\">", htmlspecialchars($errorMsg), "</p>\n\n";
        }
        ?>
    </div>

    <!-- Navigation bar -->
    <div class="navbar">
        <a href="../php/storymap.php">Home</a>
        <a href="../php/attractions.php">Attractions</a>
        <a href="../php/trips.php">Trips</a>
        <a class="active" href="../php/accountpage.php">Account</a>
    </div>

    <!-- Script to get attractions and send to php -->
    <script>
        var attractions = ['barcelona'];

        $("#table tr").click(function() {
            if ($(this).hasClass("selected")) {
                $(this).removeClass('selected')
                var value = $(this).find('td:first').html();
                var attraction = value.substring(32, value.indexOf("</p>"));
                var index = attractions.indexOf(attraction);
                if (index > -1) {
                    attractions.splice(index, 1);
                }
            } else {
                $(this).addClass('selected');
                var value = $(this).find('td:first').html();
                var attraction = value.substring(32, value.indexOf("</p>"));
                attractions.push(attraction);
            }
        });

        //Send data to php
        $(document).ready(function() {
            $('#save').click(function() {
                    var attractionPHP = attractions.join();
                    $.ajax({
                        method: 'post',
                        data: {
                            save: attractionPHP
                        },
                        success: function(res) {
                            console.log(res);
                            $('#response').css('color', 'red');
                            $('#response').css('text-align', 'center');
                            $('#response').text('Trip successfully created!!');
                        }
                    });
            });
        });
    </script>
</body>

</html>