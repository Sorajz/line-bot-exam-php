<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'GrPGyVxRxwkpKh0yebc4WmyhLwRU8Ry1+1hjIRo3YimFR6JMGll2XSGcGXRfVlJ7K/9rHxdKzcR7QTS5u1KqekjoNv/3Y+KwlRpgDYXIrjjNwA/WFJvenr2NzqEbgjnQ5pdFDHiPMzQVMQiZ9kez8gdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$userida = $event['source']['userId'];			
			// Get text sent
			$urlprofile = 'https://api.line.me/v2/bot/profile/'.$userida;
			$headersprofile = array('Authorization: Bearer ' . $access_token);
			$chprofile = curl_init($urlprofile);
			curl_setopt($chprofile, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($chprofile, CURLOPT_RETURNTRANSFER, true);
			//curl_setopt($chprofile, CURLOPT_POSTFIELDS, $post);
			curl_setopt($chprofile, CURLOPT_HTTPHEADER, $headersprofile);
			curl_setopt($chprofile, CURLOPT_FOLLOWLOCATION, 1);
			$resultprofile = curl_exec($chprofile);
			curl_close($chprofile);
			$displayname = json_decode($resultprofile, true);
			$displaynameshow = $displayname["displayName"];
			if($event['message']['text'] == 'ไอดี') {
				$text = $event['source']['userId'];
			}else{
				$text = 'สวัสดีครับ คุณ '.$displaynameshow.' ผมไม่เข้าใจคำถาม รบกวนส่งมาใหม่ครับ';
			}
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, all);
			$result = curl_exec($ch);
			curl_close($ch);

			//echo $result . "\r\n";
		}
	}
echo "OK 1 person <br>";
}else{
echo "OK ALL<br>";

if(!is_null($_POST['productN'])) {
	$productName 		= $_POST['productN'];
	$categoryName		=$_POST['categoryN'];
	$sendnotify = "สวัสดีครับตอนนี้มี  รายการใหม่ให้เสนอ"."\r\n"."ชื่อสินค้า:".$productName."\r\n"."ประเภท:".$categoryName."\r\n";
$valid['success'] = array('success' => true, 'messages' => array(),'productName' => array(),'categoryName'=> array());
echo "message auto send person all<br>";
$messages = [
				'type' => 'text',
				'text' => $sendnotify
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
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, all);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
	$valid['success'] = true;
	$valid['messages'] = "Successfully Notify Line ALL";
echo "message all end";
	echo json_encode($valid);

 }
}
