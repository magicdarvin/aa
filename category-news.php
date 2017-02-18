<?php
get_header();
?>

<div class="content container grid">
	
	<!-- <aside class="left">
	</aside> -->

	<section class="site-main">
		
		<div id="main-feed" class="grid spread blocks">
			<?php			
			if ( have_posts() ) : while ( have_posts() ) : the_post();

					global $post;

					// echo render_post_item($post);
					echo render_news_item($post, 'news');
			
			    endwhile;
			endif;
			
			wp_reset_query();
			?>
		</div>
	</section>
</div>

<?php
get_footer();