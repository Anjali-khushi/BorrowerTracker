<?php
include 'elements/dbconnect.php';
session_start();
$showAlert = false;
$showError = false;
$showLimit = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // $fName = $_POST['fullName'];
    // $uName = $_POST['userName'];
    
    // $sql2 = "Select Serial_No from users where uName ='$uName' AND Full_Name ='$fName'";
    // $result2 = mysqli_query($con, $sql2);
    // $uid = mysqli_fetch_assoc($result2);
    // echo $uid;
    // $ui = $uid['Serial_No'];
    // echo " Register ID here: ".$ui;
    
    $ui= $_SESSION['UId'];
    $accNumb = $_POST['accCount'];
    $branchName = $_POST['branchName'];
    $acclimit = $_POST['accLimit'];     //(R_Id, AccountCount, AccountBranch, AccountLimit)
    if($acclimit > 50000 || $acclimit <= 0){   
        $showLimit = true;    
    }
    else if($acclimit<=50000 && $acclimit > 0 && $branchName !="" && $accNumb !=""){
        $sql = "INSERT INTO `accountdetail` (`R_Id`, `AccountCount`, `AccountBranch`, `AccountLimit`,`Re_Amt`) VALUES ('$ui', '$accNumb', '$branchName', '$acclimit','$acclimit')";
        $result = mysqli_query($con,$sql);
        if($result)
        $showAlert = true;
        // header('location: accountDetail.php');
    }
    else{
        $showError = "Account details couldn't saved. Note: Please ensure you have filled all the details.";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Bank Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
</head>
  <body>
  <?php include 'elements/nav.php'; 
//   echo " Register ID here: ".$_SESSION['UId']; 
  ?>
  <?php 
  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Account details is successfully saved.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $showError .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }if($showLimit){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>NOTE: </strong>Account limit for lending money can not be greater then 50,000 and should be a positive number.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>
 
    <div class="container my-4">
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="fullName" value="<?php echo $_SESSION['FName']?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" class="form-control" name="userName" value="<?php echo $_SESSION['user']?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Account Count</label>
            <input type="text" class="form-control" placeholder="Number of account should be greater then 0, ex: 1,2 etc" 
            name="accCount" autocomplete="off">
        </div>
        <div class="mb-3">
            <label  class="form-label">Branch Name</label>
            <input type="text" class="form-control" placeholder="Enter account branch name. Ex: SBI, ICIC etc." 
            name="branchName" autocomplete="off">
        </div>
        <div class="mb-3">
            <label  class="form-label">Account Limit</label>
            <input type="text" class="form-control" placeholder="Maximum amount you can transfer." 
            name="accLimit" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <footer>
        <p class="p-3 bg-dark text-white text-center">@BorrowerTracker <a href="lendingRules.php#feedback" class="text-light">Feedback Time</a></p>
        <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
    </footer>
  </body>
</html>