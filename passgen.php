<?
require 'password.php';
$hash="";
//if ($_POST["pass"]==""){die();}
if ($_POST["pass"]==$_POST["check"]){
	$hash="Your hash: ".password_hash($_POST["pass"], PASSWORD_DEFAULT);
}
else{
	$passErr="Passwords do not mach.";
}
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"method="post">
Password: <input type="password" name="pass" class="textfield"><span class="error"> <?php echo $passErr;?></span><br>
Retype: <input type="password" name="check" class="textfield"><br>

<input type="submit" class="button" value="Generate!">
</form>
<br>
<? echo $hash; ?>



