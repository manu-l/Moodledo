<?php
session_start();
require("toodledo_oauth2.php");
$toodledo = new Toodledo_OAuth2();

if(isset($_REQUEST['logout'])) {
	session_unset();
	session_destroy();
}
//If we have an authorization code, exchange it for an access token and refresh token
if(!empty($_REQUEST['code'])) {
	$tokens = $toodledo->getAccessTokenFromAuthCode($_REQUEST['code'],$_REQUEST['state']);
	$access_token = $tokens['access_token']; //this will be your short-lived token to use with the API to make requests.
	$refresh_token = $tokens['refresh_token']; //this will be your long-lived token to get more access_tokens when they expire
	$expiration = $tokens['expires_in']; //this will tell you when the access_token expires
}
//if we are using a refresh token
if(!empty($_REQUEST['refresh'])) {
	$tokens = $toodledo->getAccessTokenFromRefreshToken($_REQUEST['refresh']);
	$access_token = $tokens['access_token']; //this will be your short-lived token to use with the API to make requests.
	$refresh_token = $tokens['refresh_token']; //this will be your long-lived token to get more access_tokens when they expire
	$expiration = $tokens['expires_in']; //this will tell you when the access_token expires
}
//if we already have an access token (get it from request or from the session)
if(!empty($_REQUEST['access_token'])) {
	$access_token = $_REQUEST['access_token'];
	$_SESSION['access_token'] = $access_token;
} else if(!empty($_SESSION['access_token'])){
	$access_token = $_SESSION['access_token'];
}

if(!empty($refresh_token)) {
	$_SESSION['refresh_token'] = $refresh_token;
}

// If is logged in, redirect to toodledo authentication form
if(empty($access_token)) {
	header("Location: ".$toodledo->getAuthURL());
	die();
} else {
	$_SESSION['access_token'] = $access_token;
	// Load user data
	$data = $toodledo->getResource("http://api.toodledo.com/3/account/get.php",$access_token);
	$user = json_decode($data,true);
}

// Default page
$page = "tasks";
if(!empty($_REQUEST['page'])) {
	$page = $_REQUEST['page'];
}

// Include header
include('header.php');
include('user.php');

// Do no use $page variable to avoid to open other files (like configuration file);
if($page=='tasks'){
	include('tasks.html');
} else {
	// Error - TODO To be managed
	include('loading.php');
}

// Include header
include('footer.php');
?>
