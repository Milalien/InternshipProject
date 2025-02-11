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
		
		$stmt = $conn->prepare("SELECT esittelyteksti,alaOtsikko FROM matkat_sivu WHERE kieli=?");
		$stmt->bind_param("s", $lang);
		$stmt->execute();
        $result = $stmt->get_result();
        $matkat = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
		$stmt = $conn->prepare("SELECT yhteystiedot FROM yhteystiedot_sivu WHERE kieli=?");
		$stmt->bind_param("s", $lang);
		$stmt->execute();
        $stmt->bind_result($db_yhteystiedot);
        while($stmt->fetch()){
           $yhteystiedot = $db_yhteystiedot;
        }
        $stmt->close();
		
		echo "<div class='subPage2'>
				<div class='main'>
					<div id='natureCarousel' class='carousel slide carousel-fade'>";
					$stmt = $conn->prepare("SELECT jarjestys FROM matka_slider_kuvat ORDER BY jarjestys LIMIT 1");
                    $stmt->execute();
    
                    $stmt->bind_result($db_jarjestys);
                    while($stmt->fetch()){
                        $pienin = $db_jarjestys;
                    }
                    $stmt->close();
                    $stmt = $conn->prepare("SELECT id, jarjestys, kuva FROM matka_slider_kuvat ORDER BY jarjestys DESC;");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    echo "<div class='carousel-inner'>";
                    while($row = $result->fetch_assoc()) {
                       $kuva = $row["kuva"];
                        if($row["jarjestys"] == $pienin){
                            echo <<<EOD
                                <div class="carousel-item active" data-bs-interval="10000">
                                <img src="images/Empty_nature.png" style="background-image: url('$kuva'); " class="slide">
                                </div>
                                EOD;
                        } else{
                            echo <<<EOD
                                <div class="carousel-item" data-bs-interval="10000">
                                <img src="images/Empty_nature.png" style="background-image: url('$kuva');" class="slide">
                                </div> 
                                EOD;
                        }
                    }
                    echo "</div>";
                    $stmt->close();
					echo "<button class='carousel-control-prev' type='button' data-bs-target='#natureCarousel' data-bs-slide='prev'>
                    <span class='carousel-control-prev-icon'></span>
                </button>
                <button class='carousel-control-next' type='button' data-bs-target='#natureCarousel' data-bs-slide='next'>
                    <span class='carousel-control-next-icon'></span>
                </button>
            </div>
			<div class='text-area'>
				".$matkat["esittelyteksti"]."
				<div class='text-center'>
				<h4>".$matkat["alaOtsikko"]."</h4>
				".$yhteystiedot."
				</div>
			</div>
		</div>
	</div></div>";
include "footer.php";
		?>

</body>

</html>