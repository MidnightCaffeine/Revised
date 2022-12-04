<?php include_once 'lib/connection.php';
$page = "manage_student";
session_start();

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
   <title>Manage Student</title>
   <meta name="robots" content="noindex, nofollow">
   <meta content="" name="description">
   <meta content="" name="keywords">
   <link href="assets/img/ascotLogo.png" rel="icon">
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="assets/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap5.min.css">
   <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
   <link href="assets/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/css/quill.snow.css" rel="stylesheet">
   <link href="assets/css/quill.bubble.css" rel="stylesheet">
   <link href="assets/css/remixicon.css" rel="stylesheet">
   <link href="assets/css/style.css" rel="stylesheet">
   <link href="assets/css/toastr.css" rel="stylesheet">
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
         <h1>Manage Student</h1>
         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item">Manage</li>
               <li class="breadcrumb-item">Users</li>
               <li class="breadcrumb-item active">Student</li>
            </ol>
         </nav>
      </div>
      <section class="section dashboard">
         <div class="row">
            <div class="d-flex align-items-center mt-3 mb-2">
               <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sort</button>
                  <ul class="dropdown-menu">
                     <li><a href="#" class="dropdown-item">BSIT AP3</a></li>
                     <li><a href="#" class="dropdown-item">BSIT AP4</a></li>
                  </ul>
               </div>

               <!-- add trigger modal -->
               <a type="button" class="btn btn-primary ms-auto mb-2" href="addStudent.php"><i class='bx bx-user-plus'></i> Add Student</a>
            </div>
            <table id="studentTable" class="display table table-bordered">
               <thead>
                  <tr>
                     <th>Student ID</th>
                     <th>Lastname</th>
                     <th>Firstname</th>
                     <th>Middlename</th>
                     <th>Phone</th>
                     <th>Year Group</th>
                     <th>Department</th>
                     <th>Section</th>
                     <th>Edit</th>
                     <?php
                     if ($_SESSION['position'] == 'Administrator') { ?>
                        <th>Delete</th>
                     <?php
                     }
                     ?>
                  </tr>
               </thead>
               <tbody class="table-group-divider">
                  <?php
                  $select = $pdo->prepare("SELECT * FROM student_list  ORDER BY student_id ASC");

                  $select->execute();
                  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                     <tr>
                        <td><?php echo $row["student_id"]; ?></td>
                        <td><?php echo $row["student_lastname"]; ?></td>
                        <td><?php echo $row["student_firstname"]; ?></td>
                        <td><?php echo $row["student_middlename"]; ?></td>
                        <td><?php echo $row["phone"]; ?></td>
                        <td><?php echo $row["year_group"]; ?></td>
                        <td><?php echo $row["department"]; ?></td>
                        <td><?php echo $row["section"]; ?></td>
                        <td>
                           <a type="button" class="btn btn-primary ms-auto" href="editStudent.php?id=<?php echo $row["student_id"]; ?>" data-toggle="tooltip" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        </td>

                        <?php
                        if ($_SESSION['position'] == 'Administrator') { ?>
                           <td>
                              <?php
                              $stdId = $row['student_id'];
                              ?>
                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal" data-toggle="tooltip" title="Delete"><i class="bi bi-trash"></i></button>
                           </td>


                     </tr> <?php }
                     }
                           ?>
               </tbody>
            </table>
         </div>
      </section>
   </main>
   <footer id="footer" class="footer">
      <div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
   </footer>
   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



   <script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
   <script src="assets/js/jquery.validate.js"></script>
   <script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
   <script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
   <script src="assets/js/apexcharts.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/chart.min.js"></script>
   <script src="assets/js/echarts.min.js"></script>
   <script src="assets/js/quill.min.js"></script>
   <script src="assets/js/tinymce.min.js"></script>
   <script src="assets/js/main.js"></script>
   <script src="assets/js/toastr.min.js"></script>

   <script>
      $('#studentTable').DataTable({
         pagingType: 'full_numbers',
         responsive: true,
         columnDefs: [{
            'targets': [0, 2, 3, 4, 5],
            /* column index */

            'orderable': false,
            /* true or false */
         }, ],
      });
   </script>

   <?php

   if ($_SESSION['status'] ==  "usuccess") { ?>

      <script type="text/javascript">
         toastr.success("Chages are saved Successfully");
      </script>

   <?php
   } elseif ($_SESSION['status'] ==  "asuccess") { ?>

      <script type="text/javascript">
         toastr.success("Added Successfully");
      </script>

   <?php
   } elseif ($_SESSION['status'] ==  "dsuccess") { ?>
      <script type="text/javascript">
         toastr.success("Deleted Successfully");
      </script>
   <?php
   }
   $_SESSION['status'] = '';
   ?>
   <!-- Modal HTML -->
   <div id="myModal" class="modal fade">
      <div class="modal-dialog modal-confirm  modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header flex-column">
               <div class="icon-box">
                  <i class="material-icons">&#xE5CD;</i>
               </div>
               <h4 class="modal-title w-100">Are you sure?</h4>
            </div>
            <div class="modal-body">
               <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
               <form action="lib/student/deleteStudent.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $stdId; ?>">
                  <button type="submit" name="delete" class="btn btn-danger">Delete</button>
               </form>
            </div>
         </div>
      </div>
   </div>

</body>

</html>