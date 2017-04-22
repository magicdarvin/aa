<?php
/**
 * Child theme functions
 */

// show_admin_bar( false );

add_image_size( 'custom-height-220', 300, 220, true );
add_image_size( 'custom-height-290', 300, 290, true );
add_image_size( 'custom-height-340', 300, 340, true );
add_image_size( 'custom-height-400', 300, 400, true );
add_image_size( 'custom-height-450', 300, 450, true );
/* TODO featured post add_image_size */
/* TODO wide post add_image_size */

add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );

add_theme_support( 'title-tag' );

function theme_scripts() {
    wp_register_script('themescripts', get_stylesheet_directory_uri() . '/js/scripts.min.js', array('jquery', 'jquery-ui-datepicker'), '1.0.0', true);
     // wp_register_script('dirtyfuckingscripts', get_stylesheet_directory_uri() . '/js/dh.js', array('jquery'), '1.0.0', true);
    wp_register_script('slick-slider', get_stylesheet_directory_uri() . '/js/vendor/slick.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('themescripts');
    // wp_enqueue_script('dirtyfuckingscripts');
    wp_register_style('themecss', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0', 'all');
    wp_enqueue_style('themecss');
    wp_register_style('dhcss', get_stylesheet_directory_uri() . '/dh.css', array('themecss'), '1.0.0', 'all');
    wp_enqueue_style('dhcss');
    wp_enqueue_style('calendar-stuff', 'http://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'theme_scripts');


function register_additional_theme_menu() {
    register_nav_menus( array(
        'top-header-menu' => __('Top Header Menu', 'theme'),
        'social' => __('Social Menu', 'theme'),
        'tags-menu' => __('Tags Menu', 'theme'),
        'footer-one' => __('Footer Menu One', 'theme'),
        'footer-two' => __('Footer Menu Two', 'theme'),
        'mobile-menu' => __('Mobile Menu', 'theme')
    ));
}
add_action('init', 'register_additional_theme_menu');


function modify_nav_menu_args( $args ) {

    if( 'tags-menu' == $args['theme_location'] )
    {
        $args['link_before'] = '#';
    }

    return $args;
}
add_filter( 'wp_nav_menu_args', 'modify_nav_menu_args' );


function tags_count( $items, $args ) {

    if( 'tags-menu' == $args->theme_location )
    {
    //     //$args['link_before'] = '#';

        $links = explode('</a></li>', $items);

        if(!$links) return $items;

        foreach($links as $link) {
            preg_match('/menu-item-([0-9]*)/', $links[0], $id);
        }
    }

    return $items;
}
add_filter( 'wp_nav_menu_items', 'tags_count', 10, 2 );


function custom_modified_post_title ($title) {

    if ( !is_admin() ) {

        $title = str_replace('|','<br>', $title);
    } else {

        $title = str_replace('|','', $title);
    }
    return $title;
}
add_filter( 'the_title', 'custom_modified_post_title');

function custom_modified_post_wp_title($title, $sep) {

    $title = str_replace('|','', $title);
    return $title;
}
add_filter( 'wp_title', 'custom_modified_post_wp_title', 10, 2 );


/* Shortcodes */
function add_sidenote_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'number' => 7,
    ), $atts, 'sidenote' );

    ob_start();

        echo '<aside class="sidenote">'.apply_filters('the_content', $content).'</aside>';
        // do stuff

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'sidenote', 'add_sidenote_shortcode' );

function add_large_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'wide' => false,
    ), $atts, 'large' );

    // ob_start();
        // remove_filter( 'the_content', 'wpautop' );
        $output = '<div class="large-text">'.apply_filters('the_content', $content).'</div>';
        // $output = preg_replace('/<br>/', '', $output);
        // add_filter( 'the_content', 'wpautop' );
        // do stuff

    // $output = ob_get_contents();
    // ob_end_clean();

    return $output;
}
add_shortcode( 'large', 'add_large_shortcode' );

function add_cut_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'wide' => false,
    ), $atts, 'cut' );

        remove_filter( 'the_content', 'wpautop' );
        $output = '<div class="cut">'.apply_filters('the_content', $content).' </div><a class="cut" href="#">Читать далее</a>';
        add_filter( 'the_content', 'wpautop' );

    return $output;
}
add_shortcode( 'cut', 'add_cut_shortcode' );

function add_lightbox_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'wide' => false,
    ), $atts, 'lightbox' );

    remove_filter( 'the_content', 'wpautop' );

    // if($atts['wide']) $output = '<div class="lightbox wide">'.apply_filters('the_content', $content).'</div>';
    $output = '<div class="this-is-baguette">'.apply_filters('the_content', $content).'</div>';
    $output = preg_replace('/<br>/', '', $output);
    add_filter( 'the_content', 'wpautop' );

    return $output;
}
add_shortcode( 'lightbox', 'add_lightbox_shortcode' );

function add_row_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'wide' => false,
    ), $atts, 'row' );

    // ob_start();
        remove_filter( 'the_content', 'wpautop' );

        if($atts['wide']) $output = '<div class="row wide">'.apply_filters('the_content', $content).'</div>';
        else $output = '<div class="row">'.apply_filters('the_content', $content).'</div>';
        // $stuff = str_replace('<br>', '', $stuff);
        // $stuff = str_replace('<br/>', '', $stuff);
        $output = preg_replace('/<br>/', '', $output);
        // echo $stuff;
        // echo '<div class="row">'.$content.'</div>';
        add_filter( 'the_content', 'wpautop' );
        // do stuff

    // $output = ob_get_contents();
    // ob_end_clean();

    return $output;
}
add_shortcode( 'row', 'add_row_shortcode' );

function add_col_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'wide' => false,
    ), $atts, 'col' );

    // ob_start();

        // echo '<div class="col">'.apply_filters('the_content', $content).'</div>';
        $output = '<div class="col">'.apply_filters('the_content', $content).'</div>';
        // do stuff

    // $output = ob_get_contents();
    // ob_end_clean();

    return $output;
}
add_shortcode( 'col', 'add_col_shortcode' );

function add_tooltip_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'tooltip' );

    if(!$atts['id']) {

        $parts = explode('||', $content);

        // ob_start();
            // $output = '<span class="tooltip">'.trim($parts[0]).'<span class="wrap"><span class="content">'.apply_filters('the_content', trim($parts[1])).'</span></span></span>';
            $output = '<span class="tooltip">'.trim($parts[0]).'<span class="wrap"><span class="content">'.trim($parts[1]).'</span></span></span>';
        // $output = ob_get_contents();
        // ob_end_clean();

    } else {

        $parts = explode(',', $atts['id']);
        if(!$parts) return;

        $posts = '';

        foreach($parts as $part) {
            $post = get_post($part);
            $posts .= '<span class="content"><a href="'.get_permalink($post).'">'.get_the_post_thumbnail($post).get_the_title($post).'</a></span>';
        }

        // ob_start();
            $output = '<span class="tooltip">'.$content.'<span class="wrap">'.$posts.'</span></span>';
        // $output = ob_get_contents();
        // ob_end_clean();
    }

    return $output;
}
add_shortcode( 'tooltip', 'add_tooltip_shortcode' );

function add_item_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'item' );

    if(!$atts['id']) return;

    $post = get_post($atts['id']);

    $output = render_post_item($post);

    return $output;
}
add_shortcode( 'item', 'add_item_shortcode' );

function add_section_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'section' );

    $output = '<section class="post-section" id="'.$atts['id'].'"><p>'.$content.'</p></section>';

    return $output;
}
add_shortcode( 'section', 'add_section_shortcode' );

function add_postquote_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'postquote' );

    $output = '<div class="postquote">'.$content.'</div>';

    return $output;
}
add_shortcode( 'postquote', 'add_postquote_shortcode' );

function add_aside_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'wide' => false,
    ), $atts, 'aside' );

    // ob_start();

        // echo '<div class="col">'.apply_filters('the_content', $content).'</div>';
        $output = '<aside class="right">'.apply_filters('the_content', $content).'</aside>';
        // $output = '<aside class="right">'.$content.'</aside>';
        // do stuff

    // $output = ob_get_contents();
    // ob_end_clean();

    return $output;
}
add_shortcode( 'aside', 'add_aside_shortcode' );

function add_divide_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'height' => 0,
    ), $atts, 'divide' );

    $output = '<div class="divide" style="height: '.$atts['height'].'px;"></div>';

    return $output;
}
add_shortcode( 'divide', 'add_divide_shortcode' );



function add_sdvig_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'size' => 0,
    ), $atts, 'sdvig' );

    $output = '<i style="margin-left: '.$atts['size'].'px; font-style:normal;">'.$content.'</i>';

    return $output;
}
add_shortcode( 'sdvig', 'add_sdvig_shortcode' );

function add_list_authors_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => 0,
    ), $atts, 'list_authors' );

    $users = get_users( array('role__in' => array('author'), 'exclude' => array(104, 150) ) );
    $ids = [];
    foreach($users as $user) $ids[] = $user->ID;

    ob_start();

        wp_list_authors( array('exclude_admin' => true, 'include' => implode(',', $ids) ) );

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'list_authors', 'add_list_authors_shortcode' );



/* Meta shortcodes */

function add_intro_image_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'intro_image' );

    if($atts['id']) $intro_image = get_field('intro_image', $atts['id']);
    else $intro_image = get_field('intro_image', get_the_ID());
    $output = '';

    if($intro_image) {
        $output .= '<div class="intro-image">';
        $output .= '<img src="'.$intro_image['url'].'" alt="'.$intro_image['alt'].'">';
        $output .= '<p class="wp-caption-text">'.$intro_image['caption'].'</p>';
        $output .= '</div>';
    };

    return $output;
}
add_shortcode( 'intro_image', 'add_intro_image_shortcode' );

function add_main_tag_link_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'main_tag_link' );

    if($atts['id']) $relation_tags_main = get_field('relation_tags_main', $atts['id']);
    else $relation_tags_main = get_field('relation_tags_main', get_the_ID());
    $output = '';

    if($relation_tags_main) $output .= '<a class="main-tag ocrfr20-20 upc" href="'.get_term_link($relation_tags_main).'">#'.$relation_tags_main->name.'</a>';

    return $output;
}
add_shortcode( 'main_tag_link', 'add_main_tag_link_shortcode' );

function add_views_meta_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'views_meta' );

    ob_start(); ?>

    <div class="meta-info metainline">
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
            FB <?php echo get_facebook_number( get_permalink(get_the_ID()) ); ?>
        </span>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="vk">
            VK <?php print_r( get_vk_number( get_permalink(get_the_ID()) ) ); ?>
        </span>
    </div>

    <?php $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'views_meta', 'add_views_meta_shortcode' );

function add_opening_date_place_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'opening_date_place' );

    $content = preg_replace( '/<p><\/p>/', '', $content );

    $output = '<div class="ocrfr15-19 upc opening-date-place">'.$content.'</div>';

    return $output;
}
add_shortcode( 'opening_date_place', 'add_opening_date_place_shortcode' );

function add_author_name_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'author_name' );

    $output = '<span class="ocrfr12-20 upc author-name ">'.$content.'</span>';

    return $output;
}
add_shortcode( 'author_name', 'add_author_name_shortcode' );

function add_smallify_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'smallify' );

    $output = '<p class="smallify">'.$content.'</p>';

    return $output;
}
add_shortcode( 'smallify', 'add_smallify_shortcode' );

function add_smalltext_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'smalltext' );

    $output = '<span class="smallify">'.$content.'</span>';

    return $output;
}
add_shortcode( 'smalltext', 'add_smalltext_shortcode' );

function add_break_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'break' );

    $output = '<p style="color:white;">.</p>';

    return $output;
}
add_shortcode( 'break', 'add_break_shortcode' );

function add_clear_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'clear' );

    $output = '<div></div>';

    return $output;
}
add_shortcode( 'clear', 'add_clear_shortcode' );

function add_random_tags_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'random_tags' );

    if(!$atts['id']) return;

    $ids = explode(',', $atts['id']);
    $output = '';

    foreach($ids as $id) {
        $term = get_term( $id, 'relation');
        if($term) $output .= '<li><a href="'.get_term_link($term->term_id, 'relation').'">#'.$term->name.'<sup>'.$term->count.'</sup></a></li> ';
    }

    $output = '<nav class="random"><ul>'.$output.'</ul></nav>';

    return $output;
}
add_shortcode( 'random_tags', 'add_random_tags_shortcode' );

function add_contents_list_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'contents_list' );

    $output = '<div id="contents-list" class="contents-list"></div>';

    return $output;
}
add_shortcode( 'contents_list', 'add_contents_list_shortcode' );

function add_text_banner_shortcode( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'text_banner' );

    $output = '';
    if(wp_is_mobile()) $output = get_field('text_banner_mobile', 'options');
    else $output = get_field('text_banner', 'options');

    return $output;
}
add_shortcode( 'text_banner', 'add_text_banner_shortcode' );

// function add_contents_shortcode( $atts, $content = null ) {

//     $atts = shortcode_atts( array(
//         'id' => null,
//     ), $atts, 'contents' );

//     $output = '';

//     $contents_list = get_field('contents_list', get_the_ID());
//     if($contents_list) $output = $contents_list;

//     return $output;
// }
// add_shortcode( 'contents', 'add_contents_shortcode' );


/* Render functions */
function render_post_item($post = null, $class = null, $size = null) {

    if(!$post) return;

    $tags = '';
    $thumb = null;
    $tag = null;

    $relation_tags = get_field('relation_tags', $post);
    $relation_tags_main = get_field('relation_tags_main', $post);
    $custom_header = get_field('custom_header', $post);

    $terms = wp_get_post_terms($post->ID, 'relation');
    $link = get_permalink($post);

    if($terms) foreach($terms as $term) $tags .= '<a href="'.get_term_link($term).'">'.$term->name.'</a> ';

    if($size) $thumb = get_the_post_thumbnail($post, $size);
    else {
        $custom_height = get_field('custom_height', $post);

        if($custom_height && $class != 'featured') $thumb = get_the_post_thumbnail($post, 'custom-height-'.$custom_height);
        else $thumb = get_the_post_thumbnail($post, 'large');
    }

    if($relation_tags_main) $tag = '<a href="'.get_term_link($relation_tags_main).'">'.$relation_tags_main->name.'</a>';
    elseif($tags) $tag = $tags; //the_tags('',' ',' ');

    ob_start();
        setup_postdata($post);
    ?>
    <article class="item <?php echo $class.' '; if(!$thumb) echo 'no-img'; if($relation_tags_main) echo 'rel-'.$relation_tags_main->slug; ?>">
        <div class="wrap">

            <?php if($thumb) { ?>
                <a href="<?php echo $link ?>"><?php echo $thumb; ?></a>
            <?php } ?>

            <div class="text">

                <?php if($tag) { ?>
                    <span class="tag"><?php echo $tag; ?></span>
                <?php } ?>

                <div>
                    <a class="title-link" href="<?php echo $link ?>"><?php if($custom_header) echo $custom_header; else echo get_the_title($post); ?></a>
                    <a class="text-link" href="<?php echo $link ?>">
                        <?php echo $post->post_excerpt; ?>
                    </a>
                </div>
                <span class="author">Текст: <?php echo the_author_posts_link(); ?><!-- КОНСТАНТИН ЗАЦЕПИН --></span>
            </div>
        </div>
        <span class="date"><?php echo get_the_time('d.m.y', $post); ?></span>
    </article>
    <?php
        wp_reset_postdata();
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

function render_news_item($post = null, $class = null) {

    if(!$post) return;

    $custom_header = get_field('custom_header', $post);

    ob_start();
    $link = get_permalink($post);
    setup_postdata($post);
    ?>
    <article class="item <?php echo $class; ?>">
        <div class="wrap">
            <div class="text">
                <a href="<?php echo $link ?>"><?php if($custom_header) echo $custom_header; else echo get_the_title($post); ?></a>
            </div>
        </div>
        <span class="date"><?php echo get_the_time('d.m', $post); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo get_the_time('H:i', $post); ?></span>
    </article>
    <?php
    wp_reset_postdata();
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

function render_calendar_item($post = null, $class = null, $size = null) {

    if(!$post) return;

    ob_start();
    $link = get_permalink($post);
    setup_postdata($post);

    $start = get_field('date_of_event', $post);
    $end = get_field('end_date', $post);
    $start_time = get_field('start_time', $post);
    $end_time = get_field('end_time', $post);
    if($start) $startdate = new DateTime($start);
    if($end) $enddate = new DateTime($end);

    $city = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3843 ) );
    $place = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3862 ) );
    $type = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3846 ) );

    $custom_header = get_field('custom_header', $post);
    $custom_place = get_field('custom_place', $post);

    ?>
    <article class="item <?php echo $class; ?>" data-start="<?php echo $start; ?>" data-end="<?php echo $end; ?>" data-city="<?php echo $city[0]->slug; ?>" data-place="<?php echo $place[0]->slug; ?>" data-type="<?php echo $type[0]->slug; ?>">
        <a href="<?php echo $link ?>"><?php if($custom_header) echo $custom_header; else echo get_the_title($post); ?></a>
        <span class="date"><?php if($startdate) echo $startdate->format('d.m'); if($enddate && $enddate != $startdate) echo ' – '.$enddate->format('d.m.y'); ?></span>
        <span class="date"><?php if($start_time) echo $start_time; if($end_time && $end_time != $start_time) echo ' – '.$end_time; ?></span>
        <span class="date"><?php if($custom_place) echo $custom_place; elseif($place) foreach($place as $p) echo $p->name.' '; ?></span>
        <a href="<?php echo $link ?>">
        <?php if($size) echo get_the_post_thumbnail($post, $size);
            else {
                $custom_height = get_field('custom_height', $post);
                if($custom_height) echo get_the_post_thumbnail($post, 'custom-height-'.$custom_height);
                else echo get_the_post_thumbnail($post);
            } ?>
        </a>
    </article>
    <?php
    wp_reset_postdata();
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

function cmp($a, $b) {
    if ($a->name == $b->name) return 0;
    return ($a->name < $b->name) ? -1 : 1;
}

function render_filter_select($source = null, $class = null, $hide_empty = false, $divs = false, $parent_term = null, $sort = null) {

    if(!$source) return;

    if(is_numeric($source)) {
        $terms = get_terms(array(
            'taxonomy' => 'relation',
            'hide_empty' => $hide_empty,
            'parent' => $source,
            'order'  => 'ASC'
        ));
        $parent_term = $source;
    }
    elseif(is_array($source)) {
        $terms = $source;
    }
    else return;

    if($sort) usort($terms, 'cmp');

    $output = '';

    foreach($terms as $term) {
        $city = get_field('city', $term);
        // $concept = get_field('concept', $term);
        // $inst = get_field('inst', $term);
        $ignore = get_field('ignore_in_filter', $term);

        if($ignore) continue;

        // if($divs) $output .= '<li><a data-city="'.$city->slug.'" href="#'.$term->slug.'">'.$term->name.'</a></li>';
        if($divs) $output .= '<li><input type="radio" name="'.$parent_term.'" id="'.$term->slug.'" value="'.$term->slug.'"><label data-city="'.$city->slug.'" for="'.$term->slug.'">'.$term->name.'</label></li>';
        else $output .= '<option data-city="'.$city->slug.'" value="'.$term->slug.'">'.$term->name.'</option>';
    }

    if($divs) $output = '<div id="'.$class.'" class="dropdown '.$class.'"><ul>
        <li><input type="radio" name="'.$parent_term.'" id="'.$parent_term.'-none" value="" checked="checked"><label class="plus" data-city="'.$city->slug.'" for="'.$parent_term.'-none">+</label></li>
        '.$output.'
        </ul></div>';
    else $output = '<select name="'.$class.'" id="'.$class.'"><option value="">+</option>'.$output.'</select>';

    return $output;
}

function render_filter_list($source = null, $class = null, $hide_empty = false, $sort = false) {

    if(!$source) return;

    if(is_numeric($source)) $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => $hide_empty,
        'parent' => $source,
        'order'  => 'ASC'
    ));
    elseif(is_array($source)) $terms = $source;
    else return;

    if($sort) usort($terms, 'cmp');

    $output = '';

    $first = '';

    foreach($terms as $term) {

        $ignore = get_field('ignore_in_filter', $term);
        if($ignore) continue;

        $city = get_field('city', $term);
        $concept = get_field('concept', $term);
        $inst = get_field('inst', $term);

        $cities = '';
        if($city) foreach($city as $c) $cities .= $c->slug.' ';

        $concepts = '';
        if($concept) foreach($concept as $c) $concepts .= $c->slug.' ';

        $insts = '';
        if($inst) foreach($inst as $c) $insts .= $c->slug.' ';

        if(mb_substr($term->name,0,1) != $first) $output .= '<li class="letter">'.mb_substr($term->name,0,1).'</li>';

        $output .= '<li data-city="'.$cities.'" data-concept="'.$concepts.'" data-inst="'.$insts.'" value="'.$term->slug.'"><a class="name" href="'.get_term_link($term).'">'.$term->name.'<sup>'.$term->count.'</sup></a></li>';

        $first = mb_substr($term->name,0,1);
    }

    $output = '<ul class="list '.$class.'" id="'.$class.'">'.$output.'</ul>';
    return $output;
}

function render_filters_lists($parent_term = null, $class = null, $hide_empty = false, $sort = false) {

    if(!$parent_term) return;

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => $hide_empty,
        'parent' => $parent_term,
        'order'  => 'ASC'
    ));

    if($sort) usort($terms, 'cmp');

    $output = '';

    $first = '';

    $cities_list = [];
    $concepts_list = [];
    $insts_list = [];

    foreach($terms as $term) {

        $ignore = get_field('ignore_in_filter', $term);
        if($ignore) continue;

        $city = get_field('city', $term);
        $concept = get_field('concept', $term);
        $inst = get_field('inst', $term);

        $cities = '';
        if($city) foreach($city as $c) { $cities .= $c->slug.' '; $cities_list[$c->slug] = $c; }

        $concepts = '';
        if($concept) foreach($concept as $c) { $concepts .= $c->slug.' '; $concepts_list[$c->slug] = $c; }

        $insts = '';
        if($inst) foreach($inst as $c) { $insts .= $c->slug.' '; $insts_list[$c->slug] = $c; }

        if(mb_substr($term->name,0,1) != $first) $output .= '<li class="letter">'.mb_substr($term->name,0,1).'</li>';

        $output .= '<li data-city="'.$cities.'" data-concept="'.$concepts.'" data-inst="'.$insts.'" value="'.$term->slug.'"><a class="name" href="'.get_term_link($term).'">'.$term->name.'<sup>'.$term->count.'</sup></a></li>';

        $first = mb_substr($term->name,0,1);
    }

    $output = '<ul class="list '.$class.'" id="'.$class.'">'.$output.'</ul>';
    return array($output, $cities_list, $concepts_list, $insts_list);
}

function render_term_preview($term = null, $show_count = true) {

    if(!$term) return;

    $output = '';
    $city = get_field('city', $term);
    $concept = get_field('concept', $term);
    $inst = get_field('inst', $term);

    if($show_count) $show_count = '<sup>'.$term->count.'</sup>';

    $output .= '<li data-city="'.$city->slug.'" data-concept="'.$concept->slug.'" data-inst="'.$inst->slug.'" value="'.$term->slug.'"><a class="name" href="'.get_term_link($term).'">'.$term->name.$show_count.'</a>';

    $image = get_field('image', $term);
    if($image) $output .= '<a href="'.get_term_link($term).'"><img src="'.$image['sizes']['medium'].'" alt="'.$image['alt'].'"></a>';

    // $intro_text = get_field('intro_text', $term);
    // if($intro_text) $output .= $intro_text;
    if($term->description) $output .= '<p class="description">'.$term->description.'</p>';

    $output .= '</li>';

    return $output;
}

function render_terms_previews($terms = null, $class = null, $limit = null, $show_count = true) {

    if(!$terms) return;

    $output = '';
    $first = '';
    $counter = 0;

    foreach($terms as $term) {

        if($limit != null && $counter == $limit) break;

        $ignore = get_field('ignore_in_filter', $term);
        if($ignore) continue;

        $output .= render_term_preview($term, $show_count);
        $counter++;

        $first = mb_substr($term->name,0,1);
    }

    $output = '<ul class="list '.$class.'" id="'.$class.'">'.$output.'</ul>';
    return $output;
}

function render_filter_list_previews($parent_term = null, $class = null, $limit = null, $show_count = true) {

    if(!$parent_term) return;

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => $parent_term
    ));

    return render_terms_previews($terms, $class, $limit, $show_count);
}

function render_side_calendar($slug = null) {

    $calendarargs = array(
        'posts_per_page'   => 5,
        'category_name'    => 'calendar',
        'post_type'        => 'post',
        'post_status'      => 'all'
    );

    if(isset($_GET['city']) && $_GET['city'] != '') $calendarargs['tax_query'] = array(
        array(
           'taxonomy' => 'relation',
           'field'    => 'slug',
           'terms'    => sanitize_text_field($_GET['city'])
        )
    );

    if(isset($_GET['filter']) && $_GET['filter'] != '') $calendarargs['tax_query'] = array(
        array(
           'taxonomy' => 'relation',
           'field'    => 'slug',
           'terms'    => sanitize_text_field($_GET['filter'])
        )
    );

    if($slug) $calendarargs['tax_query'] = array(
        array(
           'taxonomy' => 'relation',
           'field'    => 'slug',
           'terms'    => $slug
        )
    );

    $calendarloop = new WP_Query( $calendarargs );
    $calendaritems = [];

    if ( $calendarloop->have_posts() ) : while ( $calendarloop->have_posts() ) : $calendarloop->the_post();

        global $post;

        $start = get_field('date_of_event', get_the_ID());
        $end = get_field('end_date', get_the_ID());
        $time = current_time('Ymd');

        $start_time = get_field('start_time', $post);
        $end_time = get_field('end_time', $post);

        if($start) $startdate = new DateTime($start);
        if($end) $enddate = new DateTime($end);

        $custom_header = get_field('custom_header', $post);
        $custom_place = get_field('custom_place', $post);

        $city = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3843 ) );
        $place = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3862 ) );
        $type = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3846 ) );

        ob_start(); ?>

        <article class="item">
            <h4><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php if($custom_header) echo $custom_header; else the_title(); ?></a></h4>
            <span class="date"><?php if($startdate) echo $startdate->format('d.m'); if($enddate && $enddate != $startdate) echo ' – '.$enddate->format('d.m.y'); ?></span>
            <span class="date"><?php if($start_time) echo $start_time; if($end_time && $end_time != $start_time) echo ' – '.$end_time; ?></span>
            <span class="date upc"><?php if($custom_place) echo $custom_place; elseif($place) foreach($place as $p) echo $p->name.' '; ?></span>
            <div class="content">
                <?php if(has_excerpt($post->ID)) the_excerpt(); ?>
            </div>
        </article>

        <?php $output = ob_get_contents();
        ob_end_clean();

        if($start > $time) $calendaritems['soon'][] = $output;
        else if($start == $time || $end >= $time) $calendaritems['now'][] = $output;

        endwhile;
    endif;

    wp_reset_query();

    if($calendaritems['now']) {
        $today = implode('', $calendaritems['now']);
        if($today) echo '<div class="segodnyacal">Сегодня:</div>'.$today;
    }

    if($calendaritems['soon']) {
        $soon = implode('', $calendaritems['soon']);
        if($soon) echo '<div class="izavtracal">Скоро:</div>'.$soon;
    }

    ?>

    <?php //echo implode('', $calendaritems['now']); ?>

    <?php //echo implode('', $calendaritems['soon']); ?>

    <?php
}

// function show_all_relations( $query ) {
//     // if ( $query->is_term() && $query->is_main_query() ) {
//         $query->set( 'posts_per_page', -1 );
//     // }
// }
// add_action( 'pre_get_posts', 'show_all_relations' );


/* Content filter */
function parse_img_func($content) {

    $vidmatches = array();
    /* preg_match_all('/<iframe.*?><\/iframe>/', $content, $vidmatches); */
    preg_match_all('/<iframe.*?src=".*?youtube.*?".*?><\/iframe>/', $content, $vidmatches);

    // if($vidmatches) foreach($vidmatches[0] as $match) $content = str_replace($match, '<div class="videowrapper">'.$match.'</div>', $content);

    if ( is_single() ) {
        $matches = array();

        preg_match('/<p>(<img.*?)?<\/p>/', $content, $matches);
        if($matches) $content = str_replace($matches[0], $matches[1], $content);

        // $section_matches = array();
        // preg_match_all('/\[section.*?(id=\"(.*?)\").*?\](.*?)\[\/section\]/', $content, $section_matches);
        // if($section_matches) {
        //     $list = '';
        //     // print_r($section_matches);
        //     // echo 'LOLOL';
        //     foreach($section_matches[2] as $key => $item) $list .= '<li><a href="#'.$item.'">'.$section_matches[3][$key].'</a></li>';
        //     $list = '<ul class="post-contents">'.$list.'</ul>';

        //     // update_field('contents_list', $list, get_the_ID());
        //     // $content = '<div class="contents"><span>Оглавление: </span>'.$list.'</div>'.$content;
        // }

        // $content = force_balance_tags( $content );
        // $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
        // $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
        // $content = preg_replace( '/<p><\/p>/', '', $content );
    }
    return $content;
}
add_filter( 'the_content', 'parse_img_func', 20, 1);


function load_more_posts() {

    $offset = 0;
    $load = 12;

    $offset = $_GET['offset'];
    $term = $_GET['term'];
    $parent = $_GET['parent'];
    $search = $_GET['search'];
    $load = $_GET['load'];
    $author = $_GET['author'];

    if(isset($load) && $load != '') $load = sanitize_text_field($load);

    $output = '';

    $args = array(
        'posts_per_page'   => (int)$load, //12,
        'offset'           => $offset,
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'tax_query'        => array(),
        'cat'              => '-2089'
     );

    if(isset($search) && $search != '') $args['s'] = sanitize_text_field($search);

    if(isset($author) && $author != '') $args['author'] = sanitize_text_field($author);

    if(!isset($term) || $term == '' || $term != 'photos') {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => 'photo',
            'operator' => 'NOT IN'
        );
    }

    if(isset($term) && $term != '') $args['tax_query'][] = array(
           array(
               'taxonomy' => 'relation',
               'field'    => 'slug',
               'terms'    => $term
           )
    );

    if(isset($parent) && $parent != '') {

        $terms = get_terms(array(
            'taxonomy' => 'relation',
            'hide_empty' => false,
            'parent' => $parent
        ));

        for($i=$offset; $i<$offset+10; $i++) $output .= render_term_preview($terms[$i]);

        // ob_start();
        // foreach($terms as $key => $$term) {

        // }
        // $output = ob_get_contents();
        // ob_end_clean();

    } else {
        $loop = new WP_Query( $args );

        // if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

        //     endwhile;
        // endif;

        // wp_reset_query();

        // $loop = new WP_Query( $args );
        wp_reset_query();

        ob_start();
        foreach($loop->posts as $key => $post) {
            if(get_field('wide', $post)) echo render_post_item($post, 'wide');
            else echo render_post_item($post);
        }
        $output = ob_get_contents();
        ob_end_clean();
    }

    return $output;
}

function load_more_posts_json() {
    $results = json_encode( load_more_posts() );
    return $results;
}

function load_more_posts_ajax() {
    $results = load_more_posts_json();
    die($results);
}

/* Social */

function get_twitter_number($url = null) {

    if(!$url) return;
    // echo $url;
    // $url = 'http://hungryshark.ru/articles/2767-biblioteka-food-and-the-city';
    $twitter_request = file_get_contents('http://cdn.api.twitter.com/1/urls/count.json?url='.$url);
    $twitter = json_decode($twitter_request);
    return $twitter;
}

function get_facebook_number($url = null) {

    if(!$url) return 0;
    // $url = 'https://medium.com/sketch-app-sources/designing-with-meaningful-color-28edd86240a7#.z23nkwzft';
    $facebook_request = file_get_contents('http://graph.facebook.com/'.$url);
    $fb = json_decode($facebook_request);
    $vb_c = 0;
    if (property_exists($fb,'share')) {
        $vb_c = $fb->share->share_count;
    }
    return $vb_c;
}

function get_vk_number($url = null) {

    if(!$url) return 0;
    // $url = 'http://www.pravmir.ru/minzdrav-otpravil-v-regionyi-pravila-poseshheniya-reanimatsiy-rodstvennikami-polnyiy-tekst/';
    $vk_request = file_get_contents('http://vk.com/share.php?act=count&index=1&url='.$url);
    $temp = array();
    preg_match('/^VK.Share.count\(1, (\d+)\);$/i', $vk_request, $temp);
    return $temp[1];
}


add_action( 'wp_ajax_nopriv_load_more_posts_ajax', 'load_more_posts_ajax' );
add_action( 'wp_ajax_load_more_posts_ajax', 'load_more_posts_ajax' );

/* ACF Options page */
if( function_exists('acf_add_options_page') ) {

    // acf_add_options_page('Theme Settings');

    $option_page = acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'  => false
    ));
}

/* ACF */
function ard_artists_items($field) {

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => 3860
    ));

    if($terms) foreach($terms as $term) $field['choices'][$term->term_id] = $term->name;

    return $field;
}
add_filter('acf/load_field/name=ard_artists', 'ard_artists_items');

function ard_persons_items($field) {

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => 3845
    ));

    if($terms) foreach($terms as $term) $field['choices'][$term->term_id] = $term->name;

    return $field;
}
add_filter('acf/load_field/name=ard_persons', 'ard_persons_items');

function ard_insts_items($field) {

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => 3862
    ));

    if($terms) foreach($terms as $term) $field['choices'][$term->term_id] = $term->name;

    return $field;
}
add_filter('acf/load_field/name=ard_insts', 'ard_insts_items');

function ard_cities_items($field) {

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => 3843
    ));

    if($terms) foreach($terms as $term) $field['choices'][$term->term_id] = $term->name;

    return $field;
}
add_filter('acf/load_field/name=ard_cities', 'ard_cities_items');

function ard_concepts_items($field) {

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => 3863
    ));

    if($terms) foreach($terms as $term) $field['choices'][$term->term_id] = $term->name;

    return $field;
}
add_filter('acf/load_field/name=ard_concepts', 'ard_concepts_items');

function ard_type_items($field) {

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => 3846
    ));

    if($terms) foreach($terms as $term) $field['choices'][$term->term_id] = $term->name;

    return $field;
}
add_filter('acf/load_field/name=ard_type', 'ard_type_items');

function ard_themes_items($field) {

    $terms = get_terms(array(
        'taxonomy' => 'relation',
        'hide_empty' => false,
        'parent' => 3864
    ));

    if($terms) foreach($terms as $term) $field['choices'][$term->term_id] = $term->name;

    return $field;
}
add_filter('acf/load_field/name=ard_themes', 'ard_themes_items');

function update_meta_from_selects( $post_id ) {

    if ( wp_is_post_revision( $post_id ) )
        return;

    $ard_artists = get_field('ard_artists', $post_id);
    if($ard_artists) foreach($ard_artists as $artist) if(term_exists($artist['label'], 'relation') && !has_term($artist['label'], 'relation', $post_id)) wp_set_object_terms($post_id, $artist['label'], 'relation', true);

    $ard_persons = get_field('ard_persons', $post_id);
    if($ard_persons) foreach($ard_persons as $type) if(term_exists($type['label'], 'relation') && !has_term($type['label'], 'relation', $post_id)) wp_set_object_terms($post_id, $type['label'], 'relation', true);

    $ard_insts = get_field('ard_insts', $post_id);
    if($ard_insts) foreach($ard_insts as $type) if(term_exists($type['label'], 'relation') && !has_term($type['label'], 'relation', $post_id)) wp_set_object_terms($post_id, $type['label'], 'relation', true);

    $ard_cities = get_field('ard_cities', $post_id);
    if($ard_cities) foreach($ard_cities as $type) if(term_exists($type['label'], 'relation') && !has_term($type['label'], 'relation', $post_id)) wp_set_object_terms($post_id, $type['label'], 'relation', true);

    $ard_concepts = get_field('ard_concepts', $post_id);
    if($ard_concepts) foreach($ard_concepts as $type) if(term_exists($type['label'], 'relation') && !has_term($type['label'], 'relation', $post_id)) wp_set_object_terms($post_id, $type['label'], 'relation', true);

    $ard_type = get_field('ard_type', $post_id);
    if($ard_type) foreach($ard_type as $type) if(term_exists($type['label'], 'relation') && !has_term($type['label'], 'relation', $post_id)) wp_set_object_terms($post_id, $type['label'], 'relation', true);

    $ard_themes = get_field('ard_themes', $post_id);
    if($ard_themes) foreach($ard_themes as $type) if(term_exists($type['label'], 'relation') && !has_term($type['label'], 'relation', $post_id)) wp_set_object_terms($post_id, $type['label'], 'relation', true);
}
add_action( 'save_post', 'update_meta_from_selects' );




remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_imagedirect');
function gallery_shortcode_imagedirect($attr) {
    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'medium',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) )
        $itemtag = 'dl';
    if ( ! isset( $valid_tags[ $captiontag ] ) )
        $captiontag = 'dd';
    if ( ! isset( $valid_tags[ $icontag ] ) )
        $icontag = 'dt';

    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )

    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
    }

    $output .= "</div>\n";

    return $output;
}


function custom_posts_per_page( $query ) {
    if( $query->is_main_query() && is_category( 'calendar' ) && ! is_admin() ) {
        $query->set( 'posts_per_page', -1 );
    }
    if(is_category() || is_archive() && !is_author()) $query->set( 'posts_per_page', -1 );
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );
