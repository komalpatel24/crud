<?php
 include 'conn.php';
 
 $fNameErr = $lNameErr  = $ageErr = $genErr = $depErr = $dojErr = $salaryErr = $emailErr = $passwordErr = $cPasswordErr = $hobbyErr = $fileErr = '';
 
 # insert data through user
 if (isset($_POST['submit']) ) {
 
     $selectTable = "SELECT * FROM user";
 
     if (!mysqli_query($conn, $selectTable)) {
         $createTable = "CREATE TABLE user (
     id int(10) AUTO_INCREMENT not null primary key,
     firstName varchar(10) not null,
     lastName varchar(10) not null,
     age text (2) not null,
     gender text not null,
     department text not null,
     date_of_join date not null,
     salary int(10) not null,
     email  varchar(100) not null,
     password varchar(100) not null,
     confirm_password varchar(100) not null,
     hobby text not null,
     photo varchar(100) not null
  )";
 
         if (!mysqli_query($conn, $createTable)) {
             echo mysqli_error($conn);
         }
     }
   
     $email = $_POST['email'];
     $pass = $_POST['password'];
     
     $selectEmail = "SELECT * FROM user WHERE email = '$email' ";
     $query = mysqli_query($conn, $selectEmail);
     $num_row = mysqli_num_rows($query);

     
     if (empty($_POST['fName'])) {
         $fNameErr = 'first name should be not empty';
     } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['fName'])) {
         $fNameErr = 'only enter alphabet ';
     } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['lName'])) {
         $lNameErr = '* only enter alphabet ';
     } elseif (empty($_POST['gender'])) {
         $genErr = 'gender should be not empty';
     } elseif (empty($_POST['department'])) {
         $depErr = 'please enter your department';
     } elseif (empty($_POST['doj'])) {
         $dojErr = 'when did you join this company?';
     } elseif ($_POST['doj'] > date('Y-m-d')) {
         $dojErr = 'invalid date';
     } elseif (empty($_POST['salary'])) {
         $salaryErr = 'enter your  salary ';
     } elseif ($_POST['salary'] < 1) {
         $salaryErr = 'salary shold not be less than 1 ';
     } elseif (empty($_POST['email'])) {
         $emailErr = 'email should be not empty';
     } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
         $emailErr = 'email invalid';
     } elseif ($num_row) {
         $emailErr = 'this email is already registered';
     } elseif (empty($pass)) {
         $passwordErr = 'Password should be not empty';
     } elseif (!preg_match("/[A-Z]/", $pass)) {
         $passwordErr = 'Password should contain at least one Capital Letter';
     } elseif (!preg_match("/[a-z]/", $_POST['password'])) {
         $passwordErr = 'Password should contain at least one small Letter';
     } elseif (!preg_match("/\d/", $_POST['password'])) {
         $passwordErr = 'Password should contain at least one digit';
     } elseif (!preg_match("/\W/", $_POST['password'])) {
         $passwordErr = 'Password should contain at least one special character';
     } elseif (strlen($pass) != 8) {
         $passwordErr = 'Password should be 8 characters';
     } elseif (empty($_POST['cPassword'])) {
         $cPasswordErr = 'enter your confirm password';  
     } elseif ($_POST['cPassword'] != $_POST['password']) {
         $cPasswordErr = 'password and confirm password are not match';
     } elseif (empty($_POST['hobby'])) {
         $hobbyErr = 'hobby should be not empty';
     } elseif (!file_exists($_FILES["file"]["tmp_name"])) {
         $fileErr = 'Choose image file to upload ';
     } elseif ($_FILES["file"]["size"] > 1000000) {
         $fileErr = 'image size should be less than 1 MB';
     }else {
        
         $firstName = $_POST['fName'];
         $lastName = $_POST['lName'];
         $age = $_POST['age'];
         $gender = $_POST['gender'];
         $department = $_POST['department'];
         $dateOfJoin = $_POST['doj'];
         $email = $_POST['email'];
         $password = base64_encode($_POST['password']);
         $confirm_password = base64_encode($_POST['cPassword']);
         $salary = $_POST['salary'];
         $hobby = $_POST['hobby'];
         
         $ArrToString = implode(", ", $hobby);
         
         $target_dir = "assets/pics/";
         
         $imagePath = $target_dir . basename($_FILES['file']['name']);
         
         $movefile = move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);
         
         $insertQuery = "INSERT INTO user (`firstName`,`lastName`,`age`,`gender`,`department`,`date_of_join`,`salary`,`email`,`password`, `confirm_password`, `hobby`,`photo`) VALUES ('$firstName','$lastName','$age','$gender','$department ','$dateOfJoin','$salary ','$email','$password','$confirm_password','$ArrToString','$imagePath')";
         if (mysqli_query($conn, $insertQuery) && $movefile) {
             if (isset($_POST['add_user'])) {
                 header('location:dashboard.php');
             }
            header('location:user_login.php');
         }else {
             echo mysqli_error($conn);
         }
     }
 }
 
 # insert data through admin
 if (isset($_POST['add_user']) ) {
 
     $selectTable = "SELECT * FROM user";
 
     if (!mysqli_query($conn, $selectTable)) {
         $createTable = "CREATE TABLE user (
     id int(10) AUTO_INCREMENT not null primary key,
     firstName varchar(10) not null,
     lastName varchar(10) not null,
     age text ,
     gender text not null,
     department text not null,
     date_of_join date not null,
     salary int(10) not null,
     email  varchar(100) not null,
     password varchar(100) not null,
     confirm_password varchar(100) not null,
     hobby text not null,
     photo varchar(100) not null
    )";
 
         if (!mysqli_query($conn, $createTable)) {
             echo mysqli_error($conn);
         }
     }
   
     $email = $_POST['email'];
     $pass = $_POST['password'];
     
     $selectEmail = "SELECT * FROM user WHERE email = '$email' ";
     $query = mysqli_query($conn, $selectEmail);
     $num_row = mysqli_num_rows($query);
     
     if (empty($_POST['fName'])) {
         $fNameErr = 'first name should be not empty';
     } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['fName'])) {
         $fNameErr = 'only enter alphabet ';
     } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['lName'])) {
         $lNameErr = '* only enter alphabet ';
     } elseif (empty($_POST['gender'])) {
         $genErr = 'gender should be not empty';
     } elseif (empty($_POST['department'])) {
         $depErr = 'please enter your department';
     } elseif (empty($_POST['doj'])) {
         $dojErr = 'when did you join this company?';
     } elseif ($_POST['doj'] > date('Y-m-d')) {
         $dojErr = 'invalid date';
     } elseif (empty($_POST['salary'])) {
         $salaryErr = 'enter your  salary ';
     } elseif ($_POST['salary'] < 1) {
         $salaryErr = 'salary shold not be less than 1 ';
     } elseif (empty($_POST['email'])) {
         $emailErr = 'email should be not empty';
     } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
         $emailErr = 'email invalid';
     } elseif ($num_row) {
         $emailErr = 'this email is already registered';
     } elseif (empty($pass)) {
         $passwordErr = 'Password should be not empty';
     } elseif (!preg_match("/[A-Z]/", $pass)) {
         $passwordErr = 'Password should contain at least one Capital Letter';
     } elseif (!preg_match("/[a-z]/", $_POST['password'])) {
         $passwordErr = 'Password should contain at least one small Letter';
     } elseif (!preg_match("/\d/", $_POST['password'])) {
         $passwordErr = 'Password should contain at least one digit';
     } elseif (!preg_match("/\W/", $_POST['password'])) {
         $passwordErr = 'Password should contain at least one special character';
     } elseif (strlen($pass) != 8) {
         $passwordErr = 'Password should be 8 characters';
     } elseif (empty($_POST['cPassword'])) {
         $cPasswordErr = 'enter your confirm password';  
     } elseif ($_POST['cPassword'] != $_POST['password']) {
         $cPasswordErr = 'password and confirm password are not match';
     } elseif (empty($_POST['hobby'])) {
         $hobbyErr = 'hobby should be not empty';
     } elseif (!file_exists($_FILES["file"]["tmp_name"])) {
         $fileErr = 'Choose image file to upload ';
     } elseif ($_FILES["file"]["size"] > 1000000) {
         $fileErr = 'image size should be less than 1 MB';
     }else {
        
         $firstName = $_POST['fName'];
         $lastName = $_POST['lName'];
         $age = $_POST['age'];
         $gender = $_POST['gender'];
         $department = $_POST['department'];
         $dateOfJoin = $_POST['doj'];
         $email = $_POST['email'];
         $password = base64_encode($_POST['password']);
         $confirm_password = base64_encode($_POST['cPassword']);
         $salary = $_POST['salary'];
         $hobby = $_POST['hobby'];
         
         $ArrToString = implode(", ", $hobby);
         
         $target_dir = "assets/pics/";
         
         $imagePath = $target_dir . basename($_FILES['file']['name']);
         
         $movefile = move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);
         
         $insertQuery = "INSERT INTO user (`firstName`,`lastName`,`age`,`gender`,`department`,`date_of_join`,`salary`,`email`,`password`, `confirm_password`, `hobby`,`photo`) VALUES ('$firstName','$lastName','$age','$gender','$department ','$dateOfJoin','$salary ','$email','$password','$confirm_password','$ArrToString','$imagePath')";
         if (mysqli_query($conn, $insertQuery) && $movefile) {

             header('location:dashboard.php');
              
         }else {
             echo mysqli_error($conn);
         }
     }
 }
?>