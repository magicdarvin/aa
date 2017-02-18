<?php
get_header();
?>

<div class="content container grid">
	
	<aside class="left">
	</aside>

	<section class="site-main">

		<?php 
			$tag_menu = get_field('tag_menu', 'options'); 
			$cal_menu = get_field('cal_menu', 'options');
			if($cal_menu) $tag_menu = $cal_menu;
			 
			if($tag_menu) { ?>

        <nav class="tags">
            <?php //wp_nav_menu( array('theme_location' => 'tags-menu') ); ?>
            <?php 
                $tag_menu_output = '<ul>';
                foreach($tag_menu as $item) $tag_menu_output .= '<li><a href="'.get_term_link($item).'">#'.$item->name.'<sup>'.$item->count.'</sup></a></li>';
                $tag_menu_output .= '</ul>';
                echo $tag_menu_output; 
            ?>
            <a href="#" data-toggler=".tags ul|active, this|active" class="mobile expand"><span>+</span></a>
        </nav>

        <?php } ?>

		<!-- <div class="calendar-filters grid">
			<div class="filter">
				<a class="event-date-range" href="#" data-toggler=".filter .inputs|hide-item">Интервал</a>
				<div class="inputs hide-item">
					<input type="text" name="startdate" id="startdate" placeholder="Дата начала">
					<input type="hidden" name="altstartdate" id="altstartdate">
					<input type="text" name="enddate" id="enddate" placeholder="Дата окончания">
					<input type="hidden" name="altenddate" id="altenddate">
					<a class="clear-range" href="#">Сбросить</a>
				</div>
				<div class="inputs"><span data-toggler=".filter .inputs|hide-item">+</span></div>
			</div>
			<div class="filter">
				<label for="event-city">Город</label><?php //echo render_filter_select(3843,'event-city'); ?>
			</div>
			
			<div class="filter">
				<label for="event-place">Тип</label><?php //echo render_filter_select(3846,'event-type'); ?>
			</div>
		</div> -->

		<!-- <label for="event-place">Место</label><?php //echo render_filter_select(3844,'event-place'); ?> -->

		<div id="main-feed" class="grid spread blocks calendar-events">
			<?php			
			if ( have_posts() ) : while ( have_posts() ) : the_post();

					global $post;

					// echo render_post_item($post);
					echo render_calendar_item($post, 'calendar');
			
			    endwhile;
			endif;
			
			wp_reset_query();
			?>
		</div>
	</section>
</div>

<?php
get_footer();