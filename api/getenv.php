<?php
session_start();
include_once '../config.php';
if (isset($_SESSION['user'])){ 
if($_POST["env"]=="t"){
	$env=shell_exec("python ".$config['site_root']."api/temp.py");
	//$env=substr($env, 5, 4);
	
}
elseif($_POST["env"]=="h"){
	$env=shell_exec("python ".$config['site_root']."api/rh.py");
}
else{
	$env="N/A";
}
echo $env;
}
if (!isset($_SESSION['user'])){
die("You are not authorised to access this page.");
}
?>
