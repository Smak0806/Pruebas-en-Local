<?php 

	//INDEX = ITEM
	//VALUE = CONTENIDO DEL ITEM
	//$parrafo_4 = fopen("contents.txt", "r");

	
		
	//HEAD: index=>value
	$head_content = array(	
						"title"=>"<title>Titulo de la pagina</title>",	//Titulo de la página.

						"meta"=>"<meta name='author' content=''>",	//Autor de la página
																		
						"meta"=>"<meta name='keywords' content=''>",	//Palabras claves de la página
						
						"meta"=>"<meta name='description' content=''>", 	//Descripción del contenido de la página
						
						"css"=>"<link rel='stylesheet' href='styles.css'>",	//Pagina de estilos de la página
						
						"script-js"=>"<script src='script.js' type='text/javascript' charset='utf-8' async defer></script>",	//Scripts que utiliza la página
						
						"link2"=>"",	//						 
						
						"link3"=>"",	//
						
						"bootstrap"=>"<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'><script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>",	//CDN Bootstrap
						
						"font-awesome"=> "<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>",	//CDN Fuentes de Font-Awesome
						
						"google_fonts"=>"<link href='https://fonts.googleapis.com/css?family=Roboto::100,300i,400,700,900' rel='stylesheet'><link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,900' rel='stylesheet'><link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet'>", //Fuentes de Google 'Roboto','Indie+Flower,Playfair+Display;'

						
						"favicon"=>"<link rel='icon' href='favicon.ico'>",	//

						"jQuery"=> "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>"	//CDN jQuery
				);
		
	//FOOTER: index=>value
	$footer_content = array(
						"banner_content_1" => "Footer content 1",	// 
						"banner_content_2" => "Footer content 2"	//
				);

	//<header> .banner [1]
	$header_banners = array(
						"banner_1" => date("F j, Y, g:i a") ."<br>IP Cliente:".$_SERVER['REMOTE_ADDR'],	// BANNER 1, FECHA E IP
						"banner_2" => "<form class='form-inline'>
				    <input class='form-control col-lg-8 my-1 my-sm-0 col-sm-6 mr-sm-2 p-1' type='text' placeholder='Buscar...'>
				    <button class='btn btn-outline-primary p-1 my-1 my-sm-0' type='submit'>Search</button>
				</form>"	//BANNER 2 (BUSCADOR)
				);



	//BARRA DE NAVEGACIÓN: index=>value
	$navbar_link = 	array(
					"Inicio"=>"index2.php", 	//
					"Manual"=>"manual.php",	//
					"Documentos"=>"docs.php",	//
					"driverEditor"=>"drivereditor"	//
				);

	//ASIDE: INDEX LIST. index=>value 
	$aside_link = array(
					"header"=>"Nombre de Lista",//
					"link1"=>"href 1", //
					"link2"=>"href 2",	//	
					"link3"=>"href 3",	//
					"link4"=>"href 4",	//
					"link5"=>"href 5",	//
					"link6"=>"href 6"	//
				);

	//ASIDE: BANNERS
	$aside_content = array(
					"content_1" => "<p>Contenido 1: Lorem lorem lorem Lorem Lorem</p>",	//
					"content_2"	=> "<p>Contenido 2: Ipsum Ipsum Ipsum Ipsum Ipsum</p>",	//
					"content_3" => "<p>Contenido 3: Polem polem Polem polem Polem</p>", //
					"content_4" => "<p>Contenido 4: Dolor dolor dolor dolor dolor</p>" //
				);



	$box_content = array(
					"paragraph1"	=>	"<p>parrafo 1 </p>",	//
					"paragraph2"	=>	"<p>parrafo 2</p>",	//
					"paragraph3"	=>	"<p>parrafo 3</p>",	//
					"paragraph4"	=>	"<p>parrafo 4</p>"
				);

	//LISTA DE IMAGENES DE CONTAINER CENTRAL DE LA PAGINA
	$images_list = array(
					"image0"=>"images0", //IMAGEN IZQUIERDA
					"image1"=>"images1", //IMAGEN MEDIO
					"image2"=>"images2"  //IMAGEN DERECHA
				);

	
	$content_title = array(
							"titulo_parrafo1"=>"Titulo1",	// file: parrafos/parrafo1.txt
							"titulo_parrafo2"=>"Titulo2",	// file: parrafos/parrafo2.txt
							"titulo_parrafo3"=>"Titulo3",	// file: parrafos/parrafo3.txt
							"titulo_parrafo4"=>"Titulo4",	// file: parrafos/parrafo4.txt
							"titulo_parrafo5"=>"Titulo5",	// file: parrafos/parrafo5.txt
							"titulo_parrafo6"=>"Titulo6",	// file: parrafos/parrafo6.txt
							"titulo_parrafo7"=>"Titulo7",	// file: parrafos/parrafo7.txt
							"titulo_parrafo8"=>"Titulo8",	// file: parrafos/ parrafo8.txt
							"titulo_parrafo9"=>"Titulo9",	// file: parrafos/parrafo9.txt
							"titulo_parrafo10"=>"Titulo10",	// file: parrafos/parrafo10.txt
							"titulo_parrafo11"=>"Titulo11",	// file: parrafos/parrafo11.txt
							"titulo_parrafo12"=>"Titulo12" // file: parrafos/parrafo12.txt
				);

?>