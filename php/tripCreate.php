<?php
// Initialize the session
session_start();
require_once "config.php";
$user_id = $_SESSION["id"];
$errorMsg = "";

//Initialize variables
$table = " <table id='table'> <tr> <th>Attraction</th> </tr> ";



//Get all attractions
$sql = "SELECT storymap_slides_ID, storymap_slides_text_headline,  storymap_slides_media_url FROM attractions";
$result = $link->query($sql);
if (!mysqli_num_rows($result) == 0) {
    while ($row = mysqli_fetch_array($result)) {
        $table .= "<tr><td style='height: 200px;'> <p style='text-align: center;'>" . $row['storymap_slides_text_headline'] . "</p><img src='" . "../storage/attractions/" . $row['storymap_slides_media_url'] . "'" . " alt='' style='width: 100%; height: 200px;'></img></td></tr>";
    }
}

if (!empty($_POST['data'])) {

    $tripJS = $_POST['data'];

    $sql = "INSERT INTO trips(userID, attractions) VALUES ($user_id, '$tripJS')";
    if ($link->query($sql) === TRUE) {
        print_r("Success!");
    } else {
        print_r($link->error);
    }
    exit();
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page</title>
    <script type ="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" href="../css/mobile/tripCreate_mobile.css">
</head>

<body>
    <!-- Banner -->
    <div class="logo">
        <img src="../storage/mobile/storymaplogo.png">
        <a href="#">Barcelona</a>
    </div>
    <div class="tripCreate">
        <p>Click save when you are done selecting:</p>
        <input class="submit_button" type="button" value="Save" id="save">
        <p class="back_button"><a href="accountpage.php">Back</a></p>
        <p>Choose attractions: </p>
        <div id='response'></div>

        <?php echo $table ?>
        </table>

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
        <a href="../php/about.php">About</a>
        <a class="active" href="../php/accountpage.php">Account</a>
    </div>

    <!-- Script to get attractions and send to php -->
    <script>
        var attractions = [];

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
                    data: { data: attractionPHP },
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