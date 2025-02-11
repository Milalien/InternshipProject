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
		
		$stmt = $conn->prepare("SELECT video, esittelyteksti,nappi1,varausOsoite,nappi2,hinnasto,alaOtsikko1,sijainti,kartta,alaOtsikko2 FROM mokki1_sivu WHERE kieli=?");
		$stmt->bind_param("s", $lang);
		$stmt->execute();
        $result = $stmt->get_result();
        $mokki1 = $result->fetch_array(MYSQLI_ASSOC);
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
					<div class='carouselContainer'>
					
					<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
            <a class='next' onclick='plusSlides(1)'>&#10095;</a>
		
			<div id='0' class='cabinSlides' style='position:relative;width:100%;overflow:hidden;padding-top:56.25%;'>
			".$mokki1["video"]."
			</div>";
		
                    $stmt = $conn->prepare("SELECT id, jarjestys, kuva FROM mokki1_slider_kuvat ORDER BY jarjestys;");
                    $stmt->execute();
                    $result = $stmt->get_result();

             
                    while($row = $result->fetch_assoc()) {
                       $kuva = $row["kuva"];
                        $id=$row["id"];
                            echo <<<EOD
                                <div id=$id class="cabinSlides">
                                <img src="$kuva" style="width:100%">
                                </div>
                                EOD;
                       
                    }
                 
                    $stmt->close();
					
            echo "<div class='tabs'>";
            echo "<div class='tab'>
                          <img class='demo cursor' src='images/uusimakiThumb.jpg' style='width:100%' onclick='currentSlide(0)' alt=''>
                  </div>";
            $stmt = $conn->prepare("SELECT id, jarjestys, kuva FROM mokki1_slider_kuvat ORDER BY jarjestys;");
                    $stmt->execute();
                    $result = $stmt->get_result();
  
                 
                    while($row = $result->fetch_assoc()) {

                echo "<div class='tab'>
                          <img class='demo cursor' src='".$row["kuva"]."' style='width:100%' onclick='currentSlide(".$row["id"].")' alt=''>
                        </div>";
                   
                    }
                 
                    $stmt->close();
            
    
    
            
             echo "</div>
			<div class='text-area'>
				".$mokki1["esittelyteksti"]."";
				if($mokki2["varausOsoite"] != null){
				    echo "<a class='btn' href=".$mokki1["varausOsoite"]." role='button'>".$mokki1["nappi1"]."</a>";
				}
			        
			        if($mokki1["nappi2"]){
                        echo "<button type='button' class='btn' id='priceBtn1'>".$mokki1["nappi2"]."</button>";
			        }
                    echo "<div id='prices1' class='modal'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h2>".$mokki1["nappi2"]."</h2>
                                <span class='close'>&times;</span>

                            </div>
                            <div class='modal-body'>
                                <div>
                                    ".$mokki1["hinnasto"]."
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class='btm'>
                        <div class='location'>
                            <h3>".$mokki1["alaOtsikko1"]."</h3>
                            ".$mokki1["sijainti"]."
                            ".$mokki1["kartta"]."
                        </div>
                        <div>
                            <h3>".$mokki1["alaOtsikko2"]."</h3>
                            ".$yhteystiedot."
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
	include "footer.php";
	?>
       
    <script src="scripts/index.js"></script>
    <script type="text/javascript">
      let slides = document.getElementsByClassName("cabinSlides");
        let slideIndex = 1;
        showSlides(slideIndex);
        
        // Next/previous controls
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
        
        // Thumbnail image controls
        function currentSlide(n) {
        let x;
        for (x = 0; x < slides.length; x++) {
            if(slides.item(x)==slides.namedItem(n)){break;}
          }
        
          showSlides(slideIndex = x+1);
        }
        
        function showSlides(n) {
          let i;
          
         
          let dots = document.getElementsByClassName("demo");
          
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
        
        }
    </script>
</body>

</html>