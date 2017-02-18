<?php
/*
	Template name: Wiki page
*/
get_header('wiki');

$start_offset = 20;
?>

<div class="content container grid">
	
	<!-- <aside class="left"> -->
	<!-- </aside> -->

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

			<div class="mobile">
				<div>
					<a class="wiki-section" href="<?php echo get_permalink(44914); ?>">Художники</a>
				</div>
				<div>
					<a class="wiki-section" href="<?php echo get_permalink(44918); ?>">Персоналии</a>
				</div>
				<div>
					<a class="wiki-section" href="<?php echo get_permalink(44921); ?>">Институции</a>
				</div>
				<div>
					<a class="wiki-section" href="<?php echo get_permalink(44924); ?>">Города</a>
				</div>
				<div>
					<a class="wiki-section" href="<?php echo get_permalink(44927); ?>">Понятия</a>
				</div>
			</div>
			
			<div class="large">
				<div class="grid wiki spread desktop">
					<div>
						<a class="wiki-section" href="<?php echo get_permalink(44914); ?>">Художники</a><!-- <input type="text" class="search" name="artist" id="artist"> -->
					</div>
					<div>
						<a class="wiki-section" href="<?php echo get_permalink(44918); ?>">Персоналии</a><!-- <input type="text" class="search" name="person" id="person"> -->
					</div>
				</div>
				<div class="wiki-featured">
					<?php $wiki_featured_left = get_field('wiki_featured_left', 'options');
					if($wiki_featured_left) echo render_terms_previews($wiki_featured_left, '', null, false); ?>
				</div>
				<div class="grid wiki spread">
					<div id="artists">
						
						<?php echo render_filter_list_previews(3860,'artist', $start_offset, false); ?>
						<a href="#" class="loadmore" data-posts-offset="<?php echo $start_offset; ?>" data-parent="3860" data-target="#artist"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
					</div>
					<div id="persons">
						
						<?php echo render_filter_list_previews(3845,'person', $start_offset, false); ?>
						<a href="#" class="loadmore" data-posts-offset="<?php echo $start_offset; ?>" data-parent="3845" data-target="#person"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
					</div>
				</div>
			</div>

			<div id="insts">
				<a class="wiki-section" href="<?php echo get_permalink(44921); ?>">Институции</a><!-- <input type="text" class="search" name="inst" id="inst"> -->
				<?php echo render_filter_list_previews(3862,'inst', $start_offset, false); ?>
				<a href="#" class="loadmore" data-posts-offset="<?php echo $start_offset; ?>" data-parent="3862" data-target="#inst"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
			</div>

			<div class="large">
				<div class="grid wiki spread desktop">
					<div>
						<a class="wiki-section" href="<?php echo get_permalink(44924); ?>">Города</a><!-- <input type="text" class="search" name="city" id="city"> -->
					</div>
					<div>
						<a class="wiki-section" href="<?php echo get_permalink(44927); ?>">Понятия</a><!-- <input type="text" class="search" name="concept" id="concept"> -->
					</div>
				</div>
				<div class="wiki-featured">
					<?php $wiki_featured_right = get_field('wiki_featured_right', 'options');
					if($wiki_featured_right) echo render_terms_previews($wiki_featured_right, '', null, false); ?>
				</div>
				<div class="grid wiki spread">
					<div id="cities">
						
						<?php echo render_filter_list_previews(3843,'city', $start_offset, false); ?>
						<a href="#" class="loadmore" data-posts-offset="<?php echo $start_offset; ?>" data-parent="3843" data-target="#city"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
					</div>
					<div id="concepts">
						
						<?php echo render_filter_list_previews(3863,'concept', $start_offset, false); ?>
						<a href="#" class="loadmore" data-posts-offset="<?php echo $start_offset; ?>" data-parent="3863" data-target="#concept"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
					</div>
				</div>
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