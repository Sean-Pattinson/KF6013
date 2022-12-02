<?php
require "config.php";
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$_SESSION['oauth_token'] = $request_token['oauth_token'];

$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

if ($connection->getLastHttpCode()==200){
    // Let's generate the URL and redirect
    $url = $connection->url('oauth/authorize', array('oauth_token'
    => $request_token['oauth_token']));
    header('Location: '. $url) ;
    /* Should be finished here.. */
    } else {
     // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.' . " HTTP Error Code " .
    $connection->getLastHttpCode());
    }
?>