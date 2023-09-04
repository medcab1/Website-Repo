
<?php include('Crypto.php')?>
<?php 

	error_reporting(1);
	
	$merchant_data='2';
	$working_key='713B0F5F080E4302A5DBCA80C6514B0A';//Shared by CCAVENUES
	$access_code='AVWU77KF78BE31UWEB';//Shared by CCAVENUES

	$jsonData = file_get_contents('php://input');
	$data = json_decode($jsonData);

	$order_id = (string) $data->orderId;
	$tid = (string) $data->tid;
	$amount = (string) $data->amount;
	$name = (string) $data->name;
	$mobile_no = (string) $data->mobile_no; 
	$merchant_param1 = (string) $data->marchant_param1;  
	$merchant_param2 = (string) $data->marchant_param2; 
	$address = '3rd floor, Rajsha Tower, Vibhuti Khand, Gomti Nagar';
	$zibcode = '226010';
	$city = 'Lucknow';
	$state = 'Uttar Pradesh';
	$country = 'India';
	$email = 'billing@medcab.com';
	
	// print_r($data); exit();
	// foreach ($_POST as $key => $value){
	// 	$merchant_data.=$key.'='.$value.'&';
	// }
	
	$merchant_data.='2tid='.$data->tid.'&';
	$merchant_data.='merchant_id=2566639&';
	$merchant_data.='order_id='.$data->order_id.'&';
	$merchant_data.='amount='.$data->amount.'&';
	$merchant_data.='redirect_url=https://medcab.in/assets/cc_pay_adesh/ccavResponseHandler.php&';
	$merchant_data.='cancel_url=https://medcab.in/assets/cc_pay_adesh/ccavResponseHandler.php&';
	$merchant_data.='currency=INR';
	
	$static_m = '2tid='.$tid.'&merchant_id=2566639&order_id='.$order_id.'&amount='.$amount.'&billing_tel='.$mobile_no.'&billing_name='.$name.'&billing_address='.$address.'&billing_city='.$city.'&billing_state='.$state.'&billing_zip='.$zibcode.'&billing_email='.$email.'&billing_country='.$country.'&redirect_url=https://medcab.in/assets/cc_pay_adesh/ccavResponseHandler.php&cancel_url=https://medcab.in/assets/cc_pay_adesh/ccavResponseHandler.php&currency=INR';
	$encrypted_data=encrypt($static_m,$working_key); // Method for encrypting the data.
	// echo "<pre/>";
	// print_r($static_m);	exit();
	$buket = [];
	$buket2 = [];
	$add_array['encrypted_data'] = $encrypted_data;
	$add_array['merchant_data'] = $static_m;
	$add_array['access_code'] = $access_code;
	array_push($buket,$add_array);
	// $array_2['result'] = 'S';
	// $array_2['status'] = '0';
	// $array_2['Message'] = 'Success';
	// $array_2['JSONData'] = $buket;
	// array_push($buket2,$array_2);
	// echo json_encode($array_2);

	

	$array = array(
		"result" => 'S',
		"status"=>'1',
		"Message"=>'Success', 
		"JSONData"=>$buket, 
	);
	
	header('Content-Type: application/json');
 	$jsonData = json_encode($array,JSON_UNESCAPED_SLASHES);
 	echo $jsonData; 

	// return response()->json([
	// 	'result'=>'S',
	// 	'status'=>'0',
	// 	'Message'=>"Category Rate List",
	// 	"JSONData"=>$bucket
	// ]);

?>
 
 

