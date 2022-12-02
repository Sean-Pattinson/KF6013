<?php
require "config.php";
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//Start session and set the request token for oauth2 recieved in the response to a session variable.
session_start();
$_SESSION['request_token'] = $_REQUEST['code'];

//Create a new variable called request token and assign the value of $_SESSION['request_token'] to it.
$request_token = [];
$request_token['request_token'] = $_SESSION['request_token'];

//Check if the request has been successful if not redirect the user to the authentication to try again.
if (isset($_REQUEST['code']) &&
 $request_token['request_token'] !== $_REQUEST['code'] || isset($_REQUEST['code']) &&
 $_SESSION['request_token'] !== $_REQUEST['code'] || !isset($_SESSION['request_token'])) {

 header('Location: https://twitter.com/i/oauth2/authorize?response_type=code&client_id='.CLIENT_ID.'&scope=tweet.read%20tweet.write%20users.read%20follows.read%20follows.write&redirect_uri=http%3A%2F%2F20.26.215.5%2FKF6013%2Ftwitter_oauth.php&state=state&code_challenge_method=plain&code_challenge=challenge');

}


//Now we make a TwitterOAuth instance with the client ID and client secret for oauth2 PKCE authorization to make requests on behalf of the user.
$connection = new TwitterOAuth(CLIENT_ID, CLIENT_SECRET);

//At this point we will use the temporary request token to get the long lived access_token that authorized to act as the user.
$access_token = $connection->oauth2("2/oauth2/token",
array('code'=> $request_token['request_token'], "grant_type" => 'authorization_code', 'client_id' => CLIENT_ID, 'redirect_uri' => 'http://20.26.215.5/KF6013/twitter_oauth.php', 'code_verifier' => 'challenge'));

$request_token['bearer'] = $access_token->access_token;


//Now we set the Bearer token in the instance to the users access token and set the API version to 2 to make queries to twitter API v2.
$connection->setBearer($request_token['bearer']);
$connection->setApiVersion(2);

//unset the request token as we shouldn't need to use it outside of this page.
unset($_SESSION['request_token']);

// Let's get the user's info, I will store the users twitter handle and profile image url into the session variables.
try {
$user_info = $connection->get('users/me', array('user.fields' => 'profile_image_url'));
$_SESSION['user_name'] = $user_info->data->username;
$_SESSION['profile_pic'] = $user_info->data->profile_image_url;
$_SESSION['logged_in'] = TRUE;



//redirect the user to the homepage once logged in.
header('Location: index.php');
} catch(Exception $e) {
    echo 'Error: '.$e->getMessage();
}
?>