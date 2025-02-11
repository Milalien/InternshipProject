<?php
session_start();

if(isset($_SESSION["loggedin"])){
unset($_SESSION["loggedin"]);
header("location: login.html");
}

?>