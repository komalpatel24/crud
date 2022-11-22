<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '');


 
if ($conn) { 
    if (!mysqli_select_db($conn,'test')) {
        $createDB = "CREATE DATABASE test";  
        if(mysqli_query($conn,$createDB)){
            mysqli_select_db($conn,"test");
        }
    }

}else{
    echo mysqli_connect_error();
    
}

?>
