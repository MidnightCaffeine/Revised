<?php 

try{
    $pdo = new PDO('mysql:host=localhost;dbname=rfid_attendance','root','');
    //echo'Connection Successful!';

    
}catch(PDOException $f){
    
    echo $f->getmessage();
}


?>