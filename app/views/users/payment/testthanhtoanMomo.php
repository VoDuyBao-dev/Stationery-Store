<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
    action="<?php echo _WEB_ROOT . '/MomoPaymentProcessing/confirmMomo_QR'; ?>">
<input type="submit" name="payUrl" value="thanh toán tesst trang"/>
</form>





<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
    action="<?php echo _WEB_ROOT . '/MomoPaymentProcessing/PayMomo_ATM'; ?>">
<input type="submit" name="payUrl" value="thanh toán momo ATM"/>
</form>
<?php if(isset($_SESSION['testData_IPNmomo'])){
   $test = $_SESSION['testData_IPNmomo'];
   unset($_SESSION['testData_IPNmomo']);
   
   echo "$test";
}else{
    echo "No";
} ;?>


   





</body>
</html>