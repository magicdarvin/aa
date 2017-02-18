<?php

$start_posts = 8;

get_header();
?>

<div class="content container grid">
	
	<aside class="left">
	</aside>

	<section class="site-main">
		<h1><?php echo get_queried_object()->display_name; ?></h1>
		
		<div id="main-feed" class="grid spread blocks">
			<?php			
			if ( have_posts() ) : while ( have_posts() ) : the_post();

					global $post;

					// echo render_post_item($post);
					echo render_post_item($post);
			
			    endwhile;
			endif;
			
			$authorMeta = get_queried_object();
			?>
		</div>
	
		<?php //if(count($loop->posts) >= $start_posts ) { ?>

			<a href="#" class="loadmore" data-author="<?php echo $authorMeta->data->ID; ?>" data-posts-offset="<?php echo $start_posts; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>

		<?php //} ?>

	</section>
</div>

<?php
get_footer();