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

$stmt = $conn->prepare("SELECT mokkiOtsikko, mokkiTeksti, mokkiNappi1,airbnb, mokkiNappi2, matkaOtsikko, matkaTeksti, matkaNappi FROM mainoslaatikot WHERE kieli=?");
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);

echo "<div class='editAds'><h1>Mainoslaatikoiden muokkaus</h1><div class='adForms'><div class='form ads'>";
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
  <div><label for='mokkiOtsikko'>Mökki-laatikon otsikko:</label>
  <textarea name='mokkiOtsikko' style='height:30px;'>".$info["mokkiOtsikko"]."</textarea>
  <label for='mokkiTeksti'>Mökki-laatikon teksti:</label>
  <textarea name='mokkiTeksti' style='height:100px;'>".$info["mokkiTeksti"]."</textarea>
  <label for='mokkiNappi1'>Nappi 1:</label>
  <textarea name='mokkiNappi1' style='height:30px;'>".$info["mokkiNappi1"]."</textarea>
  <label for='airbnb'>Airbnb:</label>
  <textarea name='airbnb' style='height:30px;'>".$info["airbnb"]."</textarea>
  <label for='mokkiNappi2'>Nappi 2:</label>
  <textarea name='mokkiNappi2' style='height:30px;'>".$info["mokkiNappi2"]."</textarea>
  <label for='matkaOtsikko'>Luontomatka-laatikon otsikko:</label>
  <textarea name='matkaOtsikko' style='height:30px;'>".$info["matkaOtsikko"]."</textarea>
  <label for='matkaTeksti'>Luontomatka-laatikon teksti:</label>
  <textarea name='matkaTeksti' style='height:100px;'>".$info["matkaTeksti"]."</textarea>
  <label for='matkaNappi'>Nappi:</label>
  <textarea name='matkaNappi' style='height:30px;'>".$info["matkaNappi"]."</textarea></div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='adsfi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='adsen'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='adsnl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='adsfi'>";
  }
  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div></div></div>";

$conn->close();

?>