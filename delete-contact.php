<?php
// Include config file
require_once "config.php";
$id = $_POST['id'];

$sql = "DELETE FROM contacts WHERE id='$id' LIMIT 1";
$sql_delete = $pdo->prepare($sql);

$result = $sql_delete->execute(array($id));
if ($result) {
   $page_title = "Delete Post";
   include_once 'header.php'; ?>
   <div class="container">
      <div class="row">
         <div class="col-12 text-center">
            <div class="alert alert-danger mt-5">
               The Contact has been deleted!
            </div>
            <a href="contacts.php" class="btn badge-info">My Contacts</a>
            <a href="create-contact.php" class="btn btn-primary">Create Contact</a>
         </div>
      </div>
   </div>
<?php include_once 'footer.php';
} ?>