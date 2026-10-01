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

		if ( $wina->have_posts() ) : 
			while ( $wina->have_posts() ) : $wina->the_post(); 
				
				$rocznik = get_field('rocznik');
				
				// Zabezpieczenie: jeśli wino nie ma przypisanego rocznika, wpisujemy domyślny
				if ( empty($rocznik) ) $rocznik = 'Brak rocznika';

				// Jeśli PHP wykryje, że rocznik wina różni się od poprzedniego (lub to pierwsze wino)
				if ( $rocznik != $aktualny_rocznik ) {
					
					// Jeśli to nie jest pierwszy przebieg, musimy zamknąć poprzedni kontener kart
					if ( ! $czy_pierwszy_rocznik ) {
						echo '</div>'; 
					}
					
					$aktualny_rocznik = $rocznik;
					
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

				// --- ZACIĄGNIĘCIE DANYCH KARTY (z poprzedniego kodu) ---
				$kolor = get_field('kolor_karty');
				$uklad = get_field('uklad_karty');
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
			
			// Na samym końcu zamykamy ostatni kontener z kartami
			echo '</div>'; 
			wp_reset_postdata(); 
		endif; 
		?>
		</div>
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
			<div class="section-head">
				<h2 class="section-title">Oferta plenerowa</h2>
				<p1 class="section-introduction">Nasza winnica to przestrzeń,&nbsp;w której można odkrywać smaki, poznawać historię miejsca&nbsp;i spędzać czas&nbsp;w wyjątkowej atmosferze. Oferujemy różnorodne wydarzenia&nbsp;i spotkania - od kameralnych degustacji, przez wieczory tematyczne, aż po duże imprezy integracyjne.</p1>
			</div>

			<div class="section-container">
				<div class="section-content">
					<div class="section-content-top">
						<div class="photo one">
							<!-- <img src="degustacje1.png"> -->
						</div>
						<div class="description">
							<h3>01 Degustacje komentowane</h3>
							<p>Oferta kierowana jest do grup od 2 do 60 osób. Spotkanie rozpoczynamy spacerem po winnicy, podczas którego opowiadamy&nbsp;o historii miejsca oraz&nbsp;o procesie tworzenia wina. W&nbsp;zależności od wybranego pakietu, program obejmuje także zwiedzanie winiarni. Następnie zapraszamy na zadaszony taras widokowy, gdzie odbywa się degustacja minimum czterech win. Towarzyszą jej regionalne sery, domowy chleb&nbsp;i polskie oleje. Po zakończeniu istnieje możliwość zakupu win oraz pozostania&nbsp;w winnicy na dalszy wypoczynek.</p>
						</div>
						<div class="photo two">
							<!-- <img src="degustacje2.png"> -->
						</div>
					</div>
					<div class="section-content-bottom">
						<div class="photo one"></div>
						<div class="photo two">
							<!-- <img src="degustacje2.png"> -->
						</div>
					</div>
				</div>
				<div class="section-content">
					<div class="section-content-top">
					<div class="photo three">
						<!-- <img src="degustacje1.png"> -->
					</div>
					<div class="description">
						<h3>02 Spotkania firmowe i integracje</h3>
						<p>Winnica to idealne miejsce na szkolenia, spotkania integracyjne czy firmowe wydarzenia. Do dyspozycji gości oddajemy kilka przestrzeni: okrągły taras widokowy dla 30 osób, prostokątną wiatę dla 40 osób oraz klimatyczny podziemny zbiornik&nbsp;z antresolą na kolejne 30 miejsc. Na rozległej polanie można rozbić namioty,&nbsp;a całość terenu pozwala na organizację spotkań nawet do 200 osób. Zapewniamy stoły, krzesła, leżaki, nagłośnienie&nbsp;i miejsce do tańca. Dodatkowo można wynająć grill gazowy&nbsp;z obsługą lub bez. Do dyspozycji uczestników jest także parking, stojaki na rowery oraz zaplecze sanitarne.</p>						
					</div>
					<div class="photo four">
						<!-- <img src="degustacje2.png"> -->
					</div>
					</div>
					<div class="section-content-bottom">
						<div class="photo three"></div>
						<div class="photo four">
							<!-- <img src="degustacje2.png"> -->
						</div>
					</div>
				</div>
				<div class="section-content">
					<div class="section-content-top">
					<div class="photo five">
						<!-- <img src="degustacje1.png"> -->
					</div>
					<div class="description">
						<h3>03 Warsztaty i wydarzenia sezonowe</h3>
						<p>Latem i jesienią w winnicy odbywa się wiele wydarzeń plenerowych. Największą popularnością cieszy się joga wśród winorośli oraz kreatywne warsztaty malowania przy winie. Spotkania te pozwalają połączyć relaks, twórczość&nbsp;i kontakt&nbsp;z naturą. W planach pojawiają się także inne atrakcje tematyczne, które każdorazowo ogłaszamy&nbsp;w naszych kanałach społecznościowych. Aby być na bieżąco, warto śledzić kalendarz wydarzeń na Facebooku. To świetna okazja, by spędzić wolny czas&nbsp;w wyjątkowej scenerii&nbsp;i w gronie inspirujących ludzi.</p>
					</div>
					<div class="photo six">
						<!-- <img src="degustacje1.png"> -->
					</div>
					</div>
					<div class="section-content-bottom">
						<div class="photo five"></div>
						<div class="photo six">
							<!-- <img src="degustacje2.png"> -->
						</div>
					</div>
				</div>
				<div class="section-content">
					<div class="section-content-top">
					<div class="photo seven">
						<!-- <img src="degustacje1.png"> -->
					</div>
					<div class="description">
						<h3>04 Wieczory panieńskie</h3>
						<p>Nasza winnica to wyjątkowe miejsce na organizację niezapomnianego wieczoru panieńskiego. Proponujemy różnorodne atrakcje&nbsp;– od degustacji win po warsztaty malowania przy kieliszku wina. Chętne grupy mogą spróbować także nauki salsy w plenerze. Spotkanie odbywa się w kameralnej atmosferze,&nbsp;w otoczeniu winnicy&nbsp;i z pięknym widokiem na okolicę. Dbamy&nbsp;o to, by każda uczestniczka poczuła się wyjątkowo&nbsp;i zabrała ze sobą piękne wspomnienia. Na życzenie przygotowujemy dodatkowe atrakcje dopasowane do potrzeb grupy.</p>
					</div>
					<div class="photo eight">
						<!-- <img src="degustacje1.png"> -->
					</div>
					</div>
					<div class="section-content-bottom">
						<div class="photo seven"></div>
						<div class="photo eight">
							<!-- <img src="degustacje2.png"> -->
						</div>
					</div>
				</div>
				<div class="section-content">
					<div class="section-content-top">
					<div class="photo nine">
						<!-- <img src="degustacje1.png"> -->
					</div>
					<div class="description">
						<h3>05 Sesje zdjęciowe</h3>
						<p>Winnica Tyniec to malownicze wzgórze skąpane&nbsp;w południowym słońcu&nbsp;i otulone lasem, które tworzy wyjątkową scenerię do uchwycenia ważnych chwil. Pośród rzędów winorośli, na tarasie widokowym czy&nbsp;w zaciszu przy zagajniku powstają ujęcia pełne romantycznego, podmiejskiego klimatu. To idealne miejsce na stworzenie zdjęć&nbsp;i filmów, które zostają&nbsp;z Wami na długo. Oferujemy wynajem przestrzeni na sesje reklamowe, filmowe, rodzinne, ciążowe, przyjacielskie, romantyczne oraz ślubne.</p>
					</div>
					<div class="photo ten">
						<!-- <img src="degustacje1.png"> -->
					</div>
					</div>
					<div class="section-content-bottom">
						<div class="photo nine"></div>
						<div class="photo ten">
							<!-- <img src="degustacje2.png"> -->
						</div>
					</div>
				</div>
				<div class="section-content">
					<div class="section-content-top">
					<div class="photo eleven">
						<!-- <img src="degustacje1.png"> -->
					</div>
					<div class="description">
						<h3>06 Kamperem do winnicy</h3>
						<p>Winnica Tyniec udostępnia kameralne miejsca postojowe dla kamperów oraz samochodów&nbsp;z namiotami. Stanowiska przy podnóżu wzgórza przeznaczone są dla większych pojazdów, a te położone na szczycie&nbsp;– dla aut 4x4, osobowych&nbsp;i mniejszych vanów. Goście mają do dyspozycji toaletę, bieżącą zimną wodę oraz dostęp do prądu. To idealne miejsce na nocleg&nbsp;w otoczeniu winorośli, z widokiem na okolicę&nbsp;i bliskością Krakowa. Wieczorem można odpocząć przy lokalnym winie,&nbsp;a rano obudzić się&nbsp;w ciszy, słysząc jedynie śpiew ptaków.</p>
					</div>
					<div class="photo twelve">
						<!-- <img src="degustacje1.png"> -->
					</div>
					</div>
					<div class="section-content-bottom">
						<div class="photo eleven"></div>
						<div class="photo twelve">
							<!-- <img src="degustacje2.png"> -->
						</div>
					</div>
				</div>
				<div class="section-outro">
					<div class="description">
						<p>Winnica to także idealne miejsce na świętowanie urodzin, rocznic, rodzinnych spotkań czy romantycznych randek&nbsp;- zawsze&nbsp;w niepowtarzalnym klimacie&nbsp;i z kieliszkiem wina&nbsp;w dłoni.</p>
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
