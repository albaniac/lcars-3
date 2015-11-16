<?php

session_start();
if (isset($_SESSION['user'])){ 
//do stuff

}
if (!isset($_SESSION['user'])){
die("You are not authorised to access this page.");
}


?>
