<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$_POST['access_token'];
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
			$message_user = $event['message']['text'];
			// Get profile user
			$urlprofile = 'https://api.line.me/v2/bot/profile/'.$userida;
			$headersprofile = array('Authorization: Bearer ' . $access_token);
			$chprofile = curl_init($urlprofile);
			curl_setopt($chprofile, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($chprofile, CURLOPT_RETURNTRANSFER, true);
			//curl_setopt($chprofile, CURLOPT_POSTFIELDS, $post);
			curl_setopt($chprofile, CURLOPT_HTTPHEADER, $headersprofile);
			curl_setopt($chprofile, CURLOPT_FOLLOWLOCATION, 1);
			$resultprofile = curl_exec($chprofile); //แสดงค่าออกมาแล้วเก็บไว้ที่ตัวแปร $resultprofile
			curl_close($chprofile);//จบการทำงานการดึงค่าจากเว็ป
			$displayname = json_decode($resultprofile, true);//แปลงค่าตัวแปร $resultprofile เป็น json แล้วเก็บไว้ที่ตัวแปร $displayname
			$displaynameshow = $displayname["displayName"];// 
			$dtext = 'รายละเอียดที่ คุณ '.$displaynameshow.'ขอมา';
			if($message_user == 'ไอดี'|| $message_user == 'id' ) {
				$text = $userida;
			}else if($message_user == 'Id'|| $message_user == 'ID'|| $message_user == 'iD' ) {
				$text = $event['source']['userId'];
			}else{
				if(strpos($message_user,'ควย')||strpos($message_user,'เหี้ย')||strpos($message_user,'สัส')){
				$dtext = 'สวัสดีครับ คุณ '.$displaynameshow;
				$text = 'รบกวนสุภาพหน่อยครับ';
				}else if(strpos($message_user,'มึง')||strpos($message_user,'ควาย')){
				$dtext = 'สวัสดีครับ คุณ '.$displaynameshow;
				$text = 'รบกวนสุภาพหน่อยครับ';
				}else{
				$dtext = 'สวัสดีครับ คุณ '.$displaynameshow;
				$text = 'ผมไม่เข้าใจคำถาม รบกวนส่งมาใหม่ครับ';
				}
			}
			
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$dmessages = [
				'type' => 'text',
				'text' => $dtext
				];
			$messages = [
				'type' => 'text',
				'text' => $text	
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$dmessages,$messages],
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
}
echo "OK ALL<br>";

if(!is_null($_POST['productN'])) {
	$productName 		= $_POST['productN'];
	$categoryName		=$_POST['categoryN'];
	$MTextA		=$_POST['MTextA'];
	$MTextB		=$_POST['MTextB'];
	$sendnotify = $MTextA.$productName."\r\n".$MTextB.$categoryName;
$valid['success'] = array('success' => true, 'messages' => array(),'productName' => array(),'categoryName'=> array());
echo "message auto send person all<br>";
$messages = [
				'type' => 'text',
				'text' => $sendnotify
			];
	$messageslogin = [
				'type' => 'text',
				'text' => 'https://127.0.0.1:4433'
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/broadcast';
			$data = [
				'messages' => [$messages,$messageslogin],
				
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
	//แจ้งเตือนรายการที่สั่ง
if(!is_null($_POST['polineuserid'])) {
	$codeuseridline = $_POST['polineuserid'];
	$productorderpo = $_POST['poallproduct'];
	$poid = $_POST['poid'];
	$validpo['success'] = array('success' => true, 'messages' => array());
	$sendnotify = "สวัสดีครับตอนนี้มี รายการสั่งซื้อใหม่"."\r\n"."รหัสสั่งซื้อ:".$poid."\r\n"."ชื่อสินค้า:".$productorderpo;
		// Get replyToken
			$replyToken = $codeuseridline;
			// Build message to reply back
			$dmessages = [
				'type' => 'text',
				'text' => $sendnotify
				];
			$messages = [
				'type' => 'text',
				'text' => $text	
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$dmessages,$messages],
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
	$validpo['success'] = true;
	$validpo['messages'] = "Successfully Notify Line Supplier";
		echo json_encode($validpo);

 }
?>
