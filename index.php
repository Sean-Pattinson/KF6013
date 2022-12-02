<?php
require "config.php";
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

session_start();
if(!isset($_SESSION['request_token']) && !isset($_SESSION['username']) && $_SESSION['logged_in'] !== TRUE) {
    session_destroy();
    header('Location: twitter_oauth.php');
} else {

echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home Page - Coast City Sport Centre</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/main.js"></script>
<link rel="stylesheet" type="text/css" href="styles/style.css"/>
</head>';

$user = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Login';
$user_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : NULL;
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE ? $_SESSION['logged_in'] : FALSE;

echo "<body>
    <nav class='top'><a class='active' href='index.php'>Home</a>
    <a href='element3.php'>Technical Architecture</a>
    <a href='about.php'>About</a>
    <div class='login_container'>";
    
    if($logged_in === TRUE) {
       $content = '<a href="logout.php" id="login" title="Logout">Hi @'.$user;
    } else {
        $content = '<a href="twitter_oauth.php" id="login" title="Login">'.$user;
    }
        echo $content."</a></div></nav>";

echo "<main>
<div class='tweets_container'><button id='refresh'>Refresh</button><h2 id='tweets_title'>Tweets About #KF6013</h2><ul id='tweet_list'>";

echo '</ul></div>
<article class="weather">
    <header><h1>Weather Report</h1></header>
    <p>Location: <span id="location"></span></p>
    <p>Condition: <span id="condition"></span></p>
    <p>Temperature: <span id="temperature"></span></p>
    <p>Max Temperature: <span id="temperature-max"></span></p>
    <p>Min Temperature: <span id="temperature-min"></span></p>
    <p>Humidity: <span id="humidity"></span></p>
    <p>Windspeed: <span id="windspeed"></span></p>
</article>

<article class="map-container">
<h2>Coast City Sports Centre</h2>
<div id="map">

</div>
</article>
</main>';


echo '<!--note how the script is at the bottom of the page as it has to wait for the DOM to load before any of the map functionality can be applied-->	
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=YourKey&callback=initMap" async defer></script>

</body></html>';

}

?>
