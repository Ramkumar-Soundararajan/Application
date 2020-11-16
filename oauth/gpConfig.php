<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '572500833709-g37pu2df8gg0d50fmdb3i40qu3sn3j4b.apps.googleusercontent.com'; //Google client ID
$clientSecret = '3JLW6AlPf843hNbTlo5SLpWp'; //Google client secret
$redirectURL = 'https://sg-fumigation.riflows.com/ETI/oauth'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>