<?php
include 'config.php';


$findAdminTbl = "SELECT * FROM admin WHERE id = 5";
$rslt = mysqli_query($conn, $findAdminTbl);
$adminArr  = mysqli_fetch_assoc($rslt);

$selectTable = "SELECT * FROM admin";
$result = mysqli_query($conn, $selectTable);

if (!$result) {
    echo mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/bootstrap-4.6.1-dist/css/bootstrap.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <title>Document</title>
    <style>
        th,td{
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <h1>Hello Admin <span class=""> <?php echo $adminArr['userName']; ?> </span>, Welcome!!!</h1>
    <!-- <a href="admin_logout.php" class="btn btn-danger">Log out</a>
    <a href="addUser.php" class="btn btn-primary">Add Employee</a> -->

    <table class="container text-center border border-dark">
        <thead>
            <tr>
                <th class="table-primary" >Id</th>
                <th class="table-light" >userName</th>
                <th class="table-light" >password</th>
               
                <th class="table-warning" >Edit</th>
                <th class="table-danger" >Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($myData = mysqli_fetch_assoc($result)) {
                // if($myData['salary']>10000){
                ?>
                <tr>
                    <td class="table-primary" > <?php echo $myData['id']; ?> </td>
                    <td class="table-light" ><?php echo $myData['userName']; ?> </td>
                    <td class="table-light" ><?php echo $myData['password']; ?> </td>
                   
                    <td class="table-warning" ><a href="update.php?upld_id=<?php echo $myData['id']; ?>"><button class="btn btn-warning" >Update</button></a></td>
                    <td class="table-danger" ><a href="delete.php?del_id=<?php echo $myData['id']; ?>"><button class="btn btn-danger" >DELETE</button></a></td>
                </tr>
               <?php 
            //   } 
             } ?>
        </tbody>
    </table>
</body>
</html>