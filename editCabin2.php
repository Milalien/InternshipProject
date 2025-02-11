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
$conn = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT video, esittelyteksti,nappi1,varausOsoite,nappi2,hinnasto,alaOtsikko1,sijainti,kartta,alaOtsikko2 FROM mokki2_sivu WHERE kieli=?");
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);

echo "<div class='editSubPage'><h1>Mökki 2 sivun muokkaus</h1><div class='subPageForms'><div class='form subPage'>";
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
  <label for='esittelyteksti'>Alateksti 1:</label>
  <textarea class='editable' name='esittelyteksti'>".$info["esittelyteksti"]."</textarea>
  <label for='nappi1'>Nappi 1:</label>
  <textarea name='nappi1' style='height:30px;'>".$info["nappi1"]."</textarea>
  <label for='varausOsoite'>Varaussivun osoite:</label>
  <textarea name='varausOsoite' style='height:50px;'>".$info["varausOsoite"]."</textarea>
  <label for='nappi2'>Nappi 2:</label>
  <textarea name='nappi2' style='height:30px;'>".$info["nappi2"]."</textarea>
  <label for='hinnasto'>Hinnasto:</label>
  <textarea class='editable' name='hinnasto' style='height:200px;'>".$info["hinnasto"]."</textarea>
  <label for='alaOtsikko1'>Alaotsikko 1:</label>
  <textarea name='alaOtsikko1' style='height:30px;'>".$info["alaOtsikko1"]."</textarea>
  <label for='sijainti'>Sijainti:</label>
  <textarea class='editable' name='sijainti'>".$info["sijainti"]."</textarea>
  <label for='alaOtsikko2'>Alaotsikko 2:</label>
  <textarea name='alaOtsikko2' style='height:30px;'>".$info["alaOtsikko2"]."</textarea>
  </div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='cabin2fi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='cabin2en'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='cabin2nl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='cabin2fi'>";
  }
  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div>";


echo "<div class='form subPage'>
<h4>Kartta-upotuksen muokkaus:</h4>
<form action='update.php' method='post' enctype='multipart/form-data'>
<div><label for='kartta'>Kartta:</label>
<textarea name='kartta' style='height:200px;'>".$info["kartta"]."</textarea>
</div><div><input type='hidden' name='toiminto' value='cabin2map'>
<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div>";
echo "<div class='form subPage'>
<h4>Videon vaihto / muokkaus:</h4>
<form action='update.php' method='post' enctype='multipart/form-data'>
<div><label for='video'>Videon osoite:</label>
<textarea name='video' style='height:200px;'>".$info["video"]."</textarea>
</div><div><input type='hidden' name='toiminto' value='cabin2video'>
<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div></div>";

?>
<h2>Sliderin muokkaus:</h2>
<div class="sliderForms subslider">

<div class="form addSlide">
<h4>Lisää uusi:</h4>
<form action="update.php" method="post" enctype="multipart/form-data">
  <label for="slideCabin2">Valitse uusi slider-kuva:</label><br>
  <input type="file" id="slideCabin2" name="slideCabin2"><br>
  <input type="hidden" name="toiminto" value="newSlideCabin2"><br>
  <input type="submit" value="Lähetä" name="submit" class="submit">
</form>
</div>

<div class="form order">
<h5>Muokkaa järjestystä raahaamalla ja poista kuvia:</h5>
<form action="update.php" method="post" enctype="multipart/form-data">
  <?php
  $stmt = $conn->prepare("SELECT id, jarjestys, kuva FROM mokki2_slider_kuvat ORDER BY jarjestys;");
  $stmt->execute();
  $result = $stmt->get_result();
  echo "<input type='hidden' name='uusiJarjestys' id='uusiJarjestys'/>
  <ul id='sortable'>";
  while($row = $result->fetch_assoc()) {
    echo "<li class='ui-state-default' id=".$row["id"].">
	<img src=".$row["kuva"]."><a href='update.php?toiminto=deleteSlideCabin2&id=".$row["id"]."' type='button' class='btn'>Poista</a>
	</li>";
    
  }
  echo "</ul>";
	$stmt->close();
	$conn->close();
  ?>
  <input type="hidden" name="toiminto" value="slideOrderCabin2"><br>
  <input type="submit" value="Päivitä" name="submit" class="submit">
</form>
</div>
<script>
  $( function() {
   
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight",
		update: function( event, ui ) {
			var jarjestys1 = new Array();
			
			$( "li" ).each( function( index, element ){
				jarjestys1.push($(this).attr("id"));
			});
			$('#uusiJarjestys').val(jarjestys1);
		}
	});
	
  } );
  </script>