<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">		

<?php
include_once 'functions.php';

session_start();
if (isset($_SESSION['user'])){
	$temp=shell_exec("/opt/vc/bin/vcgencmd measure_temp");
	$temp=substr($temp, 5, 6);
	//echo "Core temp: ";
	$con = dbconnect(); 
	$query = 'SELECT * FROM `translations` WHERE `element` = "coretemp" AND `lang` = "'.$_SESSION['lang'].'"';
	$result = mysqli_query($con,$query);
	$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
	echo $array['value'];
					
	echo $temp;
	echo "<br>";
	
	$up=shell_exec("uptime");
	echo "Uptime: ";
	echo substr($up, 12);
	echo "<br>";
	
	$df=shell_exec("df -h");
	$con = dbconnect(); 
	$query = 'SELECT * FROM `translations` WHERE `element` = "storage" AND `lang` = "'.$_SESSION['lang'].'"';
	$result = mysqli_query($con,$query);
	$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
	echo $array['value']."<br>";
	echo "&nbsp;&nbsp;|-";
	$query = 'SELECT * FROM `translations` WHERE `element` = "system" AND `lang` = "'.$_SESSION['lang'].'"';
	$result = mysqli_query($con,$query);
	$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
	echo $array['value'];
	echo substr($df, 49, 9);
	echo "<br>";
	echo "&nbsp;&nbsp;|-";
	$query = 'SELECT * FROM `translations` WHERE `element` = "size" AND `lang` = "'.$_SESSION['lang'].'"';
	$result = mysqli_query($con,$query);
	$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
	echo $array['value'];
	echo substr($df, 65, 5);
	echo "<br>";
	echo "&nbsp;&nbsp;|-";
	$query = 'SELECT * FROM `translations` WHERE `element` = "used" AND `lang` = "'.$_SESSION['lang'].'"';
	$result = mysqli_query($con,$query);
	$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
	echo $array['value'];
	echo substr($df, 70, 5);
	echo "<br>";
	echo "&nbsp;&nbsp;|-";
	$query = 'SELECT * FROM `translations` WHERE `element` = "free" AND `lang` = "'.$_SESSION['lang'].'"';
	$result = mysqli_query($con,$query);
	$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
	echo $array['value'];
	echo substr($df, 76, 5);
	echo "<br>";
	echo "&nbsp;&nbsp;|-";
	$query = 'SELECT * FROM `translations` WHERE `element` = "usage" AND `lang` = "'.$_SESSION['lang'].'"';
	$result = mysqli_query($con,$query);
	$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
	echo $array['value'];
	echo substr($df, 81, 5);
	echo "<br>";
	echo '<audio autoplay><source src="sounds/diagnose_complete.wav" type="audio/wav"></audio>';
	
}
if (!isset($_SESSION['user'])){
die('You are not authorised to access this page.<audio autoplay><source src="sounds/access_denied.wav" type="audio/wav"></audio>');
}

?>



