<?php
session_start();
require_once 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $_SESSION['message'] = "Record Deleted successfully";
    $_SESSION['msg_type'] = "danger";
    header("location:students_list.php");

}

if (isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $mob=$_POST['mob'];
    $class=$_POST['class'];
    $subjects=$_POST['subjects'];
    $language=$_POST['language'];
    $tutor=$_POST['tutor'];
    $address=$_POST['address'];
    $gender=$_POST['gender'];
    $date=date('Y-m-d',strtotime($_POST['date']));


    $query="UPDATE students SET name='$name',mob='$mob',class='$class',subjects='$subjects',language='$language',tutor='$tutor',address='$address',gender='$gender',date='$date' WHERE id='$id' ";
    $update=mysqli_query($conn,$query);
    if ($update){
        $_SESSION['message'] = "Record Updated successfully";
        $_SESSION['msg_type'] = "warning";
        header("location:students_list.php");
    }
}

?>