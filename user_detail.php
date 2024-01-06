<?php
include "config.php";

if (!isset($_SESSION['id'])) {
    header('location: user_login.php');
}
    $id = $_SESSION['id'];
    $selectTable = "SELECT * FROM user WHERE id = '$id'";
    $query = mysqli_query($conn, $selectTable);
    $check_email = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);

 $id=$firstName=$lastName=$age=$gender=$department=$date_of_join=$email=$pass=$hobby=$salary=$photo="";
//  error_reporting (E_ALL ^ E_NOTICE);
    error_reporting(0); 
  if ($row > 0) {
    
        $id = $row['id'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $age = $row['age'];
        $gender = $row['gender'];
        $department = $row['department'];
        $date_of_join = $row['date_of_join'];
        $email = $row['email'];
        // $pass = base64_decode($row['password']);
        $pass = $row['password'];
        $hobby = $row['hobby'];
        $salary = $row['salary'];
       
        $photo = $row['photo'];
    }
    $user_welcome = "Helloo " . $row['firstName'] . ", Welcome!!" ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    
    <style>
        body,
        html {
            height: 90%;
        }
    </style>
</head>

<body>

  <!-- navbar -->
  <nav class="navbar navbar-expand-lg  bg-dark  ">

    <img src="./Assets/./image/logo.png" width="160px" alt="">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse h4 justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav justify-content-end">
        <li class="nav-item active ml-4">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active ml-4">
                <a class="nav-link" href="user_dashboard.php">User <span class="sr-only">(current)</span></a>
            </li>


                <li class="nav-item active ml-4 ">
                    <a class="nav-link" href="user_update.php">Update <span class="sr-only">(current)</span></a>
                </li>
        </ul>
    </div>
</nav>

<h2 style="text-align:center; margin-top:2em">UserData</h2> <br>

<div class="row justify-content-center ">
           <table class="table table-striped table-light w-50 table-bordered table-hover">
        <tbody>
            
            <tr>
                <td>ID</td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>FIRSTNAME</td>
                <td><?php echo $firstName; ?></td>
            </tr>
            <tr>
                <td>LASTNAME</td>
                <td><?php echo $lastName; ?></td>
            </tr>
            <tr>
                <td>AGE</td>
                <td><?php echo $age; ?></td>
            </tr>
            <tr>
                <td>GENDER</td>
                <td><?php echo $gender; ?></td>
            </tr>
            <tr>
                <td>DEPARTMENT</td>
                <td><?php echo $department; ?></td>
            </tr>
            <tr>
                <td>DOJ</td>
                <td><?php echo $date_of_join; ?></td>
            </tr>
            <tr>
                <td>EMAIL</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>PASSWORD</td>
                <td><?php echo $pass; ?></td>
            </tr>
            <tr>
                <td>HOBBY</td>
                <td><?php echo $hobby; ?></td>
            </tr>
            <tr>
                <td>SALARY</td>
                <td><?php echo $salary; ?></td>
            </tr>
            <tr>
                <td>IMAGE</td>
                <td><img src="<?php echo $photo; ?>" width="50px"></td>
            </tr>
            <tr>
                <td>OPERATIOS</td>
                <td> 
                    <button class="bg-dark p-2 ml-2"><a class="text-warning" href="user_update.php?upd_id=<?php echo $id;?>">Edit</a></button>
                    <button class="bg-dark p-2 ml-3"><a class="text-Danger"  href="user_delete.php?del_id=<?php echo $id;?>">Delete</a></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- </div> -->

</body>
</html>