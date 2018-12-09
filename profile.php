<?php


$access_token = 'C6yU4avsrRJwRDd1QLE5GMjfW4FKaEVkE0cuCdCPMSpwPFkhxy6DPiT4BJt+LXH0Krw7P105yBcorxE0TzT1mlmvvTWzTOk3tAt6av5wjzkNQNddBAgFejnTYcSj66J+i40XZuUSyIyys5xX+jC+ewdB04t89/1O/w1cDnyilFU=';

$userId = 'U5479bc5c09c356cdec1a1d1b36a5d9e0';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

