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

$stmt = $conn->prepare("SELECT valikko1,valikko2,valikko3,pudotusvalikko,alavalikko1,alavalikko2,alavalikko3,valikko4 FROM ylavalikko WHERE kieli=?");
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);

echo "<div class='editSubPage'><h1>Ylävalikon muokkaus</h1><div class='adForms'><div class='form subPage'>";
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
  <div><label for='valikko1'>Valikko 1:</label>
  <textarea name='valikko1' style='height:30px;'>".$info["valikko1"]."</textarea>
  <label for='valikko2'>Valikko 2:</label>
  <textarea name='valikko2' style='height:30px;'>".$info["valikko2"]."</textarea>
  <label for='valikko3'>Valikko 3:</label>
  <textarea name='valikko3' style='height:30px;'>".$info["valikko3"]."</textarea>
  <label for='pudotusvalikko'>Pudotusvalikko:</label>
  <textarea name='pudotusvalikko' style='height:30px;'>".$info["pudotusvalikko"]."</textarea>
  <label for='alavalikko1'>Alavalikko 1:</label>
  <textarea name='alavalikko1' style='height:30px;'>".$info["alavalikko1"]."</textarea>
  <label for='alavalikko2'>Alavalikko 2:</label>
  <textarea name='alavalikko2' style='height:30px;'>".$info["alavalikko2"]."</textarea>
  <label for='alavalikko3'>Alavalikko 3:</label>
  <textarea name='alavalikko3' style='height:30px;'>".$info["alavalikko3"]."</textarea>
  <label for='valikko4'>Valikko 4:</label>
  <textarea name='valikko4' style='height:30px;'>".$info["valikko4"]."</textarea></div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='menufi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='menuen'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='menunl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='menufi'>";
  }
  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div></div></div>";

$conn->close();

?>