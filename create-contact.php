<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
$fname = $lname = $pnumber = '';
$fname_err = $lname_err = $pnumber_err = '';
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate first name 
    if (empty(trim($_POST["fname"]))) {
        $fname_err = "Please enter a first name.";
    } elseif (strlen($_POST["fname"]) == 1) {
        $fname_err = "Please enter a real name.";
    } else {
        $fname = trim($_POST["fname"]);
    }

    // validate last name 
    if (empty(trim($_POST["lname"]))) {
        $lname_err = "Please enter a last name.";
    } elseif (strlen($_POST["fname"]) == 1) {
        $lname_err = "Please enter a real name.";
    } else {
        $lname = trim($_POST["lname"]);
    }

    //   validate phone number 
    if (empty(trim($_POST["pnumber"]))) {
        $pnumber_err = "Please enter a phone number.";
    } elseif (strlen($_POST["pnumber"]) == 5) {
        $pnumber_err = "Please enter a phone number.";
    } else {
        // Set parameters
        $pnumber_check = trim($_POST["pnumber"]);
        // Prepare a select statement
        $sql = "SELECT id FROM contacts WHERE pnumber = '$pnumber'";

        if ($stmt = $pdo->prepare($sql)) {

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $pnumber_err = "This phone number  is already existed.";
                } else {
                    $pnumber = trim($_POST["pnumber"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }


    $phone_type = $_POST["type"];
    $user_id = $_SESSION["id"];
    if (empty($fname_err) && empty($lname_err) && empty($pnumber_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO contacts (first_name,last_name, phone_type,pnumber, user_id) VALUES (:first_name, :last_name, :phone_type, :pnumber, :user_id )";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":first_name", $param_fname, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $param_lname, PDO::PARAM_STR);
            $stmt->bindParam(":phone_type", $param_phone_type, PDO::PARAM_STR);
            $stmt->bindParam(":pnumber", $param_pnumber, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);

            // Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_phone_type = $phone_type;
            $param_pnumber = $pnumber;
            $param_user_id = $user_id;


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: contacts.php");
            } else {
                echo "Something went wrong. Please try again.";
            }

            // Close statement
            unset($stmt);
        }

        // Close connection
        unset($pdo);
    }
}
?>
<?php $page_title = "Create Contact";
include_once 'header.php'; ?>

<?php include('nav.php');  ?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col-8 offset-2">
            <h2>Create Contact</h2>
            <p>Please fill this form to create an Contact.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group ">
                    <label>First Name</label>
                    <input type="text" name="fname" value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ''; ?>" class="form-control" required>
                    <span class="text-danger"><?php echo $lname_err; ?></span>
                </div>
                <div class="form-group ">
                    <label>Last Name</label>
                    <input type="text" name="lname" value="<?php echo isset($_POST["lname"]) ? $_POST["lname"] : ''; ?>" class="form-control" required>
                    <span class="text-danger"><?php echo $fname_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Phone Type</label>
                    <select name="type" class="form-control" id="type">
                        <option value="home">HOME</option>
                        <option value="work">WORK</option>
                        <option value="cellular">CELLULAR</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label>Number</label>
                    <input type="tel" name="pnumber" class="form-control" value="<?php echo isset($_POST["pnumber"]) ? $_POST["pnumber"] : ''; ?>" required>
                    <span class="text-danger"><?php echo $pnumber_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
            </form>
        </div>
    </div>
    <div class="row mb-5 mt-3">
        <dic class="col-12 text-center">
            <p>Go to <a href="contacts.php">My Contacts</a></p>
        </dic>
    </div>
</div>

<?php include_once 'footer.php'; ?>