


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <title>HOME</title>
    <style>
        .home-bg{
            background-image: url("./assets/image/bg2.jpg");
            /* height: 100vh; */
            width: 100%;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            
        }
    </style>
</head>


<body class="home-bg">

    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <!-- main content -->
    <div class="container mx-auto text-center  mt-5 row main">

        <div class="col-lg-6 ">
            <div class="background mx-auto p-3 border border-light" style="width: 18rem;">
                <a href="user_registration.php"><img src="./assets/image/users.png" class="card-img-top" alt="..."></a>
                <div class="card-body mt-4">
                    <h5 class="card-title text-light">USER</h5>
                    <a href="user_registration.php" class="btn btn-dark border-light">Click here</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 ">
            <div class="background mx-auto border border-light p-3" style="width: 18rem;">
                <a href="login.php"><img src="./assets/image/Admin.png" class="card-img-top" alt="..."></a>
                <div class="card-body">
                    <h5 class="card-title">ADMIN</h5>
                    <a href="login.php" class="btn btn-dark border-light">Click here</a>
                </div>
            </div>
        </div>

    </div>
</body>

</html>