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

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $phone_type = $_POST["type"];
    $pnumber = trim($_POST["pnumber"]);
    $user_id = $_SESSION["id"];


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
                    <input type="text" name="fname" class="form-control">
                </div>
                <div class="form-group ">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control">
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
                    <input type="text" name="pnumber" class="form-control">
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