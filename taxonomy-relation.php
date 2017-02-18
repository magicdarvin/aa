<?php
get_header('wiki');

$start_posts = 8;
?>

<div class="content container grid">

	<div class="grid spread blocks wiki">
		<div id="artists">
			<a href="<?php echo get_permalink(44914); ?>">Художники</a>
		</div>
		<div id="persons">
			<a href="<?php echo get_permalink(44918); ?>">Персоналии</a>
		</div>
		<div id="insts">
			<a href="<?php echo get_permalink(44921); ?>">Институции</a>
		</div>
		<div id="cities">
			<a href="<?php echo get_permalink(44924); ?>">Города</a>
		</div>
		<div id="concepts">
			<a href="<?php echo get_permalink(44927); ?>">Понятия</a>
		</div>
	</div>
	
	<aside class="left">
	</aside>

	<section class="site-main wiki-page wiki-top">
		
		<div class="about-content">
			<h1><?php echo get_queried_object()->name; ?></h1>
			<div class="intro">
				<?php 
					$intro = get_field('intro_text', get_queried_object());
					if($intro) echo $intro;
				?>
			</div>
			<?php 
				$image = get_field('image', get_queried_object());
				if($image) echo '<img class="about-image" src="'.$image['url'].'" alt="'.$image['alt'].'">';

				$content = get_field('content', get_queried_object());
				if($content) echo $content; 
			?>
		</div>
		
	</section>

	<?php
		$newsargs = array(
			'posts_per_page'   => 5,
			'category_name'    => 'news',
			'post_type'        => 'post',
			'post_status'      => 'publish'
		);

		$newsargs['tax_query'] = array(
			array(
			   'taxonomy' => 'relation',
			   'field'    => 'slug',
			   'terms'    => get_queried_object()->slug
			)
		);
		
		$newsloop = new WP_Query( $newsargs );

		ob_start();

		if ( $newsloop->have_posts() ) : while ( $newsloop->have_posts() ) : $newsloop->the_post(); ?>

			<article class="item">
				<div class="content">
					<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title(); ?></a>
				</div>
				<span class="date"><?php the_time('m.y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_time('H:i'); ?></span>
			</article>
			
			<?php endwhile;
		endif;

		$allnews = ob_get_contents();
		ob_end_clean();
		
		wp_reset_query();

	if(trim($allnews)) { ?>

	<section class="news">
		<h3><a href="<?php echo get_category_link(2089); ?>">Новости</a></h3>
		<div class="grid spread">
			<?php echo $allnews; ?>
		</div>
		<a href="#" data-toggler=".news .grid|active, this|active" class="mobile expand"><span>+</span></a>
	</section>

	<?php } ?>

	<aside class="left calendar">

		<?php 
			ob_start(); 
				render_side_calendar(get_queried_object()->slug);
			$allevents = ob_get_contents();
			ob_end_clean();

		if(trim($allevents)) { ?>

		<h3><a href="<?php echo get_category_link(2088); ?>">Календарь</a></h3>
			<?php echo $allevents; ?> 
		<?php } ?>

	</aside>
	
	<?php if($allevents) { ?>
	<a href="#" data-toggler="aside.calendar|active, this|active" class="mobile expand"><span>+</span></a>
	<?php } ?>

	<section class="site-main wiki-page">
		
		<div id="main-feed" class="grid spread blocks">
			<?php
			$counter = 0;
			if ( have_posts() ) : while ( have_posts() ) : the_post();

					global $post;

					// echo render_post_item($post);
					echo render_post_item($post);
					$counter++;
			    endwhile;
			endif;
			
			wp_reset_query();
			?>
		</div>
		
		<?php if($counter >= $start_posts) { ?>
		<div class="loadmore-wrap">
			<h3>
				<a href="#" class="loadmore" data-posts-offset="<?php echo $start_posts; ?>" data-term="<?php echo get_queried_object()->slug; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
			</h3>
		</div>
		<?php } ?>

	</section>

</div>

<?php
get_footer();