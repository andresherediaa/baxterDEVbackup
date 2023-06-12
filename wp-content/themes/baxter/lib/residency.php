<?php

class Residency
{
	public function __construct()
	{
		// Register Residency as a custom post type.
		register_post_type( 'baxter_residency', array(
			'labels' => array(
				'name' => 'Residencies',
				'singular_name' => 'Residency'
			),
			'public' => true,
      		'show_in_nav_menus' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'residencies' ),
			'hierarchical' => false,
			'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail' )
		) );

		// Add meta boxes to the edit page
		add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );

		// Save the data when updating a Exhibition.
		add_action( 'save_post', array( &$this, 'save_post' ) );
	}

	public function add_meta_boxes()
	{
        add_meta_box( 'year', 'Year', array(&$this, 'year'), 'baxter_residency', 'side', 'default' );
    }
    
    public function year($post)
	{
        $custom = get_post_custom( $post->ID );
		$year = '';
        if ( isset( $custom['year'] ) ) $year = $custom['year'][0];
        
        $already_selected_value = $year;
        $earliest_year = 1950;
        
		?>
        <div class="control-group">
		    <div class="controls">
                <select name="year">
                <?php
                foreach (range(date('Y'), $earliest_year) as $x) { ?>
                    <option value="<?php echo $x; ?>" <?php if ($x == $already_selected_value) echo 'selected'; ?>><?php echo $x; ?></option>
                <?php }
                ?>
                </select>
            </div>
        </div>
		<?php
    }

	public function save_post( $post_id )
	{
		if ( isset( $_POST['year'] ) ) update_post_meta($post_id, 'year', $_POST['year']);
	}

}


add_action( 'init', 'load_residency' );
function load_residency()
{
  $residency = new Residency();
}
