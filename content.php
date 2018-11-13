<!-- CONTENIDO DE LA PAGINA: Que tendrá de ancho 9/12 para dejar 3/12 al ASIDE-->
<div class="row col-lg-9 float-right m-0 p-0">
	
	<div class="row col-lg-12 col-xs-12 p-0 m-0">
		<!-- BOTONES DEL TOPE DE LA PAGINA -->
		<div class="row col-lg-12 col-sm-12 p-2 m-3 d-flex align-content-center justify-content-center ">
			<button type="button" class="btn btn-lg btn-secondary ml-1 mr-1">Secondary</button>
			<button type="button" class="btn btn-lg btn-secondary ml-1 mr-1">Secondary</button>
			<button type="button" class="btn btn-lg btn-secondary ml-1 mr-1">Secondary</button>
			<div class="btn-group">
				<button type="button" class="btn btn-lg btn-secondary ml-1">Dropdown</button>
				<button type="button" class="btn btn-lg btn-secondary mr-1 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="sr-only">Toggle Dropdown</span>
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#!">Action</a>
					<a class="dropdown-item" href="#!">Another action</a>
				</div>
			</div>
		</div>
		<div class="row col-lg-12 p-0 m-0">
			<div class="col-lg-9 col-sm-6 pt-4">
				<!--ZONA TITULAR DE LA IMAGEN: Titulo y pequeña descripcion. Añadir un slider de fotos -->
				<h1 class="col-12 text-center">Titulo de la pagina</h1>
				<p class="col-8">
					<?php contentGenerator("1");?>	
				</p>
			</div>
			<div class="col-lg-3 col-sm-6 pt-4 d-flex justify-content-center">
				<img class="fluid align-self-center" src="img1.jpg" alt="cosita">
			</div>
		</div>
		<!-- REGION MEDIA-SUPERIOR: dividido en tres columnas -->
		<div class="row col-lg-12 p-0 m-0">
			<div class="col-lg-4 col-sm-12 p-4" >
				<p>
					<?php contentGenerator("2"); ?>
				</p>
			</div>
			
			<div class="col-lg-4 col-sm-12 p-4">
				<p>
					<?php contentGenerator("3"); ?>
				</p>
			</div>
			
			<div class="col-lg-4 col-sm-12 p-4">
				<p>
					<?php contentGenerator("4"); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="row col-lg-12 col-sm-12 p-5 m-0">
		<!-- CONTAINER AZUL DE LA PAGINA - MITAD DE LA PAGINA-->
		<div class="col-12 m-0 p-2 bg-info text-white shadow roboto">
			<h2 class="bold"><?php echo $content_title["titulo_parrafo5"];?></h2>
			<p class="indieFlower">
				<?php contentGenerator("5"); ?>
			</p>
		</div>
	</div>
	<div class="row col-lg-12 m-0 p-0">
		<div class="col-lg-12 col-xs-12 m-0 p-4">
			<p>
				<?php contentGenerator("6"); ?>
			</p>
		</div>
	</div>
	<div class="row col-lg-12 p-0 m-0">
		<div class="col-lg-4 col-xs-12 p-4">
			<h2>
			<?php echo $content_title["titulo_parrafo7"];?>
			</h2>
			<p>
				<?php contentGenerator("7"); ?>
			</p>
		</div>
		
		<div class="col-lg-4 col-xs-12 p-4">
			<h2>
			<?php echo $content_title["titulo_parrafo8"];?>
			</h2>
			<p>
				<?php contentGenerator("8"); ?>
			</p>
		</div>
		
		<div class="col-lg-4 col-xs-12 p-4">
			<h2>
			<?php echo $content_title["titulo_parrafo9"];?>
			</h2>
			<p>
				<?php contentGenerator("9"); ?>
			</p>
		</div>
	</div>
	<!-- CONTAINER MEDIO-INFERIOR DE LA PAGINA: No contiene divisiones, una sola seccion de 12/12 partes -->
	<div class="row col-lg-12 p-0 m-0">
		
		<div class="col-lg-4 col-xs-12 p-4">
			<div class="col-10 p-2 mb-2 d-flex justify-content-center">
				<img class="mainBanner_img col-sm-8" src="<?php imageGenerator($images_list, 'image0');?>.png" alt="image">
			</div>
			<h5><?php echo $content_title["titulo_parrafo10"];?></h5>
			<p> 
				<?php contentGenerator("10"); ?>
			</p>
		</div>
		
		<!--CONTAINERS INFERIORES DE LA PAGINA: contiene 3 columnas en las que habrá un parrafo y una imagen. -->
		<div class="col-lg-4 col-xs-12 p-4">
			<div class="col-10 p-2 mb-2 d-flex justify-content-center">
				<img class="mainBanner_img col-sm-8" src="<?php imageGenerator($images_list, 'image1');?>.png" alt="image">
			</div>
			<h5><?php echo $content_title["titulo_parrafo11"];?></h5>
			<p>
				<?php contentGenerator("11"); ?>		
			</p>
		</div>
		
		<div class="col-lg-4 col-xs-12 p-4">
			<div class="col-10 p-2 mb-2 d-flex justify-content-center">
				<img class="mainBanner_img col-sm-8" src="<?php imageGenerator($images_list, 'image2');?>.png" alt="image">
			</div>
			<h5><?php echo $content_title["titulo_parrafo12"];?></h5>
			<p>
				<?php contentGenerator("12"); ?>	
			</p>
		</div>
	</div>
	
	
</div>