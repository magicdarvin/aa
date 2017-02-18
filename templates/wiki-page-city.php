<?php
/*
	Template name: Wiki City page
*/
get_header('wiki');
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
					<label for="artist"><a href="<?php echo get_permalink(44914); ?>">Художники</a></label>
				</div>
				<div>
					<label for="person"><a href="<?php echo get_permalink(44918); ?>">Персоналии</a></label>
				</div>
				<div>
					<label for="inst"><a href="<?php echo get_permalink(44921); ?>">Институции</a></label>
				</div>
				<div>
					<label for="concept"><a href="<?php echo get_permalink(44927); ?>">Понятия</a></label>
				</div>
			</div>
			<div id="artists" class="desktop">
				<label for="artist"><a href="<?php echo get_permalink(44914); ?>">Художники</a></label><br /><span class="fuckthisplus">+</span>
				<?php //echo render_filter_list(3860,'artist'); ?>
			</div>
			<div id="persons" class="desktop">
				<label for="person"><a href="<?php echo get_permalink(44918); ?>">Персоналии</a></label><br /><span class="fuckthisplus">+</span>
				<?php //echo render_filter_list_previews(3845,'person'); ?>
			</div>
			<div id="insts" class="desktop">
				<label for="inst"><a href="<?php echo get_permalink(44921); ?>">Институции</a></label><br /><span class="fuckthisplus">+</span>
				<?php //echo render_filter_list_previews(3862,'inst'); ?>
			</div>
			<div id="cities" class="fuckingbullshit insane">
				<label for="city" class="fuckingborders"><a href="<?php echo get_permalink(44924); ?>">Города</a></label><input type="text" class="search" name="city" id="city" placeholder="|">
				<?php echo render_filter_list(3843,'city'); ?>
			</div>
			<div id="concepts" class="desktop">
				<label for="concept"><a href="<?php echo get_permalink(44927); ?>">Понятия</a></label><br /><span class="fuckthisplus">+</span>
				<?php //echo render_filter_select(3863,'concept'); ?>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();