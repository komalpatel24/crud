<?php
include 'config.php';

    $afterErr = $boardErr = $streamErr = $yearErr = $ayearErr = $enumberErr  = $passwordErr  = ''; 

    if (isset($_POST['submit'])) {
            $after = $_POST['after'];
            $board = $_POST['board'];
            $stream = $_POST['stream'];
            $year = $_POST['year'];
            $ayear = $_POST['ayear'];
            $enumber = $_POST['enumber'];
            $password = $_POST['password'];

            if (empty($after)) {
                $afterErr = 'Admission After should be not empty';
            }elseif(empty($board)){ 
                $boardErr = 'please choose your Bord/University';  
            }elseif(empty($stream)){ 
                $streamErr = 'stream should be not empty';
            }elseif(empty($year)){ 
                $yearErr = 'please choose your last passing year';  
            }elseif(empty($ayear)){ 
                $ayearErr = 'please choose your Admission year';  
            }elseif(empty($enumber)){
                $enumberErr = 'Enrollment Number is required';  
            }elseif(empty($password)){ 
                $passwordErr = 'Password should be not empty';
            } else {
                $selectTable = "SELECT * FROM user_register WHERE enumber ='$enumber'";
                $query = mysqli_query($conn, $selectTable);
                $check_email = mysqli_num_rows($query);
                $assoc = mysqli_fetch_assoc($query);
                if ($check_email) {
        
                    // if ($assoc['after'] == ($after) && $assoc['board'] == ($board) && $assoc['stream'] == ($stream) && 
                    // $assoc['year'] == ($year) && $assoc['ayear'] == ($ayear) && $assoc['password'] == ($password)) {
                    //         header('location:welcome.php');
                    // } else {
                    //     $passwordErr = "invalid password";
                    // }

                    if(!($assoc['after'] == ($after))){
                        $afterErr = "invalid Admission After value";
                    }elseif(!($assoc['board'] == ($board))){
                        $boardErr = "selected Board invalid";
                    }elseif(!($assoc['stream'] == ($stream))){
                        $streamErr = "selected Stream invalid";
                    }elseif(!($assoc['year'] == ($year))){
                        $yearErr ="selected year invalid";
                    }elseif(!($assoc['ayear'] == ($ayear))){
                        $ayearErr = "selected Admission Year is invalid";
                    }elseif(!($assoc['password'] == ($password))){
                        $passwordErr = "invalid password";
                    } else {
                        header('location:welcome.php');
                    }

                } else {
                    // $enumberErr = "U are not registerd";/
                    ?>
                <script>
                    alert('You are not registerd!! So Plz Before Register After Login');
                    location.replace('mysy_registration.php');
                </script>
                <?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>mysy_login</title>
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
        select{
            width:99%;
            padding:8px;
            background-color:transparent;
            border:0.5px solid black;
            border-radius:5px;
        }
        img{
            width: 99%;
            margin: 0.3%;
        }
    </style>
</head>
<body>
<img src="./img/mysy.png" alt="mysy">

   <div class="container mt-4 mb-4 border border-dark w-50">
        <form method="post" enctype="multipart/form-data">
            <h6 class="text-center mt-1 mb-4">mysy Login</h6>
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
                            <select name="board"  id="board">
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

              <div class="row mt-2">
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
                            <select name="year" id="year">
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

              <div class="row mt-1">
                   <!-- <div class="form-ckeck d-inline-flex"> -->
                   <div class="col-lg-4">
                        <label for="ayear">Admission Year (First year) </label>
                   </div>
                   <div class="col-lg-8">
                            <select name="ayear" id="ayear">
                                    <option value="" selected disabled>---Choose Board---</option>
                                    <option value="2022" <?php if (isset($_POST['ayear'])) {
                                                        if ($_POST['ayear'] == '2022')
                                                            echo 'selected';} ?>>2022</option>
                            </select>
                    </div>
                      <small> <?php echo $ayearErr;  ?> </small>
             </div>

              <div class="row mt-3">
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

              <div class="row mt-2 mb-3">
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

                <!-- <div class="row mt-2">
                    <div class="col-lg-4">
                        <label for="cPassword">Confirm Password</label> 
                    </div>
                   <div class="col-lg-8">
                        <input type="password" class="form-control" name="cpassword" id="cpassword"
                                         value="<?php if (isset($_POST['cpassword'])) {
                                                echo $cpassword = $_POST['cpassword'];} ?>">
                   </div>
                        <small> <?php echo $cpasswordErr;  ?> </small>
                </div> -->
                <!-- <div class="row mt-2 justify-content-end">
                    <div class="form-check showPassword justify-content-end">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label for="showPassword" class="form-check-label">show password</label>
                    </div>
                </div> -->
            
             <div class="row mb-2 " id="btnn">
                    <div class="col-lg-6 ">
                        
                    </div>
                    <div class="col-lg-6 ">
                        <input type="submit" name="submit" value="submit">
                        <input type="reset" name="reset" value="Back">
                    </div>
             </div>
            <a href="mysy_registration.php">If you have not registered plz. click for Registration</a> <br>
            <a href="">Change Password</a> <br>
            <a href="">Forgot Password</a>




    </form>
   </div>
</body>
</html>