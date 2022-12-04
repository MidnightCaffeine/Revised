<?php include_once 'lib/connection.php';
include 'lib/card/addCard.php';
$page = "rfid_card";
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
   <title>Manage RFID Cards</title>
   <link href="assets/img/ascotLogo.png" rel="icon">
   <meta name="robots" content="noindex, nofollow">
   <meta content="" name="description">
   <meta content="" name="keywords">
   <link href="assets/img/ascotLogo.png" rel="icon">
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" rel="stylesheet">
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
         <h1>Manage RFID Cards</h1>
         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item">Manage</li>
               <li class="breadcrumb-item">Device</li>
               <li class="breadcrumb-item active">RFID Cards</li>
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
               <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addCard">Add Card</button>

            </div>
            <table id="cardTable" class="display table table-bordered">
               <thead>
                  <tr>
                     <th>Card ID</th>
                     <th>Card Number</th>
                     <th>Card Status</th>
                     <th>Card Holder</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody class="table-group-divider">
                  <?php
                  $select = $pdo->prepare("SELECT * FROM rfid_card ORDER BY card_id ");

                  $select->execute();
                  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                     <tr>
                        <td><?php echo $row["card_id"]; ?></td>
                        <td><?php echo $row["card_number"]; ?></td>
                        <td><?php echo $row["card_status"]; ?></td>
                        <td><?php echo $row["card_holder"]; ?></td>
                        <td>
                           <a type="button" class="btn btn-primary ms-auto" href="editCard.php?id=<?php echo $row["card_id"]; ?>" data-toggle="tooltip" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        </td>
                        <td>
                           <?php
                           $stdId = $row['card_id'];
                           ?>
                           <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCard" data-toggle="tooltip" title="Delete"><i class="bi bi-trash"></i></button>

                        </td>
                     </tr> <?php }
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


   <!-- add User Modal -->

   <div class="modal fade" id="addCard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <form id="addCard" action="" method="post">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add RFID Card</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="formFile" class="form-label">Import from spreadsheet</label>
                     <input class="form-control" type="file" id="formFile">
                  </div>
                  <hr id="hr1">
                  <label class="mb-2">Or add manually</label>
                  <fieldset>
                     <div class="row mb-2">
                        <div class="col-sm-5 col-md-6 mb-2">
                           <div class="form-group">
                              <label for="cardNumber">Card Number</label>
                              <input type="text" name="cardNumber" class="form-control" required />
                           </div>
                        </div>
                  </fieldset>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-primary" type="submit" name="btn_addCard">Add</button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
   <script src="assets/js/jquery.validate.js"></script>
   <script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
   <script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/apexcharts.min.js"></script>
   <script src="assets/js/chart.min.js"></script>
   <script src="assets/js/echarts.min.js"></script>
   <script src="assets/js/quill.min.js"></script>
   <script src="assets/js/tinymce.min.js"></script>
   <script src="assets/js/main.js"></script>
   <script src="assets/js/toastr.min.js"></script>
   <script>
      $('#cardTable').DataTable({
         pagingType: 'full_numbers',
         responsive: true,
         columnDefs: [{
            'targets': [1, 2, 3, 4, 5],
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
   <div id="deleteCard" class="modal fade">
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
               <form action="lib/card/deleteCard.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $stdId; ?>">
                  <button type="submit" name="deleteCardbtn" class="btn btn-danger">Delete</button>
               </form>
            </div>
         </div>
      </div>
   </div>

</body>

</html>