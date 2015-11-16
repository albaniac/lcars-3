<?php
include'config.php';
require 'password.php';
session_start();



function dbconnect()
{
    global $config;
	if (!($link = mysql_connect($config['DB_HOST'], $config['DB_USER'], $config['DB_PWD'])))
	{
        print "<h3>could not connect to database</h3>\n";
		exit;
	}
	mysql_select_db($config['DB_NAME']);
    return $link;
}

function login($username,$password,$cookie) {
	global $loginErr;
	dbconnect();
	$query = "SELECT `id`, `user`, `pass`, `gid`  FROM users WHERE user = '".$username."'";
	$result =  mysql_query($query);
	$idstring =  mysql_fetch_array($result);
	if (!$idstring) { 
		$loginErr="Username not recognized.";
		die ("<meta http-equiv='refresh' content='0; URL=index.php'>"); 
	}
	if (!password_verify($password, $idstring["pass"])){ 
		$loginErr="Wrong password.";
		die ("<meta http-equiv='refresh' content='0; URL=index.php'>");
	} 
	else
	{
		$_SESSION["user"]=$username;
		$_SESSION["uid"]=$idstring["id"];
		$_SESSION["gid"]=$idstring["gid"];
		if($cookie=="1"){
			$selector = base64_encode(openssl_random_pseudo_bytes(30));
			$validator = base64_encode(openssl_random_pseudo_bytes(30));
			//Write $validator and $selector along with username to DB
			dbconnect();
			$query = 'INSERT INTO `cookies` (`selector`, `validator`, `uid`) VALUES ("'.$selector.'","'.$validator.'",'.$_SESSION["uid"].')';
			mysql_query($query);
						
			$cookie_name = "auth";
			$cookie_value["sel"] = $selector;
			$cookie_value["val"] = password_hash($validator, PASSWORD_DEFAULT);
			setcookie($cookie_name, json_encode($cookie_value), time() + (86400 * 10), "/"); // 86400 = 1 day
		}
	}
}

function checkCookie(){
	//get username from DB based on $selector
	if(!isset($_COOKIE["auth"])) {
		return 0;
		die();
	} 
	$data = json_decode($_COOKIE["auth"],true);	
	$selector = $data["sel"];
	$validator = $data["val"];
	
	dbconnect();
	$query = "SELECT `validator`, `uid`  FROM cookies WHERE selector = '".$selector."'";
	
	$result = mysql_query($query);
	$array =  mysql_fetch_array($result);
	if (!$array) { 
		return 0;
		die();
	}
	$DBvalidator = $array["validator"];
	$uid = $array["uid"];
	dbconnect();
	$query = "SELECT `user` FROM users WHERE id = '".$uid."'";
	$result =  mysql_query($query);
	$idstring =  mysql_fetch_array($result);
	if(password_verify($DBvalidator, $validator)){
		$_SESSION["uid"] = $uid;
		$_SESSION["user"] = $idstring["user"];
		return 1;
	}
	else{
		return 0;
	}
}

function logout(){
	if(isset($_COOKIE["auth"])) {
		$data = json_decode($_COOKIE["auth"],true);	
		dbconnect();
		$query = "DELETE FROM cookies WHERE uid = '".$_SESSION["uid"]."' AND selector = '".$data["sel"]."'";
		mysql_query($query);
		setcookie($cookie_name, FALSE, 1, "/");
	}	
	session_unset(); 
	session_destroy(); 
	ob_end_flush(); 
	header("Location: index.php"); 
}

?>
