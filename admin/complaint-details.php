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
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin | Complaint Details</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
		<script language="javascript" type="text/javascript">
			var popUpWin = 0;

			function popUpWindow(URLStr, left, top, width, height) {
				if (popUpWin) {
					if (!popUpWin.closed) popUpWin.close();
				}
				popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
			}
		</script>

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
									<h3>Complaint Details</h3>
									<a class="btn btn-primary" href="<?php echo isset($ppage) ? $ppage . '.php' : '' ?>?cid=<?php echo $_GET['cid']; ?>"><i class="icon-chevron-left"></i> Back </a>
								</div>
								<div class="module-body table">
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<tbody>
											<?php $st = 'closed';
											$cid = $_GET['cid'];
											$sq = mysqli_query($bd, "SELECT * FROM `tblcomplaints` WHERE `complaintNumber` = '$cid'");
											$rows = mysqli_fetch_array($sq);
											$fac = $rows['faculty'];
											$dept = $rows['department'];
											// while ($rw = mysqli_fetch_array($sq)) {
											// 	echo $fac = $rw['faculty'];
											// 	echo $dept = $rw['department'];
											// }										
											//"select tblcomplaints.*,users.fullName as name,category.categoryName as catname from tblcomplaints join users on users.id=tblcomplaints.userId join category on category.id=tblcomplaints.category where tblcomplaints.complaintNumber='" . $_GET['cid'] . "'";
											$search = "select tblcomplaints.*,users.fullName as name,category.categoryName as catname, faculty.facultyName as facname from tblcomplaints join users on users.id=tblcomplaints.userId join category on category.id=tblcomplaints.category join faculty on faculty.id=tblcomplaints.faculty where tblcomplaints.complaintNumber='$cid' ";
											$search2 = "select tblcomplaints.*, users.fullName as name, category.categoryName as catname from tblcomplaints join users on users.id=tblcomplaints.userId join category on category.id=tblcomplaints.category where tblcomplaints.complaintNumber='$cid' ";
											$sql = $fac !== "" || $dept !== "" ? $search : $search2;
											$query = mysqli_query($bd, $sql);
											while ($row = mysqli_fetch_array($query)) {
											?>
												<tr>
													<td><b>Complaint Number</b></td>
													<td><?php echo htmlentities($row['complaintNumber']); ?></td>
													<td><b>Complainant Name</b></td>
													<td> <?php echo htmlentities($row['name']); ?></td>
													<td><b>Submission Date</b></td>
													<td><?php echo htmlentities($row['regDate']); ?>
													</td>
												</tr>
												<tr>
													<td><b>Category </b></td>
													<td><?php echo htmlentities($row['catname']); ?></td>
													<td><b>SubCategory</b></td>
													<td> <?php echo htmlentities($row['subcategory']); ?></td>
													<td><b>Complaint Type</b></td>
													<td><?php echo htmlentities($row['complaintType']); ?>
													</td>
												</tr>
												<?php if (isset($row['facname'])) { ?>
													<tr>
														<td><b>Faculty </b></td>
														<td><?php echo htmlentities($row['facname']); ?></td>
														<td><b>Department</b></td>
														<td> <?php echo htmlentities($row['department']); ?></td>
														<td><b>Complaint Type</b></td>
														<td><?php echo htmlentities($row['complaintType']); ?>
														</td>
													</tr>
												<?php } ?>
												<tr>
													<td><b>State </b></td>
													<td><?php echo htmlentities($row['state']); ?></td>
													<td><b>Nature of Complaint</b></td>
													<td colspan="3"> <?php echo htmlentities($row['noc']); ?></td>

												</tr>
												<tr>
													<td><b>Complaint Details </b></td>
													<td colspan="5"> <?php echo htmlentities($row['complaintDetails']); ?></td>
												</tr>
												</tr>
												<tr>
													<td><b>File(if any) </b></td>
													<td colspan="5"> <?php $cfile = $row['complaintFile'];
																		if ($cfile == "" || $cfile == "NULL") {
																			echo "File NA";
																		} else { ?>
															<a target="_blank" href="../users/complaintdocs/<?php echo htmlentities($row['complaintFile']); ?>" ?> View File</a>
														<?php } ?>
													</td>
												</tr>
												<?php $ret = mysqli_query($bd, "select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='" . $_GET['cid'] . "'");
												while ($rw = mysqli_fetch_array($ret)) {
												?>
													<tr>
														<td><b>Remark</b></td>
														<td colspan="5"><?php echo  htmlentities($rw['remark']); ?> <b>Remark Date <?php echo  htmlentities($rw['rdate']); ?></b></td>
													</tr>

													<tr>
														<td><b>Status</b></td>
														<td colspan="5"><?php echo  htmlentities($rw['sstatus']); ?></td>
													</tr>
												<?php } ?>

												<tr>
													<td><b>Final Status</b></td>

													<td colspan="5"><?php if ($row['status'] == "") {
																		echo "Not Process Yet";
																	} else {
																		echo htmlentities($row['status']);
																	} ?></td>
												</tr>
												<tr>
													<td><b>Action</b></td>
													<?php if ($row['status'] !== "closed") { ?>
														<td>
															<a class="btn btn-primary" href="updatecomplaint.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>" title="Update report">
																Take Action</a>
														</td>
													<?php } ?>
													<td colspan="4">
														<a class="btn btn-primary" href="userprofile.php?uid=<?php echo htmlentities($row['userId']); ?>&cid=<?php echo htmlentities($row['complaintNumber']); ?>" title="Update report">
															View User Details</a>
													</td>
												</tr>
											<?php  } ?>

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