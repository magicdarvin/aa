<?php
/*
	Template name: Old Wiki page
*/
get_header();
?>

<div class="content container grid">
	
	<aside class="left">
	</aside>

	<section class="site-main">

		<div class="filters">
			<!-- <label for="artist">Художник</label><?php //echo render_filter_select(3860,'artist'); ?> -->
			<!-- <label for="person">Персоналии</label><?php //echo render_filter_select(3845,'person'); ?> -->
			<!-- <label for="inst">Институции</label><?php //echo render_filter_select(3862,'inst'); ?> -->
			<!-- <label for="city">Города</label><?php //echo render_filter_select(3843,'city'); ?>			 -->
			<!-- <label for="concept">Понятия</label><?php //echo render_filter_select(3863,'concept'); ?>			 -->
			<!-- 3864#Сюжеты -->
		</div>	
		<div id="main-feed" class="grid spread blocks wiki">
			<div id="artists">
				<label for="artist">Художник</label><input type="text" class="search" name="artist" id="artist">
				<?php echo render_filter_list(3860,'artist'); ?>
			</div>
			<div id="persons">
				<label for="person">Персоналии</label><input type="text" class="search" name="person" id="person">
				<?php echo render_filter_list(3845,'person'); ?>
			</div>
			<div id="insts">
				<label for="inst">Институции</label><input type="text" class="search" name="inst" id="inst">
				<?php echo render_filter_list(3862,'inst'); ?>
			</div>
			<div id="cities">
				<label for="city">Города</label><input type="text" class="search" name="city" id="city">
				<?php echo render_filter_list(3843,'city'); ?>
			</div>
			<div id="concepts">
				<label for="concept">Понятия</label><input type="text" class="search" name="concept" id="concept">
				<?php echo render_filter_list(3863,'concept'); ?>
			</div>
			<?php			
			// if ( have_posts() ) : while ( have_posts() ) : the_post();

			// 		global $post;

			// 		// echo render_post_item($post);
			// 		echo render_calendar_item($post, 'calendar');
			
			//     endwhile;
			// endif;
			
			// wp_reset_query();
			?>
		</div>
	</section>
</div>

<?php
get_footer();