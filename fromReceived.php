<?php
include 'elements/dbconnect.php';
session_start();
$uid = $_SESSION['UId'];
$bId = $_GET['bId'];
$accBranch = $_GET['accBranch'];
$accBranch =trim($accBranch);
if(isset($_POST['submit']))
{
    $from = $bId;
    $to = $_POST['to'];    //borrower account branch name
    $payMode = $_POST['payMode']; 
    $tranId = $_POST['tranId']; 
    $amount = $_POST['amount'];

    $sql = "SELECT * from borrowerdetail where B_Id=$from and R_Id=$uid and AccBranch LIKE '$to'";
    $query = mysqli_query($con,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of borrower who had transfered the amount.

    $sql = "SELECT * from accountdetail where R_Id=$uid and AccountBranch LIKE '$to'";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query); 


    // constraint to check input should not be negative or 0 value by user
    if ($amount < 0 || $amount == 0)
    {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative or zero amount cannot be transferred.")';  // showing an alert box.
        echo '</script>';
    }

    // constraint to check whether transfer amount is larger to what was actually lend.
    else if($amount > $sql1['AmtBorrowed']) 
    {
        echo '<script type="text/javascript">';
        echo ' alert("Bad Request! Transfering amount is greater then borrowed amount.")';  // showing an alert box.
        echo '</script>';
    }
    else if($amount > ($sql1['AmtBorrowed'] - $sql1['AmtReturned'])) 
    {
        echo '<script type="text/javascript">';
        echo ' alert("Bad Request! Transfering amount is greater then remaining amount.")';  // showing an alert box.
        echo '</script>';
    }


    // constraint to check tranId and payment mode is not empty
    else if($tranId =="" && $payMode == ""){
        echo "<script type='text/javascript'>";
        echo "alert('Oops! Transaction Id and Payment mode can not be blank or 0.')";
        echo "</script>";
    }
    else if($tranId ==0){
        echo "<script type='text/javascript'>";
        echo "alert('Oops! Transaction Id can not be zero value.')";
        echo "</script>";
    }

    else {
        $newbalance = $sql1['AmtReturned'] + $amount;
        $sql = "UPDATE borrowerdetail set AmtReturned=$newbalance where B_Id=$from and R_Id=$uid and AccBranch LIKE '$to'";
        mysqli_query($con,$sql);
             
        $newbalance = $sql2['Re_Amt'] + $amount;
        $sql = "UPDATE accountdetail set Re_Amt=$newbalance where R_Id=$uid and AccountBranch LIKE '$to'";
        mysqli_query($con,$sql);
            
        $dateTrans = date('Y-m-d H:i:s');
        $sqlInsHis = "INSERT INTO `paymenthistory`(`B_Id`,`R_Id`,`Transaction_Id`, `AccountBranch`,
        `Date`, `Status`, `AmtPaid`) VALUES ('$from','$uid','$tranId','$to','$dateTrans',
        'Credit','$amount')";
        $resultInsHis = mysqli_query($con,$sqlInsHis);

        if($resultInsHis){
            echo "<script> alert('Transaction Successful');
                window.location='transhistory.php';
            </script>";     
        }
        $newbalance= 0;
        $amount =0;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">
        .button{
        background-color: #f46f65;
        color: #6B0772;
        border: 2px solid lightpink;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease 0s;
        padding: 8px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        ont-size: 18px;
        }
        .button:hover{
        box-shadow: 0 12px 16px 0 rgb(239, 197, 234), 0 17px 50px 0 rgb(244, 216, 241);
        background-color: #ef83cf;  
        border: 2px solid #d977ce;
        text-decoration: none;
        color:white;
        }
    </style>
</head>

<body>
 
<?php
  include 'elements/nav.php';
?>

    <div class="container">
        <h2 class="text-center pt-4">Transaction From Borrower</h2>
            <?php
                // echo $bId." ".$accBranch;
                $sql = "SELECT `Name`,Transaction_Id,AmtBorrowed,AmtReturned,Deadline FROM  borrowerdetail where B_Id=$bId and R_Id=$uid and AccBranch LIKE '$accBranch'";
                $result=mysqli_query($con,$sql);
                if(!$result)
                {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error : </strong>'.mysqli_error($con).'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
            <div>
                <h5>Borrower Details from which amount received:</h5>
            </div>
            <div class="table-responsive-sm">
            <table class="table table-bordered">
                <tr class="table-danger">
                    <th class="text-center">Borrower Id</th>
                    <th class="text-center">Borrower Name</th>
                    <th class="text-center">Transaction Id</th>
                    <th class="text-center">Total Amt</th>
                    <th class="text-center">Returned Amt</th>
                    <th class="text-center">Deadline</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $bId ?></td>
                    <td class="py-2"><?php echo $rows['Name'] ?></td>
                    <td class="py-2"><?php echo $rows['Transaction_Id'] ?></td>
                    <td class="py-2"><?php echo $rows['AmtBorrowed'] ?></td>
                    <td class="py-2"><?php echo $rows['AmtReturned'] ?></td>
                    <td class="py-2"><?php echo $rows['Deadline'] ?></td>
                </tr>
            </table>
            </div>
        <?php
             if($rows['AmtBorrowed'] > $rows['AmtReturned'])
             {
            ?>   
            <h5>Account in which amount being transfered:</h5>
        <?php
            $sql = "SELECT AccountCount,R_Id,AccountBranch,AccountLimit,Re_Amt FROM accountdetail where R_Id=$uid and AccountBranch LIKE '$accBranch'";
            $result=mysqli_query($con,$sql);
            if(!$result)
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error : </strong>'.mysqli_error($con).'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            $rows=mysqli_fetch_assoc($result);
        ?>
        <div class="table-responsive-sm">
            <table class="table table-bordered">
                <tr class="table-warning">
                    <th class="text-center">Account Count</th>
                    <th class="text-center">User ID</th>
                    <th class="text-center">Branch Name</th>
                    <th class="text-center">Account Limit</th>
                    <th class="text-center">Amount Remain</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['AccountCount']; ?></td>
                    <td class="py-2"><?php echo $uid; ?></td>
                    <td class="py-2"><?php echo $rows['AccountBranch']; ?></td>
                    <td class="py-2"><?php echo $rows['AccountLimit']; ?></td>
                    <td class="py-2"><?php echo $rows['Re_Amt'];?></td>
                </tr>
            </table>
        </div><br>
        <label>Transfer to:</label>
        <select name="to" class="form-control" required>
            <option value=""disabled selected>Choose Account Branch</option>
            <option class="table" value="<?php echo $rows['AccountBranch'];?>" >
                <?php echo $rows['AccountBranch'];?> (Balance: 
                <?php echo $rows['Re_Amt'];?> ) 
            </option>
        </select><br>
        <div class="mb-3">
        <label  class="form-label">Payment Mode :</label>
            <select class="form-control" name="payMode" id="payMode">
                <option value="online">Online</option>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
            </select>
        </div>
        <div class="mb-3">
        <label  class="form-label">Transaction Id *:</label>
            <input type="text" class="form-control" placeholder="Enter trasaction id which was generated after successful payment." 
            name="tranId" autocomplete="off" required>
        </div>
        <label>Amount Transfered:</label>
            <input type="number" class="form-control" name="amount" required>   
        <br><br>
        <div class="text-right" class="col-lg-6 col-md-6 col-12">
            <button class="button button-hover" class="btn mt-3" name="submit" type="submit" id="myBtn">Transfer</button>
        </div>
        <?php
            }else{
        ?>
        <div>
            <h5><br><b>Note: Amount has been already paid by the borrower. Hence, transaction is not needed.</b></h5>
        </div> 
        <div class="text-right" class="col-lg-6 col-md-6 col-12">
            <button class="button" class="btn mt-3"><a href="borrowertotransfer.php" class="text-dark">Borrower list</a></button>
        </div>
        <?php        
            }
        ?>  
        </form>
    </div>
<br>
<footer>
  <p class="p-3 bg-dark text-white text-center">@BorrowerTracker <a href="lendingRules.php#feedback" class="text-light">Feedback Time</a></p>
  <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
