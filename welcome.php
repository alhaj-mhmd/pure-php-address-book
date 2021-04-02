<?php
$page_title = "Welcome";
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <?php include('nav.php'); ?>

    <div class="container  mb-5  text-center">
        <div class="row mt-5">
            <div class="col-8 offset-2">
                <h1>Hi, <b><?php echo $_SESSION["name"]; ?></b></h1>
                <p>Welcome to My site.</p>
            </div>
        </div>


        <div class="row">
            <div class="col-6  mt-5 offset-3">
                <a href="reset-password.php" class="btn btn-warning mt-3">Reset Your Password</a>
                <a href="logout.php" class="btn btn-danger mt-3">Sign Out of Your Account</a>

            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>