<?php session_start();?>
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
	if($dd['merchant_param4']==0){	
		$url = "https://medcab.in/api/consumer/payment/booking_payment";
	}
	else if($dd['merchant_param4']==1){
		$url = "https://medcab.in/api/consumer/payment/booking_pending_payment";
	}
	else{
		$url = "https://medcab.in/api/consumer/payment/booking_pending_payment";
	}
	if($order_status==="Success")
	{
		if($dd['merchant_param4']==0){	
			$url = "https://medcab.in/api/consumer/payment/booking_payment";
		}
		else if($dd['merchant_param4']==1){
			$url = "https://medcab.in/api/consumer/payment/booking_pending_payment";
		}
		else{
			$url = "https://medcab.in/api/consumer/payment/booking_pending_payment";
		}
		// Create a new cURL resource
		$curl = curl_init();

		// Set the URL
		// $url = "https://appdata.medcab.in/api/app_data/consumer_app/payment/booking_pending_payment";
		curl_setopt($curl, CURLOPT_URL, $url);

		// Set the request method to POST
		curl_setopt($curl, CURLOPT_POST, true);

		// Set the request body
		$data = array(
			"consumer_id"=>$dd['merchant_param1'],
			"enquary_id"=>$dd['merchant_param2'],
			"transection_id"=>$dd['tracking_id'],
			'order_id'=>$dd['order_id'],
			"transfer_amount"=>$dd['mer_amount'],
			"order_status"=>$dd['order_status'],
			"time"=>$dd['trans_date'],
			"bank_ref_no"=>$dd['bank_ref_no'],
			"payment_mode"=>$dd['payment_mode'],
			"payment_mobile"=>$dd['billing_tel'],

		);
		
		// print_r($decryptValues);
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
		print_r($resposedata);

		curl_close($curl);
		
		echo "<script>alert('Thank you for shopping with us. Your credit card has been charged and your transaction is successful.');</script>";
		
		if($resposedata['status']==0) {
			if($dd['merchant_param4']==0){	
				header("location:https://medcab.in/payment_done/".$dd['merchant_param2']);	

			}
			else if($dd['merchant_param4']==1){
				header("location:https://medcab.in/driver/driver-assigned/".$dd['merchant_param2']);	

			}
			else if($dd['merchant_param4']==2){
				// header("location:".$dd['merchant_param3']);	
				header("location:https://medcab.in/driver/driver-assigned/".$dd['merchant_param2']);	

			}
			else{
				echo "Page not found";
			}
			// header("location:https://medcab.in/driver/driver-assigned/".$dd['consumer_id']);
		}
		else{
		echo "<br> We will be shipping your order to you soon.";

		}
		
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		header("location:".$url.$dd['merchant_param2']);	
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

<script>
window.onload=function(){
	var status=document.getElementById('status').getAttribute('status');
	var url=document.getElementById('status').value;
	alert()
	if(status==0){
		alert(status);
		window.location.replace(url);
	}

}

</script>
