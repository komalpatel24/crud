<?php
include 'config.php';

    // $after = $board = $stream = $year = $ayear = $enumber = $name = $password = $cpassword = $number = '';
    $afterErr = $boardErr = $streamErr = $yearErr = $ayearErr = $enumberErr = $nameErr = $passwordErr = $cpasswordErr = $numberErr = ''; 

    $selectTable = "SELECT * FROM user_register";
# insert data through user
if (isset($_POST['submit'])) {
   
    if (!mysqli_query($conn, $selectTable)) {
        $createTable = "CREATE TABLE user_register (
    id int(10) AUTO_INCREMENT not null primary key,
     after text not null,
     board text not null,
     stream text not null,
     year text not null,
     ayear text not null,
     enumber varchar(200) not null,
     name varchar(255) not null,
     password  varchar(100) not null,
     cpassword varchar(100) not null,
     number bigint(11) not null )";

        if (!mysqli_query($conn, $createTable)) {
            echo mysqli_error($conn);
        }
    }

    $enumber = $_POST['enumber'];
    $password= $_POST['password'];
    $number= $_POST['number'];


    $selectenumber = "SELECT * FROM user_register WHERE enumber = '$enumber' ";
    $result = mysqli_query($conn, $selectenumber);
    $enumber_exist = mysqli_num_rows($result);

        if (empty($_POST['after'])) {
            $afterErr = 'Admission After should be not empty';
        } elseif (empty($_POST['board'])) {
            $boardErr = 'please choose your Bord/University';  
        } elseif (empty($_POST['stream'])) {
            $streamErr = 'stream should be not empty';
        } elseif (empty($_POST['year'])) {
            $yearErr = 'please choose your last passing year';  
        } elseif (empty($_POST['ayear'])) {
            $ayearErr = 'please choose your Admission year';  
        } elseif (empty($_POST['enumber'])) {
            $enumberErr = 'Enrollment Number is required';  
        } elseif (!preg_match("/\d/", $enumber)) {
            $enumberErr = 'Enrollment Number should be in only Digit';
        } elseif ($enumber_exist) {
            $enumberErr = 'This Enrollment Number is already registered';

        }elseif (empty($_POST['name'])) {
                $nameErr = 'name should be not empty';
        } elseif (!preg_match("/^[a-z A-Z]*$/", $_POST['name'])) {
                $nameErr = 'only enter alphabet and blank space';
        } elseif (empty($password)) {
            $passwordErr = 'Password should be not empty';
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $passwordErr = 'Password should contain at least 1 Capital,1 small,1 digit,1 special character ';
        } elseif (!preg_match("/[a-z]/", $password)) {
            $passwordErr = 'Password should contain at least 1 Capital,1 small,1 digit,1 special character ';
        } elseif (!preg_match("/\d/", $password)) {
            $passwordErr = 'Password should contain at least 1 Capital,1 small,1 digit,1 special character ';
        } elseif (!preg_match("/\W/", $password)) {
            $passwordErr = 'Password should contain at least 1 Capital,1 small,1 digit,1 special character ';
        } elseif (strlen($password) < 8) {
            $passwordErr = 'Password should be 8 characters';
        } elseif (empty($_POST['cpassword'])) {
            $cpasswordErr = 'enter your confirm password';
        } elseif ($_POST['cpassword'] != $password) {
            $cpasswordErr = 'password and confirm password are not match';
        }elseif(empty($_POST['number'])){
            $number = 'PhoneNo is required';
        }elseif(!is_numeric($number)){ 
            $number = 'Invalid PhoneNo format';
        } else {

            $after = $_POST['after'];
            $board = $_POST['board'];
            $stream = $_POST['stream'];
            $year = $_POST['year'];
            $ayear = $_POST['ayear'];
            // $enumber = $_POST['enumber'];
            $name = $_POST['name'];
            // $password = base64_encode($_POST['password']);
            // $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            // $number = $_POST['number'];

            $insertQuery = "INSERT INTO `user_register` (`after`,`board`,`stream`,`year`,`ayear`,`enumber`,`name`,`password`, `cpassword`,`number`) VALUES ('$after','$board','$stream','$year','$ayear','$enumber','$name','$password','$cpassword','$number')";
            if (mysqli_query($conn, $insertQuery)) {
                ?>
            <script>
                alert('You are successfully registerd!!');
                location.replace('mysy_login.php');
            </script>
                    <?php 

                } else {
                echo mysqli_error($conn);
            }
         }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/bootstrap-4.6.1-dist/css/bootstrap.min.css"> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>mysy_registration</title>
    <style>
        body{
            font-size: smaller;
            font-weight: bold;
            font-family: sans-serif , arial;
        }
        small{
            color: red;
        }
        h6{
            background-color:rgb(102, 0, 32);
            color: white;
            padding: 3px;
        }
        #btnn input{
            background-color: rgb(102, 0, 32);
            color: white;
            border: none;
            font-weight: bold;
            padding: 5px;
        }
        img{
            width: 99%;
            height: 13.5vh;
            margin: 0.3%;
        }
    </style>
</head>
<body>
   <img src="./img/mysy.png" alt="mysy">
   <div class="container mt-1 mb-2 border border-dark w-50">
        <form method="post" enctype="multipart/form-data">
            <h6 class="text-center mt-1 mb-3">First Time Registration</h6>
              <div class="row mt-1 ">
                    <div class="col-lg-4">
                        <label for="">Admission After </label>
                    </div>
                    <div class="col-lg-8">
                        <!-- <div class="radio-inline"> -->
                            <label for="" class="radio-inline">
                                <input type="radio" class="radio-inline" name="after" value="ssc"<?php if (isset($_POST['after'])) { 
                                        if ($_POST['after'] == 'ssc') echo 'checked';} ?>> 10th(SSC)
                            </label>
                        <!-- </div> -->

                        <!-- <div class="radio-inline"> -->
                            <label for="" class="radio-inline">
                                <input type="radio" class="form-check-inputradio-inline" name="after" value="hsc"<?php if (isset($_POST['after'])) { 
                                        if ($_POST['after'] == 'hsc') echo 'checked';} ?>> 12th(HSC)
                            </label>
                        <!-- </div> -->

                        <!-- <div class="radio-inline"> -->
                            <label for="" class="radio-inline">
                                <input type="radio" class="radio-inline" name="after" value="diploma"<?php if (isset($_POST['after'])) { 
                                        if ($_POST['after'] == 'diploma') echo 'checked';} ?>> Diploma
                            </label>
                        <!-- </div> -->
                    </div>
                     <small> <?php echo $afterErr; ?> </small>
              </div>

              <div class="row mt-2">
                   <!-- <div class="form-ckeck d-inline-flex"> -->
                   <div class="col-lg-4">
                        <label for="board">Board/ University  </label>
                   </div>    
                   <div class="col-lg-8">
                            <select name="board"  id="board" style="width:99%;padding:7px;">
                                    <option value="" selected disabled>---Choose Board---</option>
                                    <option value="gujarat board" <?php if (isset($_POST['board'])) {
                                                        if ($_POST['board'] == 'gujarat board')
                                                            echo 'selected';} ?>>Gujarat Board</option>

                                    <option value="cbse"<?php if (isset($_POST['board'])) {
                                                        if ($_POST['board'] == 'cbse')
                                                            echo 'selected';} ?>>CBSE</option>
                                                            
                                    <option value="icse" <?php if (isset($_POST['board'])) {
                                                        if ($_POST['board'] == 'icse')
                                                            echo 'selected';} ?>>ICSE</option>

                                    <option value="nios" <?php if (isset($_POST['board'])) {
                                                        if ($_POST['board'] == 'nios')
                                                            echo 'selected';} ?>>NIOS</option>

                                    <option value="ib" <?php if (isset($_POST['board'])) {
                                                        if ($_POST['board'] == 'ib')
                                                            echo 'selected';} ?>>IB</option>
                            </select>
                   </div>
                     <small> <?php echo $boardErr;  ?> </small>
              </div>

              <div class="row mt-1">
                <div class="col-lg-4">
                    <label for="" >Stream  </label>
                </div> 
                <div class="col-lg-8">
                        <div class="radio-inline">
                                <label for="" class="radio-inline">
                                    <input type="radio" class="radio-inline" name="stream" value="science" 
                                        <?php if (isset($_POST['stream'])) { 
                                            if ($_POST['stream'] == 'science') echo 'checked';} ?>> Science
                                </label>
                            <!-- </div> -->

                            <!-- <div class="radio-inline"> -->
                                <label for="" class="radio-inline">
                                    <input type="radio" class="radio-inline" name="stream" value="general" 
                                        <?php if (isset($_POST['stream'])) { 
                                            if ($_POST['stream'] == 'general') echo 'checked';} ?>> General
                                </label>
                            <!-- </div> -->
                        </div>
                </div>
                 <small> <?php echo $streamErr; ?> </small>
              </div>

              <div class="row mt-2">
                   <!-- <div class="form-ckeck d-inline-flex"> -->
                   <div class="col-lg-4">

                        <label for="year">(10,12 or diploma)Passing Year</label>
                   </div>
                   <div class="col-lg-8">
                            <select name="year" style="width:99%;padding:8px;" id="year">
                                    <option value="" selected disabled>--Choose Passing Year--</option>
                                    <option value="2010" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2010')
                                                            echo 'selected';} ?>>2010</option>

                                    <option value="2011" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2011')
                                                            echo 'selected';} ?>>2011</option>

                                    <option value="2012" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2012')
                                                            echo 'selected';} ?>>2012</option>

                                    <option value="2013" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2013')
                                                            echo 'selected';} ?>>2013</option>

                                    <option value="2014" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2014')
                                                            echo 'selected';} ?>>2014</option>

                                    <option value="2015" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2015')
                                                            echo 'selected';} ?>>2015</option>

                                    <option value="2016" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2016')
                                                            echo 'selected';} ?>>2016</option>

                                    <option value="2017" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2017')
                                                            echo 'selected';} ?>>2017</option>

                                    <option value="2018" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2018')
                                                            echo 'selected';} ?>>2018</option>

                                    <option value="2019" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2019')
                                                            echo 'selected';} ?>>2019</option>

                                    <option value="2020" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2020')
                                                            echo 'selected';} ?>>2020</option>

                                    <option value="2021" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2021')
                                                            echo 'selected';} ?>>2021</option>

                                    <option value="2022" <?php if (isset($_POST['year'])) {
                                                        if ($_POST['year'] == '2022')
                                                            echo 'selected';} ?>>2022</option>                       

                                   
                            </select>
                   </div>
                    <small> <?php echo $yearErr;  ?> </small>
              </div>

              <div class="row mt-2">
                   <!-- <div class="form-ckeck d-inline-flex"> -->
                   <div class="col-lg-4">
                        <label for="ayear">Admission Year (First year) </label>
                   </div>
                   <div class="col-lg-8">
                            <select name="ayear" style="width:99%;padding:8px;" id="ayear">
                                    <option value="" selected disabled>---Choose Board---</option>
                                    <option value="2022" <?php if (isset($_POST['ayear'])) {
                                                        if ($_POST['ayear'] == '2022')
                                                            echo 'selected';} ?>>2022</option>
                            </select>
                    </div>
                      <small> <?php echo $ayearErr;  ?> </small>
             </div>

              <div class="row mt-2">
                    <div class="col-lg-4">
                            <!-- <div class="form-group d-inline-flex"> -->
                                <label for="" class="">Seat/Enrollment Number</label> 
                    </div>        
                    <div class="col-lg-8">
                                <input class="form-control" type="text" name="enumber" 
                                            value="<?php if (isset($_POST['enumber'])) {
                                                echo $enumber = $_POST['enumber'];} ?>">
                            <!-- </div> -->
                    </div>
                     <small> <?php echo $enumberErr; ?> </small>
              </div>

              <div class="row mt-2">
                    <div class="col-lg-4">
                            <!-- <div class="form-group d-inline-flex"> -->
                                <label for="" class="">Name(enter Name Exactly as per 
                                                        your last Board/University Marksheet)
                                </label> 
                    </div>        
                    <div class="col-lg-8">
                                <input class="form-control" type="text" name="name" 
                                            value="<?php if (isset($_POST['name'])) {
                                                echo $name = $_POST['name'];} ?>">
                            <!-- </div> -->
                    </div>
                     <small> <?php echo $nameErr; ?> </small>
              </div>

              <div class="row ">
                   <div class="col-lg-4">
                       <label for="password">Password</label>
                   </div>
                   <div class="col-lg-8">
                        <input type="password" class="form-control" name="password" id="password"
                                            value="<?php if (isset($_POST['password'])) {
                                                        echo $password = $_POST['password'];} ?>">
                   </div>
                        <small> <?php echo $passwordErr;  ?> </small>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-4">
                        <label for="cPassword">Confirm Password</label> 
                    </div>
                   <div class="col-lg-8">
                        <input type="password" class="form-control" name="cpassword" id="cpassword"
                                         value="<?php if (isset($_POST['cpassword'])) {
                                                echo $cpassword = $_POST['cpassword'];} ?>">
                   </div>
                        <small> <?php echo $cpasswordErr;  ?> </small>
                </div>
                <!-- <div class="row mt-2 justify-content-end">
                    <div class="form-check showPassword justify-content-end">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label for="showPassword" class="form-check-label">show password</label>
                    </div>
                </div> -->
            <div class="row mt-2 ">
                <div class="col-lg-4">
                    <label for="" class="">Mobile</label> 
                </div>   
                <div class="col-lg-8">
                                <input class="form-control" type="text" name="number" 
                                            value="<?php if (isset($_POST['number'])) {
                                                echo $number = $_POST['number'];} ?>">
                </div> 
                <small> <?php echo $numberErr; ?> </small>    
            </div>
     <p style="color: red;">(This Mobile number will be used as a registered Mobile number for further communication to you.) </p>
             <div class="row mb-1 ml-5" id="btnn">
                    <div class="col-lg-1">
                        <input type="submit" name="submit" value="submit">
                    </div>
                    <div class="col-lg-6">
                        <input type="reset" name="reset" value="cancel">
                    </div>
             </div>
    </form>
   </div>

</body>
</html>