<?php
session_start();
require_once "config.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
  header("location: register.php");
  exit;
}

$first_name = $last_name = $username = $email = "";
$first_name_err = $last_name_err = $email_err = $username_err = "";
$user_id = $_SESSION["id"];

$getsql = "SELECT first_name, last_name, username, email FROM users WHERE id = '$user_id'";
$result = $link->query($getsql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $username = $row['username'];
    $email = $row['email'];
  }
} else {
  echo "0 results";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!preg_match("/^[A-Za-z]+$/", $_POST['first_name'])) {
    $first_name_err = "Only letters allowed";
  } else {
    $sql = "UPDATE users
          SET first_name = (?)
          WHERE id = '$user_id'";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST["first_name"]);
    if (mysqli_stmt_execute($stmt)); {
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_close($stmt);
    }
  }

  if (!preg_match("/^[A-Za-z]+$/", $_POST['last_name'])) {
    $last_name_err = "Only letters allowed";
  } else {
    $sql = "UPDATE users
        SET last_name = (?)
        WHERE id = '$user_id'";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST["last_name"]);
    if (mysqli_stmt_execute($stmt)); {
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_close($stmt);
    }
  }
  if (!preg_match("/^[A-Za-z0-9]+$/", $_POST['username'])) {
    $username_err = "Only letters and numbers allowed";
  } else {
    $sql = "UPDATE users
          SET username = (?)
          WHERE id = '$user_id'";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST["username"]);
    if (mysqli_stmt_execute($stmt)); {
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_close($stmt);
    }
  }
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email_err = "Invalid email format";
  } else {
    $sql = "UPDATE users
          SET email = (?)
          WHERE id = '$user_id'";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_POST["email"]);
    if (mysqli_stmt_execute($stmt)); {
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_close($stmt);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--CSS Links-->
  <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
  <link rel="stylesheet" type="text/css" href="../css/mobile/accountpage_mobile.css">
  <link rel="stylesheet" type="text/css" href="../css/desktop/accountpage_desktop.css">
  <link rel="stylesheet" type="text/css" href="../css/mobile/banner_mobile.css">
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
            <a class="logo_text">Enjoy a storymap of Barcelona's most beautiful places</a>
            <div id="desktop-links" class="nav-inactive">
            <div id="btn-toggle-nav-links" onclick="meny()"></div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Attractions</a></li>
                <li><a href="#">Trips</a></li>
                <li><a href="#">Account</a></li>
            </ul>
        </div>
    </nav>
    <!-- Banner -->
    <div class="logo">
        <img src="../storage/mobile/storymaplogo.png">
        <a href="#">Barcelona</a>
    </div>
  <div id="main">
    <div id="header">
      <header><?php echo $username ?>'s Account</header>
    </div>
    <div class="wrapper">
    <h1> Your information </h1>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input_box_wrapper">
          <label for="firstname">First Name:</label>
          <input type="text" class="input_box" name="first_name" value="<?php echo $first_name ?>">
        </div>
        <div>
          <span class="error_msg"><?php echo $first_name_err; ?></span>
        </div>
        <div class="input_box_wrapper">
          <label for="lastname">Last Name:</label>
          <input type="text" class="input_box" name="last_name" value="<?php echo $last_name ?>">
        </div>
        <div>
          <span class="error_msg"><?php echo $last_name_err; ?></span>
        </div>
        <div class="input_box_wrapper">
          <label for="username">Username:</label>
          <input type="text" class="input_box" name="username" value="<?php echo $username ?>">
        </div>
        <div>
          <span class="error_msg"><?php echo $username_err; ?></span>
        </div>
        <div class="input_box_wrapper">
          <label for="email">E-Mail:</label>
          <input type="text" class="input_box" name="email" value="<?php echo $email ?>">
        </div>
        <div>
          <span class="error_msg"><?php echo $email_err; ?></span>
        </div>
        <button class="submit_button" name="Submit" type="submit" value="Submit">Submit</button>
        <p class="back_button"><a href="accountpage.php">Back</a></p>
      </form>
      </div>
      <div id="contact">
            <a id="contactus" href="contact.php"> Contact us </a>
            <a id="aboutus" href="about.php">About us</a>
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