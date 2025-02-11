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
$stmt = $conn->prepare("SELECT otsikko, yritysNimi, ytunnus, yhteystiedot, postiosOtsikko, postiosoite, kayntiosOtsikko, kayntiosoite FROM yhteystiedot_sivu WHERE kieli=?");
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);
$stmt->close();

echo "<div class='editSubPage'><h1>Yhteystietosivun muokkaus</h1><div class='subPageForms'>";
echo "<div class='form subPage'><h4>Yhteystiedot kaikilla kielillä:</h4>";
echo "<form action='update.php' method='post' enctype='multipart/form-data'>
  <div><label for='yritysNimi'>Yrityksen nimi:</label>
  <textarea name='yritysNimi' style='height:30px;'>".$info["yritysNimi"]."</textarea>
  <label for='ytunnus'>Y-tunnus:</label>
  <textarea name='ytunnus' style='height:30px;'>".$info["ytunnus"]."</textarea>
  <label for='yhteystiedot'>Yhteystiedot:</label>
  <textarea class='editable' name='yhteystiedot' >".$info["yhteystiedot"]."</textarea>
  <label for='postiosoite'>Postiosoite:</label>
  <textarea class='editable' name='postiosoite' style='height:100px;'>".$info["postiosoite"]."</textarea>
  <label for='kayntiosoite'>Käyntiosoite:</label>
  <textarea class='editable' name='kayntiosoite' style='height:100px;'>".$info["kayntiosoite"]."</textarea>
  </div><div><input type='hidden' name='toiminto' value='contactinfo'>
  <input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div>

<div class='form subPage'>";
switch($lang){
  case "fi":
    echo "<h4>Suomenkieliset otsikot:</h4>";
    break;
  case "en":
    echo "<h4>Englanninkieliset otsikot:</h4>";
    break;
  case "nl":
    echo "<h4>Hollanninkieliset otsikot:</h4>";
    break;
  default:
    echo "<h4>Suomenkieliset otsikot:</h4>";
}
echo "<form action='update.php' method='post' enctype='multipart/form-data'>
  <div><label for='otsikko'>Otsikko:</label>
  <textarea name='otsikko' style='height:30px;'>".$info["otsikko"]."</textarea>
  <label for='postiosOtsikko'>Postios. otsikko:</label>
  <textarea name='postiosOtsikko' style='height:30px;'>".$info["postiosOtsikko"]."</textarea>
  <label for='kayntiosOtsikko'>Käyntios. otsikko:</label>
  <textarea name='kayntiosOtsikko' style='height:30px;'>".$info["kayntiosOtsikko"]."</textarea>
  </div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='contactfi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='contacten'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='contactnl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='contactfi'>";
  }
  
  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div>";
?>