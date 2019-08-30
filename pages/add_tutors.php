<?php
require_once 'db.php';
session_start();
if (!isset($_SESSION['email'])){
    header("location: login.php");
}
?>

<?php if (isset($_SESSION['email'])){

    if (time() - $_SESSION['last_login_timestamp'] > 1800){
        header('location:logout.php');
    }
}
?>

<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $errors=array();

    if (empty($_POST['name'])){
        $errors['name']="Enter Your Name";
    }

    if (empty($_POST['mob'])){
        $errors['mob']="Enter Your Mobile Number";
    }

    if (empty($_POST['qualification'])){
        $errors['qualification']="Enter Your Higher Qualification";
    }

    if (empty($_POST['subjects'])){
        $errors['subjects']="Enter Your Subjects";
    }

    if (empty($_POST['language'])){
        $errors['language']="Enter Your Communication Language";
    }

    if (empty($_POST['tutor'])){
        $errors['tutor']="Select Your Tutor Type";
    }

    if (empty($_POST['address'])){
        $errors['address']="Enter Your Local Address";
    }

    if (empty($_POST['gender'])){
        $errors['gender']="Select Your Gender Type";
    }

    if (empty($_POST['date'])){
        $errors['date']="Select Date";
    }

    if (count($errors)==0){
        $name=$_POST['name'];
        $mob=$_POST['mob'];
        $qualification=$_POST['qualification'];
        $subjects=$_POST['subjects'];
        $language=$_POST['language'];
        $tutor=$_POST['tutor'];
        $address=$_POST['address'];
        $gender=$_POST['gender'];
        $date=date('Y-m-d',strtotime($_POST['date']));
       // echo $date;die('ghjjj');

        $query="INSERT INTO tutors (name,mob,qualification,subjects,language,tutor,address,gender,date) VALUES ('$name','$mob','$qualification','$subjects','$language','$tutor','$address','$gender','$date')";
        $result=mysqli_query($conn,$query);
        if ($result){
            header("location: tutors_list.php");
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

        <title>Tutors</title>

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
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript">
            $(function(){
                $("#date").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    todayHighlight:true
                });
            });
        </script>



        <style>
            .error{
                color: red;
            }
        </style>

    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">Tutor</a>
                </div>


                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?php if (isset($_SESSION['name'])) echo $_SESSION['name'] ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="index.php" class=""><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="add_tutors.php" class=""><i class="fa fa-book fa-fw"></i> Become a Tutor</a>
                            </li>
                            <li>
                                <a href="add_students.php" class=""><i class="fa fa-edit fa-fw"></i> Become a Student</a>
                            </li>
                            <li>
                                <a href="tutors_list.php"><i class="fa fa-table fa-fw"></i> Tutors List</a>
                            </li>
                            <li>
                                <a href="students_list.php"><i class="fa fa-edit fa-fw"></i> Students List</a>
                            </li>
                            <li>

                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>

                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Add Tutor Details</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Add Details
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="post" action="">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Tutor Name</label>
                                                            <input type="text" name="name" class="form-control" id="" placeholder="Tutor Name" >
                                                            <span class="error"><?php if (isset($errors['name'])) echo $errors['name'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Mobile Number</label>
                                                            <input type="number" name="mob" class="form-control" id="" placeholder="Mobile Number" >
                                                            <span class="error"><?php if (isset($errors['mob'])) echo $errors['mob'] ?></span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Higher Qualification</label>
                                                            <input type="text" name="qualification" class="form-control" id="" placeholder="Higher Qualification with Subject" >
                                                            <span class="error"><?php if (isset($errors['qualification'])) echo $errors['qualification'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Subjects You Want to Teach</label>
                                                            <input type="text" name="subjects" class="form-control" id="" placeholder="Subjects You Want to Teach" >
                                                            <span class="error"><?php if (isset($errors['subjects'])) echo $errors['subjects'] ?></span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Communication Language</label>
                                                            <input type="text" name="language" class="form-control" id="" placeholder="Communication Language" >
                                                            <span class="error"><?php if (isset($errors['language'])) echo $errors['language'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Home Tutor</label>
                                                            <select class="form-control" name="tutor">
                                                                <option>Select</option>
                                                                <option>Yes</option>
                                                                <option>No</option>
                                                            </select>
                                                            <span class="error"><?php if (isset($errors['tutor'])) echo $errors['tutor'] ?></span>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Local Address</label>
                                                            <input type="text" name="address" class="form-control" id="" placeholder="Local Address" >
                                                            <span class="error"><?php if (isset($errors['address'])) echo $errors['address'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <select class="form-control" name="gender">
                                                                <option>Select</option>
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                                <option>Other</option>
                                                            </select>
                                                            <span class="error"><?php if (isset($errors['gender'])) echo $errors['gender'] ?></span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="text" name="date" class="form-control" id="date" placeholder="DD/MM/YYYY" autocomplete="off">
                                                            <span class="error"><?php if (isset($errors['date'])) echo $errors['date'] ?></span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                                        <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->

                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->


        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>






    </body>
</html>
