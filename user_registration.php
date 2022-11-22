<?php
include 'config.php';
// if (isset($_SESSION['id'])) {
//     header('location:user_dashboard.php');
// }
$fNameErr = $lNameErr  = $ageErr = $genErr = $depErr = $dojErr = $salaryErr = $emailErr = $passwordErr = $cPasswordErr = $hobbyErr = $fileErr = '';
$selectTable = "SELECT * FROM user";
# insert data through user
if (isset($_POST['submit'])) {
   

    if (!mysqli_query($conn, $selectTable)) {
        $createTable = "CREATE TABLE user (
     id int(10) AUTO_INCREMENT not null primary key,
     firstName varchar(10) not null,
     lastName varchar(10) not null,
     age text(10) not null,
     gender text not null,
     department text not null,
     date_of_join date not null,
     salary int(10) not null,
     email  varchar(100) not null,
     password varchar(100) not null,
     hobby text not null,
     photo varchar(100) not null)";

        if (!mysqli_query($conn, $createTable)) {
            echo mysqli_error($conn);
        }
    }
        
        $email = $_POST['email'];
        $password= $_POST['password'];

        $selectEmail = "SELECT * FROM user WHERE email = '$email' ";
        $result = mysqli_query($conn, $selectEmail);
        $email_exist = mysqli_num_rows($result);

        $img_extension = ['jpg','jpeg','png','JPG','JPEG','PNG'];

            if (empty($_POST['fName'])) {
                $fNameErr = 'first name should be not empty';
            } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['fName'])) {
                $fNameErr = 'only enter alphabet';
            } elseif (empty($_POST['lName'])) {
                $lNameErr = 'last name should be not empty';
            } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['lName'])) {
                $lNameErr = 'only enter alphabet';
            } elseif (empty($_POST['age'])) {
                $ageErr = 'age should be not empty';
            } elseif (!preg_match("/\d/", $_POST['age'])) {
                $ageErr = 'age must be in digit';
            } elseif ($_POST['age'] < 18) {
                $ageErr = 'age should not be less than 18';
            } elseif (empty($_POST['gender'])) {
                $genErr = 'gender should be not empty';
            } elseif (empty($_POST['department'])) {
                $depErr = 'please choose your department';
            } elseif (empty($_POST['doj'])) {
                $dojErr = 'when did you join this company?';
            } elseif ($_POST['doj'] > date('D-M-Y')) {
                $dojErr = 'invalid date';
            } elseif (empty($_POST['salary'])) {
                $salaryErr = 'enter your  salary ';
            } elseif (!preg_match("/\d/", $_POST['salary'])) {
                $salaryErr = 'salary must be in digit';
            } elseif ($_POST['salary'] < 1) {
                $salaryErr = 'salary should not be less than 1';
            } elseif (!preg_match("/\d/", $_POST['salary'])) {
                $salaryErr = 'salary must be in digit';

            } elseif (empty($_POST['email'])) {
                $emailErr = 'email should be not empty';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErr = 'email invalid';
            } elseif ($email_exist) {
                $emailErr = 'this email is already registered';
                
            } elseif (empty($password)) {
                $passwordErr = 'Password should be not empty';
            } elseif (!preg_match("/[A-Z]/", $password)) {
                $passwordErr = 'Password should contain at least one Capital Letter';
            } elseif (!preg_match("/[a-z]/", $password)) {
                $passwordErr = 'Password should contain at least one small Letter';
            } elseif (!preg_match("/\d/", $password)) {
                $passwordErr = 'Password should contain at least one digit';
            } elseif (!preg_match("/\W/", $password)) {
                $passwordErr = 'Password should contain at least one special character';
            } elseif (strlen($password) < 8) {
                $passwordErr = 'Password should be 8 characters';
            } elseif (empty($_POST['cPassword'])) {
                $cPasswordErr = 'enter your confirm password';
            } elseif ($_POST['cPassword'] != $password) {
                $cPasswordErr = 'password and confirm password are not match';
            } elseif (empty($_POST['hobby'])) {
                $hobbyErr = 'hobby should be not empty';
            } elseif (!file_exists($_FILES["file"]["tmp_name"])) {
                $fileErr = 'Choose image file to upload ';
            } elseif (!in_array(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION),$img_extension)) {
                $fileErr = 'Choose file only in JPG, JPEG and PNG format';
            } elseif ($_FILES["file"]["size"] > 1000000) {
                $fileErr = 'image size should be less than 1 MB';
            } else {
                $firstName = $_POST['fName'];
                $lastName = $_POST['lName'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $department = $_POST['department'];
                $dateOfJoin = $_POST['doj'];
                $email = $_POST['email'];
                // $password = base64_encode($_POST['password']);
                $password = $_POST['password'];
                $salary = $_POST['salary'];
                $hobby = $_POST['hobby'];

                $ArrToString = implode(", ", $hobby);

                $target_dir = "assets/pics/";

                $imagePath = $target_dir . basename($_FILES['file']['name']);

                $movefile = move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);
                $insertQuery = "INSERT INTO `user` (`firstName`,`lastName`,`age`,`gender`,`department`,`date_of_join`,`salary`,`email`,`password`, `hobby`,`photo`) VALUES ('$firstName','$lastName','$age','$gender','$department ','$dateOfJoin','$salary ','$email','$password','$ArrToString','$imagePath')";
                if (mysqli_query($conn, $insertQuery) && $movefile) {
                    ?>
            <script>
                alert('You are successfully registerd!!');
                location.replace('user_login.php');
            </script>
                    <?php 

                } else {
                    echo mysqli_error($conn);
                }
             }
        }
            ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/CSS/style.css"> -->
    <title>Register</title>
    <style>
        .user-bg {
    background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url(./assets/image/r1.png);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    }
    small {
    color: red;
    }
    </style>
</head>

<body class="user-bg">
    <!-- navbar -->
   <?php include 'navbar.php';?>

    <!-- register form -->
    <div class="container mt-5 mb-5 text-white">
        <form method="post" enctype="multipart/form-data">
            <h1 class="text-center mt-3 mb-3">Register</h1>

            <div class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="" class="">First Name</label> 
                        <input class="form-control" type="text" name="fName" 
                                    value="<?php if (isset($_POST['fName'])) {
                                         echo $fName = $_POST['fName'];} ?>">
                        <small> * <?php echo $fNameErr; ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="">Last Name</label> 
                        <input class="form-control" type="text" name="lName"
                                    value="<?php if (isset($_POST['lName'])) {
                                         echo $lName = $_POST['lName'];} ?>">
                        <small>* <?php echo $lNameErr; ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="">Age</label> 
                        <input type="text" class="form-control" name="age"
                                        value="<?php if (isset($_POST['age'])) {
                                             echo $age = $_POST['age'];} ?>">
                        <small>* <?php echo $ageErr; ?> </small>
                    </div>

                    <label for="">Gender 
                        <small> * <?php echo $genErr; ?> </small>
                        <div class="form-check">
                            <label for="" class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender"
                                        value="male" <?php if (isset($_POST['gender'])) {
                                                 if ($_POST['gender'] == 'male')
                                                            echo 'checked';} ?>> male
                            </label>
                        </div>
                        <div class="form-check">
                            <label for="" class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender"
                                         value="female" <?php if (isset($_POST['gender'])) {
                                                 if ($_POST['gender'] == 'female')
                                                        echo 'checked';} ?>> female
                            </label>
                        </div>
                    </label>

                    <div class="form-ckeck">
                        <label for="department">Department  </label>
                            <select name="department" class="form-control" id="department">
                                <option value="" selected disabled>---Choose Department</option>
                                <option value="R & D" <?php if (isset($_POST['department'])) {
                                                    if ($_POST['department'] == 'R & D')
                                                        echo 'selected';} ?>>R & D</option>
                                <option value="Sales"<?php if (isset($_POST['department'])) {
                                                    if ($_POST['department'] == 'Sales')
                                                        echo 'selected';} ?>>Sales</option>
                                <option value="Marketing" <?php if (isset($_POST['department'])) {
                                                    if ($_POST['department'] == 'Marketing')
                                                        echo 'selected';} ?>>Marketing</option>
                                <option value="HR" <?php if (isset($_POST['department'])) {
                                                    if ($_POST['department'] == 'HR')
                                                        echo 'selected';} ?>>HR</option>
                            </select>
                            <small> * <?php echo $depErr;  ?> </small>
                           
                    </div>

                    <div class="form-group">
                        <label for="">Date Of Join</label>
                        <input type="date" class="form-control" name="doj"
                                value="<?php if (isset($_POST['doj'])) {
                                         echo $doj = $_POST['doj'];} ?>">
                        <small> * <?php echo $dojErr; ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="">Salary</label> 
                        <input type="text" class="form-control" name="salary"
                                    value="<?php if (isset($_POST['salary'])) {
                                            echo $salary = $_POST['salary'];} ?>">
                        <small> * <?php echo $salaryErr;  ?> </small>
                    </div>

                </div>


                <div class="col-lg-6">

                    <div class="form-group">
                        <label for="">E-mail</label> 
                        <input type="text" class="form-control" name="email"
                                value="<?php if (isset($_POST['email'])) {
                                          echo $email = $_POST['email'];} ?>">
                        <small> * <?php echo $emailErr;  ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                                            value="<?php if (isset($_POST['password'])) {
                                                        echo $password = $_POST['password'];} ?>">
                        <small> * <?php echo $passwordErr;  ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="cPassword">Confirm Password</label> 
                        <input type="password" class="form-control" name="cPassword" id="cPassword"
                                         value="<?php if (isset($_POST['cPassword'])) {
                                                echo $cPassword = $_POST['cPassword'];} ?>">
                        <small> * <?php echo $cPasswordErr;  ?> </small>
                    </div>
                
                    <div class="form-check showPassword " style="margin-left: 70%;">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label for="showPassword" class="form-check-label">show password</label>
                    </div>


                    <label for=""> Hobby 
                        <small> * <?php echo $hobbyErr;  ?> </small>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="reading"
                                         <?php if (isset($_POST['hobby']) && in_array('reading', $_POST['hobby'])) {
                                                         echo 'checked';} ?>>
                            <label for="hobby" class="form-check-label">reading</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="dancing"
                                         <?php if (isset($_POST['hobby']) && in_array('dancing', $_POST['hobby'])) {
                                                         echo 'checked';} ?>>
                            <label for="hobby" class="form-check-label">Dancing</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="programming"
                                             <?php if (isset($_POST['hobby']) && in_array('programming', $_POST['hobby'])) {
                                                        echo 'checked'; } ?>>
                            <label for="hobby" class="form-check-label">Programming</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="gaming"
                                                <?php if (isset($_POST['hobby']) && in_array('gaming', $_POST['hobby'])) {
                                                            echo 'checked';} ?>>
                            <label for="hobby" class="form-check-label">Gaming</label>
                        </div>

                    </label>


                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Your Photo</label> 
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                        <small> * <?php echo $fileErr;  ?> </small>
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary">
                    <input type="reset" name="submit" value="Reset" class="btn btn-warning">

                    <div class="a1 mt-3 mb-3  text-center bg-light" >
                        <p class="text-danger">already have an account?</p>
                        <a href="login.php"> click here</a>
                    </div>

                </div>

       </div>
                 
    </form>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <script src="Assets/JS/signup_pass.js"></script>

</body>

</html>