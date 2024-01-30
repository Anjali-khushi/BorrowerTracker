<?php
include '../elements/dbconnect.php';
session_start();
if(isset($_GET['deletedAcc']))
{
    $id =$_GET['deletedAcc'];
    $uid = $_SESSION['UId'];
    $sql = "delete from accountdetail where AccountCount=$id and R_Id=$uid";
    $result = mysqli_query($con,$sql);
    // $result=true;
    if($result){
        header("location:../displayAccount.php");
    }else{
        die(mysqli_error($con));
    }
}
?>
