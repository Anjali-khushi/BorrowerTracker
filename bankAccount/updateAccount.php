<?php
include '../elements/dbconnect.php';
session_start();
$showAlert = false;
$showError = false;
$showLimit = false;
$ui= $_SESSION['UId'];
$id =$_GET['updatedAcc'];
$sql1 = "select * from accountdetail where AccountCount=$id and R_Id=$ui";
$result1 = mysqli_query($con, $sql1);
$rows = mysqli_fetch_assoc($result1);
$accNumb = $rows['AccountCount'];         
$branchName = $rows['AccountBranch'];     
$acclimit = $rows['AccountLimit'];
$reAmt = $rows['Re_Amt'];
$diff = $acclimit - $reAmt;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $accNumb = $_POST['accCount'];
    $branchName = $_POST['branchName'];
    $acclimit = $_POST['accLimit'];     //(R_Id, AccountCount, AccountBranch, AccountLimit)
    $reAmt =  $acclimit - $diff;
    if($acclimit > 50000 || $acclimit <= 0){   
        $showLimit = true;    
    }
    else if($acclimit<=50000 && $acclimit > 0 && $branchName !="" && $accNumb !=""){
        $sql = "update accountdetail set AccountCount=$accNumb, AccountBranch='$branchName', AccountLimit=$acclimit, Re_Amt=$reAmt where AccountCount=$id and R_Id=$ui";
        $result = mysqli_query($con,$sql);
        if($result)
          $showAlert = true;
        // header('location: accountDetail.php');
    }
    else{
        $showError = "Account details couldn't updated. Note: Make sure all the fields are filled.";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">BorrowerTracker</a>
  <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../home.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../displayAccount.php">Bank Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../home.php#oser">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>     
  <?php 
  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Account details is successfully updated.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $showError .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }if($showLimit){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>NOTE: </strong>Account limit for lending money can not be greater then 50,000 and should be a positive nuber.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>
 
    <div class="container my-4">
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="fullName" value="<?php echo $_SESSION['FName'];?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" class="form-control" name="userName" value="<?php echo $_SESSION['user'];?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Account Count</label>
            <input type="text" class="form-control" name="accCount" autocomplete="off" value="<?php echo $accNumb;?>">
        </div>
        <div class="mb-3">
            <label  class="form-label">Branch Name</label>
            <input type="text" class="form-control" name="branchName" autocomplete="off" value="<?php echo $branchName;?>">
        </div>
        <div class="mb-3">
            <label  class="form-label">Amount Limit</label>
            <input type="text" class="form-control" name="accLimit" autocomplete="off" value="<?php echo $acclimit;?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
    <footer>
        <p class="p-3 bg-dark text-white text-center">@BorrowerTracker</p>
        <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
    </footer>
  </body>
</html>