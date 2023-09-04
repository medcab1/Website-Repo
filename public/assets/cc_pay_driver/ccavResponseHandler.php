<?php include('Crypto.php')?>
<?php

	error_reporting(0);
	
	$workingKey='713B0F5F080E4302A5DBCA80C6514B0A';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	// echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	
	$status = '';
	$msg = '';
	if($order_status==="Success")
	{
		// echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		$status = 'S';
		$msg = 'Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.';

		
	}
	else if($order_status==="Aborted")
	{
		// echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
		$status = 'F';
		$msg = 'Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail';

		
	}
	else if($order_status==="Failure")
	{
		// echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
		$status = 'F';
		$msg = 'Thank you for shopping with us.However,the transaction has been declined.';

	}
	else
	{
		// echo "<br>Security Error. Illegal access detected";
		$status = 'F';
		$msg = 'Security Error. Illegal access detected';

	
	}

	

	$buket = [];
 	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	// echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	 	$valuiea = $information[0];
		$add_array[$valuiea] = $information[1];
	}
	array_push($buket,$add_array);
	 

	$array = array(
		"result" => 'S',
		"status"=>'1',
		"Message"=>'Success', 
		"JSONData"=>$buket, 
	);
	
	header('Content-Type: application/json');
 	$jsonData = json_encode($array,JSON_UNESCAPED_SLASHES);
 	echo $jsonData; 

	 
?>
