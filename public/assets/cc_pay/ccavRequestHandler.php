
<?php include('Crypto.php')?>
<?php 


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData);
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    $errorMessage = json_last_error_msg();
    echo "JSON decoding error: $errorMessage";
} else {
//    var_dump($data);
}

 	error_reporting(1);
	
	$tid=$data->tid;
	$orderId=$data->orderId;
	$amount=$data->amount;
	$redirectUrl=$data->redirectUrl;
	$cancelUrl=$data->cancelUrl;
	$merchant_data='2';
	$currency='INR';
	$marchant_id='2566639';
	$working_key='713B0F5F080E4302A5DBCA80C6514B0A';//Shared by CCAVENUES
	$access_code='AVWU77KF78BE31UWEB';//Shared by CCAVENUES

	$merchant_data.='tid='.$tid;
 	$merchant_data.='&marchant_id='.$marchant_id;
	$merchant_data.='&currency='.$currency;
	$merchant_data.='&orderId='.$orderId;
	$merchant_data.='&amount='.$amount;
	$merchant_data.='&redirectUrl='.$redirectUrl;
	$merchant_data.='&cancelUrl='.$cancelUrl.'&'; 

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	// echo "<pre/>";
	// print_r($merchant_data);	

	$array = array(
		"encrypted_data" => $encrypted_data,
		"access_code"=>$access_code,
		"status"=>'S',
		"message"=>'Success',
		"order_id"=>$orderId,
		"redirect_url"=>$redirectUrl,
		"cancel_url"=>$cancelUrl,
		"marchant_data"=>$merchant_data,
	);
	
	header('Content-Type: application/json');
 	$jsonData = json_encode($array,JSON_UNESCAPED_SLASHES);
 	echo $jsonData; 

?>
 
 

