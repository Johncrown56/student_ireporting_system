<?php
session_start();
error_reporting(1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $uid = $_SESSION['id'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $category = $_POST['category'];
    $subcat = $_POST['subcategory'];
    $complaintNumber = date('ymd').mt_rand(000, 999);
    $complaintype = $_POST['complaintype'];
    $noc = $_POST['noc'];
    $complaintdetails = $_POST['complaindetails'];
    $compfile = $_FILES["compfile"]["name"];

    move_uploaded_file($_FILES["compfile"]["tmp_name"], "complaintdocs/" . $_FILES["compfile"]["name"]);
    $query = mysqli_query($bd, "insert into tblcomplaints(complaintNumber,userId,category,subcategory,faculty,department,complaintType,state,noc,complaintDetails,complaintFile) values('$complaintNumber','$uid','$category','$subcat', '$faculty', '$department', '$complaintype','','$noc','$complaintdetails','$compfile')");
    $sql = mysqli_query($bd, "select id, complaintNumber from tblcomplaints  order by id desc limit 1");
    if($query && $sql){
      while ($row = mysqli_fetch_array($sql)) {
        $cmpn = $row['complaintNumber'];
      }
      $complainno = $cmpn;
      $successmsg = $complaintNumber == $complainno ? "Your report has been sent successfully and your ticket number is " .$complainno : 'Error unknown';
    }else{
      $errormsg = "Error submitting your report.";
    }
    //echo '<script> alert("Your complain has been successfully filled and your complaint number is  "+"' . $complainno . '")</script>';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>iReporting System | Register Complaint</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style-responsive.css" rel="stylesheet">
  <script>
    function getCat(val) {
      if(val == 1){
        $("#showFaculty").addClass('d-block');
        $("#showFaculty").removeClass('d-none');
      }else{
        $("#showFaculty").addClass('d-none');
        $("#showFaculty").removeClass('d-block');
      }
      $.ajax({
        type: "POST",
        url: "getsubcat.php",
        data: 'catid=' + val,
        success: function(data) {
          $("#subcategory").html(data);

        }
      });
    }

    function getFac(val) {
      $.ajax({
        type: "POST",
        url: "getdept.php",
        data: 'deptid=' + val,
        success: function(data) {
          $("#department").html(data);

        }
      });
    }
  </script>

</head>

<body>

  <section id="container">
    <?php include("includes/header.php"); ?>
    <?php include("includes/sidebar.php"); ?>
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Report Issue</h3>

        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">

              <?php if ($successmsg) { ?>
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b>Success!</b> <?php echo htmlentities($successmsg); ?>
                </div>
              <?php } ?>

              <?php if ($errormsg) { ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b>Error!</b> <?php echo htmlentities($errormsg); ?>
                </div>
              <?php } ?>

              <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data">                  

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Category</label>
                  <div class="col-sm-4">
                    <select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
                      <option value="">Select Category</option>
                      <?php $sql = mysqli_query($bd, "select id,categoryName from category ");
                      while ($rw = mysqli_fetch_array($sql)) {
                      ?>
                        <option value="<?php echo htmlentities($rw['id']); ?>"><?php echo htmlentities($rw['categoryName']); ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <label class="col-sm-2 col-sm-2 control-label">Sub Category </label>
                  <div class="col-sm-4">
                    <select name="subcategory" id="subcategory" class="form-control">
                      <option value="">Select Subcategory</option>
                    </select>
                  </div>
                </div>

                <div class="form-group d-none" id="showFaculty">
                  <label class="col-sm-2 col-sm-2 control-label">Faculty</label>
                  <div class="col-sm-4">
                    <select name="faculty" id="faculty" class="form-control" onChange="getFac(this.value);">
                      <option value="">Select Faculty</option>
                      <?php $sq = mysqli_query($bd, "select id,facultyName from faculty ");
                      while ($row = mysqli_fetch_array($sq)) {
                      ?>
                        <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['facultyName']); ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <label class="col-sm-2 col-sm-2 control-label">Department </label>
                  <div class="col-sm-4">
                    <select name="department" id="department" class="form-control">
                      <option value="">Select Department</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Report Type</label>
                  <div class="col-sm-4">
                    <select name="complaintype" class="form-control" required="required">
                    <option value="">Select Report Type</option>
                      <option value="Complaint">Complaint</option>
                      <option value="General Query">General Query</option>
                      <option value="Request">Request</option>
                    </select>
                  </div>

                  <!-- <label class="col-sm-2 col-sm-2 control-label">State</label> -->
                  <label class="col-sm-2 col-sm-2 control-label">Subject of Complaint</label>
                  <div class="col-sm-4">
                    <input type="text" name="noc" required="required" value="" class="form-control">
                  </div>
                </div>


                <!-- <div class="form-group">
                  

                </div> -->

                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Complaint Details (max 2000 words) </label>
                  <div class="col-sm-6">
                    <textarea name="complaindetails" placeholder="Type your request" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Complaint Related Doc(if any) </label>
                  <div class="col-sm-6">
                    <input type="file" name="compfile" class="form-control" value="">
                  </div>
                </div>



                <div class="form-group">
                  <div class="col-sm-10" style="padding-left:25% ">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>



      </section>
    </section>
    <?php include("includes/footer.php"); ?>
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


  <!--common script for all pages-->
  <script src="assets/js/common-scripts.js"></script>

  <!--script for this page-->
  <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

  <!--custom switch-->
  <script src="assets/js/bootstrap-switch.js"></script>

  <!--custom tagsinput-->
  <script src="assets/js/jquery.tagsinput.js"></script>

  <!--custom checkbox & radio-->

  <script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

  <script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>


  <script src="assets/js/form-component.js"></script>


  <script>
    //custom select box

    $(function() {
      $('select.styled').customSelect();
    });
  </script>

</body>

</html>
<?php } ?>