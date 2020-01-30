<?php

function pageBanner() {
    ?>
        <div class="page-banner">
            <!-- <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div> -->
            <div class="page-banner__bg-image" style=""></div>
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

function register_menus() {
    register_nav_menu('main-site-nav',__('Main Site Navigation'));
    register_nav_menu('footer-nav',__('Footer Navigation'));
}
add_action('init', 'register_menus');

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
    }
}

add_action('pre_get_posts', 'org_adjust_queries');

function load_fundraising_sidebar() {
    register_sidebar(array (
        'name' => 'Fundraising Progress Bar Area',
        'id' => 'fundraising-area',
        'before_widget' => ' ',
        'after_widget' => ' '
        ) );
}
add_action('widgets_init', 'load_fundraising_sidebar');

function load_fundraising_widget() {
    register_widget('fundraising_widget');
}
add_action('widgets_init', 'load_fundraising_widget');
/*
class fundraising_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'fundraising_widget',
            __('Fundraising Widget'),
            array(
                'description' => __('Displays progress bar depicting achievement of our fundraising goal.')     
			)
        );
	}

    public function widget( $args, $instance ) {
    }

    public function form ($instance) {
    
	}

    public function update ($new_instance, $old_instance) {
        return array();
	}
}*/

//The fundraising widget class
class fundraising_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'fundraising_widget',
            __('Fundraising Widget'),
            array(
                'description' => __('Displays progress bar depicting achievement of our fundraising goal.')     
			)
        );
	}

    public function widget( $args, $instance ) {
        if (isset( $instance['heading']))
            $heading = apply_filters( 'widget_heading', $instance['heading']);
        else
            $heading = '';

        if (isset( $instance['msg']))
            $msg = apply_filters( 'widget_msg', $instance['msg']);
        else
            $msg = '';

        if (isset( $instance['percentage']))
            $percentage = apply_filters( 'widget_percentage', $instance['percentage']);
        else
            $percentage = '0';

        if (isset( $instance['goal']))
            $goal = apply_filters( 'widget_goal', $instance['goal']);
        else
            $goal = '0';

        if (isset( $instance['donate_url']))
            $donate_url = apply_filters( 'widget_donate_url', $instance['donate_url']);
        else
            $donate_url = '#';

        echo $args['before_widget'];
        echo <<<END
            <div class="section-progress">  
                <style type="text/css">
                    @-webkit-keyframes progress-bar {
                        from { width: 0%; }
                        to { width: $percentage%; }
                    }

                    @-moz-keyframes progress-bar {
                        from { width: 0%; }
                        to { width: $percentage%; }
                    }

                    @-o-keyframes progress-bar {
                        from { width: 0%; }
                        to { width: $percentage%; }
                    }

                    @keyframes progress-bar {
                        from { width: 0%; }
                        to { width: $percentage%; }
                    }
                </style>
                <div class="progress-phrase">
                    <h2>$heading</h2>
                    <p>$msg
                    </p>
                </div>
                <?php // the bar itself ?>
                <div class="progress-container">
                    <div class="progress-bg">
                        <div class="progress-bar">
                            <h3 class="raised">$percentage%</h3>
                        </div>
                    </div>
                    <h3 class="goal">Goal: $goal</h3>
                    <div class="padding-button">
                        <p class="t-center no-margin"><a href="$donate_url" class="btn btn--yellow">Learn More</a></p>
                    </div>
                </div>
            </div>
END;
        echo $args['after_widget'];
	}

    public function form( $instance ) {
        if (isset( $instance['heading']))
            $heading = $instance['heading'];
        else
            $heading = '';

        if (isset( $instance['msg']))
            $msg = $instance['msg'];
        else
            $msg = '';

        if (isset( $instance['percentage']))
            $percentage = $instance['percentage'];
        else
            $percentage = '0';

        if (isset( $instance['goal']))
            $goal = $instance['goal'];
        else
            $goal = '0';

        if (isset( $instance['donate_url']))
            $donate_url = $instance['donate_url'];
        else
            $donate_url = '#';
        ?>
        <div>
            <label for="<?php echo $this->get_field_id( 'heading' ); ?>">Heading:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'heading' ); ?>" name="<?php echo $this->get_field_name( 'heading' ); ?>" type="text" value="<?php echo esc_attr( $heading ); ?>" />
        </div>
        <div style="vertical-align: top;">
            <label for="<?php echo $this->get_field_id( 'msg' ); ?>">Message:</label>
            <textarea id="<?php echo $this->get_field_id( 'msg' ); ?>" name="<?php echo $this->get_field_name( 'msg' ); ?>" style="width: 100%" rows="10"><?php echo esc_attr( $msg ); ?></textarea>
        </div>
        <div>
            <label for="<?php echo $this->get_field_id( 'percentage' ); ?>">Percentage:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'percentage' ); ?>" name="<?php echo $this->get_field_name( 'percentage' ); ?>" type="text" value="<?php echo esc_attr( $percentage ); ?>" />
        </div>
        <div>
            <label for="<?php echo $this->get_field_id( 'goal' ); ?>">Goal:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'goal' ); ?>" name="<?php echo $this->get_field_name( 'goal' ); ?>" type="text" value="<?php echo esc_attr( $goal ); ?>" />
        </div>
        <?php
	}

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['heading'] = ( ! empty( $new_instance['heading'] ) ) ? strip_tags( $new_instance['heading'] ) : '';
        $instance['msg'] = ( ! empty( $new_instance['msg'] ) ) ? strip_tags( $new_instance['msg'] ) : '';
        $instance['percentage'] = ( ! empty( $new_instance['percentage'] ) ) ? strip_tags( $new_instance['percentage'] ) : '';
        $instance['goal'] = ( ! empty( $new_instance['goal'] ) ) ? strip_tags( $new_instance['goal'] ) : '';
        $instance['donate_url'] = ( ! empty( $new_instance['donate_url'] ) ) ? strip_tags( $new_instance['donate_url'] ) : '';

        return $instance;
	}
}

?>
