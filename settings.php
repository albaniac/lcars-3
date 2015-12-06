<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">		

<?php
include 'functions.php';

session_start();
if (isset($_SESSION['user'])){
	$con = dbconnect();
	echo '<form action="settings.php" method="post">';
	
	echo 'Door toggle time: <input type="text" name="door_time" class="settingsfield" value="'.mysqli_fetch_array(mysqli_query($con,'SELECT `value` FROM `settings` WHERE `parameter`="door_time"'))[0].'"><br>';
	echo 'Thermomether I2C address: <input type="text" name="i2c_th" class="settingsfield" value="'.mysqli_fetch_array(mysqli_query($con,'SELECT `value` FROM `settings` WHERE `parameter`="i2c_th"'))[0].'"><br>';
	echo 'Humidity sensor I2C address: <input type="text" name="i2c_rh" class="settingsfield" value="'.mysqli_fetch_array(mysqli_query($con,'SELECT `value` FROM `settings` WHERE `parameter`="i2c_rh"'))[0].'"><br>';
	
}
if (!isset($_SESSION['user'])){
die("You are not authorised to access this page.");
}

?>



