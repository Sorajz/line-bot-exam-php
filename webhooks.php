<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'mav3I6htJzCvf3KKtcvDQS5l+Jq1ZAaeTB/qXpyVUBRfFIsHmCN7R6bFw7dd5WdZFZCnKkuIQGEy8WmfUyduihOv9xXaBNMxyuMd1aENIma9ktgvj/L53N3gCCIFCKAvGngGPUcN9fcJucY+GYWsoAdB04t89/1O/w1cDnyilFU=';

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
			// Get text sent
			$text1 = "ผมเป็นบอทเดิร์นครับ ผมยังหาคำสั่งให้ปริ้น displayname ไม่ได้ หาได้เเต่ userid คือ : ";
			$text2 = $event['source']['userId'];
			$textReplyMessage = "Bot ตอบกลับคุณเป็นข้อความ";
                    	$replyData = new TextMessageBuilder($text1,$text2);
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
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
