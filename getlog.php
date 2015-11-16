<?php
include 'functions.php';
session_start();
if (isset($_SESSION['user'])){ 
	
	dbconnect();
	$to=$_POST["to"];
	if($_POST["user"]=='*'){
		$query = "SELECT * FROM `AccessLog` WHERE `Time` >= ".$_POST["from"]." AND `Time` <= ".$to;
	}
	else{
		$query = "SELECT * FROM `AccessLog` WHERE `Key` = '".$_POST["user"]."' AND `Time` >= ".$_POST["from"]." AND `Time` <= ".$to;
	}
	$result =  mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		echo '
		<table class="scrollTable" width="100%" cellspacing="0" cellpadding="0" border="0">
		<thead class="fixedHeader">
		<tr class="alternateRow">
		<th>
		<a href="#">Time</a>
		</th>
		<th>
		<a href="#">User</a>
		</th>
		<th>
		<a href="#">Action</a>
		</th>
		</tr>
		</thead>
		<tbody class="scrollContent">';
		// output data of each row
		$a = 0;
		while($row = mysql_fetch_assoc($result)) {
	        	if($a){echo '<tr class="alternaterow"><td>' . $row["Time"]. '</td><td>' . $row["Key"]. '</td><td>' . $row["Action"]. '</td></tr>';$a=0;}
	        	else{echo '<tr class="normalrow"><td>' . $row["Time"]. '</td><td>' . $row["Key"]. '</td><td>' . $row["Action"]. '</td></tr>';$a=1;}
		}
		echo '</table>';
	}
	else {
		echo "0 results";
	}

}
if (!isset($_SESSION['user'])){
echo "You are not authorised to access this page.";
die("Login error");
}


?>	
