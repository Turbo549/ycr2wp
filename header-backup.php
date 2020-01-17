<!DOCTYPE html>
<html <?php language_attributes()?>>
    <head>
        <meta charset='<?php bloginfo('charset');?>'>
        <meta name = 'viewport' content = 'width=device-width, initial scale = 1'>
        <?php wp_head(); ?>
        <meta charset="utf-8">
        <title>YouCanRide2</title>
    </head>
    <body <?php body_class();?>>
        <header class="site-header">
          <div class="container">
            <a href='<?php echo site_url();?>'><img src= '<?php echo get_theme_file_uri('/images/logo.png') ?>);' class="school-logo-text float-left"></a>
            <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group">
              <nav class="main-navigation">
                <ul>
                  <li <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 6) echo 'class="nav-item current-menu-item"'?>>
                  <a href="<?php echo site_url('/about-us') ?>">About Us</a></li>
                  <li <?php if (is_page('programs')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/programs');?>">Programs</a></li>
                  <li <?php if (get_post_type() == 'event') echo 'class="current-menu-item"' ?>>
                  <a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a></li>
                  <li <?php if (is_page('donate')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/donate');?>">Donate</a></li>
                  <li <?php if (is_page('volunteer')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/volunteer');?>">Volunteer</a></li>
                  <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>>
                  <a href="<?php echo site_url('/blog');?>">Blog</a></li>
                  <li <?php if (is_page('contact')) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/contact');?>">Contact</a></li>
                </ul>
              </nav>
              <!-- <div class="site-header__util">
                <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
                <a href="#" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
                <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div> -->
            </div>
          </div>
        </header>
