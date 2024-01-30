<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  include 'elements/dbconnect.php';
  $userName = $_POST["uName"];
  $password = $_POST["password"];
  $sql = "Select * from users where uName ='$userName' AND password ='$password'";
  $result = mysqli_query($con, $sql);
  $fname = mysqli_fetch_assoc($result);
  $num = mysqli_num_rows($result);
  if($userName ==""||$password==""){
    $showError = " User-name or password can not be blank!!";
  }
  elseif($num == 1){
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['FName'] = $fname['Full_Name'];
    $sql2 = "Select Serial_No,Email from users where uName ='$userName' AND password ='$password'";
    $result2 = mysqli_query($con, $sql2);
    $uid = mysqli_fetch_assoc($result2);
    $_SESSION['UId'] = $uid['Serial_No'];
    $_SESSION['user'] = $userName;
    $_SESSION['uMail'] = $uid['Email'];
    header("location: home.php");
  }
  else{
    $showError = " Invalid Credentials!!";
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
<style>
  .container {
    display: flex;
    align-items: center;
    justify-content: center
   }
   img {
    max-width: 100%;
    max-height:100%;
   }
   .text {
    font-size: 20px;
    padding-left: 25px;
   }
</style>
  <body>
  <nav class="navbar navbar-expand-lg" style="background-color: #8ec8f5;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Borrower Tracker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
      <a href="/BT/register.php" class="btn btn-outline-light">Register User</a>
    </div>
   </div>
  </nav>

    <?php
    if($login){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Login is successful.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>'. $showError .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    
    <h2 class= "text-center"><br><br>Sign In!</h2>
    <div class= "container">
        <div class="image">
            <img src="images/budget1.jpg"><br><br>
        </div>
        <div class ="text">
        <form action="/BT/login.php" method="post">
            <div class="mb-3">
                <label for="uName" class="form-label">User Name</label>
                <input type="text" class="form-control" id="uName" name= "uName">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name= "password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
    </div>
    <footer><br>
      <p class="p-1 text-dark text-center" style="background-color: #8ec8f5;">@BorrowerTracker<br>&copy 2023. Made by <b>Anjali</b> <br>For the Project of <b>MCA First year Semester II</b></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>