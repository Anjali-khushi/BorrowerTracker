<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <style text/css>
    .button {
    background-color: #87cefa;
    color: black;
    border: 2px solid grey;
    border-radius: 1.2px;
    cursor: pointer;
    transition: all 0.3s ease 0s;
    padding: 8px 30px;   /* button lenght and width */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    }
    </style>
  </head>
<body>
<?php include 'elements/nav.php'; 
session_start();
// echo " Register ID here: ".$_SESSION['UId'];
?>
<div class="container">
  <button class="btn btn-primary my-4">
    <a href="accountDetail.php" class="text-light">Add Bank Account</a>
  </button>
  <h3 class="text-center"><b>Account Details</b></h3>
  <br>
  <div class="table-responsive-sm">
    <table id="t01" class="table table-striped table-condensed table-bordered">
      <thead>
        <tr class="table-info" align="center">
          <th scope="col">Account Count</th>
          <th scope="col">User ID</th>
          <th scope="col">Branch Name</th>
          <th scope="col">Account Limit</th>
          <th scope="col">Amount Remain</th>
          <th scope="col">Operation</th>
        </tr>
      </thead>
      
      <tbody>
        <?php
        include 'elements/dbconnect.php';
        // if(isset($_GET['UId'])){
          $id = $_SESSION['UId'];
          $sql = "Select AccountCount,R_Id,AccountBranch,AccountLimit,Re_Amt From accountdetail where R_Id=$id";
          $result = mysqli_query($con,$sql);
          if(mysqli_num_rows($result)>0)
          { 
            while($row = mysqli_fetch_assoc($result))
            { 
              // $id = $row['Acc_Id'];        //class="table-warning"   
              echo '<tr align="center">        
              <th scope="row">'.$row['AccountCount'].'</th>       
              <td>'.$row['R_Id'].'</td>       
              <td>'.$row['AccountBranch'].'</td>        
              <td>'.$row['AccountLimit'].'</td>
              <td>'.$row['Re_Amt'].'</td>
              <td>
              <button class="btn btn-primary"><a href="bankAccount/updateAccount.php?updatedAcc='.$row['AccountCount'].'" class="text-light">Update</a></button>
              <button class="btn btn-danger"><a href="bankAccount/deleteAccount.php?deletedAcc='.$row['AccountCount'].'" class="text-light">Delete</a></button>
              </td>
              </tr>';
            }
          }
        // }
        ?>  
        </tbody>
      </table>
    </div>  
    <div  class="text-right" class="col-auto col-lg-6 col-md-6 col-sm-4">
      <a href="lendingRules.php#rules" class="button">Lending Rules</a>
    </div><br>
</div>
    
<footer>
  <p class="p-3 bg-dark text-white text-center">@BorrowerTracker <a href="lendingRules.php#feedback" class="text-light">Feedback Time</a></p>
  <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
</footer>
</body>
</html>