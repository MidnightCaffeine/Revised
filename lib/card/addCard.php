<?php
session_start();

if (isset($_POST['btn_addCard'])) {

    $cardnumber = $_POST['cardNumber'];
    $available = 'Available';
    $insert = $pdo->prepare("INSERT INTO `rfid_card`(card_number,card_status) values(:cardnumber,:available)");

    $insert->bindParam(':cardnumber', $cardnumber);
    $insert->bindParam(':available', $available);

    if ($insert->execute()) {

        $_SESSION['status'] = "asuccess";
    } else {
        $_SESSION['status'] = "error";
    }
} // end if txtemail
