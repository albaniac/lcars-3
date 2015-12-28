<!doctype html>
<?php
include 'config.php';
require 'functions.php';
$uid=36;
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>GZT TESTING GROUNDS</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>

<form action="index.php" method="post">
				<!--<span class="error"> </span><br>-->
				<?php 	$con = dbconnect(); 
					$query = 'SELECT * FROM `keys` WHERE `ID` = '.$uid;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					mysqli_close($con);
					if ($array['Active']) {$act="checked";} else{$act="unchecked";}
					?> 
				Name: <input type="text" name="name" class="textfield" value="<?php echo $array['Name'];?>"><br>
				Key: <input type="text" name="key" class="textfield" value="<?php echo $array['Key'];?>">
				<button>Get key from reader</button><br>
				Expires: <input type="text" id="expires" name="expires" class="textfield" value="<?php echo $array['Expires'];?>">
					<input type="text" id="altexpires" name="expires" class="textfield" value="<?php echo $array['Expires'];?>"><br>
				Group: <input type="text" name="group" class="textfield" value="<?php echo $array['Group'];?>"><br>
				Active: <input type="checkbox" name="active" class="checkbox" value="1" <?php echo $act;?>><br>
			</form>	


<script>
	$( "#expires" ).datepicker({dateFormat: "dd.mm.yy", altField: "#altexpires", altFormat: "yymmdd", firstDay: 1, minDate: '+1d'});
	$( "button" ).button();
</script>
 
</body>
</html>
