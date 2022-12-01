<?php
session_start();
include_once '../connection.php';


if (isset($_POST['deleteCardbtn'])) {
    $id = $_POST['id'];
    $delete = $pdo->prepare("DELETE FROM `rfid_card` WHERE card_id='$id' ");
    if ($delete->execute()) {

        $_SESSION['status'] = "dsuccess";

        header("location:../../rfid_cards.php");
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
