<!doctype html>
<html lang="ar" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-OXTEbYDqaX2ZY/BOaZV/yFGChYHtrXH2nyXJ372n2Y8abBhrqacCEe+3qhSHtLjy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-OXTEbYDqaX2ZY/BOaZV/yFGChYHtrXH2nyXJ372n2Y8abBhrqacCEe+3qhSHtLjy" crossorigin="anonymous">

    <title>My Form</title>
    <style>
      h2{
        margin-top: 10px;
        text-align: center;
      }
    </style>
  </head>
  <body>
  
<?php
  include "config.php";
  error_reporting(E_ALL ^ E_NOTICE);
//echo "Connected successfully";
//sql query
      if(isset($_POST)){
        $Name = $_POST['Name'];
        $Pass = $_POST['Pass'];

      $sql = "INSERT INTO `admin` ( `Name`, `Pass`) VALUES ( '$Name', '$Pass')";

      if (mysqli_query($conn, $sql)) {
        echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">  
          <strong>Success!</strong> Your Data Will Be Successfully Sent..!!.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      }
?>
   <div class="container mt-5 border border-black ">

    <form action="try.php" method="post">
       <h2>Login</h2>
        <div class="mb-3">
          <label for="text" class="form-label">userName</label>
          <input type="text" class="form-control" id="name" name="Name">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">password</label>
          <input type="Password" class="form-control" id="Pass" name="Pass">
        </div>
      <button type="submit" class="btn btn-primary mb-3">Submit</button>
    </form>
  </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    
    
  </body>
</html>