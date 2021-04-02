<?php
$page_title="Post";
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
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>John - index</title>

   <!-- Bootstrap core CSS -->
   <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="css/style.css" rel="stylesheet">

</head>

<body>

   <?php include('nav.php'); ?>

   <div class="container">

      <?php
      // Include config file
      require_once "config.php";

      $id = $_POST['id'];

      try {
         $sql = "SELECT * FROM contacts WHERE id='$id'";
         $result = $pdo->query($sql);
         if ($result->rowCount() > 0) {
            echo "<table class='table'>";
            echo "<tr>";
            echo "<th>id</th>";
            echo "<th>type</th>";
            echo "<th>status</th>";
            echo "<th>location</th>";
            echo "<th>skills</th>";
           

            echo "</tr>";
            while ($row = $result->fetch()) {
               echo "<tr>";
               echo "<td>" . $row['id'] . "</td>";
               echo "<td>" . $row['type'] . "</td>";
               echo "<td>" . $row['status'] . "</td>";
               echo "<td>" . $row['location'] . "</td>";
               echo "<td>" . $row['skills'] . "</td>";
             

               echo "</tr>";
            }
            echo "</table>";
            // Free result set
            unset($result);
         } else {
            echo "No records matching your query were found.";
         }
      } catch (PDOException $e) {
         die("ERROR: Could not able to execute $sql. " . $e->getMessage());
      }

      // Close connection
      unset($pdo);

      ?>





   </div>
   <!-- Bootstrap core JavaScript -->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>