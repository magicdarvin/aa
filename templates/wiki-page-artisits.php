<?php
/*
	Template name: Wiki Artist page
*/
get_header('wiki');

$artist = render_filters_lists(3860,'artist', false, true);

// $city = render_filter_select(3843,'city', true, true);
// $concept = render_filter_select(3863,'concept', true, true);

$city = render_filter_select($artist[1],'city', true, true, 'city', true);
$concept = render_filter_select($artist[2],'concept', true, true, 'concept', true);
$inst = render_filter_select($artist[3],'inst', true, true, 'inst', true);

$artist = $artist[0];
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
					<label for="person"><a href="<?php echo get_permalink(44918); ?>">Персоналии</a></label>
				</div>
				<div>
					<label for="inst"><a href="<?php echo get_permalink(44921); ?>">Институции</a></label>
				</div>
				<div>
					<label for="city"><a href="<?php echo get_permalink(44924); ?>">Города</a></label><a class="current city-current" data-toggler=".city|active, this|active">+</a>
				</div>
				<?php if(wp_is_mobile()) echo $city; ?>
				<div>
					<label for="concept"><a href="<?php echo get_permalink(44927); ?>">Понятия</a></label><a class="current concept-current" data-toggler=".concept|active, this|active">+</a>
				</div>
				<?php if(wp_is_mobile()) echo $concept; ?>
			</div>
			<div id="artists" class="fuckingbullshit insane">
				<label for="artist" class="fuckingborders"><a href="<?php echo get_permalink(44914); ?>">Художники</a></label><input type="text" class="search" name="artist" id="artist" placeholder="|">
				<?php echo $artist; //render_filter_list(3860,'artist', false, true); ?>
			</div>
			<div id="persons" class="desktop">
				<label for="persons"><a href="<?php echo get_permalink(44918); ?>">Персоналии</a></label><br /><span class="fuckthisplus">+</span>
				<?php // echo render_filter_list_previews(3845,'person'); ?>
			</div>
			<div id="insts" class="desktop">
				<label for="insts"><a href="<?php echo get_permalink(44921); ?>">Институции</a></label><br /><span class="fuckthisplus">+</span>
				<?php //echo render_filter_list_previews(3862,'inst'); ?>
			</div>
			<div id="cities" class="desktop">
				<label for="cities"><a href="<?php echo get_permalink(44924); ?>">Города</a></label><a class="current city-current" data-toggler=".city|active, this|active">+</a>
				<?php if(!wp_is_mobile()) echo $city; ?>
				
			</div>
			<div id="concepts" class="desktop">
				<label for="concepts"><a href="<?php echo get_permalink(44927); ?>">Понятия</a></label><a class="current concept-current" data-toggler=".concept|active, this|active">+</a>
				<?php if(!wp_is_mobile()) echo $concept; ?>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();