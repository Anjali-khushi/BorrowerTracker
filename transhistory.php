<?php include 'elements/dbconnect.php';
session_start();
$uid = $_SESSION['UId'];
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <style text/css>
    .table {
    letter-spacing: 1.2px;
    border-collapse: collapse; 
    }
    .button {
    background-color: #87cefa;
    color: black;
    border: 2px solid grey;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease 0s;
    padding: 8px 30px;   /* button lenght and width */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    }
    .button:hover{
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    background-color: deepskyblue;
    text-decoration: none;
    color: white;
    }
    #t01 tr:nth-child(odd) {
    width: 100%;
    background-color: #dbf0fe;
    }
    #t01 tr:nth-child(even) {
    width: 100%;
    background-color: #e7f5fe;
    } 
    </style>
</head>

<body>

<?php
  include 'elements/nav.php';
?>

    <div class="container">
        <h2 class="text-center pt-4"><b>Transaction History</b></h2>
        
       <br>
       <div class="table-responsive-sm">
    <table id="t01" class="table table-striped table-condensed table-bordered">
        <thead>
            <tr class="table-info">
                <th class="text-center">S.No.</th>
                <th class="text-center">Borrower Id</th>
                <th class="text-center">Transaction Id</th>
                <th class="text-center">Account Name</th>
                <th class="text-center">Date</th>
                <th class="text-center">Credit/Debit</th>
                <th class="text-center">Amount</th>
            </tr>
        </thead>
        <tbody>
        
        <?php
            $sql ="select * from paymenthistory where R_Id=$uid";
            $query =mysqli_query($con, $sql);
            // $rows = mysqli_fetch_assoc($query);
            // $count = count($rows);
            // echo $count;
            $i = 0;
            while($rows = mysqli_fetch_assoc($query))
            {
        ?>
            <tr>
            <td class="py-2"><?php echo $i+=1; ?></td>
            <td class="py-2"><?php echo $rows['B_Id']; ?></td>
            <td class="py-2"><?php echo $rows['Transaction_Id']; ?></td>
            <td class="py-2"><?php echo $rows['AccountBranch']; ?> </td>
            <td class="py-2"><?php echo $rows['Date']; ?> </td> 
            <td class="py-2"><?php echo $rows['Status']; ?> </td>
            <td class="py-2"><?php echo $rows['AmtPaid']; ?> </td> 
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
    <div  class="text-right" class="col-auto col-lg-6 col-md-6 col-sm-4">
    <a href="borrowertotransfer.php" class="button">View List</a>
    </div>
    <br>
</div>

<footer>
  <p class="p-3 bg-dark text-white text-center">@BorrowerTracker <a href="lendingRules.php#feedback" class="text-light">Feedback Time</a></p>
  <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>