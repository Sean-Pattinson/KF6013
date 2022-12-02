<?php
header('Content-type: application/json');
require "config.php";
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$token = $connection->oauth2('oauth2/token', array('grant_type' => 'client_credentials'));
$connection->setBearer($token->access_token);
$tweets = $connection->get("search/tweets", array("q" => "%23KF6013")); 

echo json_encode($tweets);
?>