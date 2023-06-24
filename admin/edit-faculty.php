<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Africa/Lagos'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    if (isset($_POST['submit'])) {
        $faculty = $_POST['faculty'];
        $description = $_POST['description'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $id = intval($_GET['id']);
        $sql = mysqli_query($bd, "update faculty set facultyName='$faculty', email = '$email', contact='$contact', facultyDescription='$description',updationDate='$currentTime' where id='$id'");
        $_SESSION['msg'] = $sql ? "Faculty updated successfully" : "Faculty could not be updated";
        $_SESSION['success'] = $sql ? true : false;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Faculty</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>

<body>
    <?php include('include/header.php'); ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php'); ?>
                <div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-head justify-div">
                                <h3>Edit Faculty</h3>
                                <a class="btn btn-primary" href="faculty.php"><i class="icon-chevron-left"></i> Back </a>
                            </div>
                            <div class="module-body">
                                <?php if (isset($_POST['submit'])) { ?>
                                    <div class="alert alert-<?php echo $_SESSION['success'] == true ? 'success' : 'danger' ?>">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                    </div>
                                <?php } ?>

                                <br />

                                <form class="form-horizontal row-fluid" name="Faculty" method="post">
                                    <?php
                                    $id = intval($_GET['id']);
                                    $query = mysqli_query($bd, "select * from faculty where id='$id'");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Name</label>
                                            <div class="controls">
                                                <input type="text" placeholder="Enter Faculty Name" name="faculty" value="<?php echo htmlentities($row['facultyName']); ?>" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Email Address</label>
                                            <div class="controls">
                                                <input type="email" placeholder="Enter Faculty Email" name="email" value="<?php echo htmlentities($row['email']); ?>" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Contact number</label>
                                            <div class="controls">
                                                <input type="number" placeholder="Enter Faculty phone number" name="contact" value="<?php echo htmlentities($row['contact']); ?>" class="span8 tip" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Description</label>
                                            <div class="controls">
                                                <textarea class="span8" placeholder="E.g Faculty of Sciences" name="description" rows="5"><?php echo  htmlentities($row['facultyDescription']); ?></textarea>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
    </div><!--/.wrapper-->

    <?php include('include/footer.php'); ?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable-1').dataTable();
            $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
        });
    </script>
</body>

</html>
<?php } ?>