<?php 
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!== true){
  header("location: login.php");
  exit;
}
?> 
<!DOCTYPE html>
<html>
<head>	
	<title>Borrower Tracker</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,300&display=swap" rel="stylesheet">  
    <style>
    button{
        padding: 9px.25px;
        background-color: rgba(0, 136, 169, 1.0);
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease 0s;
      }
    button:hover{
        background-color: rgba(0, 136, 169, 0.8);
      }
    </style>
</head>

<body>
<!-- <?php //echo " Register ID here: ".$_SESSION['UId']; ?> -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Welcome! <?php echo $_SESSION['user'];?> BorrowerTracker</a>
  <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="displayAccount.php">Bank Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#oser">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>   

<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/transfer1.jpg" alt="Los Angeles" width="1050" height="390">
      <div class="carousel-caption">
        <h3>Track your Lendings</h3>
        <p>Easy to use with any device!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="images/transfer2.jpg" alt="Chicago" width="1050" height="390">
      <div class="carousel-caption">
        <h3>Digitalization</h3>
        <p>Keep's us growing!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="images/transfer3.jpg" alt="New York" width="1050" height="390">
      <div class="carousel-caption">
        <h3>Help's you to Earn Profit</h3>
        <p>Your trust keeps us going!</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<section class="my-3">
	<div class="py-4">
		<h2 class="text-center"><b>About the website</b></h2>
	</div>
 <div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-12">
             <img src="images/giphy.webp" class="img-fluid aboutimg">
		</div>
    <div class="col-lg-6 col-md-6 col-12">
             <h2>Borrower Tracker</h2>
             <p >It helps to automate the interest related money lending process with computerized technology and establishes a site that is applicable to users who can be running a small business or whose main profession is of money lending. In the following ways, it benefits the current system:</p>
             <p ><li>Users who usually lend money on interest basis can now get a system that can easily provide calculation for them and improve the current lending framework.</li></p>
             <p ><li>To aware lenders regarding latest legal rules and regulation of money lending and helps to earn profit by legal means.</li></p>
             <p ><li> It comes with GUI interface which makes your transaction easier. </li></p>
             <a href="contactdetail.php" class="btn btn-success" > Check More </a>
    </div>
	</div>
 </div>
</section>
<section class="my-3">
  <div class="py-4">
    <h2 id="oser" class="text-center" ><b>Our Services</b></h2>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4 py-2 py-sm-3">
        <div class="card" >
          <img class="card-img-top" src="images/users.png" alt="..." >
          <div class="card-body" >
            <h4 class="card-title">Borrower List</h4>
            <p class="card-text">You can add,view and update the details of your borrower. And also update the amount when money received.</p>
            <a href="borrowertotransfer.php" class="btn btn-success">Borrower Edit</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4 py-2 py-sm-3">
        <div class="card" >
          <img class="card-img-top" src="images/tran.jpg" alt="..."  >
          <div class="card-body">
            <h4 class="card-title">Know About SIP</h4>
            <p class="card-text">Systematic Investment Plans is a way of investing in Mutual Funds that help inculcate financial discipline and build wealth for the future. </p>
            <a href="sipCalculate.php" class="btn btn-success">More about SIP</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4 py-2 py-sm-3">
        <div class="card" >
          <img class="card-img-top" src="images/hist.png" alt="..."  >
          <div class="card-body">
            <h4 class="card-title">Payment History</h4>
            <p class="card-text">It consist of all transactions done from your account either credit or debit. The moment you insert borrower detail entry is made.</p>
            <a href="transhistory.php" class="btn btn-success">Show history</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer>
  <p class="p-3 bg-dark text-white text-center">@BorrowerTracker <a href="lendingRules.php#feedback" class="text-light">Feedback Time</a></p>
  <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
</footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

