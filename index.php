<?php 

	// Server API key generated from Google Console.
	$api_key = "YOUR_API_KEY_HERE";
	$message = "Hello World"; // The msg that would like to send notification.

	$url = 'https://android.googleapis.com/gcm/send';

	$msg = array (	'message' 		=> $message,
					'vibrate'		=> 1,
					'sound'			=> 1,
					'largeIcon'		=> 'large_icon',
					'smallIcon'		=> 'small_icon' );

	/* Single Token */
	$reg_token = "YOUR_UNIQUE_TOKEN_GENERATED_FROM_ANDROID_APP";

	/* Multiple Token */
	/*
	$instance = $from_database;
	$reg_token = array();
	
	foreach ($instance->result() as $ajc) {
		array_push($reg_token, $ajc->instance_id);
	}
	*/

	$fields = array (	'registration_ids' 	=> $reg_token,
						'data'				=> $msg );
	
	$headers = array (	'Authorization: key=' . $api_key,
						'Content-Type: application/json' ); 

	$curl = curl_init();
	
	curl_setopt($curl, CURLOPT_URL,  $url);
	curl_setopt($curl, CURLOPT_POST, true );
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($curl);
	
	curl_close($curl);
	
	$res = json_decode($result);
	$flag = $res->success;
	
	// echo "<pre>";
	// print_r($res); // to view the response. 
	// echo "</pre>";				

	if ( $flag != 0 ) { echo "Success"; } 
	else {	echo "Fail"; }

?>