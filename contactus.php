<?php $page_title = "Contact Us";
include_once 'header.php'; ?>
<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    include('nav.php');

    require_once "config.php";
    $id = $_SESSION['id'];
    try {
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = $pdo->query($sql);
        if ($result->rowCount() > 0) {
            $row = $result->fetch();

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
    <div class="container mb-5">
        <div class="row mt-5">
            <div class="col-12 text-center mb-5 mt-4">
                <h2 class="alert alert-info">
                    Contact Us
                </h2>
            </div>
            <div class="col-sm-4">
                <!-- phone  -->
                <!-- email  -->
                <h3 class="mt-4"><i class="fab fa-linkedin"></i>Phone</h3> <span><?php echo $row['phone'] ?></span>
                <h3 class="mt-4"><i class="fas fa-envelope"></i>Email</h3> <span><?php echo $row['email'] ?></span>
            </div>
            <div class="col-sm-4">
                <!-- social -->
                <h3 class="mt-4"><i class="fab fa-facebook-square"></i> Facebook</h3> <span><?php echo $row['facebook'] ?></span>
                <h3 class="mt-4"><i class="fab fa-instagram"></i></i> Instagram</h3> <span><?php echo $row['instagram'] ?></span>
                <h3 class="mt-4"><i class="fab fa-twitter-square"></i>Twitter</h3> <span><?php echo $row['twitter'] ?></span>
                <h3 class="mt-4"><i class="fab fa-linkedin"></i>LinkedIn</h3> <span><?php echo $row['linkedin'] ?></span>
            </div>
            <div class="col-sm-4">
                <!-- address -->
                <h3 class="mt-4"><i class="fas fa-map-marker-alt"></i>Address</h3> <span><?php echo $row['address'] ?></span>

            </div>
        </div>
    </div>
<?php
} else {
    include('nav.php');
?>
    <div class="container mb-5">
        <div class="row mt-5">
            <div class="col-12 text-center mb-5 mt-4">
                <h2 class="alert alert-info">
                    Contact Us
                </h2>
            </div>
            <div class="col-sm-4">
                <!-- phone  -->
                <!-- email  -->
                <h3 class="mt-4"> <i class="fas fa-mobile-alt"></i>Phone</h3> <span>00601162304341</span>
                <h3 class="mt-4"><i class="fas fa-envelope"></i>Email</h3> <span>alhajdev@gmail.com</span>
            </div>
            <div class="col-sm-4">
                <!-- social -->
               <a href="https://www.facebook.com/mhd.alhajali">  <h3 class="mt-4"><i class="fab fa-facebook-f"></i>Facebook</h3> <span>https://www.facebook.com/mhd.alhajali/</span></a>
               <a href="https://www.linkedin.com/in/mohammad-alhaj-ali"> <h3 class="mt-4"><i class="fab fa-linkedin"></i>LinkedIn</h3> <span>https://www.linkedin.com/in/mohammad-alhaj-ali/</span></a>
            </div>
            <div class="col-sm-4">
                <!-- address -->
                <h3 class="mt-4"><i class="fas fa-map-marker-alt"></i>Address</h3> <span>Malaysia - KL</span>
              <a href="https://github.com/alhaj-mhmd" > <h3 class="mt-4"><i class="fab fa-github"></i>GitHub</h3> <span>https://github.com/alhaj-mhmd</span></a>

            </div>
        </div>



    </div>
<?php } ?>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>

</html>