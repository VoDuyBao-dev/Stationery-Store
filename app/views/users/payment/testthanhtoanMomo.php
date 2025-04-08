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
    action="<?php echo _WEB_ROOT . '/MomoPaymentProcessing/processPayment_QRCode'; ?>">
<input type="submit" name="momo" value="thanh toán momo QR code"/>
</form>

<form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
    action="<?php echo _WEB_ROOT . '/MomoPaymentProcessing/processPayment_ATM'; ?>">
<input type="submit" name="momo" value="thanh toán momo ATM"/>
</form>

</body>
</html>