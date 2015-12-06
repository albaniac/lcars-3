<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<main>
	<div id="content">
		<div class="innertube">
			<form action="index.php" method="post">
				<span class="error"> <?php echo $loginErr;?></span><br>
				<?php $_SESSION["lang"]="si_SL";
					$con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "username" AND `lang` = "'.$_SESSION['lang'].'"';
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					mysqli_close($con);
					?> <input type="text" name="username" class="textfield" value="<?php echo $username;?>"><span class="error"> <br>
				<?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "password" AND `lang` = "'.$_SESSION['lang'].'"';
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					mysqli_close($con);
					?> <input type="password" name="password" class="textfield" value=""><br>
				<?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "cookie" AND `lang` = "'.$_SESSION['lang'].'"';
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo $array['value'];
					mysqli_close($con);
					?> <input type="checkbox" name="cookie" class="checkbox" value="1" <?php if($cookie){echo "checked";} else{echo "unchecked";}?>><br>
				<input type="submit" class="button" <?php $con = dbconnect(); 
					$query = 'SELECT * FROM `translations` WHERE `element` = "login" AND `lang` = "'.$_SESSION['lang'].'"';
					$result = mysqli_query($con,$query);
					$array = mysqli_fetch_array($result,MYSQLI_ASSOC); 
					echo 'value="'.$array['value'].'"';
					mysqli_close($con);
					?>>
			</form>	
		</div>
	</div>
	
</main>
<div id="nav">
	
</div>

