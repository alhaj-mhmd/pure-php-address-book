<?php
// Include config file
require_once "config.php";
if (isset($_POST['id']) && $_POST['id'] != null) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM contacts WHERE id = '$id'";
    $result = $pdo->query($sql);
    $row = $result->fetch();
}



unset($pdo);

?>
<?php $page_title = "Edit Contact";
include_once 'header.php'; ?>
<?php
session_start();
include('nav.php');  ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2>Edit Contact</h2>
            <p class="alert alert-info">Please fill this form to edit contact.</p>
            <form action="update-contact.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                <div class="form-group ">
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control" value="<?php echo $row['first_name'] ?>">
                </div>
                <div class="form-group ">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control" value="<?php echo $row['last_name'] ?>">
                </div>
                <div class="form-group">
                    <label>Phone Type</label>
                    <select name="type" class="form-control" id="type">
                        <option <?php echo $row['phone_type'] == 'home' ? 'selected' : '' ?> value="home">HOME</option>
                        <option <?php echo $row['phone_type'] == 'work' ? 'selected' : '' ?> value="work">WORK</option>
                        <option <?php echo $row['phone_type'] == 'cellular' ? 'selected' : '' ?> value="cellular">CELLULAR</option>
                        <option <?php echo $row['phone_type'] == 'other' ? 'selected' : '' ?> value="other">Other</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label>Number</label>
                    <input type="text" name="pnumber" class="form-control" value="<?php echo $row['pnumber'] ?>">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
                <p>Go to my contacts <a href="contacts.php">My Contacts</a></p>
            </form>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>