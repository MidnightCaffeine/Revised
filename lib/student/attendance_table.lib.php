<?php include_once '../connection.php';
session_start();
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");

?>

<table id="studentTable" class="display table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Date</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Remark</th>
            <th>Instructor</th>
            <th>Suhject</th>
            <th>Department</th>
            <th>Section</th>
            <th>Year Group</th>

        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php
        $id = $_SESSION['myid'];
        $selectYou = $pdo->prepare("SELECT * from `student_list` where student_id = '$id'");
        $selectYou->execute();
        while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
            $firstname = $row["student_firstname"];
            $mname = $row["student_middlename"];
            $lname = $row["student_lastname"];
            $fullname = $firstname . " " . $mname . " " . $lname;
        }

        if ($_SESSION["position"] == "Student") {
            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `fullname` = '$fullname' ");
        } elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '' &&  isset($_SESSION['ssect']) && $_SESSION['ssect'] != '' && isset($_SESSION['ssy']) && isset($_SESSION['ssy']) != '' && isset($_SESSION['ssub']) && isset($_SESSION['ssub']) != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept AND `section` = :ssect AND `year_group` = :ssy AND `subject` = :ssub");
            $select->bindParam("dept", $_SESSION['sdept']);
            $select->bindParam("ssect", $_SESSION['ssect']);
            $select->bindParam("ssy", $_SESSION['ssy']);
            $select->bindParam("ssub", $_SESSION['ssub']);
        } elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept ");
            $select->bindParam("dept", $_SESSION['sdept']);
        } elseif (isset($_SESSION['ssect']) && $_SESSION['ssect'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `section` = :ssect ");
            $select->bindParam("ssect", $_SESSION['ssect']);
        } elseif (isset($_SESSION['ssy']) && $_SESSION['ssy'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `year_group` = :ssy ");
            $select->bindParam("ssy", $_SESSION['ssy']);
        } elseif (isset($_SESSION['ssub']) && $_SESSION['ssub'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `subject` = :ssub ");
            $select->bindParam("ssub", $_SESSION['ssub']);
        }
        

        elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '' && isset($_SESSION['ssect']) && $_SESSION['ssect'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept  AND section= :ssect");
            $select->bindParam("dept", $_SESSION['sdept']);
            $select->bindParam("ssect", $_SESSION['ssect']);
        }elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '' && isset($_SESSION['ssy']) && $_SESSION['ssy'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept AND year_level= :ssy");
            $select->bindParam("dept", $_SESSION['sdept']);
            $select->bindParam("ssy", $_SESSION['ssy']);
        }elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '' && isset($_SESSION['ssub']) && $_SESSION['ssub'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept AND subject=:ssub");
            $select->bindParam("dept", $_SESSION['sdept']);
            $select->bindParam("ssub", $_SESSION['ssub']);
        }

        elseif (isset($_SESSION['ssect']) && $_SESSION['ssect'] != '' && isset($_SESSION['ssy']) && $_SESSION['ssy'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `section` = :ssect AND year_level= :ssy ");
            $select->bindParam("ssect", $_SESSION['ssect']);
            $select->bindParam("ssy", $_SESSION['ssy']);
        } elseif (isset($_SESSION['ssect']) && $_SESSION['ssect'] != '' && isset($_SESSION['ssub']) && $_SESSION['ssub'] != '') {
            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `section` = :ssect AND subject=:ssub");
            $select->bindParam("ssect", $_SESSION['ssect']);
            
            $select->bindParam("ssub", $_SESSION['ssub']);
            
        }elseif (isset($_SESSION['ssy']) && $_SESSION['ssy'] != '' && isset($_SESSION['ssub']) && $_SESSION['ssub'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `year_group` = :ssy AND subject=:ssub");
            $select->bindParam("ssy", $_SESSION['ssy']);
            $select->bindParam("ssub", $_SESSION['ssub']);
        }
        
        elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '' && isset($_SESSION['ssect']) && $_SESSION['ssect'] != '' && isset($_SESSION['ssub']) && $_SESSION['ssub'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept  AND section= :ssect AND subject=:ssub");
            $select->bindParam("dept", $_SESSION['sdept']);
            $select->bindParam("ssect", $_SESSION['ssect']);
            
            $select->bindParam("ssub", $_SESSION['ssub']);
        }elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '' && isset($_SESSION['ssect']) && $_SESSION['ssect'] != '' && isset($_SESSION['ssy']) && $_SESSION['ssy'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept  AND section= :ssect AND year_level=:ssy");
            $select->bindParam("dept", $_SESSION['sdept']);
            $select->bindParam("ssect", $_SESSION['ssect']);
            $select->bindParam("ssy", $_SESSION['ssy']);
        }elseif (isset($_SESSION['sdept']) && $_SESSION['sdept'] != '' && isset($_SESSION['ssy']) && $_SESSION['ssy'] != '' && isset($_SESSION['ssub']) && $_SESSION['ssub'] != '') {

            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `department` = :dept AND year_level= :ssy AND subject=:ssub");
            $select->bindParam("dept", $_SESSION['sdept']);
            $select->bindParam("ssy", $_SESSION['ssy']);
            $select->bindParam("ssub", $_SESSION['ssub']);
        }elseif (isset($_SESSION['ssect']) && $_SESSION['ssect'] != '' && isset($_SESSION['ssy']) && $_SESSION['ssy'] != '' && isset($_SESSION['ssub']) && $_SESSION['ssub'] != '') {
            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `section` = :ssect AND subject=:ssub AND year_level=:ssy");
            $select->bindParam("ssect", $_SESSION['ssect']);
            $select->bindParam("ssy", $_SESSION['ssy']);
            $select->bindParam("ssub", $_SESSION['ssub']);
        }
         else {
            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `date_in` = '$d' ");
        }

        $select->execute();
        $num = 0;
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $num++;
            $date = date_create($row["date_in"]);
            $dateadded = date_format($date, "F,d Y");

        ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["fullname"]; ?></td>
                <td><?php echo $dateadded; ?></td>
                <td><?php echo $row["time_in"]; ?></td>
                <td><?php echo $row["time_out"]; ?></td>
                <td><?php echo $row["remark"]; ?></td>
                <td><?php echo $row["instructor"]; ?></td>
                <td><?php echo $row["subject"]; ?></td>
                <td><?php echo $row["department"]; ?></td>
                <td><?php echo $row["section"]; ?></td>
                <td><?php echo $row["year_group"]; ?></td>
            </tr> <?php

                }
                    ?>
    </tbody>
</table>