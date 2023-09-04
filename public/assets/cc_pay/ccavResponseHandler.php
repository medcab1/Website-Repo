<?php include('Crypto.php')?>
<?php

	error_reporting(0);
	
	$workingKey='713B0F5F080E4302A5DBCA80C6514B0A';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";
$dd=[];

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		$dd[$information[0]]=$information[1];

		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{
		
		// Create a new cURL resource
		$curl = curl_init();

		// Set the URL
		$url = "https://appdata.medcab.in/api/app_data/consumer_app/payment/booking_payment";
		curl_setopt($curl, CURLOPT_URL, $url);

		// Set the request method to POST
		curl_setopt($curl, CURLOPT_POST, true);

		// Set the request body
		$data = array(
			"consumer_id"=>$dd['consumer_id'],
			"booking_id"=>$dd['booking_id'],
			"transaction_id"=>$dd['tracking_id'],
			"transaction_amount"=>$dd['mer_amount'],
			"transaction_status"=>$dd['order_status'],
			"transaction_time"=>$dd['trans_date'],
		);
		$body = json_encode($data);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

		// Set the headers
		$headers = array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($body)
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		// Return the response instead of printing it
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// Execute the cURL request
		$response = curl_exec($curl);
		$resposedata=json_decode($response,true);
		// Check for errors
		if(curl_errno($curl)) {
			$error_message = curl_error($curl);
			// Handle the error appropriately
		}

		curl_close($curl);
		echo "<script>alert('Thank you for shopping with us. Your credit card has been charged and your transaction is successful.');</script>";
		if($resposedata['status']==0) {
			header("location:https://medcab.in/driver/driver-assigned/.$dd['consumer_id']");
		}
		echo "<br> We will be shipping your order to you soon.";
		
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	
	}

	echo "<br><br>";

	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	}

	echo "</table><br>";
	echo "</center>";
?>
