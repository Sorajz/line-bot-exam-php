<?php
$access_token = 'Lq8WXzc6SGwxTKwGVCucVaZnPZbGrbm21DrgkUtirFuD2Gc8Nqdn/GUftn+DY1bjMAKf5ZSv3x0ghX3jizgKfsn/WrCndCsnAtzEes4YUsVJ2sC3jEAE9uG1Ckty7OWcAy5EFeNx3WuD8hNWBxTmkQdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v2/bot/group/Cc3556c3448ced104db82e447835d05d5/member/U7fea73e3cb8f255226fce7f59af76ebd';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
