<?php
session_start();
include_once '../connection.php';


if (isset($_POST['deleteInstructor'])) {
    $id = $_POST['id'];
    $delete = $pdo->prepare("DELETE FROM `teacher_list` WHERE teacher_id='$id' ");
    $delete->execute();
    $delete = $pdo->prepare("DELETE FROM `user_list` WHERE id='$id' ");
    if ($delete->execute()) {

        $_SESSION['status'] = "dsuccess";

        header("location:../../manage_teacher.php");
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
