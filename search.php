<?php

$start_posts = 8;
$search_query = get_search_query();

get_header();
?>

<div class="content container grid">

	<aside class="left"></aside>
	
	<section class="site-main">
		<h1><?php echo get_search_query(); //get_queried_object()->display_name; ?></h1>
		
		<div id="main-feed" class="grid spread blocks">
			<?php			
			if ( have_posts() ) : while ( have_posts() ) : the_post();

					global $post;
					// echo render_post_item($post);
					echo render_post_item($post);
			
			    endwhile;
			endif;
			
			wp_reset_query();
			?>
		</div>

		<a href="#" class="loadmore" data-search="<?php echo $search_query; ?>" data-posts-offset="<?php echo $start_posts; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
	</section>
</div>

<?php
get_footer();