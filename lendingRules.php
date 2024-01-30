<?php
include 'elements/dbconnect.php';
session_start();
$uid =  $_SESSION['UId'];
if(isset($_POST['submit']))
{
  $uName = $_POST['fullName']; 
  $uMail = $_POST['Email']; 
  $message = $_POST['Message'];
  $sql = "INSERT INTO `feedback`(`User_Id`, `User_Name`, `User_Mail`, `Message`) 
  VALUES ('$uid','$uName','$uMail','$message')";
  $result = mysqli_query($con,$sql);
  if($result)
  {
    echo "<script> alert('Your feedback is successfully sent!!');
    </script>";  
  }else{
    echo "<script> alert('Feedback couldn't sent error occured.'".mysqli_error($con).");
    </script>"; 
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Lending Rules</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
  height: 100%;
  color: #777;
  line-height: 1.8;
}
.a:hover{
  text-decoration: none;
  color: black;
}

/* Create a Parallax Effect */
.bgimg-1{
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* First image (Logo. Full height) */
.bgimg-1 {
  background-image: url('images/budget.png');
  min-height: 50%;
}

/* Second image (Portfolio) */
/* .bgimg-2 {
  background-image: url("/w3images/parallax2.jpg");
  min-height: 400px;
} */

.w3-wide {letter-spacing: 10px;}
/* .w3-hover-opacity {cursor: pointer;} */

/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1600px) {
    .bgimg-1{
    background-attachment: scroll;
    min-height: 500px;
  }
}
</style>
</head>
<body>

<!-- Navbar (sit on top) -->
<?php include 'elements/nav.php'; ?>

<!-- First Parallax Image with Logo Text -->
<section>
<div class="bgimg-1 w3-display-container" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
    <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide">MY <span class="w3-hide-small">WEBSITE</span></span>
  </div>
</div>
</section>

<!-- Container (About Section) -->
<section>
<div class="w3-content w3-container w3-padding-64" id="rules">
  <h3 class="w3-center">Lending Rules</h3>
  <p class="w3-center"><em>Rules to follow while lending money</em></p>
  <p align="justify"><b>Secluded or isolated lending transactions:</b> There has to be a continuous lending activity with profit motive to constitute a business of money-lending. If this condition is satisfied, the money lender has to obtain a valid license to carry on such business. Therefore, providing one-time loans with no intention to carry on the business of lending money, will not trigger the requirement of adhering to the money lending laws.</p>
  <p align="justify"><b>Inter-corporate deposits:</b> The intention of a company giving an Inter-corporate Deposit (ICD) is not to engage in a money-lending transaction but to earn a surplus on the idle funds available with them. Therefore, the money-lending transactions shall not include ICD and companies shall not be required to obtain a license for undertaking such transactions.</p>
  <p align="justify"><b>Parking of money:</b> Parking of or investing idle funds in fixed deposits with Banks is in the nature of investments to earn a surplus on idle funds. Further, since regulation of banking and financial corporations is a matter of List I (i.e. Union List) of the Seventh Schedule to the Constitution of India, Section 2(13)(h) of the Money Lending Act explicitly states that “a loan shall not include a loan to, or by, a bank”, thereby excluding Banks from its purview.</p>

  <div class="w3-row">
    <div class="w3-col m6 w3-center w3-padding-small">
      <img src="images/rules.jpg" class="w3-round w3-image" width="400" height="200">
    </div>
    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-hide-small w3-padding-large">
      <p align="justify"><b>Loans by Non-banking Financial Companies:</b> In case a company lends in multiple states,  it will have to adhere to provisions under the money lending laws of each such State. Consequences mentioned in <b>Section 39 of the Money Lending Act</b> states that whoever carries on the business of money-lending without obtaining a valid licence, shall be punished with:
        <li>imprisonment for a term which may extend to 5 years; or </li>
        <li>with fine which may extend to Rs.50,000; or </li>
        <li>with both.</li>
      </p>
      <p>For more Information: Please click <a href="https://indiankanoon.org/search/?formInput=money%20lending">here</a></p>
    </div>
</div>
</section>

<!-- Container (Feedback Section) -->
<section>
<div class="w3-content w3-container w3-padding-50" id="feedback">
  <h3 class="w3-center">Feedback Time</h3>
  <p class="w3-center"><em>I'd love your feedback!</em></p>
  <div class="w3-row w3-padding-25 w3-section">
    <div class="w3-col m4 w3-container">
    <img src="images/feedback.gif" class="w3-image w3-round" style="width:100%">
    </div>
    <div class="w3-col m8 w3-panel">
      <p>Swing by for your use <i class="fa fa-coffee"></i>, or leave a feedback:</p>
      <form method="post">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" name="fullName" value="<?php echo $_SESSION['FName']?>" readonly>
          </div>
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" name="Email" value="<?php echo $_SESSION['uMail']?>" required>
          </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Type your feedback." name="Message" autocomplete="off" required > 
        <button class="w3-button w3-black w3-right w3-section" type="submit" name="submit">
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>

        <button class="w3-button w3-black w3-left w3-section">
          <i class="fa fa-search"></i> Know about<a href="sipCalculate.php" class="a a-hover"> SIP
        </a></button>
      </form>
    </div>
  </div>
</div>
</section>
<!-- Footer w3-opacity w3-hover-opacity-off-->
<footer class="w3-center w3-black w3-padding-64 ">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <p class="text-white text-center">@BorrowerTracker</p>
  <p class="text-white text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
</footer>
</body>
</html>
