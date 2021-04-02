<?php $page_title = "Search";
include_once 'header.php'; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<?php
session_start();
include('nav.php');  ?>

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <h2>Search</h2>
            <p>Please fill in name to search.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                    <label>First Name</label>
                    <input id="fname" type="text" name="fname" class="form-control">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="data">
            </div>
        </div>
    </div>


</div>
<?php include_once 'footer.php'; ?>
<script>
    $(document).ready(function() {
        $("#fname").on("keyup", function() {
            var fname = $('#fname').val();
            $.ajax({
                type: "post",
                url: "ajax-live-search.php",
                data: {
                    "fname": fname
                },

                success: function(data) {
                    let result = JSON.parse(data);
                    $('#data').html(result.data);
                }
            });
            
        });
    });
</script>