<?php
include 'elements/dbconnect.php';
session_start();
$showAlert = false;
$showError = false;
$showLimit = false;
$uid = $_SESSION['UId'];
$sql1 = "Select AccountBranch,AccountLimit,Re_Amt From accountdetail where R_Id=$uid";
$result1 = mysqli_query($con,$sql1);    
$acclimit = 0;
$remainAmt = 0;
// YYYY-MM-DD date format for saving in data base

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $bName = $_POST['bName'];
    $relative = $_POST['relative'];
    $bPhone = $_POST['bPhone'];
    $bMail = $_POST['bMail'];
    $interest = $_POST['interest'];
    $payMode = $_POST['payMode'];
    
    $borrowAmt = $_POST['borrowAmt'];
    $accBranch = $_POST['accBranch'];
    $sql2 = "Select AccountBranch,AccountLimit,Re_Amt From accountdetail where R_Id=$uid and AccountBranch LIKE '$accBranch'";
    $result2 = mysqli_query($con,$sql2);   
    
    if($result2){
        $row2 = mysqli_fetch_assoc($result2);
        $acclimit = $row2['AccountLimit'];
        $remainAmt = $row2['Re_Amt'];
    }
    $remainAmt = $remainAmt - $borrowAmt;

    $tranId = $_POST['tranId'];
    $roi = $_POST['roi'];
    $lastDate = $_POST['lastDate'];   //mm/dd/yyyy
    $lastDate = date('Y-m-d',strtotime($lastDate));
    
    if($borrowAmt > $acclimit || $borrowAmt <= 0){   
        $showLimit = true;    
    }
    else if($borrowAmt<= $acclimit && $borrowAmt > 0 && $accBranch !="" && $tranId !="" && $interest!=""){

        $sqlIns = "INSERT INTO `borrowerdetail`( `R_Id`, `Name`, `Relation`, `Phone_no`, `E_mail`, 
        `DateWhenGiven`, `InterestApply`, `PayMode`, `AmtBorrowed`, `AccBranch`, `Transaction_Id`,
        `AmtReturned`, `RoI_Applied`, `Deadline`) VALUES ('$uid','$bName','$relative','$bPhone',
        '$bMail',current_timestamp(),'$interest','$payMode', '$borrowAmt','$accBranch','$tranId','0','$roi',
        '$lastDate')";
        $resultIns = mysqli_query($con,$sqlIns);

        $sqlUpdate = "Update accountdetail Set Re_Amt=$remainAmt where R_Id=$uid and AccountBranch in ('$accBranch')";
        mysqli_query($con,$sqlUpdate);
    
        if($resultIns){
            $showAlert = true;
            $sqlBo ="Select B_Id,DateWhenGiven From borrowerdetail where R_Id=$uid Order By DateWhenGiven Desc";
            $resultBo = mysqli_query($con,$sqlBo);
            $rowBo = mysqli_fetch_assoc($resultBo);
            $bid = $rowBo['B_Id'];
            $dateGiven = $rowBo['DateWhenGiven'];
            // header('location: accountDetail.php');
        }
        $sqlInsHis = "INSERT INTO `paymenthistory`(`B_Id`,`R_Id`,`Transaction_Id`, `AccountBranch`,
        `Date`, `Status`, `AmtPaid`) VALUES ('$bid','$uid','$tranId','$accBranch','$dateGiven',
        'Debit','$borrowAmt')";
        $resultInsHis = mysqli_query($con,$sqlInsHis);
    }
    else{
        $showError = "Borrower details couldn't inserted. Note: Please ensure you have filled all required details.";
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

  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Boorrower details is successfully saved.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $showError .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }if($showLimit){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>NOTE: </strong>Amount given to borrower can not exceed the account limit and should be a positive number.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>

    <div class="container my-4">
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Lender Name</label>
            <input type="text" class="form-control" name="fullName" value="<?php echo $_SESSION['FName']?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Borrower Name *</label>
            <input type="text" class="form-control" name="bName" autocomplete="off" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Relative</label>
            <select class="form-control" name="relative" id="relative">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Borrower Contact *</label>
            <input type="tel" class="form-control" placeholder="Enter Borrower Phone Number." 
            name="bPhone" autocomplete="off" required>
        </div>
        <div class="mb-3">
            <label  class="form-label">Borrower Mail</label>
            <input type="email" class="form-control" placeholder="Enter Borrower Mail ID." 
            name="bMail" autocomplete="off">
        </div>
        <div class="mb-3">
            <label  class="form-label">Interest Applied *</label>
            <select class="form-control" name="interest" id="interest">
                <option value="N">No</option>
                <option value="Y">Yes</option>
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Payment Mode</label>
            <select class="form-control" name="payMode" id="payMode">
                <option value="online">Online</option>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Amount Borrowed *</label>
            <input type="text" class="form-control" placeholder="Enter amount borrowed by the person." 
            name="borrowAmt" autocomplete="off" required>
        </div>
        
        <?php
        echo '<div class="mb-3">
        <label  class="form-label">Account Branch *</label>';
        if(mysqli_num_rows($result1)>0){ 
            echo '<select class="form-control" name="accBranch" id="accBranch">';
            // $accCount =1;
            while($row1 = mysqli_fetch_assoc($result1))
            { $branch =$row1['AccountBranch'];   
              echo '<option value='.$branch.'>'.$row1['AccountBranch'].'</option>';
            }
            echo '</select>';
          }
        echo '<small id="CPass" class="form-text text-muted">Select branch from which amount was transfered to the person.</small>
        </div>';
        ?>

        <div class="mb-3">
            <label  class="form-label">Transaction Id *</label>
            <input type="text" class="form-control" placeholder="Enter trasaction id which was generated after successful payment." 
            name="tranId" autocomplete="off" required>
        </div>
        <div class="mb-3">
            <label  class="form-label">Rate of Interest</label>
            <select class="form-control" name="roi" id="roi">
                <option value="N">No</option>
                <option value="Y">Yes</option>
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">Deadline <stylecolor="red">*</style></label>
            <input type="date" class="form-control" placeholder="Enter last date till borrower will pay back the amount." 
            name="lastDate" autocomplete="off" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Details</button>
        <button class="btn btn-primary my-4">
            <a href="transhistory.php" class="text-light">Show History</a>
        </button>
        <!-- <div  class="text-right" class="col-auto col-lg-6 col-md-6 col-sm-4">
            <a href="transhistory.php" class="button">Show History</a>
        </div><br> -->
    </form>
    </div>
    <footer>
        <p class="p-3 bg-dark text-white text-center">@BorrowerTracker <a href="lendingRules.php#feedback" class="text-light">Feedback Time</a></p>
        <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
    </footer>
  </body>
</html>