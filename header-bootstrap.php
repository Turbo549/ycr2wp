<!DOCTYPE html>
<html <?php language_attributes()?>>
    <head>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>        

        <meta charset='<?php bloginfo('charset');?>'>
        <meta name = 'viewport' content = 'width=device-width, initial scale = 1'>
        <?php wp_head(); ?>
        <meta charset="utf-8">
        <title>YouCanRide2</title>
    </head>
    <body <?php body_class();?>>
        <header class="site-header">
          <div class ="container">
            
          <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            
            <div class="site-header__menu group">
              <!--<nav class="main-navigation">-->
              <nav class="navbar navbar-light navbar-expand-lg bg-light !importants">
                <a class="navbar-brand" href="#">
                <img class="navbar-brand navbar-logo" src="<?php echo get_theme_file_uri('/images/logo.png') ?>" alt="logo" style="width:40px;">
                </a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="#navbarMenu">
                  <ul class="navbar-nav ml-auto">
                    <li <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 6) echo 'class="nav-item current-menu-item"'?>>
                    <a href="<?php echo site_url('/about-us') ?>" class="nav-link">About Us</a></li>
                    
                    <li <?php if (is_page('programs')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/programs');?>" class="nav-link">Programs</a></li>
                    <li <?php if (get_post_type() == 'event') echo 'class="current-menu-item"' ?>>
                    <a href="<?php echo get_post_type_archive_link('event'); ?>" class="nav-link">Events</a></li>
                    <li <?php if (is_page('donate')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/donate');?>" class="nav-link">Donate</a></li>
                    <li <?php if (is_page('volunteer')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/volunteer');?>" class="nav-link">Volunteer</a></li>
                    <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>>
                    <a href="<?php echo site_url('/blog');?>" class="nav-link">Blog</a></li>
                    <li <?php if (is_page('contact')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/contact');?>" class="nav-link">Contact</a></li>
                  </ul>
                </div>
                
              </nav>
            </div>
          </div>
        </header>
                <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
