<?php
$value_to_search='';
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

if (isset($_POST['valuetosearch'])){

    $value_to_search=$_POST['valuetosearch'];
    /*echo $value_to_search;die('jhhjhhj');*/
    $search="SELECT * FROM tutors WHERE CONCAT ('id','name','mob','qualification','subjects','language','tutor','address','gender','date') LIKE '.%".$value_to_search."%' ";
    $searchresult=mysqli_query($conn,$search);
    $result=mysqli_fetch_all($searchresult);
    print_r($result);die('eeeee');
    //print_r($result);die('dddddd');
}else{
    $query="select * from register ORDER BY id ASC ";
    $result=mysqli_query($conn,$query);
    $registers=mysqli_fetch_all($result);

}


function pagination(){
    $pagination_buttons=11;
    $perpage_records=10;
    $query="select * from register";
    $row=mysqli_query($conn,$query);

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
            <a class="navbar-brand" href="index.php">Tutor</a>
        </div>




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
                    <?php if (isset($_SESSION['message'])):?>
                        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                            <?php  echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php endif?>
                    <h1 class="page-header">Users Detail</h1>
                    <div class="" align="right">
                        <a href="register.php" class="btn btn-info btn-sm">Add Users</a>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="" align="left">
                                <b>Users List</b>
                            </div>
                            <div class="" align="right">
                                <form action="tutors_list.php" method="post">
                                    <label for="search">Search</label>
                                    <input type="text" name="valuetosearch" value="<?php echo $value_to_search;?>" placeholder="value to search">
                                    <input type="submit" name="search" class="btn btn-sm" style="background-color: #5bc0de" value="Go">
                                </form>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="table">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th colspan="">Action</th>
                                        </tr>

                                        </thead>
                                        <?php foreach ($registers as $register):?>
                                            <tr>
                                                <td><?php echo $register[0]?></td>
                                                <td><?php echo $register[1]?></td>
                                                <td><?php echo $register[2]?></td>
                                                <td><?php echo $register[3]?></td>


                                                <td>
                                                    <a href="ps.php?delete=<?php echo $register[0]; ?>" class="btn btn-danger" style="margin-right: 1px">Delete</a>
                                                </td>

                                            </tr>
                                        <?php endforeach;?>

                                    </table>

                                </div>
                                <nav aria-label="">

                                   <ul class="pagination">


                                       <li class="disabled">
                                           <a href="" aria-label="Previous">
                                               <span aria-hidden="true">&laquo;</span>
                                           </a>
                                       </li>
                                       <li class="active">
                                           <a href="">1<span class="sr-only">(current)</span>

                                           </a>
                                       </li>

                                       <li class="disabled">
                                           <a href="">2<span class="sr-only"></span>

                                           </a>
                                       </li>

                                       <li class="disabled">
                                           <a href="">3<span class="sr-only"></span>

                                           </a>
                                       </li>

                                       <li class="disabled">
                                           <a href="">4<span class="sr-only">(current)</span>

                                           </a>
                                       </li>
                                       <li class="disabled">
                                           <a href="">5<span class="sr-only">(current)</span>

                                           </a>
                                       </li>
                                       <li class="disabled">
                                           <a href="">6<span class="sr-only"></span>

                                           </a>
                                       </li>
                                       <li class="disabled">
                                           <a href="" aria-label="Next">
                                               <span aria-hidden="true">&raquo;</span>
                                           </a>
                                       </li>
                                   </ul>
                                </nav>
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
