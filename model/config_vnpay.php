<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_TmnCode = "WG6RCT6R";
$vnp_HashSecret = "EMNBSNLHGWLGFOQXDXZZQGNONOSETZZF";
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));