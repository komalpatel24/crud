<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['aid'])) {
    header('location:admin_login.php');
}

if (!isset($_SESSION['aid'])) {
    $_SESSION['aid'] = $_COOKIE['aid'];
}

$id=  $_SESSION['aid'];
$findAdmnTbl = "SELECT * FROM admin WHERE id = $id";
$rslt = mysqli_query($conn, $findAdmnTbl);
$admnArr  = mysqli_fetch_assoc($rslt);


$selectTable = "SELECT * FROM user";
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
    <link rel="stylesheet" href="assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <title>Document</title>
</head>

<body>
<?php include 'navbar.php'; ?>

    <h1>Hello Admin <span class="text-primary"> <?php echo $admnArr['userName']; ?> </span>, Welcome!!!</h1>
<a href="admin_logout.php" class="btn btn-danger">Log out</a>
<a href="addUser.php" class="btn btn-primary">Add Employee</a>


    
    <table class="table text-center">
        <thead>
            <tr>

                <th class="table-primary" >Id</th>
                <th class="table-light" >Fisrt_Name</th>
                <th class="table-light" >Last_Name</th>
                <th  class="table-light">Age</th>
                <th class="table-light" >Gender</th>
                <th class="table-light" >Department</th>
                <th class="table-light" >Date Of Join</th>
                <th class="table-light" >Salary</th>
                <th class="table-light" >Email</th>
                <th class="table-light" >Password</th>
                <th class="table-light" >Hobbies</th>
                <th class="table-light" >Photos</th>
                <th class="table-warning" >Edit</th>
                <th class="table-danger" >Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($myData = mysqli_fetch_assoc($result)) {
                if($myData['salary']>10000){

                
                ?>
                <tr>

                    <td class="table-primary" > <?php echo $myData['id']; ?> </td>
                    <td class="table-light" ><?php echo $myData['firstName']; ?> </td>
                    <td class="table-light" ><?php echo $myData['lastName']; ?> </td>
                    <td class="table-light"><?php echo $myData['age']; ?> </td>
                    <td class="table-light" ><?php echo $myData['gender']; ?> </td>
                    <td class="table-light" ><?php echo $myData['department']; ?> </td>
                    <td class="table-light" ><?php echo $myData['date_of_join']; ?> </td>
                    <td class="table-light" ><?php echo $myData['salary']; ?> </td>
                    <td class="table-light" ><?php echo $myData['email']; ?> </td>
                    <td class="table-light" ><?php echo base64_decode($myData['password']); ?> </td>
                    <td class="table-light" ><?php echo $myData['hobby']; ?> </td>
                    <td class="table-light" > <img src="<?php echo $myData['photo']; ?>" alt="Network Error" hright='100px' width='100px'> </td>
                    <td class="table-warning" ><a href="update.php?upld_id=<?php echo $myData['id']; ?>"><button class="btn btn-warning" >Update</button></a></td>
                    <td class="table-danger" ><a href="delete.php?del_id=<?php echo $myData['id']; ?>"><button class="btn btn-danger" >DELETE</button></a></td>
                </tr>
            <?php} } ?>
        </tbody>



    </table>
</body>

</html>