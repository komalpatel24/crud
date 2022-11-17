<?php
    include 'config.php';

    $selectTable = "SELECT * FROM user";
    $result = mysqli_query($conn, $selectTable);
    $assoc = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net   /npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/CSS/style.css">
    <title>Dashboard</title>
</head>

<body>
    <?php include 'navbar.php';?>
    <!--  show data of users  -->
    <div class="table-responsive">
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th class="table-light">Id</th>
                    <th class="table-light">Fisrt Name</th>
                    <th class="table-light">Last Name</th>
                    <th class="table-light">Age</th>
                    <th class="table-light">Gender</th>
                    <th class="table-light">Department</th>
                    <th class="table-light">Date Of Join</th>
                    <th class="table-light">Salary</th>
                    <th class="table-light">Email</th>
                    <th class="table-light">Password</th>
                    <th class="table-light">Hobbies</th>
                    <th class="table-light">Photos</th>
                    <th class="table-warning">Edit</th>
                    <th class="table-danger">Delete</th>

                </tr>
            </thead>

            <tbody id="rows">
                <?php
                # fetch data from user table
                $result = mysqli_query($conn, $selectTable);

                while ($myData = mysqli_fetch_assoc($result)) { ?>
                    <tr id="row<?php echo $myData['id']; ?>">
                        <td class="table-light"> <?php echo $myData['id']; ?> </td>
                        <td class="table-light"><?php echo $myData['firstName']; ?> </td>
                        <td class="table-light"><?php echo $myData['lastName']; ?> </td>
                        <td class="table-light"><?php echo $myData['age']; ?> </td>
                        <td class="table-light"><?php echo $myData['gender']; ?> </td>
                        <td class="table-light"><?php echo $myData['department']; ?> </td>
                        <td class="table-light"><?php echo $myData['date_of_join']; ?> </td>
                        <td class="table-light"><?php echo $myData['salary']; ?> </td>
                        <td class="table-light"><?php echo $myData['email']; ?> </td>
                        <td class="table-light"><?php echo base64_decode($myData['password']); ?> </td>
                        <td class="table-light"><?php echo $myData['hobby']; ?> </td>
                        <td class="table-light"> <img src="<?php echo $myData['photo']; ?>" alt="Network Error" hright='100px' width='100px'> </td>
                        <td class="table-warning"><a href="update.php?update_id=<?php echo $myData['id']; ?>"><button class="btn btn-warning">Update</button></a></td>
                        <td class="table-danger" ><a href="delete.php?del_id=<?php echo $myData['id']; ?>"><button class="btn btn-danger" >DELETE</button></a></td>
                    </tr>
                <?php  }
                ?>
            </tbody>
        </table>
    </div>






    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="Assets/JS/delete.js"></script>
    <script src="./Assets/./JS/search.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> -->
</body>

</html>