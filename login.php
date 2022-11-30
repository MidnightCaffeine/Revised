<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/icheck.min.js"></script>
<script src="assets/js/sweetalert.js"></script>


<?php
include_once 'lib/connection.php';
session_start();

date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
$t = date("h:i:s A");
$action = 'Login';

if (isset($_POST['btn_login'])) {

    $useremail = $_POST['email'];
    $password = $_POST['password'];


    $select = $pdo->prepare("SELECT * FROM user_list WHERE email = '$useremail' OR username = '$useremail' ");

    $select->execute();

    $row = $select->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $row['password'])) {
        if ($row['email'] == $useremail or $row['username'] == $useremail) {
            $_SESSION['myid'] = $row['id'];
            $id = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['position'] = $row['position'];
            $_SESSION['status'] = '';

            $insertLog = $pdo->prepare("INSERT INTO user_log(user_id, user, action, log_date, log_time) values(:id, :user, :action, :logDate, :logTime)");

            $insertLog->bindParam(':id', $id);
            $insertLog->bindParam(':user', $useremail);
            $insertLog->bindParam(':action', $action);
            $insertLog->bindParam(':logDate', $d);
            $insertLog->bindParam(':logTime', $t);
            $insertLog->execute();

            if ($row["position"] == "Student") {
                $selectYou = $pdo->prepare("SELECT * from `student_list` where student_id = '$id'");
                $selectYou->execute();
                while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
                    $firstname = $row["student_firstname"];
                    $mname = $row["student_middlename"];
                    $lname = $row["student_lastname"];
                }
                $_SESSION['fullname'] = $firstname . " " . $mname . " " . $lname;
            } elseif ($row["position"] == "Instructor") {
                $selectYou = $pdo->prepare("SELECT * from `teacher_list` where teacher_id = '$id'");
                $selectYou->execute();
                while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
                    $firstname = $row["teacher_firstname"];
                    $mname = $row["teacher_middlename"];
                    $lname = $row["teacher_lastname"];
                }
                $_SESSION['fullname'] = $firstname . " " . $mname . " " . $lname;
            } else {
                $_SESSION['fullname'] = "Admin";
            }
            echo '<script type="text/javascript">
                    jQuery(function validation(){
                    
                    swal({
                          title: "Good job! ' . $_SESSION['username'] . '",
                          text: "Details Matched!!",
                          icon: "success",
                          button: "Loading...",
                        });
                    
                    
                    });
                  </script>';


                    if($_SESSION['position'] == 'Administrator'){
                        header('refresh:1;home.php');
                    }elseif($_SESSION['position'] == 'Student'){
                        header('refresh:1;student_dashboard.php');
                    }
        }
    } else {

        echo '<script type="text/javascript">
                jQuery(function validation(){
                
                swal({
                      title: "Access Denied!",
                      text: "Details Did Not Matched!!",
                      icon: "error",
                      button: "Try Again",
                    });
                
                
                });
              </script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="assets/img/ascotLogo.png" rel="icon">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/material-design-icons.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/blue.css">
    <link rel="stylesheet" href="assets/css/animate.css">
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 px-0 d-none d-sm-block thumbnail text-center">
                    <?php
                    $imagesDir = 'assets/img/bg/';

                    $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                    $randomImage = $images[array_rand($images)];

                    ?>
                    <img src="<?php echo $randomImage; ?>" alt="Random Images" class="login-img" />
                    <div class="caption">
                        <img src="assets/img/ascotLogo.png" alt="logo" class="logo animate__animated animate__bounce" />
                        <h3>ASCOT RFID Class Attendance Monitoring and Student Profiling system</h3>
                    </div>
                </div>
                <div class="col-sm-6 login-section-wrapper">
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Log in</h1>
                        <form action="" method="post">
                            <div class="form-group form-floating">
                                <input type="text" name="email" class="form-control" placeholder=" " required />
                                <label for="email">Email or Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" id="youCantCopyTheValue" name="password" class="form-control" placeholder=" " required />
                                <label for="password">Password</label>
                            </div>
                            <input name="btn_login" id="login" class="btn btn-block login-btn" type="submit" value="Login" />
                        </form>
                        <a href="#!" class="forgot-password-link">Forgot password?</a>
                        <p class="login-wrapper-footer-text">
                            Don't have an account?
                            <a href="signup.php" class="text-reset">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
    <script>
        $('#youCantCopyTheValue').bind("cut copy", function(e) {
            e.preventDefault();
        })
    </script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>