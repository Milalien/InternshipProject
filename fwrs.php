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
		
		$stmt = $conn->prepare("SELECT otsikko,esittelyteksti,kuva FROM tutkimus_sivu WHERE kieli=?");
		$stmt->bind_param("s", $lang);
		$stmt->execute();
        $result = $stmt->get_result();
        $fwrs = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
		
		echo "<div class='subPage'>
		<div class='main'>
			<h1>".$fwrs["otsikko"]."</h1>
			<div class='text-area'>
				<div>
					".$fwrs["esittelyteksti"]."
                   
                </div>
                <div>
                    <img src=".$fwrs["kuva"]." width='100%' alt=''>
                </div>
            </div>
        </div>
    </div> </div>";
		include "footer.php";
		?>
        
                    
   
</body>

</html>