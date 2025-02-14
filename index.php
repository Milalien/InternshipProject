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

        $stmt = $conn->prepare("SELECT esittelyteksti,laatikko1,laatikko2,laatikko3,napit FROM etusivu_tekstit WHERE kieli=?");
        $stmt->bind_param("s", $lang);
        $stmt->execute();
        $result = $stmt->get_result();
        $texts = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();

        echo "<div class='frontpage'>
        <div class='main'>
            ".$texts["esittelyteksti"]."
        <div class='crd'>
        <div class='txt'>
            ".$texts["laatikko1"]."
        </div>
        <div class='action'>
            <a class='btn' href='service1.php' role='button'>".$texts["napit"]."</a>
        </div>
    </div>
    <div class='crd'>
        <div class='txt'>
             ".$texts["laatikko2"]."
        </div>
        <div class='action'>
            <a class='btn' href='cabinrent.php' role='button'>".$texts["napit"]."</a>
        </div>
    </div>
    <div class='crd'>
        <div class='txt'>
             ".$texts["laatikko3"]."
        </div>
        <div class='action'>

            <a class='btn' href='naturetrips.php' role='button'>".$texts["napit"]."</a>
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
</div></div>";
include "footer.php";
?>

</body>

</html>