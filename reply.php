>/?php 
require "vendor/autoload.php";
$access_token = 'fxte5XFm9gh9kGVkWM/PCcYuao7f5tOt6Iq8GAAXUCqJ2HfIZy2U33PK6r6WwO0CAv9Sul+mLr/fq8G48y/iW7xSrPo/KTN0I5RIh9kMblMjIgdelrCdsz8XsRPk8wOQ6gn4iPwx4vevMRfAOnhREQdB04t89/1O/w1cDnyilFU=';
$channelSecret = '6024b4944041d7b1e2d5671caba23025';
$idPush = 'U169659caa82c674a47fb9d6fbe2cabfc'
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
