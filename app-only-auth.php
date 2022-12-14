<?php

$app_key = 'Your App Key';
$app_token = 'Your App Token';

//These are our constants.
$api_base = 'https://api.twitter.com/';
$bearer_token_creds = base64_encode($app_key.':'.$app_token);

//Get a bearer token.
$opts = array(
  'http'=>array(
    'method' => 'POST',
    'header' => 'Authorization: Basic '.$bearer_token_creds."\r\n".
               'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    'content' => 'grant_type=client_credentials'
  )
);
$context = stream_context_create($opts);
$json = file_get_contents($api_base.'oauth2/token',false,$context);
$result = json_decode($json,true);
if (!is_array($result) || !isset($result['token_type']) || !isset($result['access_token'])) {
  die("Something went wrong. This isn't a valid array: ".$json);
}
if ($result['token_type'] !== "bearer") {
  die("Invalid token type. Twitter says we need to make sure this is a bearer.");
}
//Set our bearer token. Now issued, this won't ever* change unless it's invalidated by a call to /oauth2/invalidate_token.
//*probably - it's not documentated that it'll ever change.
$bearer_token = $result['access_token'];
//Try a twitter API request now.
$opts = array(
  'http'=>array(
    'method' => 'GET',
    'header' => 'Authorization: Bearer '.$bearer_token
  )
);
$context = stream_context_create($opts);

//run a search for tweets by the @My_Metro account
$json = file_get_contents($api_base.'1.1/statuses/user_timeline.json?count=1&screen_name=my_metro',false,$context);
$tweets = json_decode($json,true);
//echo out the last tweet
echo "@My_Metro last tweet was: ".$tweets[0]['text']."\r\n";


	
?>
