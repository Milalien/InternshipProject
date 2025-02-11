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

$stmt = $conn->prepare("SELECT esittelyteksti,alaOtsikko FROM matkat_sivu WHERE kieli=?");
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_array(MYSQLI_ASSOC);
echo "<div class='editSubPage'><h1>Luontomatkasivun muokkaus</h1><div class='subPageForms'><div class='form subPage'>";
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
  <label for='alaOtsikko'>Alaotsikko:</label>
  <textarea name='alaOtsikko' style='height:30px;'>".$info["alaOtsikko"]."</textarea>
  </div><div>";
  switch($lang){
    case "fi":
      echo "<input type='hidden' name='toiminto' value='naturefi'>";
      break;
    case "en":
      echo "<input type='hidden' name='toiminto' value='natureen'>";
      break;
    case "nl":
      echo "<input type='hidden' name='toiminto' value='naturenl'>";
      break;
    default:
      echo "<input type='hidden' name='toiminto' value='naturefi'>";
  }

  echo "<input type='submit' value='Päivitä' name='submit' class='submit'></div>
</form></div></div></div>";

?>
<h2>Sliderin muokkaus:</h2>
<div class="sliderForms subslider">

<div class="form addSlide">
<h4>Lisää uusi:</h4>
<form action="update.php" method="post" enctype="multipart/form-data">
  <label for="slideNature">Valitse uusi slider-kuva:</label><br>
  <input type="file" id="slideNature" name="slideNature"><br>
  <input type="hidden" name="toiminto" value="newSlideNature"><br>
  <input type="submit" value="Lähetä" name="submit" class="submit">
</form>
</div>

<div class="form order">
<h5>Muokkaa järjestystä raahaamalla ja poista kuvia:</h5>
<form action="update.php" method="post" enctype="multipart/form-data">
  <?php
  $stmt = $conn->prepare("SELECT id, jarjestys, kuva FROM matka_slider_kuvat ORDER BY jarjestys;");
  $stmt->execute();
  $result = $stmt->get_result();
  echo "<input type='hidden' name='uusiJarjestys' id='uusiJarjestys'/>
  <ul id='sortable'>";
  while($row = $result->fetch_assoc()) {
    echo "<li class='ui-state-default' id=".$row["id"].">
	<img src=".$row["kuva"]."><a href='update.php?toiminto=deleteSlideNature&id=".$row["id"]."' type='button' class='btn'>Poista</a>
	</li>";
    
  }
  echo "</ul>";
	$stmt->close();
	$conn->close();
  ?>
  <input type="hidden" name="toiminto" value="slideOrderNature"><br>
  <input type="submit" value="Päivitä" name="submit" class="submit">
</form>
</div></div>
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