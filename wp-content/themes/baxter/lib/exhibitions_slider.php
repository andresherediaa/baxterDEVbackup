<?php

class Exhibitions_Slider extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 
			'classname' => 'baxter_exhibitions_slider',
			'description' => 'Exhibitions Slider',
		);
		parent::__construct( 'baxter_exhibitions_slider', 'Exhibitions Slider', $widget_ops );
    }

    public function widget( $args, $instance ) {
		// outputs the content of the widget
        echo $args['before_widget'];
        $event_ids = ! empty($instance['event_ids']) ? explode(',', $instance['event_ids']) : array();
        ?>
        <section class="exhibitions-slider">
        <?php
        foreach ($event_ids as $event_id) {
            $event = get_post($event_id);
            $custom = get_post_custom( $event->ID );
            if ( isset( $custom['baxter_featured_image_2'] ) && $custom['baxter_featured_image_2'][0]) {
                $image = $custom['baxter_featured_image_2'][0];
            } else {
                $image = wp_get_attachment_url( get_post_thumbnail_id( $event->ID ) );
            }
            if ( ! $image) {
                $image = get_template_directory_uri() . '/images/blank.png';
            }
            $start_date = get_post_meta( $event->ID, 'start_date', true );
            $start_date_time = DateTime::createFromFormat('Y-m-d', $start_date);
            $end_date = get_post_meta( $event->ID, 'end_date', true );
            $end_date_time = DateTime::createFromFormat('Y-m-d', $end_date);
            $artist = get_post_meta( $event->ID, 'artist', true );
            $curator = get_post_meta($event->ID, 'curator', true);
            $eyebrow = baxter_eyebrow($event);
            ?>
            <div class="hero hero-home" style="background-image: url('<?php echo $image; ?>')">
                <a href="<?php echo get_permalink($event->ID); ?>">
                    <div class="hero-overlay">
                        <p class="hero__eyebrow font-eyebrow font-medium"><?php echo $eyebrow; ?></p>
                        <h1 class="hero__title"><?php echo $event->post_title; ?></h1>
                        <?php if ($artist) { ?>
                            <h2 class="hero__artist font-medium"><?php echo $artist; ?></h2>
                        <?php } else if ($curator) { ?>
                            <h2 class="hero__curator font-medium">Curated by <?php echo $curator; ?></h2>
                        <?php } ?>
                        <?php if ($start_date_time && $end_date_time) { ?>
                            <p class="hero__date font-medium"><?php echo $start_date_time->format('F j, Y'); ?> - <?php echo $end_date_time->format('F j, Y'); ?></p>
                        <?php } else if ($start_date_time) { ?>
                            <p class="hero__date font-medium"><?php echo $start_date_time->format('F j, Y'); ?></p>
                        <?php } ?>
                    </div>
                </a>
            </div>        
            <?php
        }
        ?>
        </section>
        <?php
        echo $args['after_widget'];
	}

    public function form( $instance ) {
		// outputs the options form on admin
        $event_ids = ! empty($instance['event_ids']) ? explode(',', $instance['event_ids']) : array();
        
        $event_args = array(
            'post_type' => 'baxter_event',
            'meta_query' => array(
                array(
                    'key' => 'event_type',
                    'value' => 'exhibition',
                    'compare' => '='
                )
            ),
            'meta_key' => 'start_date',
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'numberposts' => -1
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
    register_widget( 'Exhibitions_Slider' );

    register_sidebar( array(
		'name'          => 'Exhibitions Slider',
		'id'            => 'baxter_exhibitions_slider',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div>',
		'after_title'   => '</div>',
	) );
});