<?php include_once 'lib/connection.php';
session_start();
$page = "attendance_instuctor";

if (!isset($_SESSION['username'])) {
	session_unset();
	session_write_close();
	session_destroy();
	header("Location: index.php");
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <title>Instructor Attendance</title>
   <meta name="robots" content="noindex, nofollow">
   <meta content="" name="description">
   <meta content="" name="keywords">
   <link href="assets/img/ascotLogo.png" rel="icon">
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="assets/css/bootstrap.min.css" rel="stylesheet">
   <script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
   <script src="assets/js/jquery.validate.js"></script>
   <script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
   <script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
   <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap5.min.css">
   <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
   <link href="assets/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/css/quill.snow.css" rel="stylesheet">
   <link href="assets/css/quill.bubble.css" rel="stylesheet">
   <link href="assets/css/remixicon.css" rel="stylesheet">
   <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
   <?php

   if ($_SESSION['status'] ==  "usuccess") {
      echo '<script type="text/javascript">
   toastr.success("Chages are saved Successfully")
   </script>';
   } elseif ($_SESSION['status'] ==  "asuccess") {
      echo '<script type="text/javascript">
   toastr.success("Added Successfully")
   </script>';
   } elseif ($_SESSION['status'] ==  "dsuccess") {
      echo '<script type="text/javascript">
   toastr.success("Deleted Successfully")
   </script>';
   }

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
         <?php
         if ($_SESSION["position"] == "Student") {
            echo  "<h1>My Attendance</h1>";
         } else {
            echo  "<h1>Instructor Attendance</h1>";
         }
         ?>

         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="home.php">Home</a></li>
               <li class="breadcrumb-item">Attendance</li>
               <li class="breadcrumb-item active"> <?php
                                                   if ($_SESSION["position"] == "Student") {
                                                      echo  $_SESSION['fullname'];
                                                   } else {
                                                      echo  "Instructor Attendance";
                                                   }
                                                   ?></li>
            </ol>
         </nav>
      </div>
      <section class="section dashboard">
         <div class="row">
            <div class="d-flex align-items-center mt-3 mb-2">

            <a type="button" class="btn btn-primary ms-auto mb-2" href="lib/instructor/exportAttendance.php"><i class='bx bx-download'></i> Export</a>

            </div>
            <div id="instructorTable"></div>
         </div>
      </section>
   </main>
   <footer id="footer" class="footer">
      <div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
   </footer>
   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <script>
      $(document).ready(function() {
         $("#instructorTable").load("lib/instructor/attendance_table.lib.php");
         setInterval(function() {
            $("#instructorTable").load("lib/instructor/attendance_table.lib.php");
         }, 2500);
      });
   </script>


   <!-- add User Modal -->

   <div class="modal fade" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <form id="addstudent" action="" method="post">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <fieldset>
                     <div class="row mb-2">
                        <div class="col-sm-5 col-md-6 mb-2">
                           <div class="form-group">
                              <label for="firstname">Firstname</label>
                              <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname" required />
                           </div>
                        </div>
                        <div class="col-sm-5 col-md-6 mb-2">
                           <div class="form-group">
                              <label for="lastname">Lastname</label>
                              <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname" required />
                           </div>
                        </div>
                     </div>
                     <div class="form-group mb-2">
                        <label for="middlename">Middlename</label>
                        <input type="middlename" name="middlename" class="form-control" placeholder="Enter Middlename" />
                     </div>
                     <div class="form-group mb-2">
                        <select name="position" id="position" class="form-select form-control" hidden>
                           <option id="position-option" value="Student" selected>Student</option>
                           <option id="position-option" value="Instructor">Instructor</option>
                        </select>
                     </div>
                     <div class="form-group mb-2">
                        <label for="department">Department</label>
                        <select name="department" id="department" class="form-select form-control">
                           <option value="" selected disabled>--Select Department--</option>
                           <option id="department-option" value="BSIT">BSIT</option>
                        </select>
                     </div>
                     <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="username" name="username" class="form-control" placeholder="Enter Username" required />
                     </div>
                     <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email@example.com" required />
                     </div>
                     <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control" placeholder="enter your passsword" required />
                     </div>
                     <div class="form-group mb-3">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="repeat passsword" required />
                     </div>
                  </fieldset>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" name="btn_addStudent">Understood</button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script src="assets/js/apexcharts.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/chart.min.js"></script>
   <script src="assets/js/echarts.min.js"></script>
   <script src="assets/js/quill.min.js"></script>
   <script src="assets/js/tinymce.min.js"></script>
   <script src="assets/js/main.js"></script>

</body>

</html>