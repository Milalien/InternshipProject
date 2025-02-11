<?php
require "config.php";
if ($_SESSION["loggedin"]!=1){
	header("location: login.html");
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
?>
<h1>Sliderin muokkaus</h1>
<div class="sliderForms">
  
<div class="form addSlide">
<h4>Lisää uusi:</h4>
<form action="update.php" method="post" enctype="multipart/form-data">
  <label for="slide">Valitse uusi slider-kuva:</label><br>
  <input type="file" id="slide" name="slide"><br>
  <input type="hidden" name="toiminto" value="newSlide"><br>
  <input type="submit" value="Lähetä" name="submit" class="submit">
</form>
</div>

<div class="form order">
<h5>Muokkaa järjestystä raahaamalla ja poista kuvia:</h5>
<form action="update.php" method="post" enctype="multipart/form-data">
  <?php
  $stmt = $conn->prepare("SELECT id, jarjestys, kuva FROM slider_kuvat ORDER BY jarjestys;");
  $stmt->execute();
  $result = $stmt->get_result();
  echo "<input type='hidden' name='uusiJarjestys' id='uusiJarjestys'/>
  <ul id='sortable'>";
  while($row = $result->fetch_assoc()) {
    echo "<li class='ui-state-default' id=".$row["id"].">
	<img src=".$row["kuva"]."><a href='update.php?toiminto=deleteSlide&id=".$row["id"]."' type='button' class='btn'><i class='bi bi-trash3-fill'></i></a>
	</li>";
    
  }
  echo "</ul>";
	$stmt->close();
	$conn->close();
  ?>
  <input type="hidden" name="toiminto" value="slideOrder"><br>
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