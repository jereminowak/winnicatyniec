<!DOCTYPE html>
<html>
 <head>
  <title>Winnica Tyniec</title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <style>@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
		 @import url('https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap');
  </style>
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image"/>
  
  <?php wp_head(); ?>
 </head>
 <body>

  <button id="backToTop">W gore</button>

  <div id="mobile-nav">
	<div class="top">
		<div class="logo">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/WT-logotyp-03.svg"></a>
		</div>
		<div class="burger">
			<button id="closeBtn"><img src="<?php echo get_template_directory_uri(); ?>/close.svg"></button>
		</div>
	</div>
	<div class="bottom">
		<div class="refs">
			<a id="about_menu">O WINNICY</a>
			<a id="wina_menu">WINO</a>
			<a id="oferta_menu">OFERTA PLENEROWA</a>
			<a id="kontakt_menu">KONTAKT</a>
		</div>
	</div>
  </div>
 
  <div id="top-nav">
	<div class="logo">
		<a id="glowna_strona"><img src="<?php echo get_template_directory_uri(); ?>/logo_nav.svg"></a>
	</div>
	<div class="refs">
			<a id="about_menu1">O Winnicy</a>
			<a id="wina_menu1">Wino</a>
			<a id="oferta_menu1">Oferta plenerowa</a>
			<a id="kontakt_menu1">Kontakt</a>
	</div>
	<div class="burger">
		<button id="burgerBtn"><img src="<?php echo get_template_directory_uri(); ?>/menuicon.svg"></button>
	</div>
  </div>