<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['update'])) {
    $complaintnumber = $_GET['cid'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $query = mysqli_query($bd, "insert into complaintremark(complaintNumber,status,remark) values('$complaintnumber','$status','$remark')");
    $sql = mysqli_query($bd, "update tblcomplaints set status='$status' where complaintNumber='$complaintnumber'");
    if ($sql) {
      //send email here to the department and the student
      $successmsg = "Complaint details updated successfully";
      $_SESSION['success'] = true;
    } else {
      $errormsg = "Complaint details not updated successfully";
      $_SESSION['success'] = false;
    }
    //echo "<script>alert('Complaint details updated successfully');</script>";
  }

?>
  <script language="javascript" type="text/javascript">
    function f2() {
      window.close();
    }

    function f3() {
      window.print();
    }
  </script>
  <!DOCTYPE html>
  <html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Admin | Update Complaint</title>
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
                  <h3>Update Complaint</h3>
                  <a class="btn btn-primary" href="complaint-details.php?cid=<?php echo $_GET['cid']; ?>"><i class="icon-chevron-left"></i> Back </a>
                </div>
                <div class="module-body">
                  <?php if (isset($successmsg)) { ?>
                    <div class="alert alert-<?php echo $_SESSION['success'] == true ? 'success' : 'danger' ?>">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>Success!</strong> <?php echo htmlentities($successmsg); ?>
                    </div>
                  <?php } ?>

                  <?php if (isset($errormsg)) { ?>
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Error!</b> <?php echo htmlentities($errormsg); ?>
                    </div>
                  <?php } ?>

                  <br />

                  <form class="form-horizontal row-fluid" name="updateticket" id="updatecomplaint" method="post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr height="50">
                        <td><b>Complaint Number</b></td>
                        <td><?php echo htmlentities($_GET['cid']); ?></td>
                      </tr>
                      <tr height="50">
                        <td><b>Status</b></td>
                        <td><select name="status" required="required">
                            <option value="">Select Status</option>
                            <option value="in process">In Process</option>
                            <option value="closed">Closed</option>

                          </select></td>
                      </tr>


                      <tr height="50">
                        <td><b>Remark</b></td>
                        <td><textarea name="remark" rows="10" required="required"></textarea></td>
                      </tr>



                      <tr height="50">
                        <td>&nbsp;</td>
                        <td><button type="submit" name="update" class="btn btn-primary">Update</button></td>
                      </tr>


                    </table>
                  </form>
                </div>
              </div>
            </div><!--/.content-->
          </div><!--/.span9-->
        </div>
      </div><!--/.container-->
    </div><!--/.wrapper-->

    <?php include('include/footer.php'); ?>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

  </body>

  </html>

<?php } ?>