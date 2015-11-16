<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">		

<?php
include 'functions.php';

session_start();
if (isset($_SESSION['user'])){
dbconnect();
echo'
<script>
$(document).ready(function() {
	$(".lightbtn").click(function(e){
		var currentAttrValue = $(this).attr("device");
		var currentId = $(this).attr("id");
		$.post( "interface.php", {action: "switch" , device: currentAttrValue}, function(data){
			if (currentId=="allon") {$(".singlebtn").animate({backgroundColor: "#FFE51E"},600);}
			if (currentId=="alloff") {$(".singlebtn").animate({backgroundColor: "#99ccff"},600);}
			
			else {
				currentId="#"+currentId;
				//alert(data)
				if(data==1){
					$(currentId).animate({backgroundColor: "#FFE51E"},600);
				}
				else{
					$(currentId).animate({backgroundColor: "#99ccff"},600);
				}
			}
		});

	});
});
</script>
<div>
	<div id="single">';
	$query = 'SELECT * FROM `devices` WHERE `class` = "light"';
	$result = mysql_query($query);
	$i=0;
	while($row = mysql_fetch_assoc($result)) {
	$cid='l'.++$i;
	echo '<div class="lightbtn singlebtn" id="'.$cid.'" device="'.$row["device"].'">';
	echo $row["device"].'</div>';
	if ($row["status"]){
		echo '<script> $(document).ready(function(){ $('.$cid.').css("background", "#FFE51E");}); </script>';
		}
	} 
echo'	</div>
	<div id="all">
		<div class="alltbtn lightbtn" id="allon" device="allon">
			All on
		</div>
		<div class="allbtn lightbtn" id="alloff" device="alloff">
			All off
		</div>
	</div>
</div>	';

}
if (!isset($_SESSION['user'])){
die("You are not authorised to access this page.");
}

?>

