<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if (isset($_GET['ppage'])) {
    $ppage = $_GET['ppage'];
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
    <title>View User Profile</title>
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
                  <h3>View User Profile</h3>
                  <a class="btn btn-primary" href="<?php echo isset($ppage) ? $ppage.'.php': 'complaint-details.php?cid='.$_GET['cid']; ?> "><i class="icon-chevron-left"></i> Back </a>
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

                  <form class="form-horizontal row-fluid" name="updateticket" id="updateticket" method="post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php

                      $ret1 = mysqli_query($bd, "select * FROM users where id='" . $_GET['uid'] . "'");
                      while ($row = mysqli_fetch_array($ret1)) {
                      ?>
                        <tr>
                          <td colspan="2"><b><?php echo $row['fullName']; ?>'s profile</b></td>
                        </tr>

                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr height="50">
                          <td><b>Registration Date:</b></td>
                          <td><?php echo htmlentities($row['regDate']); ?></td>
                        </tr>
                        <tr height="50">
                          <td><b>Email Address:</b></td>
                          <td><?php echo htmlentities($row['userEmail']); ?></td>
                        </tr>


                        <tr height="50">
                          <td><b>Matric no:</b></td>
                          <td><?php echo htmlentities($row['matricNo']); ?></td>
                        </tr>

                        <tr height="50">
                          <td><b>Address:</b></td>
                          <td><?php echo htmlentities($row['address']); ?></td>
                        </tr>



                        <tr height="50">
                          <td><b>State:</b></td>
                          <td><?php echo htmlentities($row['State']); ?></td>
                        </tr>


                        <tr height="50">
                          <td><b>Country:</b></td>
                          <td><?php echo htmlentities($row['country']); ?></td>
                        </tr>


                        <tr height="50">
                          <td><b>Pincode:</b></td>
                          <td><?php echo htmlentities($row['pincode']); ?></td>
                        </tr>

                        <tr height="50">
                          <td><b>Last Updated:</b></td>
                          <td><?php echo htmlentities($row['updationDate']); ?></td>
                        </tr>
                        <tr height="50">
                          <td><b>Status:</b></td>
                          <td><?php if ($row['status'] == 1) {
                                echo "Active";
                              } else {
                                echo "Block";
                              }
                              ?></td>
                        </tr>
                      <?php } ?>

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
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>

  </body>

  </html>

<?php } ?>