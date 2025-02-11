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
		
		$stmt = $conn->prepare("SELECT ylaOtsikko,alaOtsikko1,alaOtsikko2, esittelyteksti,kuva1,kuva2,mokki1kuva, mokki1otsikko, mokki1kuvaus, mokki1nappi,mokki2kuva,mokki2otsikko,mokki2kuvaus,mokki2nappi FROM mokkivuokraus_sivu WHERE kieli=?");
		$stmt->bind_param("s", $lang);
		$stmt->execute();
        $result = $stmt->get_result();
        $majoitus = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
		
		echo "<div class='subPage'>
				<div class='main'>
				<h1>".$majoitus["ylaOtsikko"]."</h1>
				<div class='text-area'>
					<div>
						<h2>".$majoitus["alaOtsikko1"]."</h2>
						<img src=".$majoitus["kuva1"]." style='width:100%; margin:0 auto 10px auto;' alt=''>
						".$majoitus["esittelyteksti"]."
						<img src=".$majoitus["kuva2"]." style='width:100%;  margin:10px auto 0 auto;' alt=''>
					</div>
					<div>
						<h2>".$majoitus["alaOtsikko2"]."</h2>
						<div class='card'>
                            <img src=".$majoitus["mokki1kuva"]."  alt=''>
                            <div class='card-body'>
                                <h4 class='card-title'>".$majoitus["mokki1otsikko"]."</h4>
                                <p class='card-text'>".$majoitus["mokki1kuvaus"]."</p>
                                <a href='cabinInfo1.php' class='btn'>".$majoitus["mokki1nappi"]."</a>
                            </div>
                        </div>
                        <div class='card'>
                            <img src=".$majoitus["mokki2kuva"]." alt=''>
                            <div class='card-body'>
                                <h4 class='card-title'>".$majoitus["mokki2otsikko"]."</h4>
                                <p class='card-text'>".$majoitus["mokki2kuvaus"]."</p>
                                <a href='cabinInfo2.php' class='btn'>".$majoitus["mokki2nappi"]."</a>
                            </div>
                        </div>
					</div>
				</div>
            </div>
        </div>
    	</div>";
	include "footer.php";
		?>
	
</body>

</html>