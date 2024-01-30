<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  include 'elements/dbconnect.php';
  $Name = $_POST["fullName"];
  $eMail = $_POST["eMail"];
  $pNum = $_POST["pNum"];
  $userName = $_POST["uName"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $exists = false;
  if(($password == $cpassword) && $exists == false){
    $sql = "INSERT INTO `users` (`Full_Name`, `uName`, `password`, `Phone_Num`, `Email`, `Date`) VALUES ('$Name', '$userName', '$password', '$pNum', '$eMail', current_timestamp())";
    $result = mysqli_query($con, $sql);
    if($result)
    {
      $showAlert = true;
    }
  }
  else{
    $showError = " Password Do not match";
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
  </head>
  <style>
  .container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center
   }
   img {
    max-width: 95%;
    max-height:95%;
   }
   .text {
    font-size: 20px;
    padding-left: 25px;
   }
  </style>
  <body>
  <nav class="navbar navbar-expand-lg" style="background-color: #ba94e0;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>Borrower Tracker</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <a href="/BT/login.php" class="btn btn-outline-light">Login User</a>
    </div>
  </div>
</nav>

    <?php
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Account is successfully created.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>'. $showError .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <h2 class= "text-center"><br>Sign Up!</h2>
    <div class= "container">  
      <div class="image">
        <img src="images/checklist1.jpg"><br><br>
      </div>
      <div class ="text">
        <form action="/BT/register.php" method="post">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name *</label>
                <input type="text" class="form-control" id="fullName" name= "fullName" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="eMail" class="form-label">E-Mail ID</label>
                <input type="email" class="form-control" id="eMail" name= "eMail" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="pNum" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="pNum" name= "pNum" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="uName" class="form-label">User Name *</label>
                <input type="text" class="form-control" id="uName" name= "uName" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password *</label>
                <input type="password" class="form-control" id="password" name= "password" required>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password *</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" aria-describedby="CPass" required>
                <small id="CPass" class="form-text text-muted">Make sure you type the same password</small>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>  
    </div>
    <footer><br>
      <p class="p-1 text-dark text-center" style="background-color: #ba94e0;">@BorrowerTracker<br>&copy 2023. Made by <b>Anjali</b> <br>For the Project of <b>MCA First year Semester II</b></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>