<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    $errors=array();
    if (empty($_POST['email'])){
        $errors['email']="email is requiered";
    }
    if (empty($_POST['password'])){
        $errors['password']="password is requiered";
    }
    
    if (count($errors)==0){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $password = md5($password);
        $query="SELECT * FROM register WHERE email='$email' AND password='$password'";
        //echo $query;die('hhjhjh');
        $r=mysqli_query($conn,$query);

        $result=mysqli_fetch_assoc($r);
        if(!empty($result)){
            $_SESSION['email']=$email;
             $_SESSION['name']= $result['name'];
            $_SESSION['last_login_timestamp']=time();
            //echo $_SESSION['email'];die('pppp');
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['msg_type'] = "info";
            //echo  $_SESSION['success'];die('pppp');
            header("location: index.php");

        }else{
            echo '<div class="alert alert-danger" role="alert" id="danger-message">Incorrect <i class="glyphicon glyphicon-thumbs-down"></i> Your Email or Password are incorrect.please try again.</div>';
        }
        //print_r($result) ;die('dddd');



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
    <?php if (isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>


        <div class="container">
            <div class="row">


                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">

                            <form role="form" method="post" action="" >
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                        <span class="error"><?php if (isset($errors['email'])) echo $errors['email']?></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                        <span class="error"><?php if (isset($errors['password'])) echo $errors['password']?></span>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->

                                    <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="Login">

                                    <a href="register.php" class="btn btn-lg btn-success btn-block">Register Here</a>
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
