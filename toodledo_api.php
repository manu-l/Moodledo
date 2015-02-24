<?php
session_start();
require("toodledo_oauth2.php");
$toodledo = new Toodledo_OAuth2();
$apiUrl = "http://api.toodledo.com/3/";

$access_token = $_SESSION['access_token'];

$json = array();
$req_scope = "";
$req_method = "";

if(!isset($access_token)) {
	$json = array('error' => 'Invalid access token');
}
if(empty($_REQUEST['req_scope'])) {
	$json = array('error' => 'Scope not provided');
} else {
	$req_scope = $_REQUEST['req_scope'];
}
if(empty($_REQUEST['req_method'])) {
	$json = array('error' => 'Method not provided');
} else {
	$req_method = $_REQUEST['req_method'];
}
if(!empty($json)) {
	echo json_encode($json);
	return;
}

if($req_scope == 'account'){
	if($req_method=='get') {
		$url = $url."get.php";
		$json_data = $toodledo->getResource($url,$access_token);
	}					
} else if($req_scope == 'tasks'){
	if($req_method=='get') {
		$fields = '';
		if(isset($_REQUEST['req_fields'])) {
			$fields = "&fields=".$_REQUEST['req_fields'];
		}
		$json_data = $toodledo->getResource($apiUrl.$req_scope."/get.php",$access_token.$fields);
		$json = json_decode($json_data, true);
		foreach ($json as $key => $row) {
			$duedate[$key] = $row['duedate'];
			$priority[$key] = $row['priority'];
		}
		array_multisort($duedate, SORT_ASC,  $priority, SORT_DESC, $json);
		$json_data = json_encode($json, true);
	} else if($req_method=='add') {
		if(isset($_REQUEST['req_fields']) && isset($_REQUEST['req_task'])) {
			$params = "&fields=".$_REQUEST['req_fields']."&tasks=".$_REQUEST['req_tasks'];
			$json_data = $toodledo->getResource($apiUrl.$req_scope."/add.php",$access_token.$params);
		}
	} else if($req_method=='edit') {
		if(isset($_REQUEST['req_fields']) && isset($_REQUEST['req_task'])) {
			$params = "&fields=".$_REQUEST['req_fields']."&tasks=".$_REQUEST['req_tasks'];
			$json_data = $toodledo->getResource($apiUrl.$req_scope."/edit.php",$access_token.$params);
		}
	} else if($req_method=='deete') {
		if(isset($_REQUEST['req_task'])) {
			$params = "&tasks=".$_REQUEST['req_tasks'];
			$json_data = $toodledo->getResource($apiUrl.$req_scope."/delete.php",$access_token.$params);
		}
	}				
} else if($req_scope == 'folders'){
	if($req_method=='get') {
		$json_data = $toodledo->getResource($apiUrl.$req_scope."/get.php",$access_token);
	}					
} else if($req_scope == 'contexts'){
	if($req_method=='get') {
		$json_data = $toodledo->getResource($apiUrl.$req_scope."/get.php",$access_token);
	}					
} else if($req_scope == 'goals'){
	if($req_method=='get') {
		$json_data = $toodledo->getResource($apiUrl.$req_scope."/get.php",$access_token);
	}					
} else if($req_scope == 'locations'){
	if($req_method=='get') {
		$json_data = $toodledo->getResource($apiUrl.$req_scope."/get.php",$access_token);
	}					
}

if(isset($json_data)) {
	echo $json_data;
} else {
	echo json_encode(array('error' => 'Request not recognized by the API'));
}





?>
