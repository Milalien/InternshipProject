<?php
		
        require "config.php";
		
        $conn = new mysqli(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }


        $stmt = $conn->prepare("SELECT valikko1, valikko2, valikko3, pudotusvalikko, alavalikko1, alavalikko2, alavalikko3, valikko4 FROM ylavalikko WHERE kieli=?");
        $stmt->bind_param("s", $lang);
        $stmt->execute();
        $result = $stmt->get_result();
        $header = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karels Oy</title>
    <link rel="icon" type="image/x-icon" href="images/faviconVarillinen.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="page">

<div class="header">
            <div class="logo-img">
                <img src="images/kalatalouslogoVarillinen 1.png" alt="logo" class="img-fluid">
            </div>
            <div id="ylaKaruselli" class="carousel slide carousel-fade" data-bs-ride="carousel">
                

                <?php
                    $stmt = $conn->prepare("SELECT jarjestys FROM slider_kuvat ORDER BY jarjestys LIMIT 1");
                    $stmt->execute();
    
                    $stmt->bind_result($db_jarjestys);
                    while($stmt->fetch()){
                        $pienin = $db_jarjestys;
                    }
                    $stmt->close();
                    $stmt = $conn->prepare("SELECT id, jarjestys, kuva FROM slider_kuvat ORDER BY jarjestys DESC;");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    echo "<div class='carousel-inner'>";
                    while($row = $result->fetch_assoc()) {
                       $kuva = $row["kuva"];
                        if($row["jarjestys"] == $pienin){
                            echo <<<EOD
                                <div class="carousel-item active" data-bs-interval="10000">
                                <img src="images/Empty.png" style="background-image: url('$kuva');" class="slide">
                                </div>
                                EOD;
                        } else{
                            echo <<<EOD
                                <div class="carousel-item" data-bs-interval="10000">
                                <img src="images/Empty.png" style="background-image: url('$kuva');" class="slide">
                                </div> 
                                EOD;
                        }
                    }
                    echo "</div>";
                    $stmt->close();
                ?>


                <button class="carousel-control-prev" type="button" data-bs-target="#ylaKaruselli" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ylaKaruselli" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><?=$header['valikko1'];?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="companyinfo.php"><?=$header['valikko2'];?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutme.php"><?=$header['valikko3'];?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?=$header['pudotusvalikko'];?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="fishandwaterresearch.php"><?=$header['alavalikko1'];?></a></li>
                        <li><a class="dropdown-item" href="cabinrent.php"><?=$header['alavalikko2'];?></a></li>
                        <li><a class="dropdown-item" href="naturetrips.php"><?=$header['alavalikko3'];?></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactinfo.php"><?=$header['valikko4'];?></a>
                </li>
                <li class="nav-item lang">

                    <a class="nav-link btn-sm" href="?la=fi"><img src="images/fi.svg" height="20px"></a>

                    <a class="nav-link btn-sm" href="?la=en"><img src="images/en.svg" height="20px"></a>

                    <a class="nav-link btn-sm" href="?la=nl"><img src="images/nl.svg" height="20px"></a>

                </li>
            </ul>
</div>