<?php
session_start();

require "config.php";

$post_tunnus = $_POST["tunnus"];
$post_salasana = $_POST["salasana"];

$conn = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT id, tunnus, salasana FROM kayttaja WHERE id='1'");
$stmt->execute();

$stmt->bind_result($db_id, $db_tunnus, $db_salasana);
while($stmt->fetch()){
	$id = $db_id;
	$tunnus=$db_tunnus;
	$salasana=$db_salasana;
}


if(password_verify($post_salasana, $salasana) && $post_tunnus == $tunnus) {
    $_SESSION["loggedin"] = 1;
	header("location: adminpage.php");
} 




?>