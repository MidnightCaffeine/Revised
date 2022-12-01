<?php
include 'connection.php';
date_default_timezone_set('Asia/Manila');
$cardid = $_POST['cardid'];
$d = date("Y-m-d");
$t = date("h:i:s A");
$remark = array("On Time", "Late", "Absent");

require __DIR__ . '../../vendor/autoload.php';

use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC4b66b8d70feb4d6d056df8e8f2521f58';
$auth_token = '1b94d357d9dee7717ff1c8dc1b5182bd';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+15138662927";

$client = new Client($account_sid, $auth_token);

$select = $pdo->prepare("SELECT * from user_list where card_number='$cardid'");
$select->execute();

while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
	$id = $row["id"];
	if ($row["position"] == "Student") {

		$selectStudent = $pdo->prepare("SELECT * from `student_list` where student_id = '$id'");
		$selectStudent->execute();
		while ($row = $selectStudent->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["student_firstname"];
			$mname = $row["student_middlename"];
			$lname = $row["student_lastname"];
			$guardianEmail = $row["guardian_email"];
		}
		$fullname = $firstname . " " . $mname . " " . $lname;

		$getInstructor = $pdo->prepare("SELECT * from attendance_instructor WHERE `date_in` = '$d' AND `time_out`='0' ");
		$getInstructor->execute();
		while ($row = $getInstructor->fetch(PDO::FETCH_ASSOC)) {
			$teacher_login = date($row["time_in"]);
			$current_instructor = $row["fullname"];
		}


		$select = $pdo->prepare("SELECT * from attendance WHERE fullname='$fullname' AND date_in='$d' AND time_out='0' ");
		$select->execute();


		if ($select->rowCount() > 0) {
			//logout
			while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				$ids = $row["id"];
			}
			$update = $pdo->prepare("UPDATE `attendance` SET `time_out` = '$t' WHERE `attendance`.`fullname` = '$fullname' AND `date_in` = '$d' AND `id` = '$ids' ");
			$update->execute();
			echo "success";
		} elseif ($t >= date('H:i:s', strtotime($teacher_login . ' +15 minutes'))) { //login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`, `time_out`, `remark` ,`instructor`) VALUES (:fullname, :d, :t, '0', :remark,:instructor)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->bindParam(":remark", $remark[1]);
			$insert->bindParam(":instructor", $current_instructor);
			$insert->execute();
			echo "success";
		} elseif ($t < date('H:i:s', strtotime($teacher_login . ' +15 minutes'))) { //login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`,`time_out`,`remark`,`instructor`) VALUES (:fullname, :d, :t, '0',:remark,:instructor)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->bindParam(":remark", $remark[0]);
			$insert->bindParam(":instructor", $current_instructor);
			$insert->execute();

			echo "success";
		} else {
			echo "error";
		}
	} elseif ($row["position"] == "Instructor") {

		$selectTeacher = $pdo->prepare("SELECT * from `teacher_list` where teacher_id = '$id'");
		$selectTeacher->execute();
		while ($row = $selectTeacher->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["teacher_firstname"];
			$mname = $row["teacher_middlename"];
			$lname = $row["teacher_lastname"];
		}
		$fullname = $firstname . " " . $mname . " " . $lname;


		$select = $pdo->prepare("SELECT * from attendance_instructor where fullname='$fullname' AND date_in='$d' AND time_out='0' ");
		$select->execute();

		if ($select->rowCount() > 0) { //logout
			while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				$ids = $row["id"];
			}
			$update = $pdo->prepare("UPDATE `attendance_instructor` SET `time_out` = '$t' WHERE `attendance_instructor`.`fullname` = '$fullname' AND `date_in` = '$d' AND `id` = '$ids' ");
			if ($update->execute()) {
				$selectAbsent = $pdo->prepare("SELECT * FROM student_list");
				$selectAbsent->execute();
				while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					$ids = $row["id"];

					$slname = $row["student_firstname"];
					$smname = $row["student_middlename"];
					$ssname = $row["student_lastname"];

					$studentName = $slname . " " . $smname . " " . $ssname;

					$getAttendanceList = $pdo->prepare("SELECT * FROM attendance WHERE fullname='$studentName' AND date_in='$d' AND time_out='0'");
					$getAttendanceList->execute();

					if ($getAttendanceList->rowCount() < 0) {

						$d = 0;

						$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`,`time_out`,`remark`,`instructor`) VALUES (:fullname, :d, :t, '0',:remark,:instructor)");
						$insert->bindParam(":fullname", $studentName);
						$insert->bindParam(":d", $d);
						$insert->bindParam(":t", $d);
						$insert->bindParam(":remark", $remark[2]);
						$insert->bindParam(":instructor", $fullname);
						$insert->execute();
					} elseif (($getAttendanceList->rowCount() > 0)) {

						$update = $pdo->prepare("UPDATE `attendance` SET `time_out` = '$t' WHERE `attendance`.`fullname` = '$studentName' AND `date_in` = '$d'");
						$update->execute();
					} else {
						echo "success";
					}
				}
			}
		} else { //login
			$insert = $pdo->prepare("INSERT INTO `attendance_instructor`(`fullname`, `date_in`, `time_in`, `time_out`) VALUES (:fullname, :d, :t, '0')");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->execute();

			$selectStudents = $pdo->prepare("SELECT phone from student_list ");
			if ($selectStudents->execute()) {
				while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					$phone = $row["phone"];
				}
			}
			echo "success";
		}
	}
}
