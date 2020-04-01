<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

$user_id = $_SESSION["id"];

$getsql = "SELECT username FROM users WHERE id = '$user_id'";
$result = $link->query($getsql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = $row['username'];
    }
} else {
    echo "0 results";
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StoryMap/Account Page/Change password</title>
    <!--CSS Links-->
    <link rel="stylesheet" href="../css/mobile/banner_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/nav_mobile.css">
    <link rel="stylesheet" type="text/css" href="../css/mobile/accountpage_mobile.css">
</head>

<body>
    <!-- Banner -->
    <div class="logo">
        <img src="../storage/mobile/storymaplogo.png">
        <a href="#">Barcelona</a>
    </div>
    <div id="main">
        <div id="header">
            <header><?php echo $username ?>'s Account</header>
        </div>
        <h1> Change password</h1>
        <div class="wrapper">
            <p>Please fill out this form to reset your password.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="new_password <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <div class="input_box_wrapper">
                        <label>New Password: </label>
                        <input type="password" name="new_password" class="input_box" value="<?php echo $new_password; ?>">
                    </div>
                    <span class="error_msg"><?php echo $new_password_err; ?></span>
                </div>
                <div class="con_password <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <div class="input_box_wrapper">
                        <label>Confirm Password: </label>
                        <input type="password" name="confirm_password" class="input_box">
                    </div>
                    <span class="error_msg"><?php echo $confirm_password_err; ?></span>
                </div>
                <button class="submit_button" name="Submit" type="submit" value="Submit">Submit</button>
                <p class="back_button"><a href="accountpage.php">Back</a></p>
            </form>
        </div>
        <div id="contact">
            <p> <a href="contact.php"> Contact us!</li> </a> </p>
        </div>
        <!-- Navigation bar -->
        <div class="navbar">
            <a href="../php/storymap.php">Home</a>
            <a href="../php/attractions.php">Attractions</a>
            <a href="../php/about.php">About</a>
            <a class="active" href="../php/accountpage.php">Account</a>
        </div>
</body>

</html>