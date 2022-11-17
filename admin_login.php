<?php
    include 'config.php';
# select data form admin table and create table if not exist
$selectTable = "SELECT * FROM admin1 ";
$tblQuery = mysqli_query($conn, $selectTable);

if (!$tblQuery) {
    $createTable = "CREATE TABLE  admin1 ( id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, userName varchar(100) NOT NULL, password varchar(100) NOT NULL )";
    if (!mysqli_query($conn, $createTable)) {
        echo mysqli_errno($conn);
    }
    # insert data in admin table for admin login 
    $insertData = "INSERT INTO `admin1` (`userName`,`password`) VALUES('admin','123')";
    if (!mysqli_query($conn, $insertData)) {
        echo mysqli_error($conn);
    }
}

# admin login with session and cookie
$loginErr = $userNameErr = $passwordErr = '';
if (isset($_POST['asubmit'])) {

    if (empty($_POST['userName']) || empty($_POST['password'])) {

        $loginErr = "username and password required";
    } else {


        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $fetch_array = mysqli_fetch_assoc($tblQuery);
        if (empty($userName && $password)) {
            $loginErr = "* both field required";
        } elseif ($fetch_array['userName'] != $userName) {
            $userNameErr = "* username is not correct";
        } elseif ($fetch_array['password'] != $password) {
            $passwordErr = "* password incorect";
        } else {
            header('location:dashboard.php');
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
    <!-- <link rel="stylesheet" href="./assets/./CSS/./style.css"> -->
    <title>Login</title>
    <style>
        
        small {
          color:red;
        }
        body{
          background-image: url("al.jpg");
          background-repeat: no-repeat;
          background-size: cover;
          box-sizing: border-box;
        }
        .container{
            background-color: rgba(0, 0,0, 0.7);
            margin-top:7%;
        }
        
      </style>
</head>

<body class="login-bg">
    <!-- navbar -->
    
    <?php include 'navbar.php'; ?>
    <div class="black">

  <div class="container  text-light mx-auto row w-50"> 
      <div class="col-lg-12 mb-4">

        <form method="post">
            <h1 class="text-center p-3"> Admin Log in</h1>
            <small> *<?php echo $loginErr; ?></small>

            <div class="form-group">
                <label for="" class="">User Name</label>
                <input class="form-control" type="text" name="userName" value="<?php setValue('userName'); ?>">
                <small> *<?php echo $userNameErr; ?></small>
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" id="apassword" name="password" value="<?php setValue('password'); ?>">
                <small> *<?php echo $passwordErr; ?></small>
            </div>

           <div class="form-check showPassword">
                 <input type="checkbox" class="form-check-input" id="asignInPass">
                 <label for="asignInPass" class="form-check-label">show password</label>
           </div>


        <br>
            <input type="submit" name="asubmit" value='Login' class="btn btn-primary">
            <a href="admin_login.php" class="btn btn-danger btn1">Cancel</a>

        </form>
    </div>

  </div>
    
   <script src="Assets/JS/asignin_pass.js"></script>

</body>
</html>