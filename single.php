<?php
/*
	Template name: Main page
*/

get_header();

$start_posts = 12;

$args = array(
	'posts_per_page'   => $start_posts,
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'cat'			   => '-2089',
	'tax_query'		   => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => 'photo',
				'operator' => 'NOT IN'
			)
		)
);

$loop = new WP_Query( $args );
wp_reset_query();
$relation_tags_main = get_field('relation_tags_main', get_the_ID());
?>



<div class="content container grid <?php if($relation_tags_main) echo $relation_tags_main->slug; ?>">
	<!-- <aside class="left"></aside> -->

	<!-- <section class="site-main the-content"> -->
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


				<?php 
					
					if(!$opening) : 

					$intro_image = get_field('intro_image', get_the_ID());
					
					$special = get_field('special', get_the_ID());
					if($special) { 
					?>	
						<div class="hero-wrap">
							<div class="single-hero">
								<!-- <img src="<?php echo $intro_image['url']; ?>" alt="<?php echo $intro_image['alt']; ?>"> -->
								<?php if($relation_tags_main) echo '<a class="main-tag ocrfr20-20 upc" href="'.get_term_link($relation_tags_main).'">#'.$relation_tags_main->name.'</a>'; ?>
								<h1><?php the_title(); ?></h1>
							</div>
							<?php if($intro_image) { 
								echo '<p class="wp-caption-text">'.$intro_image['caption'].'</p>'; ?>
								<style>
									.single-hero {
										background: url('<?php echo $intro_image['url']; ?>') center center no-repeat;
										background-size: cover;
										max-height: 895px;
										/*min-height: 895px;*/
										/*-webkit-filter: grayscale(100%);
										-moz-filter: grayscale(100%);
										-o-filter: grayscale(100%);
										-ms-filter: grayscale(100%);
										filter: grayscale(100%);*/
									}
									@media only screen and (min-width: 768px) {
										.single-hero {
											max-height: <?php echo $intro_image['height']; ?>px;
										}
									}
									@media only screen and (min-width: 1200px) {
										.single-hero {
											height: 895px;
											max-height: 895px;
										}
									}
								</style>
							<?php } ?>
						</div>
						
						<aside class="left"></aside>
						<section class="site-main the-content">
						
					<?php } else { ?>
						<aside class="left"></aside>
						<section class="site-main the-content <?php if (in_category(array (2089,2088))) { ?>this__is__spartaaaaaaa<?php } ?>">
						<?php if($relation_tags_main) echo '<a class="main-tag ocrfr20-20 upc" href="'.get_term_link($relation_tags_main).'">#'.$relation_tags_main->name.'</a>'; ?>
						<h1><?php the_title(); ?></h1>
					<?php }
				?>
				
				<div class="meta-info">
					<?php if(function_exists('the_views')) { ?>
						<span class="views">
							<?php the_views(); ?>&nbsp;&nbsp;<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/views.png" alt=""> 
						</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php } ?>
					<span class="comments">
						<?php comments_number('0', '1', '%'); ?>&nbsp;&nbsp;<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/comments.png" alt="">
					</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<!-- <span class="TW">
						TW <?php //echo get_twitter_number( get_permalink(get_the_ID()) ); ?>
					</span> -->
					<span class="fb">
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
   target="_blank" title="Поделиться на Facebook" class="sharebut">FB</a> <?php echo get_facebook_number( get_permalink(get_the_ID()) ); ?>
					</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="vk">
						<a href="http://vk.com/share.php?url=<?php the_permalink(); ?>"
   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
   target="_blank" title="Поделиться на Vkontakte" class="sharebut">VK</a> <?php print_r( get_vk_number( get_permalink(get_the_ID()) ) ); ?>
					</span>
				</div>
				<div class="intro <?php if (in_category(2088)) {?>xyintro<?php } ?>">
					<?php
					$fuckintro = get_field('fuckintro', get_the_ID()); if (!$fuckintro) { 
						$intro = get_field('intro', get_the_ID());
						if($intro) echo $intro; 
						elseif (has_excerpt()) the_excerpt(); }
					?>
				</div>
				<div class="meta-info bottom-meta <?php if (in_category(2088)) {?>shmeta<?php } ?>">
					<span class="date"><?php the_time('d.m.y'); ?><?php if (in_category(2089)) { ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php the_time('H:i'); ?><?php } ?></span><?php if (in_category(2089)) { ?><span class="privetvsemvetomchatike">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ИСТОЧНИК:&nbsp;</span><span class="singleauhorlink"><?php if( get_field('newssourcelink') ): ?><a href="<?php the_field('newssourcelink'); ?>"><?php endif; ?><?php the_field('newssource'); ?><?php if( get_field('newssourcelink') ): ?></a><?php endif; ?></span><?php } elseif ( get_field('photoauthor') ) { ?>&nbsp;&nbsp;&nbsp;&nbsp;ФОТО: <?php the_field('photoauthor'); ?><?php } else { ?><span class="privetvsemvetomchatike">&nbsp;&nbsp;&nbsp;&nbsp;ТЕКСТ:&nbsp;</span><span class="singleauhorlink"><?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></span> <?php } ?>
				</div>
				<?php 
					if(!$special) {

						if($intro_image) {
							echo '<div class="intro-image"><figure class="vsepomaketu">';
							echo '<img src="'.$intro_image['url'].'" alt="'.$intro_image['alt'].'">';
							echo '<figcaption class="wp-caption-text">'.$intro_image['caption'].'</figcaption>';
							echo '</figure></div>';
						}; 
					}

					endif;
				?>
				
			</section>
			
			<aside class="left"><!-- calendar -->
				<!-- <h3><a href="<?php //echo get_category_link(2088); ?>">Календарь</a></h3> -->
					<?php //render_side_calendar(); ?>
					<?php 
						$aside_banner = get_field('aside_banner', 'options');
						$aside_banner_single = get_field('aside_banner', get_the_ID());

						$aside_banner_mobile = get_field('aside_banner_mobile', 'options');
						$aside_banner_mobile_single = get_field('aside_banner_mobile', get_the_ID());
						
						if($aside_banner_single) $aside_banner = $aside_banner_single;
						if($aside_banner_mobile_single) $aside_banner_mobile = $aside_banner_mobile_single;

						if($aside_banner && !wp_is_mobile()) echo $aside_banner;
						elseif($aside_banner_mobile) echo $aside_banner_mobile;
					?>
			</aside>

			<section class="site-main the-content">
				
				<?php 
					the_content();

					$gallery = get_field('gallery', get_the_ID());
					if($gallery) {
						$output = '<div class="this-is-baguette">';
						// print_r($gallery); 
							$counter = 0;
							foreach($gallery as $img) {
								if($counter == 0) $output .= '<div class="row">';

								$output .= '<div class="col"><a href="'.$img['url'].'">'.wp_get_attachment_image( $img['id'], 'medium' ).'</a><p class="wp-caption-text"><em>'.$img['caption'].'</em></p></div>';
								$counter++;

								if((count($gallery) > 4 && $counter == 4) || $counter == count($gallery)) { 
									$output .= '</div>';
									$counter = 0;
								}
							}
						$output .= '</div>';
						echo $output;
					}

					$terms = wp_get_post_terms($post->ID, 'relation');
				    $tags = '';
				    if($terms) foreach($terms as $term) $tags .= '<li><a href="'.get_term_link($term).'">#'.$term->name.'<sup>'.$term->count.'</sup></a></li>';
				    if($tags) echo '<nav class="tags ocrfr20-20 upc"><ul>'.$tags.'</ul></nav>';

					if ( comments_open() || get_comments_number() ) :
						comments_template();

					endif;
					
				?>
						
		    <?php endwhile;
		endif;
		// wp_reset_query();

		?>
			</section>

		<!-- Clone of Main -->

		<section class="news">
			<h3><a href="<?php echo get_category_link(2089); ?>">Новости</a></h3>
			<div class="grid spread">
				<?php
					$newsargs = array(
						'posts_per_page'   => 5,
						'category_name'    => 'news',
						'post_type'        => 'post',
						'post_status'      => 'publish'
					);
					
					$newsloop = new WP_Query( $newsargs );
					
					if ( $newsloop->have_posts() ) : while ( $newsloop->have_posts() ) : $newsloop->the_post(); ?>

						<article class="item">
							<div class="content">
								<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title(); ?></a>
							</div>
							<span class="date"><?php the_time('d.m'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_time('H:i'); ?></span>
						</article>
						
						<?php endwhile;
					endif;
					
					wp_reset_query();
				?>
				<!-- <article class="item">
					<p>Петр Павленский стал лауреатом премии Вацлава Гавела</p>
					<span class="date">02.03 23:20</span>
				</article> -->
			</div>
			<a href="#" data-toggler=".news .grid|active, this|active" class="mobile expand"><span>+</span></a>
		</section>

		<aside class="left calendar">
		<h3><a href="<?php echo get_category_link(2088); ?>">Календарь</a></h3>
			<?php render_side_calendar(); ?>
		</aside>
		<a href="#" data-toggler="aside.calendar|active, this|active" class="mobile expand"><span>+</span></a>

		<section class="site-main main-clone the-main">

			<div class="grid spread blocks">
			<?php
				// foreach($loop->posts as $key => $post) if($key != 0) {
				for($i = 0; $i < 3; $i++) {
					$post = $loop->posts[$i];
					// if(get_field('wide', $post)) echo render_post_item($post, 'wide');
					// else echo render_post_item($post);
					echo render_post_item($post);
				}

				$wide = get_field('wide', 'options');
				if($wide) echo render_post_item($wide, 'wide');

				for($i = 3; $i < 6; $i++) {
					$post = $loop->posts[$i];
					echo render_post_item($post);
				}

				$photoargs = array(
					'posts_per_page'   => 9,
					'category_name'    => 'photo',
					'post_type'        => 'post',
					'post_status'      => 'publish'
				);

				if(isset($_GET['city']) && $_GET['city'] != '') $photoargs['tax_query'] = array(
					array(
					   'taxonomy' => 'relation',
					   'field'    => 'slug',
					   'terms'    => sanitize_text_field($_GET['city'])
					)
				);
				
				$photoloop = new WP_Query( $photoargs );
				wp_reset_query();

				wp_enqueue_script('slick-slider'); 

				echo '<article id="photo-slider" class="wide photo-slider">'; 

					echo '<div class="slick-slider" data-slick-slider data-slick=\'{ "infinite": false, "slidesToShow": 3, "slidesToScroll": 3, "arrows": true, "responsive": [{"breakpoint": 980, "settings": {"slidesToShow": 2, "slidesToScroll": 2} },{"breakpoint": 640, "settings": {"slidesToShow": 1, "slidesToScroll": 1} }] }\'>';

					foreach($photoloop->posts as $post) echo render_post_item($post);

					echo '</div>';

				echo '</article>';

			?>
			</div>
			<div id="main-feed" class="grid spread blocks">
			<?php
				for($i = 6; $i < 12; $i++) {
					$post = $loop->posts[$i];
					echo render_post_item($post);
				}
			?>
			
			</div>
			<div class="loadmore-wrap">
				<h3>
					<a href="#" class="loadmore" data-posts-offset="<?php echo $start_posts; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/plus.svg" alt="Загрузить еще" title="Загрузить еще"></a>
				</h3>
			</div>
			</section>


</div>


<?php
get_footer();