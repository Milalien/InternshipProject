<?php
require "config.php";
if ($_SESSION["loggedin"]!=1){
	header("location: login.html");
}
if(isset($_SESSION["pageUpdate"])){
	echo "<p>".$_SESSION["pageUpdate"]."</p>";
	unset($_SESSION["pageUpdate"]);
}
$conn = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT esittelyteksti,laatikko1,laatikko2,laatikko3,napit FROM etusivu_tekstit WHERE kieli=?");
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);


$stmt->close();
echo "<h1>Etusivun tekstien muokkaus</h1><div class='form index'>";
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
  <div>
  <label for='esittelyteksti'>Esittelyteksti:</label>
  <textarea class='editable' name='esittelyteksti'>".$info["esittelyteksti"]."</textarea>
  <label for='laatikko1'>Laatikko 1:</label>
  <textarea class='editable' name='laatikko1'>".$info["laatikko1"]."</textarea>
  <label for='laatikko2'>Laatikko 2:</label>
  <textarea class='editable' name='laatikko2'>".$info["laatikko2"]."</textarea>
  <label for='laatikko3'>Laatikko 3:</label>
  <textarea class='editable' name='laatikko3'>".$info["laatikko3"]."</textarea>
  <label for='napit'>Nappien teksti:</label>
  <textarea name='napit' style='height:30px;'>".$info["napit"]."</textarea>
  </div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='frontpagefi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='frontpageen'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='frontpagenl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='frontpagefi'>";
  }
  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div>";



$conn->close();
?>