<?php

require_once "config.php";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $id = $_POST["id"];
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $phone_type = $_POST["type"];
    $pnumber = trim($_POST["pnumber"]);


    // Prepare an update statement
    $sql_update = "UPDATE  contacts SET first_name = '" . $fname . "' , last_name = '" . $lname . "', phone_type = '" . $phone_type . "',  pnumber = '" . $pnumber . "' WHERE id = '" . $id . "' ";

    if ($stmt_update = $pdo->prepare($sql_update)) {
        // Attempt to execute the prepared statement
        if ($stmt_update->execute()) {
            $page_title = "Update Contact";
            include_once 'header.php'; ?>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="alert alert-success  mt-5">
                            The Contact has been updated!
                        </div>
                        <a href="contacts.php" class="btn badge-info">My Contacts</a>
                        <a href="create-contact.php" class="btn btn-primary">Create Contact</a>
                       
                  </div>
                  <div class="col-12 text-center mt-3">
                  <form action="edit-contact.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input class=" alert alert-info" type="submit" name="submit" value="Back To The Contact">
                        </form>
                  </div>
               </div>
            </div>
         <?php include_once 'footer.php';
        } else {
            echo "Something went wrong. Please try again.";
        }

        // Close statement
        unset($stmt_update);
    }
}
