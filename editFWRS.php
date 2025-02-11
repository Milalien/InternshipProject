<?php 
require "config.php";
if ($_SESSION["loggedin"]!=1){
	header("location: login.html");
}
if(isset($_SESSION["pageUpdate"])){
	echo "<p>".$_SESSION["pageUpdate"]."</p>";
	unset($_SESSION["pageUpdate"]);
}
if(isset($_SESSION["uploadError"])){
	echo "<p>".$_SESSION["uploadSuccess"]."<br>".$_SESSION["uploadError"]."</p>";
	unset($_SESSION["uploadError"]);
	unset($_SESSION["uploadSuccess"]);
	
} elseif(isset($_SESSION["uploadSuccess"])){
	echo "<p>".$_SESSION["uploadSuccess"]."</p>";
	unset($_SESSION["uploadSuccess"]);
} 
if(isset($_SESSION["uploadInfo"])){
	echo "<p>".$_SESSION["uploadInfo"]."</p>";
	unset($_SESSION["uploadInfo"]);
} 

$conn = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT otsikko,esittelyteksti FROM tutkimus_sivu WHERE kieli=?");
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);

echo "<div class='editSubPage'><h1>Kala- ja vesistötutkimus-sivun muokkaus</h1><div class='subPageForms'><div class='form subPage'>";
switch($lang){
  case "fi":
    echo "<h4>Suomenkieliset tekstit:</h4>";
    break;
  case "en":
    echo "<h4>Englanninkieliset tekstit:</h4>";
    break;
  case "nl":
    echo "<h4>Hollanninkieliset tekstit:</h4>";
    break;
  default:
    echo "<h4>Suomenkieliset tekstit:</h4>";
}
echo "<form action='update.php' method='post' enctype='multipart/form-data'>
  <div><label for='otsikko'>Otsikko:</label>
  <textarea name='otsikko' style='height:30px;'>".$info["otsikko"]."</textarea>
  <label for='esittelyteksti'>Teksti:</label>
  <textarea class='editable' name='esittelyteksti'>".$info["esittelyteksti"]."</textarea></div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='FWRSfi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='FWRSen'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='FWRSnl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='FWRSfi'>";
  }
  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div></div>";

$stmt = $conn->prepare("SELECT kuva FROM tutkimus_sivu LIMIT 1");
$stmt->execute();
$stmt->bind_result($db_kuva);
	while($stmt->fetch()){
		$kuva = $db_kuva;		
    }
$stmt->close();

echo "<div class='form changeimg'>
<h4>Vaihda kuva:</h4>
<form action='update.php' method='post' enctype='multipart/form-data'>
  <label for='fwrsimg'><img src=".$kuva." style='width:80%;'></label><br>
  <input type='file' id='fwrsimg' name='fwrsimg'><br>
  <input type='hidden' name='toiminto' value='FWRSimage'><br>
  <input type='submit' value='Vaihda kuva' name='submit' class='submit'>
</form>
</div></div>";


$conn->close();

?>