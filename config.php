<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('192431960793-9is87m92k076ijhu8ijve8vcsfkgop6i.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://betaitsolution.com/signup.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

$con = new mysqli('localhost','root','','betait');


if($con->connect_error){
    die("connection faild:".$con->connect_error);
}

?> 