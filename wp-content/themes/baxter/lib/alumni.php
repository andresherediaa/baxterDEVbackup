<?php

class Alumni
{
	public function __construct()
	{
		// Register Alumni as a custom post type.
		register_post_type( 'baxter_alumni', array(
			'labels' => array(
				'name' => 'Alumni',
				'singular_name' => 'Alumni'
			),
			'public' => true,
      		'show_in_nav_menus' => true,
			'has_archive' => false,
			'rewrite' => array( 'slug' => 'all-alumni' ),
			'hierarchical' => false,
			'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail' ),
			'show_in_rest' => true,
		) );

		// Add meta boxes to the edit page
		add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );

		// Save the data when updating an Alumni member.
		add_action( 'save_post', array( &$this, 'save_post' ) );
	}

	public function add_meta_boxes()
	{
        add_meta_box( 'last_name', 'Last Name', array(&$this, 'last_name'), 'baxter_alumni', 'side', 'default' );
		add_meta_box( 'alumni_type', 'All Alumni', array(&$this, 'alumni_type'), 'baxter_alumni', 'side', 'default' );
		add_meta_box( 'related_program', 'All Programs', array(&$this, 'related_program'), 'baxter_alumni', 'side', 'default' );
		add_meta_box( 'year', 'Year', array(&$this, 'year'), 'baxter_alumni', 'side', 'default' );
		add_meta_box( 'viewing_room', 'Viewing Room', array(&$this, 'viewing_room'), 'baxter_alumni', 'side', 'default' );
		add_meta_box( 'portfolio_site', 'Portfolio Site', array(&$this, 'portfolio_site'), 'baxter_alumni', 'side', 'default' );
		add_meta_box( 'ig_link', 'Instagram Link', array(&$this, 'ig_link'), 'baxter_alumni', 'side', 'default' );
		add_meta_box( 'alumni_gallery', 'Gallery', array(&$this, 'alumni_gallery'), 'baxter_alumni', 'side', 'default' );
  }
    public function last_name($post)
	{
		$custom = get_post_custom( $post->ID );
		$last_name = '';
		if ( isset( $custom['last_name'] ) ) $last_name = $custom['last_name'][0];
		?>
        <div class="control-group">
  		    <div class="controls">
  		        <input type="text" name="last_name" value="<?php echo $last_name; ?>">
  		    </div>
        </div>
		<?php
	}
	
    public function alumni_type($post)
	{
    $custom = get_post_custom( $post->ID );
		$alumni_type = '';
		if ( isset( $custom['alumni_type'] ) ) $alumni_type = $custom['alumni_type'][0];
		?>
        <div class="control-group">
		    <div class="controls">
                <select name="alumni_type">
                    <option value="artists" <?php if ($alumni_type == 'artist') echo 'selected'; ?>>Artists</option>
                    <option value="curators" <?php if ($alumni_type == 'curator') echo 'selected'; ?>>Curators</option>
                    <option value="writers" <?php if ($alumni_type == 'writers') echo 'selected'; ?>>Writers</option>
                </select>
            </div>
        </div>
		<?php
    }
    
    public function related_program($post)
	{
		$custom = get_post_custom( $post->ID );
		$related_program = '';
		if ( isset( $custom['related_program'] ) ) $related_program = $custom['related_program'][0];
		?>
        <div class="control-group">
		    <div class="controls">
                <select name="related_program">
                    <option value="baxter_residency" <?php if ($related_program == 'baxter_residency') echo 'selected'; ?>>Baxter St. Residency</option>
					<option value="guest_curatorial" <?php if ($related_program == 'guest_curatorial') echo 'selected'; ?>>Guest Curatorial Program</option>
					<option value="nominations_competitions" <?php if ($related_program == 'nominations_competitions') echo 'selected'; ?>>Nominations &amp; Juried Competitions</option>
					<option value="project_space" <?php if ($related_program == 'project_space') echo 'selected'; ?>>Project Space</option>
					<option value="stoneleaf_residency" <?php if ($related_program == 'stoneleaf_residency') echo 'selected'; ?>>STONELEAF Residency</option>
					<option value="youngarts_residency" <?php if ($related_program == 'youngarts_residency') echo 'selected'; ?>>YoungArts Residency</option>
					<option value="zine_photobook" <?php if ($related_program == 'zine_photobook') echo 'selected'; ?>>Zine and Photobook Fair</option>
                </select>
            </div>
        </div>
		<?php
	}
	
	public function year($post)
	{
		$custom = get_post_custom( $post->ID );
		$year = '';
		if ( isset( $custom['year'] ) ) $year = $custom['year'][0];
		?>
        <div class="control-group">
  		    <div class="controls">
  		        <input type="text" name="year" value="<?php echo $year; ?>">
  		    </div>
        </div>
		<?php
	}
	
	public function viewing_room($post)
	{
		$custom = get_post_custom( $post->ID );
		$viewing_room = '';
		if ( isset( $custom['viewing_room'] ) ) $viewing_room = $custom['viewing_room'][0];
		?>
        <div class="control-group">
  		    <div class="controls">
  		        <input type="text" name="viewing_room" value="<?php echo $viewing_room; ?>">
  		    </div>
        </div>
		<?php
	}
	

	public function portfolio_site($post)
	{
		$custom = get_post_custom( $post->ID );
		$portfolio_site = '';
		if ( isset( $custom['portfolio_site'] ) ) $portfolio_site = $custom['portfolio_site'][0];
		?>
        <div class="control-group">
  		    <div class="controls">
  		        <input type="text" name="portfolio_site" value="<?php echo $portfolio_site; ?>">
  		    </div>
        </div>
		<?php
	}
	
	public function ig_link($post)
	{
		$custom = get_post_custom( $post->ID );
		$ig_link = '';
		if ( isset( $custom['ig_link'] ) ) $ig_link = $custom['ig_link'][0];
		?>
        <div class="control-group">
  		    <div class="controls">
  		        <input type="text" name="ig_link" value="<?php echo $ig_link; ?>">
  		    </div>
        </div>
		<?php
	}
	
	public function alumni_gallery($post)
	{
		//an array with all the images (ba meta key). The same array has to be in custom_postimage_meta_box_save($post_id) as well.
		$meta_keys = array('image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7');

		foreach($meta_keys as $meta_key){
			$image_meta_val=get_post_meta( $post->ID, $meta_key, true);
			?>
			<div class="custom_postimage_wrapper" id="<?php echo $meta_key; ?>_wrapper" style="margin-bottom:20px;">
				<img src="<?php echo ($image_meta_val!=''?wp_get_attachment_image_src( $image_meta_val)[0]:''); ?>" style="width:100%;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" alt="">
				<a class="addimage button" onclick="custom_postimage_add_image('<?php echo $meta_key; ?>');"><?php _e('Add Image','BaxterSt'); ?></a><br>
				<a class="removeimage" style="color:#a00;cursor:pointer;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" onclick="custom_postimage_remove_image('<?php echo $meta_key; ?>');"><?php _e('Remove Image','BaxterSt'); ?></a>
				<input type="hidden" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo $image_meta_val; ?>" />
			</div>
		<?php } ?>
		<script>
		function custom_postimage_add_image(key){

			var $wrapper = jQuery('#'+key+'_wrapper');

			custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
				title: '<?php _e('Select Image','BaxterSt'); ?>',
				button: {
					text: '<?php _e('Select Image','BaxterSt'); ?>'
				},
				multiple: false
			});
			custom_postimage_uploader.on('select', function() {

				var attachment = custom_postimage_uploader.state().get('selection').first().toJSON();
				var img_url = attachment['url'];
				var img_id = attachment['id'];
				$wrapper.find('input#'+key).val(img_id);
				$wrapper.find('img').attr('src',img_url);
				$wrapper.find('img').show();
				$wrapper.find('a.removeimage').show();
			});
			custom_postimage_uploader.on('open', function(){
				var selection = custom_postimage_uploader.state().get('selection');
				var selected = $wrapper.find('input#'+key).val();
				if(selected){
					selection.add(wp.media.attachment(selected));
				}
			});
			custom_postimage_uploader.open();
			return false;
		}

		function custom_postimage_remove_image(key){
			var $wrapper = jQuery('#'+key+'_wrapper');
			$wrapper.find('input#'+key).val('');
			$wrapper.find('img').hide();
			$wrapper.find('a.removeimage').hide();
			return false;
		}
		</script>
		<?php
		wp_nonce_field( 'alumni_gallery', 'custom_postimage_meta_box_nonce' );
	}
	
	public function save_post( $post_id )
	{
		if ( isset( $_POST['last_name'] ) ) update_post_meta($post_id, 'last_name', $_POST['last_name']);
		if ( isset( $_POST['alumni_type'] ) ) update_post_meta($post_id, 'alumni_type', $_POST['alumni_type']);
		if ( isset( $_POST['related_program'] ) ) update_post_meta($post_id, 'related_program', $_POST['related_program']);
		if ( isset( $_POST['year'] ) ) update_post_meta($post_id, 'year', $_POST['year']);
		if ( isset( $_POST['viewing_room'] ) ) update_post_meta($post_id, 'viewing_room', $_POST['viewing_room']);
		if ( isset( $_POST['portfolio_site'] ) ) update_post_meta($post_id, 'portfolio_site', $_POST['portfolio_site']);
		if ( isset( $_POST['ig_link'] ) ) update_post_meta($post_id, 'ig_link', $_POST['ig_link']);
		if (isset( $_POST['custom_postimage_meta_box_nonce'] ) && wp_verify_nonce($_POST['custom_postimage_meta_box_nonce'],'alumni_gallery')) {
			$meta_keys = array('image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7');
			foreach($meta_keys as $meta_key){
				if(isset($_POST[$meta_key]) && intval($_POST[$meta_key])!=''){
					update_post_meta( $post_id, $meta_key, intval($_POST[$meta_key]));
				}else{
					update_post_meta( $post_id, $meta_key, '');
				}
			}
		}
	}
}

add_action( 'init', 'load_alumni' );
function load_alumni()
{
  $alumni = new Alumni();
}
?>