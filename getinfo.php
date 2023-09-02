<?php
	header('Content-Type: application/json');
	$response = [time(), $_SERVER];
	$response[1]['REMOTE_NAME'] = gethostbyaddr($response[1]['REMOTE_ADDR']);
	if( ! strlen($response[1]['REMOTE_NAME']) > 0 ){
		$response[1]['REMOTE_NAME'] = $response[1]['REMOTE_ADDR'];
	}
	unset( $response[1]['CONTEXT_DOCUMENT_ROOT'] );
	unset( $response[1]['DOCUMENT_ROOT'] );
	unset( $response[1]['GATEWAY_INTERFACE'] );
	unset( $response[1]['PATH'] );
	unset( $response[1]['SCRIPT_FILENAME'] );
	unset( $response[1]['SERVER_ADMIN'] );
	unset( $response[1]['SERVER_SOFTWARE'] );

	$post_data = [
		'username' => $response[1]['SERVER_NAME'],
		'title'    => $_SERVER['SCRIPT_NAME'],
		'content'  => $response[1]['REMOTE_NAME'],
	];
	$curl_req = curl_init('https://discord.com/api/webhooks/xxxxxxxx/xxxxxxxxxxxxxxx');
	curl_setopt($curl_req,CURLOPT_POST, TRUE);
	curl_setopt($curl_req,CURLOPT_POSTFIELDS, http_build_query($post_data));
	curl_setopt($curl_req,CURLOPT_SSL_VERIFYPEER, FALSE);/* オレオレ証明書対策 */
	curl_setopt($curl_req,CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl_req,CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl_req,CURLOPT_COOKIEJAR, 'cookie');
	curl_setopt($curl_req,CURLOPT_COOKIEFILE, 'tmp');
	curl_setopt($curl_req,CURLOPT_FOLLOWLOCATION, TRUE);/* Locationヘッダを追跡 */
	//$curl_res=curl_exec($curl_req);

	echo json_encode($response);
	exit();
