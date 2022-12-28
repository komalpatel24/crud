<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '');
 
if ($conn) { 
    if (!mysqli_select_db($conn,'mysy')) {
        $createDB = "CREATE DATABASE mysy";  
        if(mysqli_query($conn,$createDB)){
            mysqli_select_db($conn,"mysy");
        }
    }
}else{
    echo mysqli_connect_error();
    
}

?>
