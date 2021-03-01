<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'PlY04CPq5qCs7zcXy8A2CUaPLe727AI7NNkqqpn4/3RGn3UtEIr8+X53odtRdyV5Av9Sul+mLr/fq8G48y/iW7xSrPo/KTN0I5RIh9kMblMQLIrmSXNALEqGLwrqphHcgL8SdbApK1rOcWwY1McNgwdB04t89/1O/w1cDnyilFU=';

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
			$text = $event['source']['userId'];
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
<?php
require "vendor/autoload.php";
$access_token = 'fxte5XFm9gh9kGVkWM/PCcYuao7f5tOt6Iq8GAAXUCqJ2HfIZy2U33PK6r6WwO0CAv9Sul+mLr/fq8G48y/iW7xSrPo/KTN0I5RIh9kMblMjIgdelrCdsz8XsRPk8wOQ6gn4iPwx4vevMRfAOnhREQdB04t89/1O/w1cDnyilFU=';
$channelSecret = '6024b4944041d7b1e2d5671caba23025';
$idPush = 'U169659caa82c674a47fb9d6fbe2cabfc'
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
