
<?php

include 'config.php';

    $userNameErr = $passwordErr = '';

        $selectTable = "SELECT * FROM `admin` ";
        $tblQuery = mysqli_query($conn,$selectTable);

        if (!$tblQuery) {
            $createTable = "CREATE TABLE  admin ( id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, userName varchar(100) NOT NULL, password varchar(100) NOT NULL )";
            if(!mysqli_query($conn,$createTable)){
            echo mysqli_error($conn); 
            }
        }

        if (isset($_POST['submit'])) {
            
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            
            if (empty($_POST['userName'])) {
                $userNameErr = 'userName  should be not empty';
            } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['userName'])) {
                $userNameErr = 'only enter alphabet ';
            } elseif (empty($_POST['password'])) {
                $passwordErr = 'Password should be not empty';
            } elseif (!preg_match("/[A-Z]/", $password)) {
                $passwordErr = 'Password should contain at least one Capital Letter';
            } elseif (!preg_match("/[a-z]/", $_POST['password'])) {
                $passwordErr = 'Password should contain at least one small Letter';
            } elseif (!preg_match("/\d/", $_POST['password'])) {
                $passwordErr = 'Password should contain at least one digit';
            } elseif (strlen($password) != 8) {
                $passwordErr = 'Password should be 8 characters';

                $insertQuery = "INSERT INTO `admin` (`userName`,`password`) VALUES ('$userName','$password')";
                if (!mysqli_query($conn, $insertQuery)) {
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
    <link rel="stylesheet" href="./assets/./bootstrap-4.6.1-dist/./css/./bootstrap.min.css">
    <title>Admin_Login</title>
</head>

<body>

    <div class="container bg-light col-lg-3">
        <form method="post">
            <h1 class="text-center">Login</h1>

            <div class="form-group">
                <label for="" class="">UserName : </label>
                <input class="form-control" type="text" name="userName">
                <small> * <?php echo $userNameErr; ?> </small>
            </div>

            <div class="form-group">
                <label for="">Password : </label> 
                <input class="form-control" type="text" name="password">
                <small> * <?php echo $passwordErr; ?> </small>
            </div>

            <input type="submit" name="submit" value='submit' class="btn btn-primary">
        </form>
    </div>

</body>
</html>