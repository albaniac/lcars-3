<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<main>
	<div id="content">
		<div class="innertube">
		<?php 
		if (isset($_SESSION['user'])){ include("diag.php"); }
		?>
		</div>
	</div>

</main>
	<div id="nav">
		<div class="navbutton" id="b1">
			<h3>Lights</h3>
		</div>
		<div class="navbutton" id="b2">	
			<h3>Heating</h3>
		</div>
		<div class="navbutton" id="b3">	
			<h3>Access Control</h3>
		</div>
		<div class="navbutton" id="b4">	
			<h3>Settings</h3>
		</div>
		<div class="navbutton" id="b5">	
			<h3>Diagnostics</h3>
		</div>
		<a href="index.php?p=logout">
		<div class="navbutton" id="b6">	
			<h3>Logout</h3>	
		</div>
		</a>
	
	</div>

<script>
	function getenv(){
		$.post( "api/getenv.php", {env: "t"}, function( data ) {
  			$("#temp").html("<p><b>T: " + data + "°C</b></p>");
		});	
		$.post( "api/getenv.php", {env: "h"}, function( data ) {
  			$("#rh").html("<p><b>RH: " + data + "%</b></p>");
		});
	}
	
	$("#b1").click(function(){
		$.get("lights.php",function(data){
			$(".innertube").html(data);
		});
	});	
	
	$("#b2").click(function(){
		$.get("air.php",function(data){
			$(".innertube").html(data);
		});
	});
	
	$("#b3").click(function(){
		$.get("access.php",function(data){
			$(".innertube").html(data);
		});
	});

	$("#b4").click(function(){
		$.get("settings.php",function(data){
			$(".innertube").html(data);
		});
	});

	$("#b5").click(function(){
		$.get("diag.php",function(data){
			$(".innertube").html(data);
		});
	});	
	</script>
</html>
