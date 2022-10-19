<?php

session_start();
setcookie('id',$_SESSION['id'],time() - 300,'/');
session_unset();
session_destroy();
header('location:user_login.php');
?>