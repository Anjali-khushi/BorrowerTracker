<?php
// include 'elements/dbconnect.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'elements/nav.php'; ?>

<section>
<div class="w3-content w3-container w3-padding-55" id="rules">
  <h3 class="w3-center">About SIP</h3>
  <p class="w3-center"><em><b>What is it? How does it work? Benefits? Calculate SIP.</b></em></p>
  <p align="justify"><b>What is SIP? </b>Systematic Investment Plan or SIP is a method of investing in mutual funds wherein an investor chooses a mutual fund scheme and invests the fixed amount of his choice at fixed intervals.
  SIP investment plan is about investing a small amount over time rather than investing one-time huge amount resulting in a higher return.</p>
  <p align="justify"><b>How does it work? </b>Once you apply for one or more SIP plans, the amount is automatically debited from your bank account and invested in the mutual funds you have purchased at the predetermined time interval. 
  At the end of the day, you will be allocated the units of mutual funds depending on the Net Asset Value of the mutual fund.
With every investment in an SIP plan in India, the additional units are added to your account depending on the market rate. With every investment, the amount being reinvested is larger and so is the return on those investments.
</p>

  <div class="w3-row">
    <div class="w3-col m6 w3-center w3-padding-small">
      <img src="images/feedback1.png" class="w3-round w3-image" width="500" height="340">
    </div>
    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-hide-small w3-padding-large">
      <p align="justify"><b>Benefits of Investing in SIP: </b> 
      <li align="justify"><b>Makes You a Disciplined Investor-</b> SIP can be the best investment option for you if you do not possess superior financial knowledge about the way the market moves.
          With SIP since the money gets auto-deducted from your account and goes to your mutual funds, you can sit back and relax. </li>
        <li align="justify"><b>Rupee Cost Averaging Factor-</b> With SIP since your investment amount is constant, for a longer period of time, with rupee cost averaging you can take advantage of market volatility.</li>
        <li align="justify"><b>Power Of Compounding-</b> SIP is a disciplined way of investing and ensures you constantly strive to make your investments grow.</li>
      </p>
      <p>For more Information: Please refer to <a href="https://groww.in/p/sip-systematic-investment-plan">Groww</a> or <a href="https://cred.club/calculators/sip-calculator">Cred</a> a fast growing scope in investment field.</p>
    </div>
</div>
<p><b>Calculate SIP:</b> A SIP plan calculator works on the following formula –

<br> <p  class="w3-center">M = P × ({[1 + i]^n – 1} / i) × (1 + i).</p>

In the above formula –
<li><b>M</b>: is the amount you receive upon maturity.</li>
<li><b>P</b>: is the amount you invest at regular intervals.</li>
<li><b>n</b>: is the number of payments you have made.</li>
<li><b>i</b>: is the periodic rate of interest.</li>

Take for example you want to invest Rs. 1,000 per month for 12 months at a periodic rate of interest of 12%.
then the monthly rate of return will be 12%/12 = 1/100=0.01
Hence, M = 1,000X ({[1 +0.01 ]^{12} – 1} / 0.01) x (1 + 0.01)
which gives Rs 12,809 Rs approximately in a year.
</p>


<div class="container my-4">
    <form method="post">
      <!-- <form oninput="result.value=parseInt(monthInvest.value)*({[1+ (parseInt(expRate.value)/100)*1/parseInt(timeMonth.value)]^{parseInt(timeMonth.value)} -1}/(parseInt(expRate.value)/100)*1/parseInt(timeMonth.value))*(1+ (parseInt(expRate.value)/100)*1/parseInt(timeMonth.value))"> -->
        <div class="mb-3">
            <label class="form-label"><b>Full Name</b></label>
            <input type="text" class="form-control" name="fullName" value="<?php echo $_SESSION['FName'];?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label"><b>User Name</b></label>
            <input type="text" class="form-control" name="userName" value="<?php echo $_SESSION['user'];?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label"><b>Monthly Investment in Rs</b></label>
            <input type="number" class="form-control" name="monthInvest" id="monthInvest" value="0" autocomplete="off" required>
            <medium class="form-text text-muted">How much money you want to invest on monthly basis?</medium>
          </div>
        <div class="mb-3">
            <label  class="form-label"><b>Expected Return Rate (p.a) in %</b></label>
            <input type="number" class="form-control" name="expRate" id="expRate" value="0" autocomplete="off" required>
            <medium class="form-text text-muted">Expected rate of interest on yearly basis. Write only number no percentage sign.</medium>
          </div>
        <div class="mb-3">
            <label  class="form-label"><b>Time Period on yearly basis</b></label>
            <input type="number" class="form-control" name="timeYear" id="timeYear" value="0" autocomplete="off" required>
            <medium class="form-text text-muted">For how many years are you planning to invenst?</medium>
          </div>
          <!-- <output name="result" for="monthInvest expRate timeMonth">0</output> -->
          <!-- <input type="submit"  -->
        <button type="button" id="btnCal" class="btn btn-primary"><a href="sipMysql.php" class="text-light">Calculate</a></button>
    </form>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Invested Amount</th>
          <th>&#8377;<span id="printInvest">0</span></th>
        </tr>
        <tr>
          <th>Est Returns</th>
          <th>&#8377;<span id="printEstReturns">0</span></th>
        </tr>
        <tr>
          <th>Total Value</th>
          <th>&#8377;<span id="printTotalValue">0</span></th>
        </tr>
      </table>
    </div>

</div>
</section>

<footer>
  <p class="p-3 bg-dark text-white text-center">@BorrowerTracker <a href="lendingRules.php#feedback" class="text-light">Feedback Time</a></p>
  <p class="p-1 text-dark text-center">&copy 2023. Made by <b>Anjali</b> <br> For the Project of  <b>MCA First year Semester II</b></p>
</footer>

<script>
var printInvest = document.getElementById('printInvest');
var printEstReturns = document.getElementById('printEstReturns');
var printTotalValue = document.getElementById('printTotalValue');
var btnCal = document.getElementById('btnCal');
btnCal.addEventListener('click',()=>{
  var monthInvest = document.getElementById('monthInvest').value;
  var expRate = document.getElementById('expRate').value;
  var timeYear = document.getElementById('timeYear').value;
  $.ajax({
    url:"siplogic.php",
    method:"post",
    data:{monthInvest:monthInvest,expRate:expRate,timeYear:timeYear},
    success:function(data){
      data=JSON.parse(data);
      printInvest.innerHTML=parseInt(data.invest_Amt);
      printEstReturns.innerHTML=parseInt(data.est_Rate);
      printTotalValue.innerHTML=parseInt(data.total_Value);
    }
  })
})

</script>
</body>
</html> 
