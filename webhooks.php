<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'xYWwce1Yov/D+hm3t44Kh2O56s+uoLtWJI6cp9pC/EU1Iw8JwXEoKW0ojBSOh4QRm9tvvd1bWAE8gV4pxQeB234RqRFsQGNBVUXo/OyS7grsUP0nUiNVpVzS+AEFJnE74HvEjG7jek6stse12PAztwdB04t89/1O/w1cDnyilFU=';
$channel_secret = '18c44ec2d7cbaeef30ffe0f331a33f2b';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if (false) {
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

			echo $result + 'hahaha'. "\r\n";
		} else if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			echo 'hahaha'. "\r\n";

			$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
			$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channel_secret]);
			$response = $bot->getProfile('<userId>');
			if ($response->isSucceeded()) {
				$profile = $response->getJSONDecodedBody();
				echo $profile['displayName'];
				echo $profile['pictureUrl'];
				echo $profile['statusMessage'];
			}
		}
	}
}
echo "OK";
