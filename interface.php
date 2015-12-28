<?php
include_once 'config.php';
include_once 'functions.php';
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
		$con = dbconnect();

		if ($_POST["device"]=="allon"){
			$query = 'UPDATE `devices` SET `status`=1 WHERE  `class` = "light"';
			}
		elseif ($_POST["device"]=="alloff"){
			$query = 'UPDATE `devices` SET `status`=0 WHERE  `class` = "light"';
			}
		else {
			$newstatus = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `devices` WHERE `device` = '".$_POST["device"]."'"))["status"];
			$newstatus = (int)!$newstatus;
			$query = "UPDATE `devices` SET `status`=".$newstatus." WHERE `device`='".$_POST["device"]."'";
			echo $newstatus;
					
		}
		mysqli_query($con,$query);
		mysqli_commit($con);
		mysqli_close($con);
	}
	elseif($_POST["action"]=="udel"){
		$con = dbconnect();
		$query = 'DELETE FROM `keys` WHERE `ID`='.$_POST["sqid"];
		mysqli_query($con,$query);
		mysqli_commit($con);
		mysqli_close($con);
		echo 'Success!';
	}
	

	elseif($_POST["action"]=="getuser"){
		
		$con = dbconnect(); 
		$query = 'SELECT * FROM `keys` WHERE `ID`='.$_POST["sqid"];
		$result = mysqli_query($con,$query);
		$array = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if ($array['Active']) {$act="checked";} else{$act="unchecked";} 
		$query = 'SELECT * FROM `translations` WHERE `element` = "editor" AND `lang` = "'.$_SESSION['lang'].'"';
		$result = mysqli_query($con,$query);
		$trans = mysqli_fetch_array($result,MYSQLI_ASSOC);
		mysqli_close($con);
		//echo $array['value'];
		eval($trans['value']);
		
	}
	
	
	elseif($_POST["action"]=="uupd"){
		//$con = dbconnect();
		//$query = 'UPDATE `keys` SET `Key`=[value-2],`Name`=[value-3],`Group`=[value-4],`Active`=[value-5],`Added`=[value-6],`Expires`=[value-7],`Hex`=[value-8] WHERE `ID`='.$_POST["sqid"];
		//mysqli_query($con,$query);
		//mysqli_commit($con);
		//mysqli_close($con);
		echo 'Success!';
	}

	else{}

}
if (!isset($_SESSION['user'])){
die('You are not authorised to access this page.<audio autoplay><source src="sounds/access_denied.wav" type="audio/wav"></audio>');
}
?>

