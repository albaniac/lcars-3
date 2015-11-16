<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<main>
	<div id="content">
		<div class="innertube">
			<form action="index.php" method="post">
				<span class="error"> <?php echo $loginErr;?></span><br>
				Userame: <input type="text" name="username" class="textfield" value="<?php echo $username;?>"><span class="error"> <br>
				Password: <input type="password" name="password" class="textfield" value=""><br>
				Remember me <input type="checkbox" name="cookie" class="checkbox" value="1" <?php if($cookie){echo "checked";} else{echo "unchecked";}?>><br>
				<input type="submit" class="button" value="LOGIN">
			</form>	
		</div>
	</div>
	
</main>
<div id="nav">
	
</div>

