
<?php
session_start();
if (isset($_SESSION['aid']) || isset($_COOKIE['aid'])) {    
    header('location:dashboard.php');
}

include 'conn.php';
$selectTable = "SELECT * FROM admin ";
$tblQuery = mysqli_query($conn,$selectTable) ;

if (!$tblQuery) {
    $createTable = "CREATE TABLE  admin ( id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, userName varchar(100) NOT NULL, password varchar(100) NOT NULL )";
    if(!mysqli_query($conn,$createTable)){
       echo mysqli_errno($conn); 
    }
}

if (isset($_POST['submit'])) {
    
    $uname = $_POST['userName'];
    $pass = $_POST['password'];
    
    $fetch_array = mysqli_fetch_assoc($tblQuery);
    
    if ($uname == $fetch_array['userName'] && $pass == $fetch_array['password']) {
        $_SESSION['aid'] = $fetch_array['id'];
        setcookie('aid',$fetch_array['id'],time() + 300,'/');
        header('location:dashboard.php');
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
    <title>Admin_Login</title>
</head>

<body>
<?php include 'navbar.php'; ?>

    <div class="container bg-light col-lg-3">
        <form method="post">
            <h1 class="text-center">Log in</h1>

            <div class="form-group">
                <label for="" class="">User Name</label>
                <input class="form-control" type="text" name="userName" value="<?php setValue('userName'); ?>">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="text" name="password" value="<?php setValue('password'); ?>">
            </div>

            <input type="submit" name="submit" value='Log in' class="btn btn-primary">
        </form>
    </div>

</body>
</html>