<?php 

	//INDEX = ITEM
	//VALUE = CONTENIDO DEL ITEM
	
	
	//HEAD: index=>value
	$head_content = array(	
						"title"=>"<title>Titulo de la pagina</title>",

						"meta"=>"<meta name='author' content=''>",	//
																		
						"meta"=>"<meta name='keywords' content=''>",	//
						
						"meta"=>"<meta name='description' content=''>", 	//
						
						"css"=>"<link rel='stylesheet' href='styles.css'>",	//
						
						"link1"=>"",	//						
						
						"link2"=>"",	//						 
						
						"link3"=>"",	//
						
						"bootstrap"=>"<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'><script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>",	//
						
						"font-awesome"=> "<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>",	//
						
						"google_fonts"=>"",	//
						
						"favicon"=>"",	//

						"jQuery"=> "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>"	//
						);
		
	//FOOTER: index=>value
	$footer_content = array(
						"banner_content_1" => "Footer content 1",	// 
						"banner_content_2" => "Footer content 2"	//
						);

	//<header> .banner [1]
	$header_banners = array(
						"banner_1" => "<h3>Banner 1 content (header)</h3>",	//
						"banner_2" => "<form class='form-inline'>
				    <input class='form-control mr-sm-2' type='text' placeholder='Search'>
				    <button class='btn btn-outline-primary my-2 my-sm-0' type='submit'>Search</button>
				</form>"	//
						);



	//BARRA DE NAVEGACIÓN: index=>value
	$navbar_link = 	array(
					"home"=>"index.php", 	//
					"about"=>"about.php",	//
					"link1"=>"link1.php",	//
					"link2"=>"link2.php",	//
					"link3"=>"link3.php",	//
					"contact"=>"contact.php"	//
					);

	//ASIDE: index=>value 
	$aside_link = array(
					"link1"=>"href 1", //
					"link2"=>"href 2",	//	
					"link3"=>"href 3",	//
					"link4"=>"href 4",	//
					"link5"=>"href 5",	//
					"link6"=>"href 6"	//
					);

	$aside_content = array(
					"content_1" => "<p>Contenido 1: Lorem lorem lorem Lorem Lorem</p>",	//
					"content_2"	=> "<p>Contenido 2: Ipsum Ipsum Ipsum Ipsum Ipsum</p>"	//
					);



	$box_content = array(
					"paragraph1"	=>	"<p>parrafo 1 </p>",	//
					"paragraph2"	=>	"<p>parrafo 2</p>",	//
					"paragraph3"	=>	"<p>parrafo 3</p>",	//
					);


?>