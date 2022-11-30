<?php

include 'SQL_con.php';
include '../profile.php';

$user_id = $_SESSION['myid'];
$select = mysqli_query($pdo, "SELECT * FROM 'user_list' WHERE id = '$user_id'") or die ('query failed');
if(mysqli_num_rows($select) > 0){
$fetch=mysqli_fetch_assoc($select);

}

if(isset($_POST['update'])){

$about = mysqli_real_escape_string($pdo, $_POST['about']);
   $username = mysqli_real_escape_string($pdo, $_POST['username']);
   $cardN = mysqli_real_escape_string($pdo, $_POST['cardN']);
$phone = mysqli_real_escape_string($pdo, $_POST['Phone']);
$email = mysqli_real_escape_string($pdo, $_POST['Email']);


   mysqli_query($pdo, "UPDATE `user_list` SET username = '$username', card_number='$cardN', email = '$email' WHERE id = '$user_id'") or die('query failed');


   $img = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['img']['size'];
   $update_image_tmp_name = $_FILES['img']['tmp_name'];
   $update_image_folder = '../assets/img/uploads/'.$img;

   if(!empty($img)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
header("Location: ../my_profile.php?error=$em&$data");
      }else{
         $image_update= mysqli_query($pdo, "UPDATE `user_list` SET photo = '$img' WHERE id = '$user_id'") or die('query failed');
         if($image_update){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
header("Location: ../profile.php");
      }
   }

}

?>
