<?php
get_header();
?>

<div class="content container grid">

	<aside class="left">&nbsp;</aside>

	<section class="site-main">

		<div id="main-feed">
		<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<h1><?php the_title(); ?></h1>

			<?php the_content(); ?>

			<?php endwhile;
			endif;
		?>
		</div>
		
	</section>
</div>

<?php
get_footer();