<?php include_once 'lib/connection.php';
session_start();
include 'lib/student/addStudent.php';
$page = "about-developer";
$user_id = $_SESSION['myid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <title>About Developer</title>
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


<style>
html {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}
.img {
display: block;
max-width: 80%;
height: auto;
margin: 20px;
border: 25px solid black;
border-image: url(assets/img/developer_profile/border.jpg) 120 120;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
align-items: center;
text-align: center;
position: relative;
max-width: 100%;
}

.card::before, .card::after {
  content: "";
  position: absolute;
  left: -2px;
  top: -2px;
  background: linear-gradient(
    -45deg,
    #9B4EC7,
    #BFC74E,
    #4EC75A,
    #C77E4E,
    #099fff
  );
  background-size: 400%;
  height: calc(100% + 5px);
  width: calc(100% + 5px);
  z-index: -1;
  animation: change 40s linear infinite;
}

@keyframes change{
   0%{
      background-position: 0 0;
   }
   50%{
      background-position: 400% 0;
   }
   100%{
      background-position: 0 0;
   }
}

.card::after{
   filter: blur(40px);
   opacity: .5;
}

.container {
  padding: 0 16px;
}

.container::after, .container::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

</style>
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
      <div class="About Developer">

<h2>About Developer</h2>
<p>We are the team Midnight Coffee from Aurora State College of Technology. We are currently under the fourth-year college who specialize Application Programming. This produced system is our capstone project.</p>
<br>

<div class="row">
  <div class="column">
    <div class="card">
      <img class="img" src="assets/img/developer_profile/jobert.jpg" alt="Jobert">
      <div class="container">
        <h2>Jobert Simbre</h2>
        <p class="title">Application Programming - A4</p>
        <p>Info</p>
        <p>@gmail.com</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img class="img" src="assets/img/developer_profile/dylan.jpg" alt="Dylan">
      <div class="container">
        <h2>Dylan Reeve Gundran</h2>
        <p class="title">Application Programming - A4</p>
        <p>Info</p>
        <p>@gmail.com</p>

      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img class="img" src="assets/img/developer_profile/henry.jpg" alt="James">
      <div class="container">
        <h2>James Henry Ruzol</h2>
        <p class="title">Application Programming - A4</p>
        <p>Info</p>
        <p>@gmail.com</p>
      </div>
    </div>
  </div>
 
  <div class="column">
    <div class="card">
      <img class="img" src="assets/img/developer_profile/khaster.jpg" alt="Khaster">
      <div class="container">
        <h2>Khaster Troi Bautista</h2>
        <p class="title">Application Programming -A4</p>
        <p>Info</p>
        <p>@gmail.com</p>
      </div>
    </div>
  </div>
</div>


   <footer id="footer" class="footer">
      <div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
   </footer>
   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <script>
      $(document).ready(function() {
         $('#studentTable').DataTable({
            pagingType: 'full_numbers',
            responsive: true,

         });
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