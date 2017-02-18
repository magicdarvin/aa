<?php
get_header();

$args = array(
	'posts_per_page'   => 12,
	'post_type'        => 'post',
	'post_status'      => 'publish'
);

$loop = new WP_Query( $args );
wp_reset_query();
?>

<div class="content container grid">
	<aside class="left cities">
		Города +
	</aside>

	<section class="site-main">
		<nav class="tags">
			<?php wp_nav_menu( array('theme_location' => 'tags-menu') ); ?>
			<!-- <ul>
				<li><a href="#">#фотоотчеты</a></li>
				<li><a href="#">#открытия недели</a></li>
				<li><a href="#">#образование и резиденции<sup>39</sup></a></li>
				<li><a href="#">#самоорганизация<sup>12</sup></a></li>
				<li><a href="#">#молодые художники<sup>5</sup></a></li>
				<li><a href="#">#коллекционеры<sup>7</sup></a></li>
				<li><a href="#">#скульптура<sup>1</sup></a></li>
				<li><a href="#">#живопись<sup>18</sup></a></li>
				<li><a href="#">#гендер<sup>18</sup></a></li>
				<li><a href="#">#ни возьмись<sup>14</sup></a></li>
				<li><a href="#">#фотография<sup>5</sup></a></li>
				<li><a href="#">#видеоарт<sup>3</sup></a></li>
				<li><a href="#">#перформанс<sup>2</sup></a></li>
				<li><a href="#">#концептуализм30</a></li>
			</ul> -->
			<a href="#" data-toggler=".tags ul|active, this|active" class="mobile expand"><span>+</span></a>
		</nav>

			<div class="grid spread blocks">
			<div class="banner-featured">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner-first.jpg" alt="">
			</div>
			
			<?php
				if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
					
					global $post;

					if($loop->posts[0]->ID === $post->ID) {
						?>
						<article class="item featured">
							<div class="wrap">
								<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
								<!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/featured.jpg" alt=""> -->
								<div class="text">
									<span class="tag">#ПОРТРЕТ ХУДОЖНИКА В ЮНОСТИ</span>
									<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
									<!-- <p>О попытке изменить академическую выучку и выборе графики в противовес живописи</p> -->
									<span class="author">ТЕКСТ: КОНСТАНТИН ЗАЦЕПИН</span>
								</div>
							</div>
							<span class="date"><?php the_time('d.m.y'); ?></span>
						</article>
						<?php
					}
					
				    endwhile;
				endif;
			?>
		</div>
	</section>

	<section class="news">
		<h3>Новости</h3>
		<div class="grid spread">
			<?php
				$args = array(
				'posts_per_page'   => 5,
				'category'         => 'news',
				'post_type'        => 'post',
				'post_status'      => 'draft'
				//'tax_query' => array(
				//		array(
				//			'taxonomy' => 'people',
				//			'field'    => 'slug',
				//			'terms'    => 'bob',
				//		),
				//	)
				);
				
				$loop = new WP_Query( $args );
				
				if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<article class="item">
						<?php the_excerpt(); ?>
						<span class="date"><?php the_time('m.y H:i'); ?></span>
					</article>
					
					<?php endwhile;
				endif;
				
				wp_reset_query();
			?>
			<!-- <article class="item">
				<p>Петр Павленский стал лауреатом премии Вацлава Гавела</p>
				<span class="date">02.03 23:20</span>
			</article>
			<article class="item">
				<p>Петр Павленский стал лауреатом премии Вацлава Гавела</p>
				<span class="date">02.03 23:20</span>
			</article>
			<article class="item">
				<p>Петр Павленский стал лауреатом премии Вацлава Гавела</p>
				<span class="date">02.03 23:20</span>
			</article>
			<article class="item">
				<p>Петр Павленский стал лауреатом премии Вацлава Гавела</p>
				<span class="date">02.03 23:20</span>
			</article>
			<article class="item">
				<p>Петр Павленский стал лауреатом премии Вацлава Гавела</p>
				<span class="date">02.03 23:20</span>
			</article> -->
		</div>
		<a href="#" data-toggler=".news .grid|active, this|active" class="mobile expand"><span>+</span></a>
	</section>

	<aside class="left calendar">
		<h3>Календарь</h3>
		<div>Сегодня:</div>
		<article class="item">
			<h4>Мауро Рестифф</h4>
			<span class="date">07.04 — 26.06.16</span> 
			<p>Гараж, музей современного искусства</p>
		</article>
		<article class="item">
			<h4>Мауро Рестифф</h4>
			<span class="date">07.04 — 26.06.16</span> 
			<p>Гараж, музей современного искусства</p>
		</article>
		<article class="item">
			<h4>Мауро Рестифф</h4>
			<span class="date">07.04 — 26.06.16</span> 
			<p>Гараж, музей современного искусства</p>
		</article>
		<div>Скоро:</div>
		<article class="item">
			<h4>Мауро Рестифф</h4>
			<span class="date">07.04 — 26.06.16</span> 
			<p>Гараж, музей современного искусства</p>
		</article>
	</aside>
		<a href="#" data-toggler="aside.calendar|active, this|active" class="mobile expand"><span>+</span></a>

		<section class="site-main">
		<div class="grid spread blocks">
			<?php
				if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
					
					global $post;

					if($loop->posts[0]->ID !== $post->ID) {
						?>
						<article class="item">
							<div class="wrap">
								<?php the_post_thumbnail(); ?>
								<!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/1.jpg" alt=""> -->
								<div class="text">
									<span class="tag">#ПОРТРЕТ ХУДОЖНИКА В ЮНОСТИ</span>
									<h3><?php the_title(); ?></h3>
									<?php the_excerpt(); ?>
									<!-- <p>О попытке изменить академическую выучку и выборе графики в противовес живописи</p> -->
									<span class="author">ТЕКСТ: КОНСТАНТИН ЗАЦЕПИН</span>
								</div>
							</div>
							<span class="date"><?php the_time('d.m.y'); ?></span>
						</article>
						<?php
					}

				    endwhile;
				endif;
			?>
			<article class="item wide">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/4.jpg" alt="">
				<div class="text">
					<span class="tag">#ПОРТРЕТ ХУДОЖНИКА В ЮНОСТИ</span>
					<h3>Леонид Цхе</h3>
					<p>О попытке изменить академическую выучку и выборе графики в противовес живописи</p>
					<span class="author">ТЕКСТ: КОНСТАНТИН ЗАЦЕПИН</span>
				</div>
				<span class="date">14.04.16</span>
			</article>
		</div>
	</section>
</div>

<?php
get_footer();