<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['submit'])) {
		$faculty = $_POST['faculty'];
		$dept = $_POST['department'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
		$date = date('d-m-Y h:i:s A');
		$qry = "INSERT INTO `department`(`facultyid`, `department`, `email`, `contact`,  `creationDate`, `updationDate`) VALUES ('$faculty', '$dept', '$email', '$contact', NOW(), '$date' )";
		$sql = mysqli_query($bd, $qry);
		if ($sql) {
			$_SESSION['msg'] = "Department created !!";
			$_SESSION['success'] = true ;
		} else {
			$_SESSION['msg'] = "Department not created !!";
			$_SESSION['success'] = false ;
		}
	}

	if (isset($_GET['del'])) {
		$con = mysqli_query($bd, "delete from department where id = '" . $_GET['id'] . "'");
		$_SESSION['delmsg'] = $con ? "Department deleted" : 'Department not deleted';
		$_SESSION['success'] = $con ? true : false;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Department</title>
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
							<div class="module-head">
								<h3>Sub Faculty</h3>
							</div>
							<div class="module-body">
								<?php if (isset($_POST['submit'])) { ?>
									<div class="alert alert-<?php echo $_SESSION['success'] == true ? 'success' : 'danger' ?>">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Success!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
									</div>
								<?php } ?>

								<?php if (isset($_GET['del'])) { ?>
									<div class="alert alert-<?php echo $_SESSION['success'] == true ? 'success' : 'danger' ?>">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Error</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
									</div>
								<?php } ?>

								<br />

								<form class="form-horizontal row-fluid" name="department" method="POST">
									<div class="control-group">
										<label class="control-label" for="basicinput">Faculty</label>
										<div class="controls">
											<select name="faculty" class="span8 tip" required>
												<option value="">Select Faculty</option>
												<?php $query = mysqli_query($bd, "select * from faculty");
												while ($row = mysqli_fetch_array($query)) { ?>
													<option value="<?php echo $row['id']; ?>"><?php echo $row['facultyName']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Department Name</label>
										<div class="controls">
											<input type="text" placeholder="Enter Department Name" name="department" class="span8 tip" required>
										</div>
									</div>

                                    <div class="control-group">
											<label class="control-label" for="basicinput">Email Address</label>
											<div class="controls">
												<input type="email" placeholder="Enter Department Email" name="email" class="span8 tip" required>
											</div>
										</div>

                                        <div class="control-group">
											<label class="control-label" for="basicinput">Contact number</label>
											<div class="controls">
												<input type="number" placeholder="Enter Department phone number" name="contact" class="span8 tip" required>
											</div>
										</div>

									<div class="control-group">
										<div class="controls">
											<button type="submit" name="submit" class="btn btn-primary">Create</button>
										</div>
									</div>
								</form>
							</div>
						</div>


						<div class="module">
							<div class="module-head">
								<h3>Sub Faculty</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Faculty</th>
											<th>Department</th>
											<th>Email</th>
                                            <th>Contact</th>
											<th>Last Updated</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<?php $query = mysqli_query($bd, "select department.id,faculty.facultyName, department.department, department.email,  department.contact,  department.creationDate,department.updationDate from department join faculty on faculty.id=department.facultyid order By department.facultyid");
										$cnt = 1;
										while ($row = mysqli_fetch_array($query)) {
										?>
											<tr>
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo htmlentities($row['facultyName']); ?></td>
												<td><?php echo htmlentities($row['department']); ?></td>
												<td> <?php echo htmlentities($row['email']); ?></td>
                                                <td> <?php echo htmlentities($row['contact']); ?></td>
												<td><?php echo htmlentities($row['updationDate']); ?></td>
												<td>
													<a href="edit-department.php?id=<?php echo $row['id'] ?>"><i class="icon-edit"></i></a>
													<a href="department.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a>
												</td>
											</tr>
										<?php $cnt = $cnt + 1;
										} ?>

								</table>
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