 <?php $page_title = "Search";
    include_once 'header.php'; ?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

 <?php session_start();
    include('nav.php');  ?>

 <div class="container">
     <div class="row">
         <div class="col-10 offset-1">
             <h2>Search</h2>
             <p>Please fill in name to search.</p>
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                 <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                     <label>First Name</label>
                     <input type="text" name="fname" class="form-control">
                 </div>

                 <div class="form-group">
                     <input type="submit" class="btn btn-primary" value="Search">
                 </div>
             </form>
         </div>
     </div>


     <?php
        include('config.php');
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno - 1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM contacts";
        $total_pages_result = $pdo->prepare($total_pages_sql);
        $total_pages_result->execute();
        $total_pages_total_rows =  $total_pages_result->fetchColumn();
        $total_pages = ceil($total_pages_total_rows / $no_of_records_per_page);
        if (isset($_GET["fname"])) {
            if (empty(trim($_GET["fname"]))) {
                echo "<p class='text-danger'>Please enter a name.</p>";
            } else {
                $fname = $_GET['fname'];
            }

            if (isset($fname)) {
                $sql = "SELECT * FROM contacts WHERE first_name LIKE '%$fname%'  LIMIT  $offset, $no_of_records_per_page";
                if ($stmt = $pdo->prepare($sql)) {
                    if ($stmt->execute()) {
                        if ($stmt->rowCount() > 0) {
                            echo "<div class='table-responsive'>";
                            echo "<table class='table table-bordered table-striped text-center'>
                            <tr>
                            <th>id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Type</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                            </tr>
                            ";

                            while ($row = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['first_name'] . "</td>";
                                echo "<td>" . $row['last_name'] . "</td>";
                                echo "<td>" . $row['phone_type'] . "</td>";
                                echo "<td>" . $row['pnumber'] . "</td>";
                                echo '<td>
                                    <form action="contact.php" method="post">
                                        <input type="hidden" name="id" value="' . $row["id"] . '">
                                        <input type="submit" name="submit" value="Details">
                                    </form>
                                </td>';
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                            // Free result set
                            unset($result);
                        } else {
                            echo "<p class='text-danger'> No records matching your query were found.</p>";
                        }
                    }
                }

                unset($stmt);
            }
        }

        ?>
     <div class="row">
         <div class="col-8 offset-2">
             <ul class="pagination">
                 <li><a href="?fname=<?php echo $fname ?>&pageno=1">First</a></li>
                 <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?>">
                     <a href="<?php if ($pageno <= 1) {
                                    echo '#';
                                } else {
                                    echo "?fname=" . $fname . "&pageno=" . ($pageno - 1);
                                } ?>">Prev</a>
                 </li>
                 <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?>">
                     <a href="<?php if ($pageno >= $total_pages) {
                                    echo '#';
                                } else {
                                    echo "?fname=" . $fname . "&pageno=" . ($pageno + 1);
                                } ?>">Next</a>
                 </li>
                 <li><a href="?fname=<?php echo $fname ?>&pageno=<?php echo $total_pages - 1; ?>">Last</a></li>
             </ul>
         </div>
     </div>


 </div>
 <?php include_once 'footer.php'; ?>