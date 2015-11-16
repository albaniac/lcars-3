<?php
include 'config.php';
include 'functions.php';
session_start();
if (isset($_SESSION['user'])){ 
	if($_POST["action"]=="toggle"){
		$user="web-".$_SESSION["user"];
		#echo("/usr/bin/python ".$config['site_root']."api/proxy.py toggle ".$user." ".$_POST["time"]."<br>");
		echo exec("/usr/bin/python ".$config['site_root']."api/proxy.py toggle ".$user." ".$_POST["time"]);
	}
	
	elseif($_POST["action"]=="open"){
		$user="web-".$_SESSION["user"];
		echo exec("python ".$config['site_root']."api/proxy.py open ".$user);
	}
	
	elseif($_POST["action"]=="close"){
		$user="web-".$_SESSION["user"];
		echo exec("python ".$config['site_root']."api/proxy.py close ".$user);
	}
	
	elseif($_POST["action"]=="addkey"){
		echo exec("python ".$config['site_root']."api/proxy.py addkey ".$_POST["name"]." ".$_POST["group"]." ".$_POST["expires"]);
	}
	
	elseif($_POST["action"]=="check"){
		echo exec("python ".$config['site_root']."api/proxy.py check");
	}
	elseif($_POST["action"]=="switch"){
		dbconnect();

		if ($_POST["device"]=="allon"){
			$query = "UPDATE `devices` SET `status`=1 WHERE 1";
			}
		elseif ($_POST["device"]=="alloff"){
			$query = "UPDATE `devices` SET `status`=0 WHERE 1";
			}
		else {
			$newstatus = mysql_fetch_assoc(mysql_query("SELECT * FROM `devices` WHERE `device` = '".$_POST["device"]."'"))["status"];
			$newstatus = (int)!$newstatus;
			$query = "UPDATE `devices` SET `status`=".$newstatus." WHERE `device`='".$_POST["device"]."'";
			echo $newstatus;
					
		}
		mysql_query($query);
	}

	else{}

}
if (!isset($_SESSION['user'])){
die("You are not authorised to access this page.");
}
?>

