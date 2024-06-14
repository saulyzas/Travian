<?php
	include("PayPalInfo.php");
    $con = mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
	mysql_select_db(SQL_DB, $con);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	else
	{
		echo('Connected');
	}
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	ini_set('log_errors', true);
	ini_set('error_log', 'ipn_errors.log');
	include('ipnlistener.php');
    echo 'hi';
	$listener = new IpnListener();

	try
	{
		$listener->requirePostMethod();
		$verified = $listener->processIpn();
	}
	catch(Exception $e)
	{
		error_log($e->getMessage());
		exit(0);
	}

	if($verified)
	{
		$payment_amount = $listener->getPaymentAmount();
		$email = $listener->getEmail();
        $gold_amount = $listener->getPackage();
        $username = $listener->getUserName();
        //$addgold = "UPDATE s1_users SET gold = 1 WHERE email = '$email'";
        $addgold = "UPDATE s1_users SET gold = gold + $gold_amount WHERE username = '$username'";	
		$result = mysql_query($addgold);
        mail("asher940@gmail.com", "Maxim got more money ffs", "Maxim cpt.fgt got $payment_amount ffs...");
	}
	else
	{
		die("Lox");
	}
?>
