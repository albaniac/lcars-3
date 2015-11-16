<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">		

<?php
//include 'functions.php';

session_start();
if (isset($_SESSION['user'])){
	$temp=shell_exec("/opt/vc/bin/vcgencmd measure_temp");
	$temp=substr($temp, 5, 6);
	echo "Core temp: ";
	echo $temp;
	echo "<br>";
	
	$up=shell_exec("uptime");
	echo "Uptime: ";
	echo substr($up, 12);
	echo "<br>";
	
	$df=shell_exec("df -h");
	echo "Storage: <br>";
	echo "&nbsp;&nbsp;|-System: ";
	echo substr($df, 49, 9);
	echo "<br>";
	echo "&nbsp;&nbsp;|-Size: ";
	echo substr($df, 65, 5);
	echo "<br>";
	echo "&nbsp;&nbsp;|-Used: ";
	echo substr($df, 70, 5);
	echo "<br>";
	echo "&nbsp;&nbsp;|-Free: ";
	echo substr($df, 76, 5);
	echo "<br>";
	echo "&nbsp;&nbsp;|-Usage: ";
	echo substr($df, 81, 5);
	echo "<br>";
	
}
if (!isset($_SESSION['user'])){
die("You are not authorised to access this page.");
}

?>



