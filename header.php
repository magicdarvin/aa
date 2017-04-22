<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php wp_title(); ?></title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,shrink-to-fit=no">

    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <link rel="apple-touch-icon" href="img/favicon/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <?php wp_head(); ?>
    <!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css"/> -->

</head>
<body <?php body_class(); ?>>
    <div class="fakeandroiddiv">

    <?php $top_banner = get_field('top_banner', 'options'); ?>

    <div class="static-header <?php if($top_banner) echo ' with-banner'; ?>">

        <?php if($top_banner) echo '<div class="banner-top container">'.$top_banner.'</div>'; ?>

        <header class="site-header container">
            <div class="top-deck grid spread">
                <nav class="mobile">
                    <?php
                    $cities = '';
                    $main_cities = get_field('main_cities', 'options');
                    if($main_cities) {
                        $current = 'Города ';
                        // $main_cities_select = '<select name="global-city" class="global-city" id="global-city"><option value="">+</option>';
                        $main_cities_select = '<div class="global-city" id="global-city"><ul>'; //<option value="">+</option>
                            // foreach($main_cities as $city) $main_cities_select .= '<option value="'.$city->slug.'">'.$city->name.'</option>';
                            foreach($main_cities as $city) {

                                if(isset($_GET['city']) && $_GET['city'] != '' && $city->slug == $_GET['city']) $current = $city->name.' ';

                                $main_cities_select .= '<li><a data-slug="'.$city->slug.'" href="'.esc_url( home_url( '/' ) ).'?city='.$city->slug.'">'.$city->name.'</a></li>';
                            }

                            $main_cities_select .= '<li><a data-slug="" href="'.get_permalink(44924).'">Еще</a></li>';
                        // $main_cities_select .= '</select>';
                        $main_cities_select .= '</ul></div>';

                        $cities = '<label for="global-city"><a href="#" class="cities-plus" data-toggler=".global-city|active, this|active">'.$current.'</a></label>';
                        $cities .= $main_cities_select;
                        echo $cities;
                    } ?>
                </nav>
                <nav class="mobile custom-menu">
                    <?php wp_nav_menu( array('theme_location' => 'mobile-menu') ); ?>
                    <!-- <ul>
                        <li><a href="#">города</a></li>
                        <li><a href="#">#тэги</a></li>
                        <li><a href="#">новости</a></li>
                        <li><a href="#">календарь</a></li>
                    </ul> -->
                </nav>
                <nav class="mode">
                    <a href="#" class="textmode"><span class="txt">txt</span>/<span class="im">img</span></a><!-- data-toggler="body|textmode, self|active" -->
                </nav>
                <nav class="top">
                    <?php wp_nav_menu( array('theme_location' => 'top-header-menu') ); ?>
                </nav>
                <nav class="social">
                    <?php wp_nav_menu( array('theme_location' => 'social') ); ?>
                </nav>
                <nav class="mobile footer-clone">
                    <div class="menu-one">
                        <?php wp_nav_menu( array('theme_location' => 'footer-one') ); ?>
                    </div>
                    <div class="menu-two">
                        <?php wp_nav_menu( array('theme_location' => 'footer-two') ); ?>
                    </div>
                    <div class="copy">
                        использование материалов разрешено только с предварительного согласия правообладателей. все права на картинки и тексты принадлежат их авторам.
                    </div>
                    <div class="made">
                        дизайн: cargocollectiVe.com/lupanoVa
                    </div>
                </nav>
            </div>
            <div class="bottom-deck">

                <div class="grid spread middle wrap">
                    <a class="wiki-link" href="<?php echo get_permalink(44589); ?>">Справочник</a>
                    <a href="#" data-toggler=".top-deck|active, self|active" class="mobile-menu"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/menu.png" alt="Меню"></a>
                    <a href="#" data-toggler=".search-block|active" class="mobile-search"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.png" alt="Поиск"></a>

                    <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="black" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.jpg" alt=""><img class="blue" src="<?php echo get_stylesheet_directory_uri(); ?>/img/aroundartblue.jpg" alt=""></a>

                    <a href="#" data-toggler=".search-block|active" class="desktop search-button"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.png" alt="Поиск"></a>
                </div>

            </div>

            <div class="search-block">
                <div class="wrap">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </header>
    </div>

    <div class="content container grid below-fixed">

        <?php
            if(is_category('calendar')) {
                global $wp_query;

                $eventsCity = [];
                $eventsType = [];
                $eventsPlace = [];
                echo '<!--';
                // print_r($wp_query);
                echo '-->';
                foreach($wp_query->posts as $post) {
                    $city = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3843 ) );
                    $place = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3862 ) );
                    $type = wp_get_post_terms( $post->ID, 'relation', array( 'parent' => 3846 ) );

                    $eventsCity[$city[0]->slug] = $city[0];
                    $eventsType[$type[0]->slug] = $type[0];
                    $eventsPlace[$place[0]->slug] = $place[0];
                }
                echo '<!--';
                print_r($eventsCity);
                echo '-->';

                echo '<!--';
                print_r($eventsType);
                echo '-->';

                echo '<!--';
                print_r($eventsPlace);
                echo '-->';
            ?>

            <div class="calendar-filters grid">

                <div class="filter words-filter">
                    <label data-toggler=".filter .soon|active">Скоро</label>

                    <div id="event-words" class="dropdown soon">
                        <ul>
                            <!-- <li><a data-action="none" class="plus" href="#">+</a></li> -->
                            <li><input type="radio" name="wordsfilter" id="plus" value="none"><label class="plus" for="plus">+</label></li>
                            <li><input type="radio" data-date="<?php echo current_time('d.m.Y'); ?>" data-alt-date="<?php echo current_time('Ymd'); ?>" name="wordsfilter" id="today" value="today" checked="checked"><label for="today">Сегодня</label></li>
                            <li><input type="radio" data-date="<?php echo date('d.m.Y', strtotime('tomorrow')); ?>" data-alt-date="<?php echo date('Ymd', strtotime('tomorrow')); ?>" name="wordsfilter" id="tomorrow" value="tomorrow"><label for="tomorrow">Завтра</label></li>
                            <li><input type="radio" name="wordsfilter" id="done" value="done"><label for="done">Прошедшие</label></li>
                            <li><input type="radio" data-date="<?php echo current_time('d.m.Y'); ?>" data-alt-date="<?php echo current_time('Ymd'); ?>" name="wordsfilter" id="closing" value="closing"><label for="closing">Закрываются</label></li>
                            <!-- <li><a data-date="<?php echo current_time('d.m.Y'); ?>" data-alt-date="<?php echo current_time('Ymd'); ?>" data-action="today" href="#">Сегодня</a></li> -->
                            <!-- <li><a data-date="<?php echo date('d.m.Y', strtotime('tomorrow')); ?>" data-alt-date="<?php echo date('Ymd', strtotime('tomorrow')); ?>" data-action="tomorrow" href="#">Завтра</a></li> -->
                            <!-- <li><a data-action="done" href="#">Прошедшие</a></li> -->
                            <!-- <li><a data-action="closing" href="#">Закрываются</a></li> -->
                        </ul>
                    </div>
                    <div class="inputs"><span class="soon-label plus event-words-current" data-toggler=".filter .soon|active">+</span></div>
                </div>

                <div class="filter range-filter">
                    <label class="event-date-range" data-toggler=".range-inputs|hide-item, .range-label|dn">Интервал</label>

                    <div class="range-inputs hide-item inputs">
                        С <input type="text" name="startdate" id="startdate" placeholder="..."> ПО
                        <input type="hidden" name="altstartdate" id="altstartdate">
                        <input type="text" name="enddate" id="enddate" placeholder="...">
                        <input type="hidden" name="altenddate" id="altenddate">
                        <a class="clear-range" href="#">Сбросить</a>
                    </div>
                    <div class="inputs range-label"><span class="plus" data-toggler=".range-inputs|hide-item, .range-label|dn">+</span></div>
                </div>

                <div class="filter">
                    <label for="event-city">Город</label><?php echo render_filter_select($eventsCity,'event-city', true, true, 'event-city', true); //render_filter_select(3843,'event-city', true, true); ?><a class="current event-city-current inputs plus" data-toggler=".event-city|active, this|active">+</a>
                </div>
                <!-- <label for="event-place">Место</label><?php echo render_filter_select(3844,'event-place'); ?> -->

                <div class="filter">
                    <label for="event-place">Тип</label><?php echo render_filter_select($eventsType,'event-type', false, true, 'event-type', true); //render_filter_select(3846,'event-type', false, true); ?><a class="current event-type-current inputs plus" data-toggler=".event-type|active, this|active">+</a>
                </div>
            </div>

        <?php } ?>

        <?php if(is_front_page()) { ?>
        <aside class="left cities">
            <!-- <label for="global-city"><a href="#" class="cities-plus" data-toggler=".global-city|active, this|active">Города </a></label> -->
            <?php
                // $main_cities = get_field('main_cities', 'options');
                // if($main_cities) {
                //     $current = 'Города ';
                //     // $main_cities_select = '<select name="global-city" class="global-city" id="global-city"><option value="">+</option>';
                //     $main_cities_select = '<div class="global-city" id="global-city"><ul>'; //<option value="">+</option>
                //         // foreach($main_cities as $city) $main_cities_select .= '<option value="'.$city->slug.'">'.$city->name.'</option>';
                //         foreach($main_cities as $city) {

                //             if(isset($_GET['city']) && $_GET['city'] != '' && $city->slug == $_GET['city']) $current = $city->name.' ';

                //             $main_cities_select .= '<li><a data-slug="'.$city->slug.'" href="'.esc_url( home_url( '/' ) ).'?city='.$city->slug.'">'.$city->name.'</a></li>';
                //         }

                //         $main_cities_select .= '<li><a data-slug="" href="'.get_permalink(44924).'">Еще</a></li>';
                //     // $main_cities_select .= '</select>';
                //     $main_cities_select .= '</ul></div>';

                //     echo '<label for="global-city"><a href="#" class="cities-plus" data-toggler=".global-city|active, this|active">'.$current.'</a></label>';
                //     echo $main_cities_select;
                // }
                if(!isset($_GET['filter']) || $_GET['filter'] == '') echo $cities;
            ?>
        </aside>
        <?php } else { ?>
        <aside class="left <?php if (in_category(array(2089,2088))) { ?>fuckthatshit<?php } ?>"><?php if (in_category(2089)) { ?> <a class="hidemebitch" href="/category/news"><h3>Новости</h3></a><?php } ?><?php if (in_category(2088)) { ?> <a class="hidemebitch" href="/category/calendar"><h3>Календарь</h3></a><?php } ?>
            <?php
            if(is_search()) {}//echo '<h3 class="section-title">Поиск<br>'.get_search_query().'</h3>';
            elseif(get_queried_object()->name) echo '<h3>'.get_queried_object()->name.'</h3>';
            //elseif(get_queried_object()->post_title && is_page()) echo '<h3>'.get_queried_object()->post_title.'</h3>';
                // else get_the_title(get_the_ID());
            ?>
        </aside>
        <?php } ?>

        <section class="site-main top-nav <?php if (in_category(array (2089,2088))) { ?>morebullshit<?php } ?>">

            <?php $tag_menu = get_field('tag_menu', 'options'); if(is_front_page() || in_category(2089)|| in_category(2088) && $tag_menu) { ?>

            <nav class="tags">
                <?php //wp_nav_menu( array('theme_location' => 'tags-menu') ); ?>
                <?php
                    $tag_menu_output = '<ul>';
                    // foreach($tag_menu as $item) $tag_menu_output .= '<li><a data-slug="'.$item->slug.'" href="'.get_term_link($item).'">#'.$item->name.'<sup>'.$item->count.'</sup></a></li>';
                        foreach($tag_menu as $item) {

                            if(isset($_GET['filter']) && $_GET['filter'] != '') {
                                if($item->slug == $_GET['filter']) $tag_menu_output .= '<li><a data-slug="'.$item->slug.'" href="'.esc_url( home_url( '/' ) ).'?filter='.$item->slug.'">#'.$item->name.'<sup>'.$item->count.'</sup></a></li>';
                            } else $tag_menu_output .= '<li><a data-slug="'.$item->slug.'" href="'.esc_url( home_url( '/' ) ).'?filter='.$item->slug.'">#'.$item->name.'<sup>'.$item->count.'</sup></a></li>';
                        }
                    $tag_menu_output .= '</ul>';
                    echo $tag_menu_output;
                ?>
                <a href="#" data-toggler=".tags ul|active, this|active" class="mobile expand"><span>+</span></a>
            </nav>

            <?php } ?>

        </section>
    </div>
