<?php
 $page_title = "Signup";

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $username = $password = $confirm_password = $email  = $secure = "";
$name_err = $username_err = $password_err = $email_err = $secure_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name

    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } elseif (strlen($_POST["name"]) == 1) {
        $name_err = "Please enter a real name.";
    } else {
        $name = $_POST["name"];
    }

    if (empty(trim($_POST["username"]))) {
        $username_err = "please enter username";
    } else if (strpos($_POST["username"], '@')) {
        $username_err = "please enter valid username";
    } else {
        // Set parameters
        $username_check = trim($_POST["username"]);
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = '$username_check'";

        if ($stmt = $pdo->prepare($sql)) {

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    //Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "plaeas enter a email";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty($_POST["skills"])) {
        $skills_err = "plaeas enter a skill";
    } else {
        $skills = implode(",", $_POST["skills"]);
    }

    if (empty(trim($_POST["secure"]))) {
        $secure_err = "plaeas answer the secure question";
    } else {
        $secure_check = trim($_POST["secure"]);
        // Prepare a select statement
        $sql_secure = "SELECT id FROM users WHERE secure = '$secure_check'";

        if ($stmt_secure = $pdo->prepare($sql_secure)) {

            // Attempt to execute the prepared statement
            if ($stmt_secure->execute()) {

                if ($stmt_secure->rowCount() >= 0) {

                    $secure_err = "This answer is already taken.";
                } else {
                    $secure = trim($_POST["secure"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt_secure);
        }
    }
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $facebook = trim($_POST['facebook']);
    $instagram = trim($_POST['instagram']);
    $twitter = trim($_POST['twitter']);
    $linkedin = trim($_POST['linkedin']);
    // Check input errors before inserting in database
    if (empty($name_err) && empty($password_err) && empty($username_err) && empty($email_err)) {
        $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, username, email,  password, secure, skills,phone,address,facebook,instagram,twitter,linkedin) VALUES ('$name', '$username', '$email', '$password','$secure', '$skills','$phone','$address','$facebook','$instagram','$twitter','$linkedin' )";
        

        if ($stmt_insert = $pdo->prepare($sql)) {
            // Attempt to execute the prepared statement
            if ($stmt_insert->execute()) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt_insert);
        }
    }

    // Close connection
    unset($pdo);
}
?>

<?php require_once 'header.php'; ?>
    <?php include('nav.php'); ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-12 text-center mb-5">
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
            </div>
            <div class="col-sm-6 text-center">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="" required>
                        <span class="text-danger"><?php echo $name_err; ?></span>
                    </div>
                    <div class="text-danger">
                        <?php    ?>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="" required>
                        <span class="text-danger"><?php echo $username_err; ?></span>
                    </div>
                    

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="" required>
                    </div>
                    <div class="text-danger">
                        <?php    ?>
                    </div>

                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" minlength="6" value="<?php echo $password; ?>">
                        
                    </div>
                    <div class="text-danger">
                        <?php  echo $password_err  ?>
                    </div>

                    <div class="form-group ">
                        <label>Skills</label>
                        <select name="skills[]" class="form-control selectpicker" id="skills" multiple data-live-search="true" required>
                            <option value="no skills">No Skills</option>
                            <option value="html">HTML</option>
                            <option value="css">CSS</option>
                            <option value="javascript">JAVASCRIPT</option>
                            <option value="php">PHP</option>
                             
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="text-danger">
                        <?php    ?>
                    </div>

            </div>
            <div class="col-sm-6 text-center">

                <div class="form-group ">
                    <label>Phone</label>
                    <input type="phone" name="phone" class="form-control" value="">
                </div>
                <div class="form-group ">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="">
                </div>
                <div class="form-group ">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="">
                </div>
                <div class="form-group ">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="">
                </div>
                <div class="form-group ">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="">
                </div>
                <div class="form-group ">
                    <label>LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" value="">
                </div>

            </div>
            <div class="col-sm-12 text-center mt-4">
                <div class="form-group ">
                    <label>What is your favorite thing <span class="text-info" data-toggle="tooltip" title="For Forgot Password!" data-placement="top"> &#9432;</span></label>
                    <input type="text" name="secure" class="form-control" value="" required>
                </div>
                <div class="text-danger">
                    <?php echo $secure_err; ?>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
                </form>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>

            </div>
        </div>


    </div>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('select').selectpicker();
    </script>
</body>

</html>