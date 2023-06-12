<?php

class Alumni_Header extends WP_Widget {
    public function __construct() {
        $widget_ops = array( 
			'classname' => 'baxter_alumni_header',
			'description' => 'Alumni Header',
		);
		parent::__construct( 'baxter_alumni_header', 'Alumni Header', $widget_ops );
    }

    public function widget( $args, $instance ) {
		// outputs the content of the widget
        echo $args['before_widget'];
		$alumni_summary = get_post(21837);
		$summary = $alumni_summary->post_content;
		$summary = apply_filters('the_content', $summary);
		$summary = str_replace(']]>', ']]&gt;', $summary);
        $alumni_ids = ! empty($instance['alumni_ids']) ? explode(',', $instance['alumni_ids']) : array();
		$alumni_type = '';
		$related_program = '';
		$order_by = '';
		$search_param = '';

		if (isset($_GET['alumni_type'])) $alumni_type = $_GET['alumni_type']; 
		if (isset($_GET['related_program'])) $related_program = $_GET['related_program'];
		if (isset($_GET['order_by'])) $order_by = $_GET['order_by'];
		if (isset($_GET['search_param'])) $search_param = $_GET['search_param'];
        ?>
        <div class="alumni-form" id="alumni-form">
		  <div class="alumni-form-inner">
			<h1>Alumni</h1>
			<div class="alumni-form-res">
				<?php echo $summary; ?>
			</div>
			<div class="search-sort-options">
			  <div class="sort-categories">
				<select id="filter_type">
				  <option value="">All Alumni</option>
				  <option value="artists" <?php if ($alumni_type == 'artists') echo 'selected'; ?>>Artists</option>
				  <option value="curators" <?php if ($alumni_type == 'curators') echo 'selected'; ?>>Curators</option>
				  <option value="writers" <?php if ($alumni_type == 'writers') echo 'selected'; ?>>Writers</option>
				</select>

				<select id="filter_program">
				  <option value="">All Programs</option>
				  <option value="baxter_residency" <?php if ($related_program == 'baxter_residency') echo 'selected'; ?>> Baxter St. Residency</option>
				  <option value="guest_curatorial" <?php if ($related_program == 'guest_curatorial') echo 'selected'; ?>>Guest Curatorial Program</option>
				  <option value="nominations_competitions" <?php if ($related_program == 'nominations_competitions') echo 'selected'; ?>>Nominations &amp; Juried Competitions</option>
				  <option value="project_space" <?php if ($related_program == 'project_space') echo 'selected'; ?>>Project Space</option>
				  <option value="stoneleaf_residency" <?php if ($related_program == 'stoneleaf_residency') echo 'selected'; ?>>STONELEAF Residency</option>
				  <option value="youngarts_residency" <?php if ($related_program == 'youngarts_residency') echo 'selected'; ?>>YoungArts Residency</option>
				  <option value="zine_photobook" <?php if ($related_program == 'zine_photobook') echo 'selected'; ?>>Zine and Photobook Fair</option>
				</select>

				<select id="filter_order_by">
				  <option value="">Order by</option>
				  <option value="a_z" <?php if ($order_by == 'a_z') echo 'selected'; ?>>A to Z</option>
				  <option value="z_a" <?php if ($order_by == 'z_a') echo 'selected'; ?>>Z to A</option>
				  <option value="old_new" <?php if ($order_by == 'old_new') echo 'selected'; ?>>Oldest to Newest</option>
				  <option value="new_old" <?php if ($order_by == 'new_old') echo 'selected'; ?>>Newest to Oldest</option>
				</select>

				<a class="reset-link">Reset</a>
			  </div><!--.sort-categories-->
			  <div class="search-bar">
				<input type="text" autocomplete="off" name="search_param" id="search_param" value=<?php echo $search_param; ?>>
				<button class="search-button-alumni">Search</button>
			  </div><!--.search-bar-->
			</div><!--.search-sort-options-->
		  </div><!-- .alumni-form-inner -->
		</div><!-- .alumni-form -->

        <?php
        echo $args['after_widget'];
	}
	
	public function form( $instance ) {
		// outputs the options form on admin
        $alumni_ids = ! empty($instance['alumni_ids']) ? explode(',', $instance['alumni_ids']) : array();
        
        $all_alumni_args = array(
			'post_type' => 'baxter_alumni',
			'post_status' => 'publish',
			'post__not_in'  => array( 21837 ),
			'numberposts' => -1,
			'posts_per_page' => 9,
			'paged' => $paged,
			'meta_query' => array(
				'last_name__order_by' => array(
					'key' => 'last_name',
					'compare' => 'exists',
				)
			),
			'orderby' => array( 'last_name__order_by' => 'ASC' )
		);
        $alumni = get_posts($all_alumni_args);
        ?>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'alumni_ids' ) ); ?>">Alumni</label> 
        <?php
        foreach ($alumni as $al) {
            $checked = '';
            if (in_array($al->ID, $alumni_ids)) {
                $checked = ' checked="checked"';
            }
            ?>
            <div>
                <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('alumni_ids')); ?>" name="<?php echo esc_attr($this->get_field_name('alumni_ids[]')); ?>" value="<?php echo $al->ID; ?>" <?php echo $checked; ?>>
                <label for="<?php echo $this->get_field_id('alumni_ids'); ?>"><?php echo $al->post_title; ?></label>
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
        $instance['alumni_ids'] = !empty($new_instance['alumni_ids']) ? implode(',', $new_instance['alumni_ids']) : '';
        return $instance;
	}
}

add_action( 'widgets_init', function(){
    register_widget( 'Alumni_Header' );

    register_sidebar( array(
		'name'          => 'Alumni Header',
		'id'            => 'baxter_alumni_header',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<div>',
		'after_title'   => '</div>',
	) );
});