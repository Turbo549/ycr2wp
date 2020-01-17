<?php

function pageBanner() {
    ?>
<div class="page-banner">
       <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
       <div class="page-banner__content container container--narrow">
         <h1 class="page-banner__title"><?php the_title(); ?></h1>
         <div class="page-banner__intro">
           <!-- <p>Don't forget to implement dynamic later.</p> TODO replace me later -->
         </div>
       </div>
     </div>
    <?php
}


function organization_files() {
    //importing the font awesome, this is copied after http: and isn't using the link because this is how wordpress manages them
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri());
    //to load javascript, just change style to script - NULL means no dependencies - version number - do you want to load right before closing body tag
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
}

add_action('wp_enqueue_scripts', 'organization_files');

function organization_features() {
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'organization_features');

function org_adjust_queries($query) {
   if (!is_admin() AND is_post_type_archive('event')) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
      ));
    }}


add_action('pre_get_posts', 'org_adjust_queries');

 ?>
