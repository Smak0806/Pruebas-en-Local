<?php

	


//<head>
	function headContentCreator($array){
		//$array = $head_content:variables.php
		//$dumpster = var_dump($array); echo $dumpster; //debugging
		foreach ($array as $key => $value) {
			if($value=="") continue;
			else
				echo $value;
		}
	}




//<header>
	//<header> .banner[1], banner[2]
	function headerBannerCreator($array, $numBanner){

		//$array = $header_banners:variables.php

		//echo "<script>console.log(".var_dump($array).");</script>";//debugging

		//foreach ($array as $key => $value) {
		//	if($key==$numBanner)
				echo $array[$numBanner]; 	
		//}

	}

//<navbar>
	function navbarContentCreator($array){

		//$array = $navbar_link:variables.php

		//echo "<script>console.log(".var_dump($array).");</script>";//debugging

		foreach ($array as $key => $value) {
			if($value=="")	continue;
			else 
				echo "<li class='nav-item'><a class='nav-link' href='$value' title='$key'>$key</a></li>";
			
			}
	}


//<aside>
	function asideContentCreator($array){

		//$aside_link:variables.php
		if(is_array($array)){
			foreach ($array as $key => $value) {
				if($value=="") continue;
				if($key=="header"){
					echo "<h5>$value</h5>";
				}
				else
					echo "<li><a>$value</a></li>";
			}
		}else
			echo $array;			
	}


	function imageGenerator($array, $arg){
		
			echo $array[$arg];
		
	}









?>