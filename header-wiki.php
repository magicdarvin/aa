<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <title>AroundArt</title> -->
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
    <div class="banner-top container">
        <?php 
            // $top_banner = get_field('top_banner', 'options');
            // $top_banner_link = get_field('top_banner_link', 'options');
            // if($top_banner_link) echo '<a href="'.$top_banner_link.'"><img src="'.$top_banner.'"></a>';
            // elseif($top_banner) echo '<img src="'.$top_banner.'">'; 
        ?>
        <?php
            $top_banner = get_field('top_banner', 'options');
            if($top_banner) echo $top_banner;
        ?>
        <!-- <img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/banner-top.jpg" alt=""> -->
    </div>

    <header class="site-header container">
        <div class="top-deck grid spread">
            <nav class="mobile">
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
        </div>
        <div class="bottom-deck">
            <div class="grid spread middle wrap">
                <!-- <a class="wiki-link" href="<?php echo get_permalink(44589); ?>">Справочник</a> -->
                <a href="#" data-toggler=".top-deck|active, self|active" class="mobile mobile-menu"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/menu.png" alt="Меню"></a>
                <a href="#" data-toggler=".search-block|active" class="mobile mobile-search"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.png" alt="Поиск"></a>
                
                <div class="logo"><a href="<?php echo get_permalink(44589); ?>"><span>справочник</span></a><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="black" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.jpg" alt=""><img class="blue" src="<?php echo get_stylesheet_directory_uri(); ?>/img/aroundartblue.jpg" alt=""></a></div>

                <a href="#" data-toggler=".search-block|active" class="desktop search-button"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.png" alt="Поиск"></a>
            </div>
            
        </div>

        <div class="search-block">
                <?php get_search_form(); ?>
            </div>
    </header>