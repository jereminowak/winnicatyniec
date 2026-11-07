<?php get_header(); ?>

<section class="main-splash">
	  <div class="page-intro">
		<h1 class="main-title">Winnica Tyniec w Krakowie</h1>
		<p class="main-subtitle">Miejsce, gdzie historia spotyka się z teraźniejszością</p>
	  </div>   
	</section>
	
	<section class="about" id="about">
	  <div class="container">
		<div class="section-logo">
			<img src="<?php echo get_template_directory_uri(); ?>/about-img.png">
		</div>
		<div class="section-text">
			<div class="section-head">
				<h2 class="section-title">O Winnicy</h2>
			</div>
			<p class="section-body">Winnica Tyniec to urokliwe miejsce&nbsp;w historycznym mieście Kraków. Ideą&nbsp;i treścią przedsięwzięcia jest odnowienie jednej&nbsp;z najstarszych winnic w Polsce, przywrócenie jej miastu&nbsp;i mieszkańcom oraz stworzenie enoturystycznej wielowymiarowej atrakcji. To idealne miejsce dla ludzi interesujących się winem, lokalnym winiarskim dziedzictwem oraz dla poszukujących nowych doznań&nbsp;z duchem czasu. Tutaj można poczuć, jak tradycja łączy się&nbsp;z współczesnością. </p>
			<!--<a href=>Dowiedz się więcej</a>-->
			<!--<div class="link-btn">
				<a>Dowiedz się więcej</a>
			</div>-->
		</div>
		
	  </div>
	</section>

	<section class="statement">
		<div class="ornament">
	
		</div>
	</section>
	
	<section class="wina" id="wina">
		<div class="container">
		<?php
		// Pobieramy wszystkie wina i sortujemy od najnowszego rocznika
		$wina = new WP_Query(array(
			'post_type'      => 'wina',
			'posts_per_page' => -1,          // -1 pobiera wszystkie
			'meta_key'       => 'rocznik',   // Sortujemy po polu z ACF
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC'       // Od najwyższego (np. 2026 -> 2025)
		));

		$aktualny_rocznik = '';
		$czy_pierwszy_rocznik = true;
		$licznik_win_w_roczniku = 0; // Dodajemy licznik kart
		$ostatni_kolor = '';         // Zapamiętujemy kolor dla pustej karty

		if ( $wina->have_posts() ) : 
			while ( $wina->have_posts() ) : $wina->the_post(); 
				
				$rocznik = get_field('rocznik');
				
				// Zabezpieczenie: jeśli wino nie ma przypisanego rocznika, wpisujemy domyślny
				if ( empty($rocznik) ) $rocznik = 'Brak rocznika';

				// Jeśli PHP wykryje, że rocznik wina różni się od poprzedniego (lub to pierwsze wino)
				if ( $rocznik != $aktualny_rocznik ) {
					
					// Jeśli to nie jest pierwszy przebieg, musimy zamknąć poprzedni kontener kart
					if ( ! $czy_pierwszy_rocznik ) {
						// SPRAWDZENIE: Czy poprzedni rocznik miał nieparzystą liczbę win?
						if ( $licznik_win_w_roczniku % 2 != 0 ) {
							// Dodajemy pustą kartę wypełniającą w kolorze ostatniego wina
							echo '<div class="flip-wrapper placeholder-card"><div class="flip-card ' . esc_attr($ostatni_kolor) . '"></div></div>';
						}
						
						echo '</div>'; // Zamykamy poprzedni .carousel 
					}
					
					$aktualny_rocznik = $rocznik;
					$licznik_win_w_roczniku = 0; // Zerujemy licznik dla nowego rocznika
					
					// Generujemy nagłówki
					if ( $czy_pierwszy_rocznik ) {
						// Wygląd dla pierwszego nagłówka (z głównym tytułem "Wino")
						echo '<div class="section-head">';
						echo '<h2 class="section-title">Wino</h2>';
						echo '<h3 class="section-title2">ROCZNIK ' . esc_html($rocznik) . '</h3>';
						echo '</div>';
						$czy_pierwszy_rocznik = false;
					} else {
						// Wygląd dla każdego kolejnego nagłówka (tylko rok)
						echo '<div class="section-head-mid">';
						echo '<h3 class="section-title2">ROCZNIK ' . esc_html($rocznik) . '</h3>';
						echo '</div>';
					}
					
					// Otwieramy nowy elastyczny kontener dla tego rocznika
					echo '<div class="carousel">';
				}

				// Podnosimy licznik dla aktualnego wina
        		$licznik_win_w_roczniku++;

				// --- ZACIĄGNIĘCIE DANYCH KARTY (z poprzedniego kodu) ---
				$kolor = get_field('kolor_karty');
				$uklad = get_field('uklad_karty');
				$ostatni_kolor = $kolor;
				
				$icon_color = ($kolor == 'bg-light' || $kolor == 'bg-rose') ? 'dark' : 'light';
				?>
				
				<div class="flip-wrapper">
					<div class="flip-card <?php echo esc_attr($kolor); ?> <?php echo esc_attr($uklad); ?>">
						<div class="flip-card-inner">
							
							<div class="flip-card-front">
								<div class="plus-<?php echo $uklad; ?>">
									<img src="<?php echo get_template_directory_uri(); ?>/plus_<?php echo $icon_color; ?>.svg"/>
								</div>
								<div class="card-content">
									<div class="wine-photo">
										<img src="<?php the_field('zdjecie_butelki_przod'); ?>" class="wine-bottle">
									</div>
									<div class="wine-info">
										<h3><?php the_title(); ?></h3>
										<h4><?php the_field('rodzaj_wina'); ?></h4>
										<p><?php the_field('krotkie_haslo_przod'); ?></p>
									</div>
								</div>
							</div>

							<div class="flip-card-back">
								<div class="minus-<?php echo $uklad; ?>">
									<img src="<?php echo get_template_directory_uri(); ?>/minus_<?php echo $icon_color; ?>.svg"/>
								</div>
								<div class="card-content">
									<div class="wine-info">
										<div class="wine-info-text">
											<h3><?php the_title(); ?></h3>
											<h4><?php the_field('rodzaj_wina'); ?></h4>
											<p><?php the_field('opis_z_tylu_karty'); ?></p>
										</div>
									</div>
									<div class="wine-photo">
										<img src="<?php the_field('zdjecie_butelki_tyl'); ?>" class="wine-bottle back">
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			<?php endwhile; 
			
			// SPRAWDZENIE DLA OSTATNIEGO ROCZNIKA: 
			// Gdy pętla się skończy, musimy sprawdzić ten sam warunek dla ostatniej grupy win
			if ( $licznik_win_w_roczniku % 2 != 0 ) {
				echo '<div class="flip-wrapper placeholder-card"><div class="flip-card ' . esc_attr($ostatni_kolor) . '"></div></div>';
			}

			echo '</div>'; // Zamknięcie ostatniego kontenera
			wp_reset_postdata();
		endif; 
		?>
		</div>
	</section>

	<section class="vouchery" id="vouchery">
		<h2 class="section-title"><?php the_field('vouchery_tytul'); ?></h2>
		
		<!-- ACF (WYSIWYG) samo dodaje tagi <p>, więc nie musimy ich pisać w kodzie -->
		<?php the_field('vouchery_opis_glowny'); ?>
		
		<div class="section-photo">
			<div class="section-head">
				<div class="vouchery-grid">
					
					<div class="voucher-item">
						<h3><?php the_field('voucher_1_tytul'); ?></h3>
						<p><?php the_field('voucher_1_opis'); ?></p>
					</div>

					<div class="voucher-item">
						<h3><?php the_field('voucher_2_tytul'); ?></h3>
						<p><?php the_field('voucher_2_opis'); ?></p>
					</div>
					
				</div>
			</div>
			
			<?php if( get_field('vouchery_zdjecie') ): ?>
				<img src="<?php the_field('vouchery_zdjecie'); ?>" alt="Vouchery prezentowe">
			<?php endif; ?>
			
		</div>
		
		<?php the_field('vouchery_tekst_dolny'); ?>
	</section>

	<section class="kalendarz" id="kalendarz">
		<div class="section-head">
			<h2 class="section-title">Kalendarz wydarzeń</h2>
			<div class="calendar-wrapper">
				<iframe
					src="https://calendar.google.com/calendar/embed?src=0bdcdd0d456278ccaf42eb56cfb0914d49d7d0078dbf41ca10aebd35507d768d%40group.calendar.google.com&ctz=Europe%2FWarsaw&mode=AGENDA"
					frameborder="0"
					scrolling="no">
				</iframe>
			</div>
		</div>
		
	</section>

	<section class="oferta" id="oferta">
		<div class="container">
			
			<!-- NAGŁÓWEK POBIERANY ZE STRONY GŁÓWNEJ -->
			<div class="section-head">
				<h2 class="section-title"><?php the_field('oferta_tytul'); ?></h2>
				<p1 class="section-introduction"><?php the_field('oferta_wstep'); ?></p1>
			</div>

			<div class="section-container">
				<?php
				// Pobieramy wszystkie oferty
				$oferty = new WP_Query(array(
					'post_type'      => 'oferty',
					'posts_per_page' => -1,
					'order'          => 'ASC' // Najstarsze pierwsze (dodawaj je w panelu w kolejności 1,2,3...)
				));

				$i = 1; // Nasz licznik numeracji

				if ( $oferty->have_posts() ) : 
					while ( $oferty->have_posts() ) : $oferty->the_post(); 
						
						// Formatujemy licznik, żeby zawsze miał dwa znaki (np. "01", "02")
						$numer = str_pad($i, 2, '0', STR_PAD_LEFT); 
						
						$img_1 = get_field('oferta_zdjecie_1');
						$img_2 = get_field('oferta_zdjecie_2');
						?>
						
						<div class="section-content">
							<div class="section-content-top">
								<!-- Zdjęcie wpisywane bezpośrednio do stylów -->
								<div class="photo" style="background-image: url('<?php echo esc_url($img_1); ?>');"></div>
								
								<div class="description">
									<h3><?php echo $numer; ?> <?php the_title(); ?></h3>
									<p><?php the_field('opis_oferty'); ?></p>
								</div>
								
								<div class="photo" style="background-image: url('<?php echo esc_url($img_2); ?>');"></div>
							</div>
							
							<div class="section-content-bottom">
								<div class="photo" style="background-image: url('<?php echo esc_url($img_1); ?>');"></div>
								<div class="photo" style="background-image: url('<?php echo esc_url($img_2); ?>');"></div>
							</div>
						</div>

					<?php 
					$i++; // Zwiększamy licznik
					endwhile; 
					wp_reset_postdata(); 
				endif; 
				?>

				<!-- TEKST KOŃCOWY POBIERANY ZE STRONY GŁÓWNEJ -->
				<div class="section-outro">
					<div class="description">
						<?php the_field('oferta_zakonczenie'); ?>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="statement state2">
		<div class="ornament">
	
		</div>
	</section>
	
	<section class="gallery" id="gallery">
		<div class="container">
			<div class="section-head">
				<h2 class="section-title">Galeria</h2>
			</div>
			<div class="gallery-container">
				<div class="item tall"></div>
				<div class="item small"></div>
				<div class="item medium"></div>
				<div class="item medium"></div>
				<div class="item small"></div>
				<div class="item high"></div>
				<div class="item small"></div>
				<div class="item small"></div>
			</div>
			<button class="button">
				Zobacz więcej
			</button>
		</div>
		
	</section>

	<section class="features" id="kontakt">
		<div class="container">
			<div class="section-head">
				<h2 class="section-title">Kontakt</h2>
			</div>
			<div class="section-data">
				<div class="data-gora">
				<div class="formularz">
					<p>Masz pytanie lub chcesz zaplanować wizytę w&nbsp;winnicy? Napisz do nas -&nbsp;chętnie pomożemy i&nbsp;doradzimy.</p>
					<?php echo do_shortcode('[contact-form-7 id="bca0452" title="Formularz główny" html_id="contactForm"]'); ?>
				</div>
				<div class="dolny-tekst-mobile">
					<p>Jeśli wolisz porozmawiać bezpośrednio, zadzwoń do nas<br/>
					Kasia: <a href="tel:+48601174179" class="telefon-link">+48 601 174 179</a><br/>
					Sławek: <a href="tel:+48696440600" class="telefon-link">+48 696 440 600</a></p>
				</div>
				<div class="mapa">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2563.540603689457!2d19.804999375729622!3d50.01996521826722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47165fcf57d9fcab%3A0x994d56422bb9ac65!2sWinnica%20Tyniec!5e0!3m2!1spl!2spl!4v1745136586811!5m2!1spl!2spl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				</div>
				<div class="data-dol">
					<p>Jeśli wolisz porozmawiać bezpośrednio, zadzwoń do nas<br/>
					Kasia: <a href="tel:+48601174179" class="telefon-link">+48 601 174 179</a><br/>
					Sławek: <a href="tel:+48696440600" class="telefon-link">+48 696 440 600</a></p>
				</div>

			</div>
		</div>
		
	</section>

	<section id="dofinansowania">
		<div class="container">
			<div class="section-logos">
				<img class="komp" src="<?php echo get_template_directory_uri(); ?>/logoKPO.jpeg"/>
				<img class="mobilka" src="<?php echo get_template_directory_uri(); ?>/logoKPOpion.png"/>
			</div>
			<div class="section-text-dof">
				<p>Winnica Tyniec s.c. realizuje przedsięwzięcie w ramach Krajowego Programu Odbudowy - działania/części inwestycji A1.4.1. „Inwestycje na rzecz dywersyfikacji i skracania łańcucha dostaw produktów rolnych i spożywczych oraz budowy odporności podmiotów uczestniczących w łańcuchu”- wsparcia dla mikro-, małych i średnich przedsiębiorstw na wykonywanie działalności w zakresie przetwórstwa lub wprowadzania do obrotu produktów rolnych, rybołówstwa lub akwakultury.
W ramach realizacji operacji pn. Zakup i instalacja nowych maszyn do przetwarzania, przechowywania i magazynowania produktów rolnych w firmie „Winnica Tyniec S.C” Wnioskodawca zainwestuje w urządzenia umożliwiające dywersyfikacje oferty poprzez wprowadzenie działań z zakresu przetwórstwa, magazynowania i wprowadzania do obrotu produktów rolnych co pozytywnie wpłynie na rozwój kultury winiarskiej na terenie małopolski.</p>
				<p1>Wartość projektu (całkowity koszt netto projektu): 753 542,12 PLN<br/>
Wysokość wkładu Funduszy Europejskich: 376 771,06 PLN</p>
			</div>
		</div>
	</section>
	
<?php get_footer(); ?>
</body>
