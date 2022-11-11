<?php

include 'config.php';

$id = $_GET['del_id'];

$deleteQuery = "DELETE  FROM  admin WHERE id=$id";

if(mysqli_query($conn,$deleteQuery)){
    echo "<script> alert('Record Deleted') 
    window.location.href='dashboard1.php';
    </script>";
}
?>

