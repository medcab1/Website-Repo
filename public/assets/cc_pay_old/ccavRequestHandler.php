<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	error_reporting(1);
	
	$merchant_data='2';

	$working_key='713B0F5F080E4302A5DBCA80C6514B0A';//Shared by CCAVENUES
	$access_code='AVWU77KF78BE31UWEB';//Shared by CCAVENUES

	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	// echo "<pre/>";
	// // print_r($merchant_data);
	// // exit();
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

