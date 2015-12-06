<?php
include 'config.php';
require 'functions.php';
session_start();

if (!checkCookie()){
	$username=stripslashes($_POST["username"]);
	$password=stripslashes($_POST["password"]);
	$cookie=$_POST["cookie"];
	if($username) { login($username,$password,$cookie); }
}

$page=stripslashes($_GET["p"]);
$query=trim($_GET["q"]);


if ($page == "logout") {logout();}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>LCARS: GZT-project</title>
		<link href="lcars.css" rel="stylesheet" type="text/css">
		<script src="jquery.js"></script>
		<script src="jquery-colors.js"></script>
		<script>	
		function startTime() {
		    var today=new Date();
		    var h=today.getHours();
		    var m=today.getMinutes();
		    var d=today.getDate();
		    var mn=today.getMonth();
		    var y=today.getFullYear();
		    
		    d = checkTime(d);
		    mn = checkTime(mn);
		    m = checkTime(m);
		    h = checkTime(h);
		    document.getElementById('date').innerHTML = "<h2> "+d+"."+mn+"."+y+" &bull; "+h+":"+m+"</h2>";
		    getenv();
		    var t = setTimeout(function(){startTime();},5*1000);
		}
		
		function checkTime(i) {
		    if (i<10) {i = "0" + i};
		    return i;
		}
		</script>
	
	</head>
	
	<body onload="startTime()">		

		<header id="header">
			<div id="hlcorner">
				<div id="hmenu">
					<h2><?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "hmenu" AND `lang` = "'.$_SESSION['lang'].'"';
					//echo $query;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					mysqli_close($con);
					?></h2>
				</div>
				<div id="hmask">
				</div>
			</div>
			
			<div id="hbar">
				<div class="spacer">
				</div>
				<div id="title">
					<h1>GZT &bull; NCC-0007</h1>
				</div>
			</div>
			
		</header>
			
		<div id="wrapper">

<?php
if (isset($_SESSION['user'])){ include("dashboard.php"); }
if (!isset($_SESSION['user'])){ include("login.php"); }

?>
		</div>
		<footer id="footer">
			<div id="flcorner">
				<div id="fmenu">
					
				</div>
				<div id="fmask">
				</div>
			</div>
			<div id="fbar">
				<div id="date">
				</div>
				<div id="infopanel">
					<div id="temp">
					<p><b>T: N/A</b></p>
					</div>
					<div id="rh">
					<p><b>RH: N/A</b></p>
					</div>		
			</div>				
			</div>
			
		</footer>
	
	</body>
