<script src="assets/js/sweetalert.js"></script>
<?php
$page = "add_student";
include_once 'lib/connection.php';
session_start();

include 'lib/student/addStudent.lib.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Add Student</title>
	<meta name="robots" content="noindex, nofollow">
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="assets/img/ascotLogo.png" rel="icon">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/jquery.validate.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap5.min.css">
	<link href="assets/css/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/css/quill.snow.css" rel="stylesheet">
	<link href="assets/css/quill.bubble.css" rel="stylesheet">
	<link href="assets/css/remixicon.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">



	<script>
		$().ready(function() {

			// validate signup form on keyup and submit
			$("#addStudentForm").validate({
				rules: {
					firstname: "required",
					lastname: "required",
					middlename: {
						required: false,
						minlength: 2
					},
					department: "required",
					username: {
						required: true,
						minlength: 5
					},
					password: {
						required: true,
						minlength: 4
					},
					confirm_password: {
						required: true,
						minlength: 4,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					},
				},
				messages: {
					firstname: "Please enter your firstname",
					lastname: "Please enter your lastname",
					department: "Please select a department",
					middlename: {
						minlength: "Middlename not middle inittial"
					},
					username: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 5 characters"
					},
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: "Please enter a valid email address",
				}
			});
		});
	</script>

</head>

<body>
	<?php
	include 'include/navigation.php';
	if ($_SESSION["position"] == "Administrator") {
		include 'include/sideNavigation.php';
	} elseif ($_SESSION["position"] == "Instructor") {
		include 'include/instructorSideNavigation.php';
	} elseif ($_SESSION["position"] == "Student") {
		include 'include/studentSideNavigation.php';
	}
	?>
	<main id="main" class="main">
		<div class="pagetitle">
			<h1>Add Student</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Manage</li>
					<li class="breadcrumb-item">Users</li>
					<li class="breadcrumb-item">Student</li>
					<li class="breadcrumb-item active">Add Student</li>
				</ol>
			</nav>
		</div>
		<section class="section dashboard">
			<div class="row ms-3 me-3">
				<div>
					<a type="button" class="btn btn-primary ms-auto mb-2" href="manage_student.php"><i class='bx bx-arrow-back'></i> Back</a>
				</div>

				<div class="card mt-3">
					<div class="card-body">
						<div class="mt-3">
							<form id="importStudent" action="import.php" method="post" enctype="multipart/form-data">
								<div class="mb-2">
									<label for="importFile" class="form-label">Import from spreadsheet</label>
									<div class="input-group">
										<input type="file" name="import_file" class="form-control" id="import_file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
										<button name="save_exel_data" class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Button</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<h5 class="mt-3">Provide details manually</h5>
						<?php if (isset($_SESSION['message'])) : ?>
							<div class="msg">
								<?php
								echo $_SESSION['message'];
								unset($_SESSION['message']);
								?>
							</div>
						<?php endif ?>
						<div class="">
							<form id="addStudentForm" action="" method="post">
								<div class="">
									<fieldset>
										<div class="row mb-2 pt-2">
											<div class="col-sm-5 col-md-6 mb-2">
												<div class="form-group">
													<input type="text" name="firstname" class="form-control" placeholder="Firstname" required />
												</div>
											</div>
											<div class="col-sm-5 col-md-6 mb-2">
												<div class="form-group">
													<input type="text" name="lastname" class="form-control" placeholder="Lastname" required />
												</div>
											</div>
										</div>
										<div class="form-group mb-3">
											<input type="middlename" name="middlename" class="form-control" placeholder="Middlename" />
										</div>
										<div class="form-group mb-3">
											<select name="position" id="position" class="form-select form-control" hidden>
												<option value="" disabled>--Select Position--</option>
												<option id="position-option" selected value="Student">Student</option>
												<option id="position-option" value="Instructor">Instructor</option>
											</select>
										</div>
										<div class="form-group mb-3">
											<select name="department" id="department" class="form-select form-control" required>
												<option value="" selected disabled>--Select Department--</option>
												<option id="department-option" value="BSIT">BSIT</option>
											</select>
										</div>
										<div class="form-group mb-3">
											<input type="username" name="username" class="form-control" placeholder="Username" required />
										</div>
										<div class="form-group mb-3">
											<input type="email" name="email" class="form-control" placeholder="Email" required />
										</div>
										<div class="form-group mb-3">
											<input id="password" type="password" name="password" class="form-control" placeholder="Password" required />
										</div>
										<div class="form-group mb-3">
											<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required />
										</div>

										<input name="btn_addStudent" id="signup" class="btn btn-block btn-primary" type="submit" value="Add Student" />
									</fieldset>
							</form>
						</div>
					</div>
				</div>


			</div>
		</section>
	</main>
	<footer id="footer" class="footer">
		<div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/apexcharts.min.js"></script>
	<script src="assets/js/chart.min.js"></script>
	<script src="assets/js/echarts.min.js"></script>
	<script src="assets/js/quill.min.js"></script>
	<script src="assets/js/tinymce.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
	<script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>