<?php
session_start();

if ($_SESSION["loggedin"]!=1){
	header("location: login.html");
}
if(isset($_GET["la"]) && $_GET["la"]!= $_SESSION["la"]){
	$_SESSION["la"] = $_GET["la"];
	$lang = $_SESSION["la"];
} elseif(isset($_SESSION["la"])){
	$lang = $_SESSION["la"];
} else {
	$_SESSION["la"] = "fi";
	$lang = $_SESSION["la"];
}

?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karels Oy - admin</title>
    <link rel="icon" type="image/x-icon" href="images/faviconVarillinen.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/adminpages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	<script src="scripts/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '.editable',
        license_key: 'gpl',
		menubar: false,
        plugins: 'lists advlist autoresize code',
        min_height: 30,
        min_width: 300,
        toolbar_mode: 'floating',
		toolbar: 'undo redo | styles | bold italic | bullist | alignment | outdent indent | code',
        setup: (editor) => {
        editor.ui.registry.addGroupToolbarButton('alignment', {
        icon: 'align-center',
        tooltip: 'Alignment',
        items: 'alignleft aligncenter alignright | alignjustify'
    });

  }
      });
    </script>
</head>
<body>

<div class="adminPage">
<div class="adminHeader">
<h2>Admin-sivut</h2>
<?php
$currentlink = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$link = explode('&',$currentlink)[0];
echo "<a href='".$link."&la=fi'><img src='images/fi.svg' height='20px'></a>
<a href='".$link."&la=en'><img src='images/en.svg' height='20px'></a>
<a href='".$link."&la=nl'><img src='images/nl.svg' height='20px'></a>";
?>
	
	<a href="logout.php" class="btn">Kirjaudu ulos</a>
</div>

	
<div class="menu">
<a href="?page=editIndex">Etusivu</a>
<a href="?page=editMenu">Ylävalikko</a>
<a href="?page=editAds">Mainoslaatikot</a>
<a href="?page=editSlider">Kuva-slider</a>
<a href="?page=editCompanyInfo">Yritysesittely</a>
<a href="?page=editAboutme">Oma esittely</a>
<a href="?page=editFWRS">Kala- ja vesistötutkimus</a>
<a href="?page=editCabinrent">Mökkivuokraus</a>
<a href="?page=editCabin1">Mökin 1 sivu</a>
<a href="?page=editCabin2">Mökin 2 sivu</a>
<a href="?page=editNaturetrips">Luontomatkat</a>
<a href="?page=editContactinfo">Yhteystiedot</a>
</div>
<div class="main" id="adminMAin">
	
	
<?php
switch ($_GET['page']) {
    case "editIndex":
        include "editIndex.php";
        break;
    case "editMenu":
        include "editMenu.php";
        break;
    case "editAds":
        include "editAds.php";
        break;
    case "editSlider":
        include "editSlider.php";
        break;
    case "editCompanyInfo":
        include "editCompanyInfo.php";
        break;
    case "editAboutme":
        include "editAboutme.php";
        break;
    case "editFWRS":
        include "editFWRS.php";
        break;
    case "editCabinrent":
        include "editCabinrent.php";
        break;
    case "editCabin1":
        include "editCabin1.php";
        break;
    case "editCabin2":
        include "editCabin2.php";
        break;
    case "editNaturetrips":
        include "editNaturetrips.php";
        break;
    case "editContactinfo":
        include "editContactinfo.php";
        break;
    default:
        include "editIndex.php";
};



	?>
	
	
	
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
	
</body>
</html>