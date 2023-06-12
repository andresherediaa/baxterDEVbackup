<?php

class Secondary_Events_Slider extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 
			'classname' => 'baxter_secondary_events_slider',
			'description' => 'Secondary Events Slider',
		);
		parent::__construct( 'baxter_secondary_events_slider', 'Secondary Events Slider', $widget_ops );
    }

    public function widget( $args, $instance ) {
		// outputs the content of the widget
        echo $args['before_widget'];
        $event_ids = ! empty($instance['event_ids']) ? explode(',', $instance['event_ids']) : array();
        ?>
        <section class="secondary-events-slider">
            <div class="left-right left-right--two-thirds">
                <div class="left-right-inner">
                    <?php
                    foreach ($event_ids as $event_id) {
                        $event = get_post($event_id);
                        $custom = get_post_custom( $event->ID );
                        // $image = wp_get_attachment_url( get_post_thumbnail_id( $event->ID ) );
                        // if ( ! $image) {
                        //     $image = get_template_directory_uri() . '/images/blank.png';
                        // }

                        if ( isset( $custom['baxter_featured_image_2'] ) ) {
                            $image = $custom['baxter_featured_image_2'][0];
                        } else {
                            $image = wp_get_attachment_url( get_post_thumbnail_id( $event->ID ) );
                        }
                        if ( ! $image) {
                            $image = get_template_directory_uri() . '/images/blank.png';
                        }

                        $excerpt = empty($event->post_excerpt) ? wp_trim_words($event->post_content, 55, '') : $event->post_excerpt;
                        $start_date = get_post_meta( $event->ID, 'start_date', true );
                        $start_date_time = DateTime::createFromFormat('Y-m-d', $start_date);
                        $end_date = get_post_meta( $event->ID, 'end_date', true );
                        $end_date_time = DateTime::createFromFormat('Y-m-d', $end_date);

                        $date = get_the_date('F j, Y', $event->ID);

                        $curator = get_post_meta($event->ID, 'curator', true);
                        $eyebrow = baxter_eyebrow($event);
                        ?>
                        <div>
                            <div class="secondary-event">            
                                <div class="left-right-left">
                                    <a href="<?php echo get_permalink($event->ID); ?>"><img src="<?php echo $image; ?>"></a>
                                </div>
                                <div class="left-right-right">
                                    <h2 class="font-medium font-eyebrow"><a href="<?php echo get_permalink($event->ID); ?>"><?php echo $eyebrow; ?></a></h2>
                                    <h1 class="font-medium no-top-margin"><a href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a></h1>
                                    <div><?php echo $excerpt; ?></div>
                                    <div class="secondary-event__meta">
                                        <p class="read-more"><a href="<?php echo get_permalink($event->ID); ?>">READ MORE</a><span class="secondary-event__arrows"></span></p>
                                        <hr>
                                        <?php if ($start_date_time && $end_date_time) { ?>
                                            <h4 class="font-medium font-small color-gray"><?php echo $start_date_time->format('F j, Y'); ?> - <?php echo $end_date_time->format('F j, Y'); ?></h4>
                                        <?php } else if ($start_date_time) { ?>
                                            <h4 class="font-medium font-small color-gray"><?php echo $start_date_time->format('F j, Y'); ?></h4>
                                        <?php } else { ?>
                                            <h4 class="font-medium font-small color-gray"><?php echo $date; ?></h4>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div><!-- .left-right-inner -->
            </div><!-- .left-right -->   
        </section>
        <?php
        echo $args['after_widget'];
	}

    public function form( $instance ) {
		// outputs the options form on admin
        $event_ids = ! empty($instance['event_ids']) ? explode(',', $instance['event_ids']) : array();
        
        $event_args = array(
            'post_type' => array('baxter_event', 'post'),
            // 'meta_key' => 'start_date',
            // 'orderby' => 'meta_value',
            'orderby' => 'date',
            'order' => 'DESC',
            'numberposts' => 50
        );
        $events = get_posts($event_args);
        ?>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'event_ids' ) ); ?>">Featured Events</label> 
        <?php
        foreach ($events as $event) {
            $checked = '';
            if (in_array($event->ID, $event_ids)) {
                $checked = ' checked="checked"';
            }
            ?>
            <div>
                <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('event_ids')); ?>" name="<?php echo esc_attr($this->get_field_name('event_ids[]')); ?>" value="<?php echo $event->ID; ?>" <?php echo $checked; ?>>
                <label for="<?php echo $this->get_field_id('event_ids'); ?>"><?php echo $event->post_title; ?></label>
            </div>
            <?php
        }
        ?>
		</p>
        <?php
	}

    public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = $old_instance;
        $instance['event_ids'] = !empty($new_instance['event_ids']) ? implode(',', $new_instance['event_ids']) : '';
        return $instance;
	}
}

add_action( 'widgets_init', function(){
    register_widget( 'Secondary_Events_Slider' );

    register_sidebar( array(
		'name'          => 'Secondary Events Slider',
		'id'            => 'baxter_secondary_events_slider',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div>',
		'after_title'   => '</div>',
	) );
});