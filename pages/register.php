<?php
session_start();
require_once 'db.php' ;
$name=$email='';
?>
<?php

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $errors=array();

        if (empty($_POST['name'])){
            $errors['name']="Please enter your name";
        }

        if (strlen($_POST['name']) < 3){
            $errors['name1']="your name must be greater than 3 character";
        }
        if (empty($_POST['email'])){
            $errors['email']="Please enter your email";
        }


        if (empty($_POST['mob'])){
            $errors['mob']="Please enter your mobile number";
        }


        if (empty($_POST['password'])){
            $errors['password']="Please enter your password";
        }

        if (strlen($_POST['password'])<5){
            $errors['password1']="your password must be 6 character long";
        }
        $name=$_POST['name'];
        $email=$_POST['email'];
        //echo $email;die('ttttt');
        $mob=$_POST['mob'];
        $user_check=" SELECT * FROM register WHERE name='$name' OR  email='$email' LIMIT 1";
        $r=mysqli_query($conn,$user_check);
        $result=mysqli_num_rows($r);
        //print_r($result);die('ssssss');
         // if user exists
        //echo $result;die('tttt');

            if ($result == 1) {
                return false;
            }





        if(count($errors)==0){
           // print_r($_POST);


            $password=md5($_POST['password']);
           // print_r($_POST);die('ghghhg');
            $query="INSERT INTO register (name,email,mob,password) VALUES('$name','$email','$mob','$password')";
            if (mysqli_query($conn,$query)){
                $_SESSION['message']="You are registered successfully.please login here.";
                $_SESSION['msg_type']="success";
                header("location:login.php");
            }else{
                echo "Error: " .mysqli_error($conn);
            }

        }


    }




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Startmin - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Register Here</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="" method="post">
                        <fieldset>

                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" type="text"  autofocus>
                              <span class="error"> <?php if (isset($errors['name'])) echo $errors['name']?><br>
                                  <?php if (isset($errors['name1'])) echo $errors['name1']?></span>

                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                               <span class="error"> <?php if (isset($errors['email'])) echo $errors['email']?> </span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Mobile Number" name="mob" type="number" autofocus>
                                <span class="error"><?php if (isset($errors['mob'])) echo $errors['mob']?>
                                </span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                               <span class="error"> <?php if (isset($errors['password'])) echo $errors['password']?><br>
                                <?php if (isset($errors['password1'])) echo $errors['password1']?> </span>
                            </div>
                            
                            <!-- Change this to a button or input when using this as a form -->

                            <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="SignUp">


                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- jQuery -->
<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>

</body>
</html>
