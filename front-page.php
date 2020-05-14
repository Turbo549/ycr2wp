<!-- BEGIN front-page.php -->

<?php get_header(); ?>


<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/header.png') ?>);"></div>
      <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">You Can Ride 2</h1>
        <h2 class="headline headline--medium">Cycling For All</h2>
        <h3 class="headline headline--small"></h3>
        <!-- <a href="<?php echo site_url('/donate');?>" class="btn btn--large btn--blue">Donate Today</a> -->
      </div>
    </div>

    <?php // New section addidtion for donation goals ?>
    <?php if ( is_active_sidebar( 'fundraising-area' ) ) : ?>
        <?php dynamic_sidebar( 'fundraising-area' ); ?>
    <?php endif; ?>
    <?php //End progress bar section ?>

</div>

<!-- Gallery Section Attempt

<section class="wrapper">
  <div class="gallery">
    <div class="info1">
      <h2>Hello H2</h2>
    </div>
    <div class="gallery1 gallery-photos">
      <img src="<?php //echo get_theme_file_uri('/images/gallery1.jpg') ?>" alt="">
    </div>
    <div class="gallery2 gallery-photos">
      <img src="<?php //echo get_theme_file_uri('/images/gallery2.jpg') ?>" alt="">
    </div>
    <div class="gallery3 gallery-photos" style="transform: rotate(90deg);">
      <img src="<?php //echo get_theme_file_uri('/images/gallery3.jpg') ?>" alt="">
    </div>
    <div class="gallery4 gallery-photos" style="transform: rotate(180deg);">
      <img src="<?php //echo get_theme_file_uri('/images/gallery4.jpg') ?>" alt="">
    </div>
    <div class="gallery5 gallery-photos">
      <img src="<?php //echo get_theme_file_uri('/images/gallery5.jpg') ?>" alt="">
    </div>
    <div class="gallery6 gallery-photos">
      <img src="<?php //echo get_theme_file_uri('/images/gallery6.jpg') ?>" alt="">
    </div>
  </div>
</section> 
-->

<div class="covid--container">
  <h2 class="covid-title">
  COVID-19 Update
  </h2>
  <p class="covid-message covid">
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
  Nulla non dui libero. Aliquam consectetur bibendum ipsum quis fermentum. 
  Nulla non aliquet dolor. Nam et augue quis dui tempor bibendum a ut orci. 
  Quisque nec eleifend nunc. Quisque nunc orci, molestie condimentum lorem id, 
  ultricies placerat orci. Phasellus sed arcu nec ante faucibus iaculis. 
  Ut ut leo et elit molestie scelerisque vehicula et urna. 
  </p>
  <p class="t-center no-margin"><a href="<?php echo site_url('/about-us/covid-19-update/');?>" class="btn btn--yellow">Read Full Details</a></p>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>  

      <?php
        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
          'posts_per_page' => 2,
          'post_type' => 'event',
          'meta_key' => 'event_date',
          'orderby' => 'meta_value_num', 
          'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
          )
        ));

        while($homepageEvents->have_posts()) {
          $homepageEvents->the_post(); ?>
          <div class="event-summary">
            <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php 
            $eventDate = new DateTime(get_post_field('event_date'));
            echo $eventDate->format('M')
          ?></span>
          <span class="event-summary__day"><?php 
            $eventDate = new DateTime(get_post_field('event_date'));
            echo $eventDate->format('d')
          ?></span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          <p><?php if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                } ?> <a href="<?php the_permalink(); ?>" class="nu gray new-line">Learn more</a></p>
        </div>
        </div>
        <?php }

      ?>

      <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>

    </div>
  </div>
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">From Our Blog</h2>
      <?php
        $homepagePosts = new WP_Query(array(
            'posts_per_page' => 2
        ));

        while ($homepagePosts -> have_posts()) {
            $homepagePosts -> the_post(); ?>
            <div class="event-summary">
                <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php the_time('M'); ?></span>
                <span class="event-summary__day"><?php the_time('d'); ?></span>
                </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                }
                ?><a href="<?php the_permalink(); ?>" class="nu gray new-line">Read more</a></p>
            </div>
            </div>
            <?php 
      } wp_reset_postdata();
      ?>

    

      <p class="t-center no-margin"><a href="<?php echo site_url('/blog');?>" class="btn btn--yellow">View All Posts</a></p>
    </div>
  </div>
</div>

<div class="hero-slider">
<div class="hero-slider__slide slide1" style="background-image: url(<?php echo get_theme_file_uri('images/gallery5.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">Volunteer</h2>
      <p class="t-center">Learn about our volunteer opportunities.</p>
      <p class="t-center no-margin"><a href="<?php echo site_url('/volunteer');?>" class="btn btn--blue">Learn more</a></p>
    </div>
  </div>
</div>
<div class="hero-slider__slide slide2" style="background-image: url(<?php echo get_theme_file_uri('images/gallery6.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">Donate</h2>
      <p class="t-center">Click here to donate today.</p>
      <p class="t-center no-margin"><a href="<?php echo site_url('/donate');?>" class="btn btn--blue">Learn More</a></p>
    </div>
  </div>
</div>
<div class="hero-slider__slide slide3" style="background-image: url(<?php echo get_theme_file_uri('images/gallery7.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">Watch Our Story</h2>
      <p class="t-center">See us in the news.</p>
      <p class="t-center no-margin"><a href="https://www.youtube.com/watch?v=lB2pQUH8owI" class="btn btn--blue">Watch Here</a></p>
    </div>
  </div>
</div>
</div>

<?php
get_footer();
?>
<!-- END front-page.php -->
