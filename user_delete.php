<?php

include 'config.php';

$id = $_GET['del_id'];

$deleteQuery = "DELETE  FROM  user WHERE id=$id";

if(mysqli_query($conn,$deleteQuery)){
    echo "<script> alert('Record Deleted') 
    window.location.href='user_logout.php';
    </script>";
}
?>

