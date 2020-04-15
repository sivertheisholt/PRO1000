<?php
// Initialize the session
session_start();
require_once "config.php";
$user_id = $_SESSION["id"];
$errorMsg = "";

//Initialize variables
$table = "";
$select = '<select id="tripID" name="tripID">';
$saveButton = "";
$backButton = "";

//Get all lists
$sql = "SELECT ID, userID, tripname FROM trips WHERE userID = $user_id";
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

if (!empty($_POST['deleteId'])) {

    $deleteID = $_POST['tripID'];

    $sql = "DELETE FROM trips WHERE ID = $deleteID";
    if ($link->query($sql) === TRUE) {
        $errorMsg = "Trip successfully deleted";
    } else {
        $errorMsg = $link->error;
    }
}

if (!empty($_POST['selectId'])) {

    $table = " <div class='image_wrap'> ";
    $attractions = "";
    $sqlID = (int) $_POST['tripID'];
    $_SESSION['currentSelected'] = $sqlID;
    $attractionsIds = [];
    $found = 0;

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




    //Get all attractions, this is spaghetti...
    $sql = "SELECT storymap_slides_ID, storymap_slides_text_headline, storymap_slides_media_url FROM attractions";
    $result = $link->query($sql);
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
            for ($i = 0; $i < sizeof($attractionsIds); $i++) {
                if ($row['storymap_slides_ID'] == $attractionsIds[$i] && $row['storymap_slides_ID'] != 1) {
                    $found = 1;
                }
            }
            if ($found == 1) {
                $table .= "<div class='edit selected' data-name='".$row['storymap_slides_text_headline']."'> <p style='text-align: center;'>" . $row['storymap_slides_text_headline'] . "</p><img src='" . "../storage/attractions/" . $row['storymap_slides_media_url'] . "'" . " alt='' style='height: 200px; margin-left: auto; margin-right: auto;'></img></div>";
                $found = 0;
            } else if ($row['storymap_slides_ID'] == 1) {
            } else {
                $table .= "<div class='edit' data-name='".$row['storymap_slides_text_headline']."'> <p style='text-align: center;'>" . $row['storymap_slides_text_headline'] . "</p><img src='" . "../storage/attractions/" . $row['storymap_slides_media_url'] . "'" . " alt='' style='height: 200px; margin-left: auto; margin-right: auto;'></img></div>";
            }
        }
    }
    $saveButton = '<input class="submit_button save" type="button" value="Save">';
    $backButton = '<a href="accountpage.php"><p class="back_button">Back</p></a>';
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
    <link rel="stylesheet" type="text/css" href="../css/desktop/tripEdit_desktop.css">
    <link rel="stylesheet" type="text/css" href="../css/attraction_view.css">

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
                <li><a href="../php/about.php">About us</a></li>
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
            <h1>Choose trip to edit</h1>
            <?php echo $select ?>
            </select>
            <div id="editTripButtonSelect">
                <input class="submit_button" style="text-align: center;" type="submit" name="selectId" onclick='showSave()'>
                <input class="submit_button back_button" style="display: inline-block" type="submit" value="Delete" name="deleteId">
            </div>
            <div class="button_wrapper">
            <?php echo $saveButton ?>
                <a href="accountpage.php"><p class="back_button">Back</p></a>
            </div>
            <div id='response'></div>

            <!-- messages -->
            <?PHP
            if (isset($errorMsg) && $errorMsg) {
                echo "<p style=\"color: red;\">", htmlspecialchars($errorMsg), "</p>\n\n";
            }
            ?>
            <?php echo $table ?>
            <div class="button_wrapper">
                <?php echo $saveButton ?>
                <?php echo $backButton ?>
            </div>
        </form>  
    </div>

    <!-- Navigation bar -->
    <div class="navbar">
        <a href="../php/storymap.php">Home</a>
        <a href="../php/attractions.php">Attractions</a>
        <a href="../php/trips.php">Trips</a>
        <a class="active" href="../php/accountpage.php">Account</a>
    </div>
    <script>

        //Script to get attractions and send to php

        var attractions = ['barcelona'];

        function showSave() {
            console.log("hi");
            document.getElementById('saveDiv').style.visibility = 'visible';
        }

        $(".edit").click(function() {
            if ($(this).hasClass("selected")) {
                $(this).removeClass('selected')
            } else {
                $(this).addClass('selected');
            }
        });

        //Send data to php
        $(document).ready(function() {
            $('.save').click(function() {
                var allAttractionsSelected = document.getElementsByClassName('selected');
                for (var i = 0; i < allAttractionsSelected.length; ++i) {
                    var value = allAttractionsSelected[i].innerHTML;
                    //var attractionName = value.substring(59, value.indexOf("</p>"));
                    var attractionName = allAttractionsSelected[i].getAttribute("data-name");
                    console.log(attractionName);
                    attractions.push(attractionName);
                }
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
                        $('#response').text('Trip successfully updated!');
                    }
                });
            });
        });
    </script>
</body>

</html>