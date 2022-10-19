<?php
session_start();
if (!isset($_SESSION['aid']) || !isset($_COOKIE['aid'])) {    
    header('location:admin_login.php');
}

include('insert.php');

function setValue($value)
{
    if (isset($_POST[$value])) {
        echo $_POST[$value];
    }
}

function checked($name, $value, $show)
{
    if (isset($_POST[$name])) {
        if ($_POST[$name] == $value)
            echo  $show;
    }
}

function arrChecked($name, $value, $show)
{
    if (isset($_POST[$name])) {
        if (in_array($value, $_POST[$name])) {
            echo $show;
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
    <link rel="stylesheet" href="Assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/CSS/style.css">


    <title>Add User</title>
</head>

<body>
<?php include 'navbar.php'; ?>

    <div class="container  bg-light w-100 ">
        <form method="post" enctype="multipart/form-data">
            <h1 class="text-center">Add User</h1>
            <div class="row   ">

                <div class="col-lg-6  ">

                    <div class="form-group">
                        <label for="" class="">First Name</label> <small> * <?php echo $fNameErr;   ?> </small>
                        <input class="form-control" type="text" name="fName" value="<?php setValue('fName'); ?>">
                    </div>


                    <div class="form-group">
                        <label for="">Last Name</label> <small> <?php echo $lNameErr;   ?> </small>
                        <input class="form-control" type="text" name="lName" value="<?php setValue('lName'); ?>">
                    </div>


                    <div class="form-group">
                        <label for="">Age</label> <small> <?php echo $ageErr;   ?> </small>
                        <input type="text" class="form-control" name="age" value="<?php setValue('age'); ?>">
                    </div>

                    <label for="">Gender <small> * <?php echo $genErr; ?> </small>
                        <div class="form-check">
                            <label for="" class="form-check-label">
                                <input type="radio" value="male" class="form-check-input" name="gender" <?php checked('gender', 'male', 'checked'); ?>> Male
                            </label>
                        </div>
                        <div class="form-check">

                            <label for="" class="form-check-label">

                                <input type="radio" value="female" class="form-check-input" name="gender" <?php checked('gender', 'female', 'checked'); ?>> Female
                            </label>
                        </div>
                    </label>


                    <div class="form-ckeck">

                        <label for="department">Department <small> * <?php echo $depErr;  ?> </small>
                            <select name="department" class="form-control" id="department">
                                <option value="" selected disabled>---Choose Department</option>
                                <option value="R & D" <?php checked('department', 'R & D', 'selected'); ?>>R & D</option>
                                <option value="Sales" <?php checked('department', 'Sales', 'selected'); ?>>Sales</option>
                                <option value="Marketing" <?php checked('department', 'Marketing', 'selected'); ?>>Marketing</option>
                                <option value="HR" <?php checked('department', 'HR', 'selected'); ?>>HR</option>
                            </select>
                        </label>
                    </div>




                    <div class="form-group">
                        <label for="">Date Of Join</label> <small> * <?php echo $dojErr; ?> </small>
                        <input type="date" class="form-control" name="doj" value="<?php setValue('doj'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Salary</label> <small> * <?php echo $salaryErr;  ?> </small>
                        <input type="text" class="form-control" name="salary" value="<?php setValue('salary'); ?>">
                    </div>
                </div>
                <div class="col-lg-6  ">



                    <div class="form-group">
                        <label for="">Email</label> <small> * <?php echo $emailErr;  ?> </small>
                        <input type="text" class="form-control" name="email" value="<?php setValue('email'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label><small> * <?php echo $passwordErr;  ?> </small>
                        <input type="text" class="form-control" name="password" id="password" value="<?php setValue('password'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="cPassword">Confirm Password</label> <small> * <?php echo $cPasswordErr;  ?> </small>
                        <input type="text" class="form-control" name="cPassword" id="cPassword" value="<?php setValue('cPassword'); ?>">
                    </div>

                    <label for=""> Hobby <small> * <?php echo $hobbyErr;  ?> </small>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="reading" <?php arrChecked('hobby', 'reading', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">reading</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="dancing" <?php arrChecked('hobby', 'dancing', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Dancing</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="programming" <?php arrChecked('hobby', 'programming', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Programming</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="gaming" <?php arrChecked('hobby', 'gaming', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Gaming</label>
                        </div>

                    </label>

                     
                         <small> * <?php echo $fileErr;  ?> </small>
                        <div class="custom-file">

                            <!-- <label for="file" class="custom-file-label">choose file</label> -->
                            <input type="file" class="" name="file" id="file" value="ja.png">
                        </div>
                     
 
                    <input type="submit" name="add_user" value="Add_User" class="btn btn-primary">
                    <input type="reset" name="submit" value="Reset" class="btn btn-warning">
                    
    <a href="dashboard.php" class="btn btn-info" >Back</a>

                </div>
            </div>
        </form>
    </div>










</body>

</html>
 