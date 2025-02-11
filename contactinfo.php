<?php
session_start();
if(isset($_GET["la"]) && $_GET["la"]!= $_SESSION["la"]){
	$_SESSION["la"] = $_GET["la"];
	$lang = $_SESSION["la"];
} elseif(isset($_SESSION["la"])){
	$lang = $_SESSION["la"];
} else {
	$_SESSION["la"] = "fi";
	$lang = $_SESSION["la"];
}

		include "header.php";
		
		$stmt = $conn->prepare("SELECT otsikko, yritysNimi, ytunnus, yhteystiedot, postiosOtsikko, postiosoite, kayntiosOtsikko, kayntiosoite FROM yhteystiedot_sivu WHERE kieli=?");
		$stmt->bind_param("s", $lang);
		$stmt->execute();
        $result = $stmt->get_result();
        $yhteystietosivu = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
		
		echo "<div class='subPage3'>
		<div class='main'>
			<h1>".$yhteystietosivu["otsikko"]."</h1>
			<div>
				<div>
					<h4>".$yhteystietosivu["yritysNimi"]."</h4>
					<h6>".$yhteystietosivu["ytunnus"]."</h6>
					<br>
					".$yhteystietosivu["yhteystiedot"]."
				</div>
				<div>
					<h5>".$yhteystietosivu["postiosOtsikko"]."</h5>
					<p>".$yhteystietosivu["postiosoite"]."</p>
				</div>
				<div>
                    <h5>".$yhteystietosivu["kayntiosOtsikko"]."</h5>
                    <p>".$yhteystietosivu["kayntiosoite"]."</p>
                </div>

            </div>

        </div>";
		$stmt = $conn->prepare("SELECT mokkiOtsikko, mokkiTeksti, mokkiNappi1,airbnb, mokkiNappi2, matkaOtsikko, matkaTeksti, matkaNappi FROM mainoslaatikot WHERE kieli=?");
        $stmt->bind_param("s", $lang);
        $stmt->execute();
        $result = $stmt->get_result();
        $ads = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
		echo "<div class='side'>
			<div class='ad'>
				<h3>".$ads["mokkiOtsikko"]."</h3>
				<h5>".$ads["mokkiTeksti"]."</h5>
				<div>
					<a class='btn' href='cabinrent.php' role='button'>".$ads["mokkiNappi1"]."</a>";
					if($ads["airbnb"]!=null){
					echo "<a class='btn' href=".$ads["airbnb"]." role='button'>".$ads["mokkiNappi2"]."</a>";
					}
				echo "</div>

			</div>
			<div class='ad'>
				<h3>".$ads["matkaOtsikko"]."</h3>
				<h5>".$ads["matkaTeksti"]."</h5>
				<div>
					<a class='btn' href='naturetrips.php' role='button'>".$ads["matkaNappi"]."</a>
				</div>
			</div>
		</div>
	</div> </div>";
	
	include "footer.php";
		?>

       
</body>

</html>