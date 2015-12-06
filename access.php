<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include 'functions.php';
session_start();
if (!isset($_SESSION['user'])){
die('You are not authorised to access this page.<audio autoplay><source src="sounds/access_denied.wav" type="audio/wav"></audio>');
}
?>

<script>
$(document).ready(function() {
	$('.subnavbutton').click(function(e)  {
		//alert("bu");
        	var currentAttrValue = $(this).attr('ref');
	        //alert(currentAttrValue);
 
	        // Show/Hide Tabs
        	$(currentAttrValue).show().siblings().hide();
 
	        //e.preventDefault();
	});
	
	$("#filter").submit(function(e){
		$.post( "getlog.php", $("#filter").serialize(), function(data){
			$("#logtable").empty().append(data);
		});
		e.preventDefault();
	});
	
	$("#b1").click(checkdoor());
	
	$("#b3").click(function(){
		$.post( "getlog.php", $("#filter").serialize(), function(data){
			$("#logtable").empty().append(data);
		});
	});
	
	$("#toggle").click(function(){
		$("#toggle").animate({backgroundColor: "#FFE51E"},400)
		$.post( "interface.php", {action: "toggle", time: 2},function(data){
			//checkdoor();
			//alert(data);
			if(data.valueOf()==1){
				$("#toggle").animate({backgroundColor: "#00FF40"},600);
			}
			else{
				for (i=0;i<3;i++){
					$("#toggle").animate({backgroundColor: "#FF4B4B"},400);
					$("#toggle").animate({backgroundColor: "#FFE51E"},400);
				}
			}
			$("#toggle").animate({backgroundColor: "#99ccff"},400);
			checkdoor();
			
		});

	});
	$("#open").click(function(){
		$("#open").animate({backgroundColor: "#FFE51E"},400)
		$.post( "interface.php", {action: "open"}, function(data){
			//alert(data.valueOf());
			if(data.valueOf()==1){
				$("#open").animate({backgroundColor: "#00FF40"},600);
			}
			else{
				for (i=0;i<3;i++){
					$("#open").animate({backgroundColor: "#FF4B4B"},400);
					$("#open").animate({backgroundColor: "#FFE51E"},400);
				}
			}
			$("#open").animate({backgroundColor: "#CC6666"},400);
			checkdoor();
		});

	});
	$("#close").click(function(){
		$("#close").animate({backgroundColor: "#FFE51E"},400)
		$.post( "interface.php", {action: "close"}, function(data){
			//alert(data);
			if(data.valueOf()==1){
				$("#close").animate({backgroundColor: "#00FF40"},600);
			}
			else{
				for (i=0;i<3;i++){
					$("#close").animate({backgroundColor: "#FF4B4B"},400);
					$("#close").animate({backgroundColor: "#FFE51E"},400);
				}
			}
			$("#close").animate({backgroundColor: "#F0891E"},400);
			checkdoor();
		});
		
	});
	
	function checkdoor(){
		$.post("interface.php", {action: "check"}, function(data){
			//alert(data);
			var dso = <?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "door_state_open" AND `lang` = "'.$_SESSION['lang'].'"';
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo json_encode($array['value']);
					?>;
			var dsc = <?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "door_state_closed" AND `lang` = "'.$_SESSION['lang'].'"';
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo json_encode($array['value']);
					?>;
			var dsu = <?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "door_state_check" AND `lang` = "'.$_SESSION['lang'].'"';
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo json_encode($array['value']);
					?>;				
			if(data.valueOf()==0){state=dso}
			else if(data.valueOf()==128){state=dsc}
			else {state=dsu}
			$("#doorstate").empty().append(state);
		})
	}
});

</script>

<div id="tabnav">
	<div class="subnavbutton" id="b1" ref="#door">
		<h3><?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "door" AND `lang` = "'.$_SESSION['lang'].'"';
					//echo $query;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					?></h3>
	</div>
	<div class="subnavbutton" id="b2"ref="#users">	
		<h3><?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "users" AND `lang` = "'.$_SESSION['lang'].'"';
					//echo $query;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					?></h3>
	</div>
	<div class="subnavbutton" id="b3"ref="#log">	
		<h3><?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "logs" AND `lang` = "'.$_SESSION['lang'].'"';
					//echo $query;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					?></h3>
	</div>
</div>

<div id="tabs">
	<div id="door" class="tab active" onoad="checkdoor()">
	<h1><div id="doorstate"></div></h1>
	<h1><div class="doorbtn" id="toggle"><?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "toggle" AND `lang` = "'.$_SESSION['lang'].'"';
					//echo $query;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					?></div><div class="doorbtn" id="open"> <?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "open" AND `lang` = "'.$_SESSION['lang'].'"';
					//echo $query;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					?> </div>  <div class="doorbtn" id="close"><?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "close" AND `lang` = "'.$_SESSION['lang'].'"';
					//echo $query;
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					?></div>  </h1>
	
	</div>
	
	<div id="users" class="tab">
	USERS: <br><br>
		<div id="keys_table" class="tableContainer">
		<table class="scrollTable" width="100%" cellspacing="0" cellpadding="0" border="0">
		<thead class="fixedHeader">
		<tr class="alternateRow">
		<th>
		<a href="#">Name</a>
		</th>
		<th>
		<a href="#">Group</a>
		</th>
		<th>
		<a href="#">Added on</a>
		</th>
		<th>
		<a href="#">Edit</a>
		</th>
		</tr>
		</thead>
		<tbody class="scrollContent">
	<?php
	
	$con = dbconnect();
	$query = "SELECT * FROM `keys`";
	$result =  mysqli_query($con,$query);
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		$a = 0;
		while($row = mysqli_fetch_assoc($result,MYSQLI_ASSOC)) {
	        	if($a){echo '<tr class="alternaterow"><td>' . $row["Name"]. '</td><td>' . $row["Group"]. '</td><td>' . $row["Added"]. '</td><td>Edit</td></tr>';$a=0;}
	        	else{echo '<tr class="normalrow"><td>' . $row["Name"]. '</td><td>' . $row["Group"]. '</td><td>' . $row["Added"]. '</td><td>Edit</td></tr>';$a=1;}
		}
		echo '</table></div>';
	}
	else {
		echo "0 results";
	}
		
	?>
	<button text="Add new key">
	</div>
	
	<div id="log" class="tab">
	<?php
echo '<h1>Access LOG: </h1><br><br>
		<form id="filter">
		From: <input type="date" class="textfield" name="from" value="'.date('Ymd', strtotime('-1 month')).'">  To:<input type="date" class="textfield" name="to"value="'.date('Ymd').'">  User:<select name="user"><option value="*">*</option>';
		$con = dbconnect();
		$query = "SELECT * FROM `keys`";
		$result =  mysqli_query($con,$query);
		while($row = mysqli_fetch_assoc($result,MYSQLI_ASSOC)) {echo '<option value="'.$row["Name"].'">'.$row["Name"].'</option>';}
		$query = "SELECT * FROM `users`";
		$result =  mysqli_query($con,$query);
		while($row = mysqli_fetch_assoc($result,MYSQLI_ASSOC)) {echo '<option value="web-'.$row["user"].'">web-'.$row["user"].'</option>';}
		echo '</select>
		<input type="submit" class="button" value="refresh">
		</form>
		<div id="logtable" class="tableContainer">';
		echo '</div>';
	?>
	</div>
</div>	

