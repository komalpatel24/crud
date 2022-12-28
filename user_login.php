<?php
include 'config.php';

if (isset($_SESSION['id'])) {
    header('location: user_dashboard.php');
}


        // $selectTable = "SELECT * FROM `user_login` ";
        // $tblQuery = mysqli_query($conn,$selectTable);

        // if (!$tblQuery) {
        //     $createTable = "CREATE TABLE  user_login ( id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        //                                          email varchar(100) NOT NULL, password varchar(100) NOT NULL )";
        //     if(!mysqli_query($conn,$createTable)){
        //     echo mysqli_error($conn); 
        //     }
        // }
        $emailErr = $passwordErr = '';
        if (isset($_POST['submit'])) {
            
        //     $email = $_POST['email'];
        //     $password = $_POST['password'];

        //     $selectEmail = "SELECT * FROM user WHERE email = '$email' ";
        //     $result = mysqli_query($conn, $selectEmail);
        //     $email_exist = mysqli_num_rows($result);
            
        //     if (empty($_POST['email'])) {
        //         $emailErr = 'email should be not empty';
        //     } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        //         $emailErr = 'email invalid';
        //     } elseif ($email_exist) {
        //         $emailErr = 'this email not registered';

        //     } elseif (empty($pass)) {
        //         $passwordErr = "password required";
            
        //         $insertQuery = "INSERT INTO `user_login` (`email`,`password`) VALUES ('$email','$password')";
        //         if (!mysqli_query($conn, $insertQuery)) {
        //             ?>
        //     <script>
        //         alert('You are successfully login!!');
        //         location.replace('a1.jpg');
        //     </script>
        // <?php
        //         }else{ 
        //                 echo mysqli_error($conn);
        //         }
        //     }
        $email = $_POST['email'];
        $pass = $_POST['password'];
    
        if (empty($email)) {
            $emailErr = " email required";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "invalid email";
        } elseif (empty($pass)) {
            $passwordErr = "password required";
        } else {
            $selectTable = "SELECT * FROM user WHERE email ='$email'";
            $query = mysqli_query($conn, $selectTable);
            $check_email = mysqli_num_rows($query);
            $assoc = mysqli_fetch_assoc($query);
            if ($check_email) {
    
                if ($assoc['password'] == ($pass)) {
                    $_SESSION['id'] = $assoc['id'];
                     header('location:user_dashboard.php');
                } else {
                    $passwordErr = "invalid password";
                }
            } else {
                $emailErr = "u are not ragisterd";
            // <script>
            //     alert('You are not registerd!!');
            //     location.replace('user_registration.php');
            // </script>
            
            }
        }
        }
  function setValue($value)
    {
        if (isset($_POST[$value])) {
            echo $_POST[$value];
        }
    }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="./assets/./bootstrap-4.6.1-dist/./css/./bootstrap.min.css">
    <title>User_Login</title>
    <style>
        
   small {
      color: red;
    }
    body{
      background-image: url("./assets/image/a1.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      box-sizing: border-box;
    }
    .container{
        background-color: rgba(0, 0, 0, 0.7);
        margin-top:3%;
    }
    .navbar{
        background-color: gray;
    }
    
  </style>
</head>

<body>
<?php include 'navbar.php'; ?>
    

<div class="container border border-light text-white mx-auto row w-50"> 
<div class="col-lg-12 mb-4">
        <form method="post" >
            <h1 class="text-center p-3">User_Login</h1>

            <div class="form-group">
                    <label for="" class="">Email</label>
                    <input class="form-control" type="text" name="email" value="<?php setValue('email'); ?>">
                    <small>*<?php echo $emailErr; ?></small>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" id="password" name="password" value="<?php setValue('password'); ?>">
                    <small>*<?php echo $passwordErr; ?></small>
                </div>

                <div class="form-check showPassword" style="margin-left:75%;">
                    <input type="checkbox" class="form-check-input" id="signInPass">
                    <label for="signInPass" class="form-check-label">show password</label>
                </div>

                <input type="submit" name="submit" value='Log in' class="btn btn-primary">
                <input type="reset" name="submit" value="Reset" class="btn btn-warning">


                <div class="form-group mt-3 text-center bg-light">
                    <p class="text-danger"> don't have have an account </p>
                    <a href="user_registration.php"> click here and Ragister</a>
                </div>

        </form>
</div>    
</div>
            <script src="Assets/JS/signin_pass.js"></script>

</body>
</html>