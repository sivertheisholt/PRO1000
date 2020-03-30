<?php
// Initialize the session
session_start();
require_once "config.php";
$user_id = $_SESSION["id"];
$errorMsg = "";

//Get admin status
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
$table = "";
$script = "style='visibility:hidden'";
$fileUpload = "";

//Get all attractions
$sql = "SELECT storymap_slides_ID, storymap_slides_text_headline FROM attractions";
$result = $link->query($sql);
if (!mysqli_num_rows($result) == 0) {
    while ($row = mysqli_fetch_array($result)) {
        $select .= '<option value="' . $row['storymap_slides_ID'] . '">' . $row['storymap_slides_ID'] . ". " . $row['storymap_slides_text_headline'] . '</option>';
    }
}

//Get selected attraction
if (!empty($_POST['chooseAttraction'])) {

    $x = (int) $_POST['attractions'];
    $_SESSION['attractionID'] = $x;


    $sql = "SELECT storymap_slides_media_url FROM attractionspicture WHERE storymap_slides_ID = $x";
    $result = $link->query($sql);
    if (!mysqli_num_rows($result) == 0) {
        $table .= " <table id='table'> <tr> <th>Attraction</th> </tr> ";
        while ($row = mysqli_fetch_array($result)) {
            $table .= "<tr>   <td style='height: 200px;'><img src='" . "../storage/attractions/" . $row['storymap_slides_media_url'] . "'" . " alt='' style='width: 100%; height: 200px;'></img></td>     </tr>";
            $errorMsg = "";
        }
    } else {
        $errorMsg = "No pictures";
    }
    $script = "style='visibility:visible'";
    $fileUpload = '<h1>Upload picture:</h1> <form action="#" method="post" enctype="multipart/form-data"> <input type="file" name="fileToUpload" onchange=form.submit()> </form>';
    $_GET['updateFilename'] = "";
    $_GET['deleteFilename'] = "";
}

if (!empty($_GET['updateFilename'])) {
    //Update
    $filename = $_GET['updateFilename'];
    $x = $_SESSION['attractionID'];
    $oldFilename = "";

    //Get old filename
    $sql = "SELECT storymap_slides_media_url FROM attractions WHERE storymap_slides_ID = $x";
    $result = $link->query($sql);
    if (!mysqli_num_rows($result) == 0) {
        while ($row = mysqli_fetch_array($result)) {
            $oldFilename = $row['storymap_slides_media_url'];
        }
    } else {
        $errorMsg = "Attraction not found!";
    }

    //Set new filename on attractions table
    $sql = "UPDATE attractions SET storymap_slides_media_url='$filename' WHERE storymap_slides_ID=$x";
    if ($link->query($sql) === TRUE) {
    } else {
        $errorMsg = "Error: " . $sql . "<br>" . $link->error;
    }

    //Set old filename on picture table
    $sql = "UPDATE attractionspicture SET storymap_slides_media_url='$oldFilename' WHERE storymap_slides_media_url='$filename'";
    if ($link->query($sql) === TRUE) {
        $errorMsg = "Sucessfully updated attraction!";
    } else {
        $errorMsg = "Error: " . $sql . "<br>" . $link->error;
    }
}

if (!empty($_GET['deleteFilename'])) {
    $filename = $_GET['deleteFilename'];
    $x = $_SESSION['attractionID'];

    $sql = "DELETE FROM attractionspicture WHERE storymap_slides_media_url='$filename'";
    if ($link->query($sql) === TRUE) {
        if (unlink("../storage/attractions/" . $filename)) {
            $errorMsg = "Picture successfully deleted!";
        } else {
            $errorMsg = "Error from delete";
        }
    } else {
        $errorMsg = "Error: " . $sql . "<br>" . $link->error;
    }
}

if (isset($_FILES['fileToUpload'])) {
    //Upload picture
    $target_dir = "../storage/attractions/";
    $filename = date("Y-m-d") . "_" . date("H-i-s") . "_" . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $x = $_SESSION['attractionID'];

    // Check if image file is a actual image or fake image
    if ($check !== false) {
        $errorMsg = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errorMsg = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $errorMsg = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
        $errorMsg = "Sorry only JPG or JPEG allowed";
        $uploadOk = 0;
    }

    if (!$uploadOk == 0) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $errorMsg = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            //Update database
            $sql = "INSERT INTO attractionspicture (storymap_slides_ID, storymap_slides_media_url) VALUES ($x, '$filename')";
            if ($link->query($sql) === TRUE) {
                $fileUpload = "<p style=\"color: red;\">" . "File uploaded!" . "</p>\n\n";
            } else {
                $errorMsg = "Error: " . $sql . "<br>" . $link->error;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--CSS Links-->
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" href="../css/mobile/adminUploadPicture_mobile.css">
</head>

<body>
    <img class="banner_img" src="../storage/mobile/storymapbanner.png"></img>
    <div class="attractionsUpload">
        <!--Form edit attraction!-->
        <form action="#" method="post">
            <h1>Choose attraction</h1>
            <?php echo $select ?>;
            </select>
            <input class="submit_button" type="submit" name="chooseAttraction">
            <p class="back_button"><a href="adminPage.php">Back</a></p><br>
            <input class="submit_button" <?php echo $script ?> type="button" value="Make primary picture" onclick="updateDB()">
            <input class="submit_button" <?php echo $script ?> type="button" value="Delete" onclick="deleteDB()">
        </form>

        <?php echo $fileUpload ?>
        <?PHP
        if (isset($errorMsg) && $errorMsg) {
            echo "<p style=\"color: red;\">", htmlspecialchars($errorMsg), "</p>\n\n";
        }
        ?>
        <?php echo $table ?>
        </table>
    </div>

    <!-- Navigation bar -->
    <div class="navbar">
        <a href="../php/storymap.php">Home</a>
        <a href="../php/attractions.php">Attractions</a>
        <a href="../php/about.php">About</a>
        <a class="active" href="../php/accountpage.php">Account</a>
    </div>

    <!-- Script to get filename from table and send to php -->
    <script>
        var getFilename;
        $("#table tr").click(function() {
            $(this).addClass('selected').siblings().removeClass('selected');
            var value = $(this).find('td:first').html();
            getFilename = value.substring(33, value.indexOf('alt') - 2);
        });

        //Update database
        function updateDB() {
            window.location.href = "adminUploadPicture.php?updateFilename=" + getFilename;
        }

        //Delete database
        function deleteDB() {
            window.location.href = "adminUploadPicture.php?deleteFilename=" + getFilename;
        }
    </script>
</body>

</html>