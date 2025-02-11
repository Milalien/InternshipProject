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
$stmt = $conn->prepare("SELECT ylaOtsikko,alaOtsikko1,alaOtsikko2, esittelyteksti, mokki1otsikko, mokki1kuvaus, mokki1nappi,mokki2otsikko,mokki2kuvaus,mokki2nappi FROM mokkivuokraus_sivu WHERE kieli=?");
$stmt->bind_param("s", $lang);

$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);

echo "<div class='editSubPage'><h1>Mökkivuokraus-sivun muokkaus</h1><div class='subPageForms'><div class='form subPage'>";
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
  <div><label for='ylaOtsikko'>Otsikko:</label>
  <textarea name='ylaOtsikko' style='height:30px;'>".$info["ylaOtsikko"]."</textarea>
  <label for='alaOtsikko1'>Alaotsikko 1:</label>
  <textarea name='alaOtsikko1' style='height:30px;'>".$info["alaOtsikko1"]."</textarea>
  <label for='alaOtsikko2'>Alaotsikko 2:</label>
  <textarea name='alaOtsikko2' style='height:30px;'>".$info["alaOtsikko2"]."</textarea>
  <label for='esittelyteksti'>esittelyteksti:</label>
  <textarea class='editable' name='esittelyteksti'>".$info["esittelyteksti"]."</textarea>
  <label for='mokki1otsikko'>Mökki 1 otsikko:</label>
  <textarea name='mokki1otsikko' style='height:30px;'>".$info["mokki1otsikko"]."</textarea>
  <label for='mokki1kuvaus'>Mökki 1 kuvaus:</label>
  <textarea name='mokki1kuvaus' style='height:100px;'>".$info["mokki1kuvaus"]."</textarea>
  <label for='mokki1nappi'>Nappi:</label>
  <textarea name='mokki1nappi' style='height:30px;'>".$info["mokki1nappi"]."</textarea>
  <label for='mokki2otsikko'>Mökki 2 otsikko:</label>
  <textarea name='mokki2otsikko' style='height:30px;'>".$info["mokki2otsikko"]."</textarea>
  <label for='mokki2kuvaus'>Mökki 2 kuvaus:</label>
  <textarea name='mokki2kuvaus' style='height:100px;'>".$info["mokki2kuvaus"]."</textarea>
  <label for='mokki2nappi'>Nappi:</label>
  <textarea name='mokki2nappi' style='height:30px;'>".$info["mokki2nappi"]."</textarea>
  </div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='cabinrentfi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='cabinrenten'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='cabinrentnl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='cabinrentfi'>";
  }
  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div></div>";

$stmt = $conn->prepare("SELECT kuva1, kuva2, mokki1kuva, mokki2kuva FROM mokkivuokraus_sivu LIMIT 1");
$stmt->execute();
$stmt->bind_result($db_kuva1, $db_kuva2, $db_mokkikuva1, $db_mokkikuva2);
	while($stmt->fetch()){
		$kuva1 = $db_kuva1;	
    $kuva2 = $db_kuva2;		
    $mokkikuva1=$db_mokkikuva1;
    $mokkikuva2=$db_mokkikuva2;
    }
$stmt->close();

echo "<div class='cabinimages'><div class='form changeimg'>
<h4>Vaihda mökin 1 kuva:</h4>
<form action='update.php' method='post' enctype='multipart/form-data'>
  <label for='cabin1image'><img src=".$mokkikuva1." style='width:90%;'></label><br>
  <input type='file' id='cabin1image' name='cabin1image'><br>
  <input type='hidden' name='toiminto' value='cabin1image'><br>
  <input type='submit' value='Vaihda kuva' name='submit' class='submit'>
</form>
</div>";
echo "<div class='form changeimg'>
<h4>Vaihda mökin 2 kuva:</h4>
<form action='update.php' method='post' enctype='multipart/form-data'>
  <label for='cabin2image'><img src=".$mokkikuva2." style='width:90%;'></label><br>
  <input type='file' id='cabin2image' name='cabin2image'><br>
  <input type='hidden' name='toiminto' value='cabin2image'><br>
  <input type='submit' value='Vaihda kuva' name='submit' class='submit'>
</form>
</div></div>";
echo "<div class='cabinimages'><div class='form changeimg'>
<h4>Vaihda esittelykuva 1:</h4>
<form action='update.php' method='post' enctype='multipart/form-data'>
  <label for='rentimage1'><img src=".$kuva1." style='width:90%;'></label><br>
  <input type='file' id='rentimage1' name='rentimage1'><br>
  <input type='hidden' name='toiminto' value='rentimage1'><br>
  <input type='submit' value='Vaihda kuva' name='submit' class='submit'>
</form>
</div>";
echo "<div class='form changeimg'>
<h4>Vaihda esittelykuva 2:</h4>
<form action='update.php' method='post' enctype='multipart/form-data'>
  <label for='rentimage2'><img src=".$kuva2." style='width:90%;'></label><br>
  <input type='file' id='rentimage2' name='rentimage2'><br>
  <input type='hidden' name='toiminto' value='rentimage2'><br>
  <input type='submit' value='Vaihda kuva' name='submit' class='submit'>
</form>
</div></div></div>";

?>