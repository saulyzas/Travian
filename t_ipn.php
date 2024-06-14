<?php
include("GameEngine/config.php");
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
mysql_select_db(DB_NAME, $con);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$username = $_POST['custom'];
$p = mysql_query("SELECT * FROM shop_users WHERE email = '".$receiver_email."'");
$pp = mysql_fetch_array($p);
/*
$price1 = $pp['cost_1key'];
$price2 = $pp['cost_2key'];
$price3 = $pp['cost_3key'];
$price4 = $pp['cost_4key'];
$price5 = $pp['cost_5key'];
*/
if (!$fp) {
// HTTP ERROR
} else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
	$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0) {
					
					if($payment_amount === $price1){
                                        $amout = $p1;
                                        echo "Thanks you for purchasing ".$p1." Gold!";
					}
                                        else if($payment_amount === $price2){
                                        $amout = $p2;
                                        echo "Thanks you for purchasing ".$p2." Gold!";
					}
                                        else if($payment_amount === $price3){
                                        $amout = $p3;
                                        echo "Thanks you for purchasing ".$p3." Gold!";
					}
                                        else if($payment_amount === $price4){
                                        $amout = $p4;
                                        echo "Thanks you for purchasing ".$p4." Gold!";
                    }else{
						die("ERROR: Unknown package");
					}
                                        //$result = mysql_query("SELECT * FROM `shop_keys` WHERE email = '$receiver_email' LIMIT $keystoreturn");                          
                                        $result = mysql_query("UPDATE s1_users SET gold = gold + '$amout' WHERE username = '$username'");	
					}
										
			else if (strcmp ($res, "INVALID") == 0) {
				die("lox");
		}
fclose ($fp);
}
?>