<?php
include('config.php');
if (isset($_POST['fname'])) {
    if (empty(trim($_POST['fname']))) {
        $data= '<p class="text-danger">Please enter a name.</p>';
    } else {
        $fname = $_POST['fname'];
    }

    if (isset($fname)) {
        $sql = "SELECT * FROM contacts WHERE first_name LIKE '%$fname%'";
        if ($stmt = $pdo->prepare($sql)) {
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $data =  '<div class="table-responsive">'.
                     '<table class="table table-bordered table-striped text-center">
                            <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Type</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                            </tr>';

                    while ($row = $stmt->fetch()) {
                        $data.= '<tr>'
                            . '<td>' . $row['id'] . '</td>'
                            . '<td>' . $row['first_name'] . '</td>'
                            . '<td>' . $row['last_name'] . '</td>'
                            . '<td>' . $row['phone_type'] . '</td>'
                            . '<td>' . $row['pnumber'] . '</td>';
                            $data.= '<td>
                                    <form action="contact.php" method="post">
                                        <input type="hidden" name="id" value="' . $row['id'] . '">
                                        <input type="submit" name="submit" value="Details">
                                    </form>
                                </td>';
                        $data.='</tr>';
                    }
                    $data.= '</table>'
                    . '</div>';
                    // Free result set
                    unset($result);
                } else {
                    $data= '<p class="text-danger"> No records matching your query were found.</p>';
                }
            }
        }

        unset($stmt);
    }
}

die( json_encode(array('data'=>$data)));