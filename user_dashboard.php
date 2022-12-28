
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

//  $id=$firstName=$lastName=$age=$gender=$department=$date_of_join=$email=$pass=$hobby=$salary=$photo="";
//  error_reporting (E_ALL ^ E_NOTICE);
    // error_reporting(0); 
//   if ($row > 0) {
    
//         $id = $row['id'];
//         $firstName = $row['firstName'];
//         $lastName = $row['lastName'];
//         $age = $row['age'];
//         $gender = $row['gender'];
//         $department = $row['department'];
//         $date_of_join = $row['date_of_join'];
//         $email = $row['email'];
//         // $pass = base64_decode($row['password']);
//         $pass = $row['password'];
//         $hobby = $row['hobby'];
//         $salary = $row['salary'];
       
//         $photo = $row['photo'];
//     }
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
        *{
            margin: 0px;
            padding: 0px;
        }
              body{
            background-image:   linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),url(./assets/image/d2.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            box-sizing: border-box;
            width: 100%;
            height: 100vh;
        }
      
        nav{
            background-color: white;
        }
    </style>
</head>

<body>
         <!-- navbar -->
   
    <nav class="navbar navbar-expand-lg   w-100 ">
         <img src="./Assets/./image/./angel.png" width="160px" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse h4 justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-end" id="n1" >
                <li class="nav-item dropdown">
                <div class="d-flex user-data">
                    <img src="<?php echo $row['photo']; ?>"  alt="Network Error" width='50px' height='50px' data-toggle="modal" data-target="#exampleModal">
                     <!-- Modal -->
                    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog user-info">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2><?php echo $row['firstName']; ?></h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <a  class="btn btn-primary" href="user_detail.php">Show Details</a>
                                </div>
                                <div class="modal-body">
                                    <h2><a href="user_logout.php" class="btn btn-danger">Log out</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal finished -->
                </div>
                </li>
            </ul>
        </div>
    </nav>
    

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <div class="m1">
        <h1 class="text-light p-5 mt-5 " style="text-align:center;"> <b><?php echo $user_welcome; ?> </b></h1> 
        <h3 class="m-5 text-justify text-center text-light"> Full Stack Web Development is the most popular job profile and highly paid in the market. 
            In this course, you will master skills like Python, MEAN stack, NodeJS, MongoDB(NoSQL), Python Django, NodeJS, ReactJS, 
            Quality & Performance, DevOps, etc. This Full Stack Web Development certification by E&ICT, 
            IIT Guwahati & Intellipaat is created with an objective to provide high-end skills</h3>





        <!-- <h2 class="text-light" style="text-align:center;">UserData</h2> <br>

        <div class="row justify-content-center ">
                   <table class="table  text-light w-50 table-bordered table-hover">
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
        
    </div>-->
    </div>
</body>
</html>