<?php
session_start();
if ($_SESSION["loggedin"]!=1){
	header("location: login.html");
}
require "config.php";

$conn = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Toiminnon valinta:
if(isset($_POST["toiminto"])){
	$toiminto = $_POST["toiminto"];
}
if(isset($_GET["toiminto"])){
	$toiminto = $_GET["toiminto"];
}
if($toiminto == "frontpagefi"){
	$stmt = $conn->prepare("UPDATE etusivu_tekstit SET esittelyteksti=?, laatikko1=?,
	laatikko2=?, laatikko3=?, napit=? WHERE kieli='fi'");
	$stmt->bind_param("sssss", $esittelyteksti,$laatikko1,$laatikko2,$laatikko3,$napit);
	$esittelyteksti=$_POST["esittelyteksti"];
	$laatikko1=$_POST["laatikko1"];
	$laatikko2=$_POST["laatikko2"];
	$laatikko3=$_POST["laatikko3"];
	$napit=$_POST["napit"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editIndex");
}
if($toiminto == "frontpageen"){
	$stmt = $conn->prepare("UPDATE etusivu_tekstit SET esittelyteksti=?, laatikko1=?,
	laatikko2=?, laatikko3=?, napit=? WHERE kieli='en'");
	$stmt->bind_param("sssss", $esittelyteksti,$laatikko1,$laatikko2,$laatikko3,$napit);
	$esittelyteksti=$_POST["esittelyteksti"];
	$laatikko1=$_POST["laatikko1"];
	$laatikko2=$_POST["laatikko2"];
	$laatikko3=$_POST["laatikko3"];
	$napit=$_POST["napit"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editIndex");
}
if($toiminto == "frontpagenl"){
	$stmt = $conn->prepare("UPDATE etusivu_tekstit SET esittelyteksti=?, laatikko1=?,
	laatikko2=?, laatikko3=?, napit=? WHERE kieli='nl'");
	$stmt->bind_param("sssss", $esittelyteksti,$laatikko1,$laatikko2,$laatikko3,$napit);
	$esittelyteksti=$_POST["esittelyteksti"];
	$laatikko1=$_POST["laatikko1"];
	$laatikko2=$_POST["laatikko2"];
	$laatikko3=$_POST["laatikko3"];
	$napit=$_POST["napit"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editIndex");
}
if($toiminto == "menufi"){
	$stmt = $conn->prepare("UPDATE ylavalikko SET valikko1=?,valikko2=?,valikko3=?,pudotusvalikko=?,alavalikko1=?,alavalikko2=?,alavalikko3=?,valikko4=? WHERE kieli='fi'");
	$stmt->bind_param("ssssssss", $valikko1,$valikko2,$valikko3,$pudotusvalikko,$alavalikko1,$alavalikko2,$alavalikko3,$valikko4);
	$valikko1=$_POST["valikko1"];
	$valikko2=$_POST["valikko2"];
	$valikko3=$_POST["valikko3"];
	$pudotusvalikko=$_POST["pudotusvalikko"];
	$alavalikko1=$_POST["alavalikko1"];
	$alavalikko2=$_POST["alavalikko2"];
	$alavalikko3=$_POST["alavalikko3"];
	$valikko4=$_POST["valikko4"];
	
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editMenu");
}
if($toiminto == "menuen"){
	$stmt = $conn->prepare("UPDATE ylavalikko SET valikko1=?,valikko2=?,valikko3=?,pudotusvalikko=?,alavalikko1=?,alavalikko2=?,alavalikko3=?,valikko4=? WHERE kieli='en'");
	$stmt->bind_param("ssssssss", $valikko1,$valikko2,$valikko3,$pudotusvalikko,$alavalikko1,$alavalikko2,$alavalikko3,$valikko4);
	$valikko1=$_POST["valikko1"];
	$valikko2=$_POST["valikko2"];
	$valikko3=$_POST["valikko3"];
	$pudotusvalikko=$_POST["pudotusvalikko"];
	$alavalikko1=$_POST["alavalikko1"];
	$alavalikko2=$_POST["alavalikko2"];
	$alavalikko3=$_POST["alavalikko3"];
	$valikko4=$_POST["valikko4"];
	
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editMenu");
}
if($toiminto == "menunl"){
	$stmt = $conn->prepare("UPDATE ylavalikko SET valikko1=?,valikko2=?,valikko3=?,pudotusvalikko=?,alavalikko1=?,alavalikko2=?,alavalikko3=?,valikko4=? WHERE kieli='nl'");
	$stmt->bind_param("ssssssss", $valikko1,$valikko2,$valikko3,$pudotusvalikko,$alavalikko1,$alavalikko2,$alavalikko3,$valikko4);
	$valikko1=$_POST["valikko1"];
	$valikko2=$_POST["valikko2"];
	$valikko3=$_POST["valikko3"];
	$pudotusvalikko=$_POST["pudotusvalikko"];
	$alavalikko1=$_POST["alavalikko1"];
	$alavalikko2=$_POST["alavalikko2"];
	$alavalikko3=$_POST["alavalikko3"];
	$valikko4=$_POST["valikko4"];
	
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editMenu");
}
if($toiminto == "newSlide") {
	$target_dir = "mainSlider/";
	$target_file = $target_dir . basename($_FILES["slide"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["slide"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";
		$uploadOk = 0;
	}
	if ($_FILES["slide"]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Pahoittelut, vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Pahoittelut, tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editSlider");
	} else {
		if (move_uploaded_file($_FILES["slide"]["tmp_name"], $target_file)) {
			$stmt = $conn->prepare("SELECT jarjestys FROM slider_kuvat ORDER BY jarjestys DESC LIMIT 1");
			$stmt->execute();

			$stmt->bind_result($db_jarjestys);
			while($stmt->fetch()){
				$isoin = $db_jarjestys;
			}
			$stmt->close();

			$stmt = $conn->prepare("INSERT INTO slider_kuvat (jarjestys, kuva) VALUES (?,?)");
			$stmt->bind_param("is", $jarjestys, $kuva);
			$jarjestys = $isoin+1;
			$kuva = $target_file;
			$stmt->execute();
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["slide"]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editSlider");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Pahoittelut, tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editSlider");
			
		}
	}
}
if($toiminto == "slideOrder") {
	
	$data = $_POST["uusiJarjestys"];

	$newarray = explode(",", $data);
	
	$i = count($newarray);
	
	for($x=0;$x<=$i;$x++){
		$id=(int)$newarray[$x];
		$stmt = $conn->prepare("UPDATE slider_kuvat SET jarjestys=? WHERE id=?");
		$stmt->bind_param("ii", $x, $id);
		$status = $stmt->execute() or die ($stmt->error);
	}

	$stmt->close();
	$_SESSION["uploadSuccess"] = "Järjestys päivitetty";
	header("location: adminpage.php?page=editSlider");
}
if($toiminto == "deleteSlide"){
	$deleteID = $_GET["id"];
	$stmt = $conn->prepare("SELECT kuva FROM slider_kuvat WHERE id=?");
	$stmt->bind_param("i", $deleteID);
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->bind_result($db_kuva);
	while($stmt->fetch()){
		$kuva = $db_kuva;
    }
	$stmt->close();
	if(unlink($kuva)){
		$stmt = $conn->prepare("DELETE FROM slider_kuvat WHERE id=?");
		$stmt->bind_param("i", $deleteID);
		$status = $stmt->execute() or die ($stmt->error);
		$_SESSION["uploadSuccess"] = "Kuva poistettu onnistuneesti";
	} else {
		$_SESSION["uploadSuccess"] = "Kuvan poistaminen ei onnistunut";
	}
	header("location: adminpage.php?page=editSlider");
	
}

if($toiminto == "adsfi"){
	$stmt = $conn->prepare("UPDATE mainoslaatikot SET mokkiOtsikko=?, mokkiTeksti=?, mokkiNappi1=?,airbnb=?,
	mokkiNappi2=?, matkaOtsikko=?, matkaTeksti=?,matkaNappi=? WHERE kieli='fi'");
	$stmt->bind_param("ssssssss", $mokkiOtsikko, $mokkiTeksti,$mokkiNappi1,$airbnb,$mokkiNappi2,$matkaOtsikko,$matkaTeksti,$matkaNappi);
	$mokkiOtsikko=$_POST["mokkiOtsikko"];
	$mokkiTeksti=$_POST["mokkiTeksti"];
	$mokkiNappi1=$_POST["mokkiNappi1"];
	$airbnb=$_POST["airbnb"];
	$mokkiNappi2=$_POST["mokkiNappi2"];
	$matkaOtsikko=$_POST["matkaOtsikko"];
	$matkaTeksti=$_POST["matkaTeksti"];
	$matkaNappi=$_POST["matkaNappi"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tekstit päivitetty onnistuneesti";
	header("location: adminpage.php?page=editAds");
}
if($toiminto == "adsen"){
	$stmt = $conn->prepare("UPDATE mainoslaatikot SET mokkiOtsikko=?, mokkiTeksti=?, mokkiNappi1=?,airbnb=?,
	mokkiNappi2=?, matkaOtsikko=?, matkaTeksti=?,matkaNappi=? WHERE kieli='en'");
	$stmt->bind_param("ssssssss", $mokkiOtsikko, $mokkiTeksti,$mokkiNappi1,$airbnb,$mokkiNappi2,$matkaOtsikko,$matkaTeksti,$matkaNappi);
	$mokkiOtsikko=$_POST["mokkiOtsikko"];
	$mokkiTeksti=$_POST["mokkiTeksti"];
	$mokkiNappi1=$_POST["mokkiNappi1"];
	$airbnb=$_POST["airbnb"];
	$mokkiNappi2=$_POST["mokkiNappi2"];
	$matkaOtsikko=$_POST["matkaOtsikko"];
	$matkaTeksti=$_POST["matkaTeksti"];
	$matkaNappi=$_POST["matkaNappi"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tekstit päivitetty onnistuneesti";
	header("location: adminpage.php?page=editAds");
}
if($toiminto == "adsnl"){
	$stmt = $conn->prepare("UPDATE mainoslaatikot SET mokkiOtsikko=?, mokkiTeksti=?, mokkiNappi1=?,airbnb=?,
	mokkiNappi2=?, matkaOtsikko=?, matkaTeksti=?,matkaNappi=? WHERE kieli='nl'");
	$stmt->bind_param("ssssssss", $mokkiOtsikko, $mokkiTeksti,$mokkiNappi1,$airbnb,$mokkiNappi2,$matkaOtsikko,$matkaTeksti,$matkaNappi);
	$mokkiOtsikko=$_POST["mokkiOtsikko"];
	$mokkiTeksti=$_POST["mokkiTeksti"];
	$mokkiNappi1=$_POST["mokkiNappi1"];
	$airbnb=$_POST["airbnb"];
	$mokkiNappi2=$_POST["mokkiNappi2"];
	$matkaOtsikko=$_POST["matkaOtsikko"];
	$matkaTeksti=$_POST["matkaTeksti"];
	$matkaNappi=$_POST["matkaNappi"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tekstit päivitetty onnistuneesti";
	header("location: adminpage.php?page=editAds");
}
if($toiminto == "companyimage"){
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";
		$stmt = $conn->prepare("UPDATE yritysesittely SET kuva=?");
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadInfo"] = "Tiedosto nimellä ". htmlspecialchars( basename( $_FILES["image"]["name"])). " on jo olemassa, ja vaihdettu valittuun sijaintiin onnistuneesti.";
			
		$uploadOk = 0;
	}
	if ($_FILES["image"]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Pahoittelut, vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Pahoittelut, tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editCompanyInfo");
	} else {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			

			$stmt = $conn->prepare("UPDATE yritysesittely SET kuva=?");
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["image"]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editCompanyInfo");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editCompanyInfo");
			
		}
	}
} 
if ($toiminto=="companyfi"){
	$stmt = $conn->prepare("UPDATE yritysesittely SET otsikko=?,esittelyteksti=? WHERE kieli='fi'");
	$stmt->bind_param("ss", $otsikko, $esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCompanyInfo");
}
if ($toiminto=="companyen"){
	$stmt = $conn->prepare("UPDATE yritysesittely SET otsikko=?,esittelyteksti=? WHERE kieli='en'");
	$stmt->bind_param("ss", $otsikko, $esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCompanyInfo");
}
if ($toiminto=="companynl"){
	$stmt = $conn->prepare("UPDATE yritysesittely SET otsikko=?,esittelyteksti=? WHERE kieli='nl'");
	$stmt->bind_param("ss", $otsikko, $esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCompanyInfo");
}
if($toiminto == "aboutimage"){
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["abimg"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["abimg"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";
		$stmt = $conn->prepare("UPDATE omaesittely SET kuva=?");
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadInfo"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["abimg"]["name"])). " on vaihdettu valittuun sijaintiin onnistuneesti.";

			
			
		$uploadOk = 0;
	}
	if ($_FILES["abimg"]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editAboutme");
	} else {
		if (move_uploaded_file($_FILES["abimg"]["tmp_name"], $target_file)) {
			

			$stmt = $conn->prepare("UPDATE omaesittely SET kuva=?");
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["abimg"]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editAboutme");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editAboutme");
			
		}
	}
}
if ($toiminto=="aboutfi"){
	$stmt = $conn->prepare("UPDATE omaesittely SET otsikko=?,esittelyteksti=? WHERE kieli='fi'");
	$stmt->bind_param("ss", $otsikko, $esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editAboutme");
}
if ($toiminto=="abouten"){
	$stmt = $conn->prepare("UPDATE omaesittely SET otsikko=?,esittelyteksti=? WHERE kieli='en'");
	$stmt->bind_param("ss", $otsikko, $esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editAboutme");
}
if ($toiminto=="aboutnl"){
	$stmt = $conn->prepare("UPDATE omaesittely SET otsikko=?,esittelyteksti=? WHERE kieli='nl'");
	$stmt->bind_param("ss", $otsikko, $esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editAboutme");
}
if ($toiminto == "FWRSimage"){
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["fwrsimg"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fwrsimg"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";

			$stmt = $conn->prepare("UPDATE tutkimus_sivu SET kuva=?");
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadInfo"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["fwrsimg"]["name"])). " on vaihdettu valittuun sijaintiin onnistuneesti.";
			
		
		$uploadOk = 0;
	}
	if ($_FILES["fwrsimg"]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editFWRS");
	} else {
		if (move_uploaded_file($_FILES["fwrsimg"]["tmp_name"], $target_file)) {
			

			$stmt = $conn->prepare("UPDATE tutkimus_sivu SET kuva=?");
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["fwrsimg"]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editFWRS");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editFWRS");
			
		}
	}
}
if($toiminto == "FWRSfi"){
	$stmt = $conn->prepare("UPDATE tutkimus_sivu SET otsikko=?,esittelyteksti=? WHERE kieli='fi'");
	$stmt->bind_param("ss", $otsikko,$esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editFWRS");
}
if($toiminto == "FWRSen"){
	$stmt = $conn->prepare("UPDATE tutkimus_sivu SET otsikko=?,esittelyteksti=? WHERE kieli='en'");
	$stmt->bind_param("ss", $otsikko,$esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editFWRS");
}
if($toiminto == "FWRSnl"){
	$stmt = $conn->prepare("UPDATE tutkimus_sivu SET otsikko=?,esittelyteksti=? WHERE kieli='nl'");
	$stmt->bind_param("ss", $otsikko,$esittelyteksti);
	$otsikko=$_POST["otsikko"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editFWRS");
}
if($toiminto == "newSlideNature") {
	$target_dir = "natureSlider/";
	$target_file = $target_dir . basename($_FILES["slideNature"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["slideNature"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";
		$uploadOk = 0;
	}
	if ($_FILES["slideNature"]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Pahoittelut, vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Pahoittelut, tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editNaturetrips");
	} else {
		if (move_uploaded_file($_FILES["slideNature"]["tmp_name"], $target_file)) {
			$stmt = $conn->prepare("SELECT jarjestys FROM matka_slider_kuvat ORDER BY jarjestys DESC LIMIT 1");
			$stmt->execute();

			$stmt->bind_result($db_jarjestys);
			while($stmt->fetch()){
				$isoin = $db_jarjestys;
			}
			$stmt->close();

			$stmt = $conn->prepare("INSERT INTO matka_slider_kuvat (jarjestys, kuva) VALUES (?,?)");
			$stmt->bind_param("is", $jarjestys, $kuva);
			$jarjestys = $isoin+1;
			$kuva = $target_file;
			$stmt->execute();
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["slideNature"]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editNaturetrips");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Pahoittelut, tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editNaturetrips");
			
		}
	}
}
if($toiminto == "slideOrderNature") {
	
	$data = $_POST["uusiJarjestys"];

	$newarray = explode(",", $data);
	
	$i = count($newarray);
	
	for($x=0;$x<=$i;$x++){
		$id=(int)$newarray[$x];
		$stmt = $conn->prepare("UPDATE matka_slider_kuvat SET jarjestys=? WHERE id=?");
		$stmt->bind_param("ii", $x, $id);
		$status = $stmt->execute() or die ($stmt->error);
	}

	$stmt->close();
	$_SESSION["uploadSuccess"] = "Järjestys päivitetty";
	header("location: adminpage.php?page=editNaturetrips");
}
if($toiminto == "deleteSlideNature"){
	$deleteID = $_GET["id"];
	$stmt = $conn->prepare("SELECT kuva FROM matka_slider_kuvat WHERE id=?");
	$stmt->bind_param("i", $deleteID);
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->bind_result($db_kuva);
	while($stmt->fetch()){
		$kuva = $db_kuva;
    }
	$stmt->close();
	if(unlink($kuva)){
		$stmt = $conn->prepare("DELETE FROM matka_slider_kuvat WHERE id=?");
		$stmt->bind_param("i", $deleteID);
		$status = $stmt->execute() or die ($stmt->error);
		$_SESSION["uploadSuccess"] = "Kuva poistettu onnistuneesti";
	} else {
		$_SESSION["uploadSuccess"] = "Kuvan poistaminen ei onnistunut";
	}
	header("location: adminpage.php?page=editNaturetrips");
	
}
if($toiminto == "naturefi"){
	$stmt = $conn->prepare("UPDATE matkat_sivu SET esittelyteksti=?,alaOtsikko=? WHERE kieli='fi'");
	$stmt->bind_param("ss", $esittelyteksti,$alaOtsikko);
	$esittelyteksti=$_POST["esittelyteksti"];
	$alaOtsikko=$_POST["alaOtsikko"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editNaturetrips");
}if($toiminto == "natureen"){
	$stmt = $conn->prepare("UPDATE matkat_sivu SET esittelyteksti=?,alaOtsikko=? WHERE kieli='en'");
	$stmt->bind_param("ss", $esittelyteksti,$alaOtsikko);
	$esittelyteksti=$_POST["esittelyteksti"];
	$alaOtsikko=$_POST["alaOtsikko"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editNaturetrips");
}if($toiminto == "naturenl"){
	$stmt = $conn->prepare("UPDATE matkat_sivu SET esittelyteksti=?,alaOtsikko=? WHERE kieli='nl'");
	$stmt->bind_param("ss", $esittelyteksti,$alaOtsikko);
	$esittelyteksti=$_POST["esittelyteksti"];
	$alaOtsikko=$_POST["alaOtsikko"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editNaturetrips");
}
if($toiminto == "cabinrentfi"){
	$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET ylaOtsikko=?, alaOtsikko1=?,alaOtsikko2=?,esittelyteksti=?,mokki1otsikko=?,mokki1kuvaus=?,mokki1nappi=?,mokki2otsikko=?,mokki2kuvaus=?,mokki2nappi=?  WHERE kieli='fi'");
	$stmt->bind_param("ssssssssss", $ylaOtsikko, $alaOtsikko1,$alaOtsikko2, $esittelyteksti,$mokki1otsikko,$mokki1kuvaus,$mokki1nappi,$mokki2otsikko,$mokki2kuvaus,$mokki2nappi);
	$ylaOtsikko=$_POST["ylaOtsikko"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$mokki1otsikko=$_POST["mokki1otsikko"];
	$mokki1kuvaus=$_POST["mokki1kuvaus"];
	$mokki1nappi=$_POST["mokki1nappi"];
	$mokki2otsikko=$_POST["mokki2otsikko"];
	$mokki2kuvaus=$_POST["mokki2kuvaus"];
	$mokki2nappi=$_POST["mokki2nappi"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabinrent");
}
if($toiminto == "cabinrenten"){
	$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET ylaOtsikko=?, alaOtsikko1=?,alaOtsikko2=?,esittelyteksti=?,mokki1otsikko=?,mokki1kuvaus=?,mokki1nappi=?,mokki2otsikko=?,mokki2kuvaus=?,mokki2nappi=?  WHERE kieli='en'");
	$stmt->bind_param("ssssssssss", $ylaOtsikko, $alaOtsikko1,$alaOtsikko2, $esittelyteksti,$mokki1otsikko,$mokki1kuvaus,$mokki1nappi,$mokki2otsikko,$mokki2kuvaus,$mokki2nappi);
	$ylaOtsikko=$_POST["ylaOtsikko"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$mokki1otsikko=$_POST["mokki1otsikko"];
	$mokki1kuvaus=$_POST["mokki1kuvaus"];
	$mokki1nappi=$_POST["mokki1nappi"];
	$mokki2otsikko=$_POST["mokki2otsikko"];
	$mokki2kuvaus=$_POST["mokki2kuvaus"];
	$mokki2nappi=$_POST["mokki2nappi"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabinrent");
}
if($toiminto == "cabinrentnl"){
	$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET ylaOtsikko=?, alaOtsikko1=?,alaOtsikko2=?,esittelyteksti=?,mokki1otsikko=?,mokki1kuvaus=?,mokki1nappi=?,mokki2otsikko=?,mokki2kuvaus=?,mokki2nappi=?  WHERE kieli='nl'");
	$stmt->bind_param("ssssssssss", $ylaOtsikko, $alaOtsikko1,$alaOtsikko2, $esittelyteksti,$mokki1otsikko,$mokki1kuvaus,$mokki1nappi,$mokki2otsikko,$mokki2kuvaus,$mokki2nappi);
	$ylaOtsikko=$_POST["ylaOtsikko"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$esittelyteksti=$_POST["esittelyteksti"];
	$mokki1otsikko=$_POST["mokki1otsikko"];
	$mokki1kuvaus=$_POST["mokki1kuvaus"];
	$mokki1nappi=$_POST["mokki1nappi"];
	$mokki2otsikko=$_POST["mokki2otsikko"];
	$mokki2kuvaus=$_POST["mokki2kuvaus"];
	$mokki2nappi=$_POST["mokki2nappi"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabinrent");
}
if($toiminto == "cabin1image" || $toiminto == "cabin2image" || $toiminto == "rentimage1" || $toiminto == "rentimage2" ){
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES[$toiminto]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES[$toiminto]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";
		if($toiminto == "cabin1image"){
			$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET mokki1kuva=?");
		} elseif($toiminto == "cabin2image"){
			$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET mokki2kuva=?");
		} elseif($toiminto == "rentimage1"){
			$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET kuva1=?");
		} elseif($toiminto == "rentimage2"){
			$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET kuva2=?");
		}
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadInfo"] = "Tiedosto ". htmlspecialchars( basename( $_FILES[$toiminto]["name"])). " on vaihdettu valittuun sijaintiin onnistuneesti.";
			
		$uploadOk = 0;
	}
	if ($_FILES[$toiminto]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editCabinrent");
	} else {
		if (move_uploaded_file($_FILES[$toiminto]["tmp_name"], $target_file)) {
			
			if($toiminto == "cabin1image"){
			$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET mokki1kuva=?");
			} elseif($toiminto == "cabin2image"){
				$stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET mokki2kuva=?");
			} elseif($toiminto == "rentimage1"){
			    $stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET kuva1=?");
			} elseif($toiminto == "rentimage2"){
			    $stmt = $conn->prepare("UPDATE mokkivuokraus_sivu SET kuva2=?");
			}
			$stmt->bind_param("s", $kuva);
			$kuva = $target_file;
			$status = $stmt->execute() or die ($stmt->error);
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES[$toiminto]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editCabinrent");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editCabinrent");
			
		}
	}
}

if($toiminto == "newSlideCabin1") {
	$target_dir = "cabinSliders/";
	$target_file = $target_dir . basename($_FILES["slideCabin1"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["slideCabin1"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";
		$uploadOk = 0;
	}
	if ($_FILES["slideCabin1"]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Pahoittelut, vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Pahoittelut, tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editCabin1");
	} else {
		if (move_uploaded_file($_FILES["slideCabin1"]["tmp_name"], $target_file)) {
			$stmt = $conn->prepare("SELECT jarjestys FROM mokki1_slider_kuvat ORDER BY jarjestys DESC LIMIT 1");
			$stmt->execute();

			$stmt->bind_result($db_jarjestys);
			while($stmt->fetch()){
				$isoin = $db_jarjestys;
			}
			$stmt->close();

			$stmt = $conn->prepare("INSERT INTO mokki1_slider_kuvat (jarjestys, kuva) VALUES (?,?)");
			$stmt->bind_param("is", $jarjestys, $kuva);
			$jarjestys = $isoin+1;
			$kuva = $target_file;
			$stmt->execute();
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["slideCabin1"]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editCabin1");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Pahoittelut, tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editCabin1");
			
		}
	}
}
if($toiminto == "slideOrderCabin1") {
	
	$data = $_POST["uusiJarjestys"];

	$newarray = explode(",", $data);
	
	$i = count($newarray);
	
	for($x=0;$x<=$i;$x++){
		$id=(int)$newarray[$x];
		$stmt = $conn->prepare("UPDATE mokki1_slider_kuvat SET jarjestys=? WHERE id=?");
		$stmt->bind_param("ii", $x, $id);
		$status = $stmt->execute() or die ($stmt->error);
	}

	$stmt->close();
	$_SESSION["uploadSuccess"] = "Järjestys päivitetty";
	header("location: adminpage.php?page=editCabin1");
}
if($toiminto == "deleteSlideCabin1"){
	$deleteID = $_GET["id"];
	$stmt = $conn->prepare("SELECT kuva FROM mokki1_slider_kuvat WHERE id=?");
	$stmt->bind_param("i", $deleteID);
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->bind_result($db_kuva);
	while($stmt->fetch()){
		$kuva = $db_kuva;
    }
	$stmt->close();
	if(unlink($kuva)){
		$stmt = $conn->prepare("DELETE FROM mokki1_slider_kuvat WHERE id=?");
		$stmt->bind_param("i", $deleteID);
		$status = $stmt->execute() or die ($stmt->error);
		$_SESSION["uploadSuccess"] = "Kuva poistettu onnistuneesti";
	} else {
		$_SESSION["uploadSuccess"] = "Kuvan poistaminen ei onnistunut";
	}
	header("location: adminpage.php?page=editCabin1");
	
}
if ($toiminto=="cabin1fi"){
	$stmt = $conn->prepare("UPDATE mokki1_sivu SET esittelyteksti=?,nappi1=?,varausOsoite=?,nappi2=?,hinnasto=?,alaOtsikko1=?,sijainti=?,alaOtsikko2=? WHERE kieli='fi'");
	$stmt->bind_param("ssssssss", $esittelyteksti,$nappi1,$varausOsoite, $nappi2,$hinnasto, $alaOtsikko1,$sijainti,$alaOtsikko2);

	$esittelyteksti=$_POST["esittelyteksti"];
	$nappi1=$_POST["nappi1"];
	$varausOsoite=$_POST["varausOsoite"];
	$nappi2=$_POST["nappi2"];
	$hinnasto=$_POST["hinnasto"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$sijainti=$_POST["sijainti"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin1");
}
if ($toiminto=="cabin1en"){
	$stmt = $conn->prepare("UPDATE mokki1_sivu SET esittelyteksti=?,nappi1=?,varausOsoite=?,nappi2=?,hinnasto=?,alaOtsikko1=?,sijainti=?,alaOtsikko2=? WHERE kieli='en'");
	$stmt->bind_param("ssssssss", $esittelyteksti,$nappi1,$varausOsoite, $nappi2,$hinnasto, $alaOtsikko1,$sijainti,$alaOtsikko2);

	$esittelyteksti=$_POST["esittelyteksti"];
	$nappi1=$_POST["nappi1"];
	$varausOsoite=$_POST["varausOsoite"];
	$nappi2=$_POST["nappi2"];
	$hinnasto=$_POST["hinnasto"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$sijainti=$_POST["sijainti"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin1");
}
if ($toiminto=="cabin1nl"){
	$stmt = $conn->prepare("UPDATE mokki1_sivu SET esittelyteksti=?,nappi1=?,varausOsoite=?,nappi2=?,hinnasto=?,alaOtsikko1=?,sijainti=?,alaOtsikko2=? WHERE kieli='nl'");
	$stmt->bind_param("ssssssss", $esittelyteksti,$nappi1,$varausOsoite, $nappi2,$hinnasto, $alaOtsikko1,$sijainti,$alaOtsikko2);

	$esittelyteksti=$_POST["esittelyteksti"];
	$nappi1=$_POST["nappi1"];
	$varausOsoite=$_POST["varausOsoite"];
	$nappi2=$_POST["nappi2"];
	$hinnasto=$_POST["hinnasto"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$sijainti=$_POST["sijainti"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin1");
}
if($toiminto == "cabin1video"){
	$stmt = $conn->prepare("UPDATE mokki1_sivu SET video=?");
	$stmt->bind_param("s", $video);
	$video = $_POST["video"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Video päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin1");
}
if($toiminto=="cabin1map"){
	$stmt = $conn->prepare("UPDATE mokki1_sivu SET kartta=?");
	$stmt->bind_param("s", $kartta);
	$kartta = $_POST["kartta"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kartta päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin1");
}

if($toiminto == "newSlideCabin2") {
	$target_dir = "cabinSliders/";
	$target_file = $target_dir . basename($_FILES["slideCabin2"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["slideCabin2"]["tmp_name"]);
		if($check !== false) {
			
			$uploadOk = 1;
		} else {
			$_SESSION["uploadError"] = "Tiedosto ei ole kuva.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		$_SESSION["uploadError"] = "Saman niminen tiedosto on jo olemassa";
		$uploadOk = 0;
	}
	if ($_FILES["slideCabin2"]["size"] > 5000000) {
		$_SESSION["uploadError"] = "Tiedosto liian suuri.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "webp" ) {
		$_SESSION["uploadError"] =  "Pahoittelut, vain JPG, JPEG, PNG & WEBP tiedostotyypit ovat sallittuja.";
		
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		$_SESSION["uploadSuccess"] = "Pahoittelut, tiedostoa ei voitu ladata.";
		header("location: adminpage.php?page=editCabin2");
	} else {
		if (move_uploaded_file($_FILES["slideCabin2"]["tmp_name"], $target_file)) {
			$stmt = $conn->prepare("SELECT jarjestys FROM mokki2_slider_kuvat ORDER BY jarjestys DESC LIMIT 1");
			$stmt->execute();

			$stmt->bind_result($db_jarjestys);
			while($stmt->fetch()){
				$isoin = $db_jarjestys;
			}
			$stmt->close();

			$stmt = $conn->prepare("INSERT INTO mokki2_slider_kuvat (jarjestys, kuva) VALUES (?,?)");
			$stmt->bind_param("is", $jarjestys, $kuva);
			$jarjestys = $isoin+1;
			$kuva = $target_file;
			$stmt->execute();
			$stmt->close();
			$_SESSION["uploadSuccess"] = "Tiedosto ". htmlspecialchars( basename( $_FILES["slideCabin2"]["name"])). " on ladattu onnistuneesti.";
			
			header("location: adminpage.php?page=editCabin2");
	
			
		} else {
			$_SESSION["uploadSuccess"] = "Pahoittelut, tiedoston lataamisessa tapahtui virhe.";
			header("location: adminpage.php?page=editCabin2");
			
		}
	}
}
if($toiminto == "slideOrderCabin2") {
	
	$data = $_POST["uusiJarjestys"];

	$newarray = explode(",", $data);
	
	$i = count($newarray);
	
	for($x=0;$x<=$i;$x++){
		$id=(int)$newarray[$x];
		$stmt = $conn->prepare("UPDATE mokki2_slider_kuvat SET jarjestys=? WHERE id=?");
		$stmt->bind_param("ii", $x, $id);
		$status = $stmt->execute() or die ($stmt->error);
	}

	$stmt->close();
	$_SESSION["uploadSuccess"] = "Järjestys päivitetty";
	header("location: adminpage.php?page=editCabin2");
}
if($toiminto == "deleteSlideCabin2"){
	$deleteID = $_GET["id"];
	$stmt = $conn->prepare("SELECT kuva FROM mokki2_slider_kuvat WHERE id=?");
	$stmt->bind_param("i", $deleteID);
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->bind_result($db_kuva);
	while($stmt->fetch()){
		$kuva = $db_kuva;
    }
	$stmt->close();
	if(unlink($kuva)){
		$stmt = $conn->prepare("DELETE FROM mokki2_slider_kuvat WHERE id=?");
		$stmt->bind_param("i", $deleteID);
		$status = $stmt->execute() or die ($stmt->error);
		$_SESSION["uploadSuccess"] = "Kuva poistettu onnistuneesti";
	} else {
		$_SESSION["uploadSuccess"] = "Kuvan poistaminen ei onnistunut";
	}
	header("location: adminpage.php?page=editCabin2");
	
}
if ($toiminto=="cabin2fi"){
	$stmt = $conn->prepare("UPDATE mokki2_sivu SET esittelyteksti=?,nappi1=?,varausOsoite=?,nappi2=?,hinnasto=?,alaOtsikko1=?,sijainti=?,alaOtsikko2=? WHERE kieli='fi'");
	$stmt->bind_param("ssssssss", $esittelyteksti,$nappi1,$varausOsoite, $nappi2,$hinnasto, $alaOtsikko1,$sijainti,$alaOtsikko2);

	$esittelyteksti=$_POST["esittelyteksti"];
	$nappi1=$_POST["nappi1"];
	$varausOsoite=$_POST["varausOsoite"];
	$nappi2=$_POST["nappi2"];
	$hinnasto=$_POST["hinnasto"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$sijainti=$_POST["sijainti"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin2");
}
if ($toiminto=="cabin2en"){
	$stmt = $conn->prepare("UPDATE mokki2_sivu SET esittelyteksti=?,nappi1=?,varausOsoite=?,nappi2=?,hinnasto=?,alaOtsikko1=?,sijainti=?,alaOtsikko2=? WHERE kieli='en'");
	$stmt->bind_param("ssssssss", $esittelyteksti,$nappi1,$varausOsoite, $nappi2,$hinnasto, $alaOtsikko1,$sijainti,$alaOtsikko2);

	$esittelyteksti=$_POST["esittelyteksti"];
	$nappi1=$_POST["nappi1"];
	$varausOsoite=$_POST["varausOsoite"];
	$nappi2=$_POST["nappi2"];
	$hinnasto=$_POST["hinnasto"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$sijainti=$_POST["sijainti"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin2");
}
if ($toiminto=="cabin2nl"){
	$stmt = $conn->prepare("UPDATE mokki2_sivu SET esittelyteksti=?,nappi1=?,varausOsoite=?,nappi2=?,hinnasto=?,alaOtsikko1=?,sijainti=?,alaOtsikko2=? WHERE kieli='nl'");
	$stmt->bind_param("ssssssss", $esittelyteksti,$nappi1,$varausOsoite, $nappi2,$hinnasto, $alaOtsikko1,$sijainti,$alaOtsikko2);

	$esittelyteksti=$_POST["esittelyteksti"];
	$nappi1=$_POST["nappi1"];
	$varausOsoite=$_POST["varausOsoite"];
	$nappi2=$_POST["nappi2"];
	$hinnasto=$_POST["hinnasto"];
	$alaOtsikko1=$_POST["alaOtsikko1"];
	$sijainti=$_POST["sijainti"];
	$alaOtsikko2=$_POST["alaOtsikko2"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin2");
}
if($toiminto == "cabin2video"){
	$stmt = $conn->prepare("UPDATE mokki2_sivu SET video=?");
	$stmt->bind_param("s", $video);
	$video = $_POST["video"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Video päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin2");
}
if($toiminto=="cabin2map"){
	$stmt = $conn->prepare("UPDATE mokki2_sivu SET kartta=?");
	$stmt->bind_param("s", $kartta);
	$kartta = $_POST["kartta"];
	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kartta päivitetty onnistuneesti";
	header("location: adminpage.php?page=editCabin2");
}

if($toiminto=="contactinfo"){
	$stmt = $conn->prepare("UPDATE yhteystiedot_sivu SET yritysNimi=?, ytunnus=?, yhteystiedot=?, postiosoite=?, kayntiosoite=?");
	$stmt->bind_param("sssss", $yritysNimi, $ytunnus,$yhteystiedot,$postiosoite,$kayntiosoite);
	$yritysNimi=$_POST["yritysNimi"];
	$ytunnus=$_POST["ytunnus"];
	$yhteystiedot=$_POST["yhteystiedot"];
	$postiosoite=$_POST["postiosoite"];
	$kayntiosoite=$_POST["kayntiosoite"];

	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Yhteystiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editContactinfo");
}
if($toiminto=="contactfi"){
	$stmt = $conn->prepare("UPDATE yhteystiedot_sivu SET otsikko=?, postiosOtsikko=?,kayntiosOtsikko=? WHERE kieli='fi'");
	$stmt->bind_param("sss", $otsikko,$postiosOtsikko,$kayntiosOtsikko);
	$otsikko=$_POST["otsikko"];
	$postiosOtsikko=$_POST["postiosOtsikko"];
	$kayntiosOtsikko=$_POST["kayntiosOtsikko"];

	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen suomi tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editContactinfo");
}
if($toiminto=="contacten"){
	$stmt = $conn->prepare("UPDATE yhteystiedot_sivu SET otsikko=?, postiosOtsikko=?,kayntiosOtsikko=? WHERE kieli='en'");
	$stmt->bind_param("sss", $otsikko,$postiosOtsikko,$kayntiosOtsikko);
	$otsikko=$_POST["otsikko"];
	$postiosOtsikko=$_POST["postiosOtsikko"];
	$kayntiosOtsikko=$_POST["kayntiosOtsikko"];

	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen englanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editContactinfo");
}
if($toiminto=="contactnl"){
	$stmt = $conn->prepare("UPDATE yhteystiedot_sivu SET otsikko=?, postiosOtsikko=?,kayntiosOtsikko=? WHERE kieli='nl'");
	$stmt->bind_param("sss", $otsikko,$postiosOtsikko,$kayntiosOtsikko);
	$otsikko=$_POST["otsikko"];
	$postiosOtsikko=$_POST["postiosOtsikko"];
	$kayntiosOtsikko=$_POST["kayntiosOtsikko"];

	$status = $stmt->execute() or die ($stmt->error);
	$stmt->close();
	$_SESSION["pageUpdate"] = "Kielen hollanti tiedot päivitetty onnistuneesti";
	header("location: adminpage.php?page=editContactinfo");
}
$conn->close();
?>