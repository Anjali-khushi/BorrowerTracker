<?php

$monthInvest = $_POST['monthInvest'];
$annRate = $_POST['expRate'];
$monthRate =$annRate/12/100;
$timeYear = $_POST['timeYear'];
$months= $timeYear *12;
$futureValue=0;
$futureValue=$monthInvest*((pow(1+$monthRate,$months)-1)/$monthRate)*(1+$monthRate);

$invest_Amt=$monthInvest*12*$timeYear;
$est_Rate=$futureValue-$invest_Amt;
$data=array(
    "invest_Amt"=>$invest_Amt,
    "est_Rate"=>$est_Rate,
    "total_Value"=>$futureValue
);

echo json_encode($data);

?>