<?php 


function send_mail_sendgrid($email,$subject,$message){
	$ch = curl_init();

	$data = array(
		'personalizations' => array(
			array(
				"to" => array(
					array("email"=>"hola@cholao.co")
				)
			)
		),
		"from" => array(
			"email" => $email
		),
		"subject" => $subject,
		"content" => array(
			array(
				"type" => "text/plain",
				"value" => $message
			)
		),
	);

	curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_POST, 1);



	$headers = array();
	$headers[] = "Authorization: Bearer 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";
	$headers[] = "Content-Type: application/json";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close ($ch);

	return json_encode(array("status"=>true));
}

if(isset($_POST['email'])){
	echo send_mail_sendgrid($_POST["email"],$_POST["subject"],$_POST["message"]);
}else{
	echo json_encode(array("status"=>false));
}

