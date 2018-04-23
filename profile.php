<?php
$access_token = 'Lq8WXzc6SGwxTKwGVCucVaZnPZbGrbm21DrgkUtirFuD2Gc8Nqdn/GUftn+DY1bjMAKf5ZSv3x0ghX3jizgKfsn/WrCndCsnAtzEes4YUsVJ2sC3jEAE9uG1Ckty7OWcAy5EFeNx3WuD8hNWBxTmkQdB04t89/1O/w1cDnyilFU=';
$userId = 'Ufc802c8f8ed6ed72ea92b38f676a6837';
$groupId = 'C23a8c2a40e2c284f421fcd152425c4a5';
$url = 'https://api.line.me/v2/bot/group/'.$userId;
$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result;

