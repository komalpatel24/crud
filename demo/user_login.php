<?php
session_start();

include 'conn.php';

if (isset($_SESSION['id']) || isset($_COOKIE['id'])) {    
    header('location:user_welcome.php');
}
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

     
    $selectTable = "SELECT * FROM user WHERE email ='$email'";
    $query = mysqli_query($conn, $selectTable);
    $num_rows = mysqli_num_rows($query);
    $arr = mysqli_fetch_assoc($query);
    setcookie('id',$arr['id'],time() + 300,'/');
    if ($num_rows) {
        if (base64_decode($arr['password']) == $pass) {
             
            $_SESSION['id'] = $arr['id'];
            header('location:user_welcome.php');
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
    <link rel="stylesheet" href="./assets/./bootstrap-4.6.1-dist/./css/./bootstrap.min.css">
    <title>User_Login</title>
</head>

<body>
<?php include 'navbar.php'; ?>

    <div class="container bg-light col-lg-3">
        <form method="post">
            <h1 class="text-center">Log in</h1>

            <div class="form-group">
                <label for="" class="">Email</label>
                <input class="form-control" type="text" name="email" value="<?php setValue('email'); ?>">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="text" name="password" value="<?php setValue('password'); ?>">
            </div>

            <input type="submit" name="submit" value='Log in' class="btn btn-primary">
            <div class="form-group mt-5 text-primary text-center bg-light " >
                        <p> don't have have an account </p>
                        <a href="insert.php"> Register here
                        </a>
                    </div>

        </form>
    </div>
</body>
</html>