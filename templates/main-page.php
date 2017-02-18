<?php
/*
	Template name: Main page
*/
get_header();

$featured = get_field('featured', 'options');

$start_posts = 24;
if(!$featured) $start_posts = 25;

$args = array(
	'posts_per_page'   => $start_posts,
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'tax_query'		   => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => 'photo',
				'operator' => 'NOT IN'
			)
		)
);

if(isset($_GET['city']) && $_GET['city'] != '') $args['tax_query'][] = array(
	array(
		'taxonomy' => 'relation',
		'field'    => 'slug',
		'terms'    => sanitize_text_field($_GET['city'])
	)
);

if(isset($_GET['filter']) && $_GET['filter'] != '') $args['tax_query'][] = array(
	array(
	   'taxonomy' => 'relation',
	   'field'    => 'slug',
	   'terms'    => sanitize_text_field($_GET['filter'])
	)
);

$loop = new WP_Query( $args );
wp_reset_query();
?>

<div class="content container grid">
	
	<?php if(!isset($_GET['city']) && !isset($_GET['filter'])) { ?>
	
	<aside class="left cities"></aside>

	<section class="site-main top-nav">
		<div class="grid spread blocks featured-items">
		    <?php

		    	$featured_banner = get_field('featured_banner', 'options');
		    	if($featured_banner) echo '<div class="banner-featured">'.$featured_banner.'</div>';
			    
				
				if($featured) echo render_post_item($featured, 'featured');
				else echo render_post_item($loop->posts[0], 'featured');
			?>
		</div>
	</section>
	
	<?php } ?>

	<section class="news">
		<h3><a href="<?php echo get_category_link(2089); ?>">Новости</a></h3>
		<div class="grid spread">
			<?php
				$newsargs = array(
					'posts_per_page'   => 5,
					'category_name'    => 'news',
					'post_type'        => 'post',
					'post_status'      => 'publish'
				);

				// if(isset($_GET['city']) && $_GET['city'] != '') $newsargs['tax_query'] = array(
				// 	array(
				// 	   'taxonomy' => 'relation',
				// 	   'field'    => 'slug',
				// 	   'terms'    => sanitize_text_field($_GET['city'])
				// 	)
				// );
				
				$newsloop = new WP_Query( $newsargs );
				
				if ( $newsloop->have_posts() ) : while ( $newsloop->have_posts() ) : $newsloop->the_post(); ?>

					<article class="item">
						<div class="content">
							<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_excerpt(); ?></a>
						</div>
						<span class="date"><?php the_time('m.y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_time('H:i'); ?></span>
					</article>
					
					<?php endwhile;
				endif;
				
				wp_reset_query();
			?>
		</div>
		<a href="#" data-toggler=".news .grid|active, this|active" class="mobile expand"><span>+</span></a>
	</section>

	<aside class="left calendar">
		<h3><a href="<?php echo get_category_link(2088); ?>">Календарь</a></h3>
			<?php render_side_calendar(); ?>
	</aside>
		
	<a href="#" data-toggler="aside.calendar|active, this|active" class="mobile expand"><span>+</span></a>

	<section class="site-main the-main">

		<div id="main-feed" class="grid spread blocks">
		<?php
			$counter = 0;
			if(!$featured) $counter = 1;

			for($i = $counter; $i < $counter+3; $i++) {
				$post = $loop->posts[$i];
				echo render_post_item($post);
			}

			$wide = get_field('wide', 'options');
			if($wide) echo render_post_item($wide, 'wide');

			for($i = $counter+3; $i < $counter+6; $i++) {
				$post = $loop->posts[$i];
				echo render_post_item($post);
			}

			$photoargs = array(
				'posts_per_page'   => 9,
				'category_name'    => 'photo',
				'post_type'        => 'post',
				'post_status'      => 'publish'
			);

			if(isset($_GET['city']) && $_GET['city'] != '') $photoargs['tax_query'] = array(
				array(
				   'taxonomy' => 'relation',
				   'field'    => 'slug',
				   'terms'    => sanitize_text_field($_GET['city'])
				)
			);

			if(isset($_GET['filter']) && $_GET['filter'] != '') $photoargs['tax_query'] = array(
				array(
				   'taxonomy' => 'relation',
				   'field'    => 'slug',
				   'terms'    => sanitize_text_field($_GET['filter'])
				)
			);
			
			$photoloop = new WP_Query( $photoargs );
			wp_reset_query();

			wp_enqueue_script('slick-slider'); 

			echo '<article id="photo-slider" class="wide photo-slider">'; 

				if(count($photoloop->posts) < 3) {
					
					echo '<div class="grid spread blocks mb">';
				} else {
					
					echo '<div class="slick-slider" data-slick-slider data-slick=\'{ "infinite": false, "slidesToShow": 3, "slidesToScroll": 3, "arrows": true, "responsive": [{"breakpoint": 980, "settings": {"slidesToShow": 2, "slidesToScroll": 2} },{"breakpoint": 640, "settings": {"slidesToShow": 1, "slidesToScroll": 1} }] }\'>';
				}

				foreach($photoloop->posts as $post) echo render_post_item($post);

				echo '</div>';

			echo '</article>';

			for($i = $counter+6; $i < $start_posts; $i++) {
				$post = $loop->posts[$i];
				echo render_post_item($post);
			}
		?>
		</div>
		
		<div class="loadmore-wrap">
			<?php if(isset($_GET['city']) && $_GET['city'] != '') { ?>

				<a href="#" class="loadmore" data-posts-offset="<?php echo $start_posts; ?>" data-term="<?php echo sanitize_text_field($_GET['city']); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>

			<?php } elseif(isset($_GET['filter']) && $_GET['filter'] != '') { ?>

				<a href="#" class="loadmore" data-posts-offset="<?php echo $start_posts; ?>" data-term="<?php echo sanitize_text_field($_GET['filter']); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a> 

			<?php } else { ?>

				<a href="#" class="loadmore" data-posts-offset="<?php echo $start_posts; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>

			<?php } ?>
		</div>
	</section>
</div>

<?php
get_footer();