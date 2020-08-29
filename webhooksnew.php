<?php // callback.php
			$messages = [
				'type' => 'text',
				'text' => สวัสดี
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/broadcast';
			$data = [
				
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, all);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";

function sendlinemesg(){
	define('LINE_API', "https://api.line.me/v2/bot/message/broadcast");
	define('LINE_TOKEN',"GrPGyVxRxwkpKh0yebc4WmyhLwRU8Ry1+1hjIRo3YimFR6JMGll2XSGcGXRfVlJ7K/9rHxdKzcR7QTS5u1KqekjoNv/3Y+KwlRpgDYXIrjjNwA/WFJvenr2NzqEbgjnQ5pdFDHiPMzQVMQiZ9kez8gdB04t89/1O/w1cDnyilFU=");
	function notify_message($message){
		$queryData = array('message' => $message);
		$queryData = http_build_query($queryData,'','&');
		$headerOption = array(
			'http' => array(
				'method' => 'POST',
				'header' => "Content-Type: application/json \r\n"
							."Authorization: Bearer".LINE_TOKEN."\r\n"
							."Content-Length: ".strlen($queryData)."\r\n",
				'content' => $queryData
			)
		);
		$context = stream_context_create($headerOption);
		$result = file_get_contents(LINE_API, FALSE,$context);
		$res = json_decode($result);
		return $res;
	}
}
echo "OK";
