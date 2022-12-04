<?php
include '../connection.php';

if(isset($_POST["submit_file"]))
{
 $file = $_FILES["import_file"]["tmp_name"];
 $file_open = fopen($file,"r");
 while(($csv  = fgetcsv($file_open, 1000, ",")) !== false)
 {

  $firstname = ucwords(strtolower($csv [0]));
  $middlename = ucwords(strtolower($csv [1]));
  $lastname = ucwords(strtolower($csv [2]));
  $phone = $csv [3];
  $yeargroup = $csv [4];
  $department = $csv [5];
  $section = $csv [6];
  $guardianEmail = $csv [7];
  $username = $csv [8];
  $password = $csv [9];
  $email = $csv [10];


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
    
  $insert = $pdo->prepare("INSERT into student_list(student_id ,student_firstname,student_middlename ,student_lastname, department ) values(:id, :firstname, :middlename, :lastname, :department)");

  $insert->bindParam(':id', $id);
  $insert->bindParam(':firstname', $firstname);
  $insert->bindParam(':middlename', $middlename);
  $insert->bindParam(':lastname', $lastname);
  $insert->bindParam(':department', $department);
  $insert->execute();
  }


 }
}
