<?php
session_start();
if (isset($_SESSION['user'])){ 
if($_POST["env"]=="t"){
	$env=shell_exec("/opt/vc/bin/vcgencmd measure_temp");
	$env=substr($env, 5, 4);
	
}
elseif($_POST["env"]=="h"){
	$env="66";
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
