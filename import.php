<?php
include_once 'lib/connection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;



if (isset($_POST['save_exel_data'])) {
    $filename = $_FILES['import_file']['name'];
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = 0;
        foreach ($data as $row) {
            if ($count > 0) {
                $firstname = ucwords(strtolower($row['0']));
                $middlename = ucwords(strtolower($row['1']));
                $lastname = ucwords(strtolower($row['2']));
                $phone = $row['3'];
                $yeargroup = $row['4'];
                $department = $row['5'];
                $section = $row['6'];
                $guardianEmail = $row['7'];
                $username = $row['8'];
                $password = $row['9'];
                $email = $row['10'];

                $position = 'Student';
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $select = $pdo->prepare("SELECT email from user_list where email='$email'");
                $select->execute();

                if ($select->rowCount() > 0) {

                    $_SESSION['message'] = "Email already exist";
                }
                $select = $pdo->prepare("SELECT username from user_list where username='$username'");
                $select->execute();
                if ($select->rowCount() > 0) {
                    $_SESSION['message'] = "Username already exist";
                } else {
                    $insert = $pdo->prepare("INSERT into user_list(username,email,password,position) values(:name,:email,:pass,:position)");

                    $insert->bindParam(':name', $username);
                    $insert->bindParam(':email', $email);
                    $insert->bindParam(':pass', $hashedPassword);
                    $insert->bindParam(':position', $position);
                    if ($insert->execute()) {
                        $select = $pdo->prepare("SELECT id FROM user_list WHERE username='$username'");
                        $select->execute();

                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row['id'];
                        }

                        $insert = $pdo->prepare("INSERT into student_list(student_id ,student_firstname,student_middlename ,student_lastname, phone, year_group, department, section, guardian_email ) values(:id, :firstname, :middlename, :lastname,:phone, :yeargroup, :department, :section, :guardianemail)");

                        $insert->bindParam(':id', $id);
                        $insert->bindParam(':firstname', $firstname);
                        $insert->bindParam(':middlename', $middlename);
                        $insert->bindParam(':lastname', $lastname);
                        $insert->bindParam(':phone', $phone);
                        $insert->bindParam(':yeargroup', $yeargroup);
                        $insert->bindParam(':department', $department);
                        $insert->bindParam(':section', $section);
                        $insert->bindParam(':guardianemail', $guardianEmail);
                        $insert->execute();
                    }
                }
            } else {
                $count = 1;
            }
        }
        $_SESSION['status'] = "asuccess";
        header("Location: manage_student.php");
    } else {
        $_SESSION['status'] = "invalid file";
        header("Location: manage_student.php");
        exit(0);
    }
}
