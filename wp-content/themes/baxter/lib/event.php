<?php

class Event
{
	public function __construct()
	{
		// Register Events as a custom post type.
		register_post_type( 'baxter_event', array(
			'labels' => array(
				'name' => 'Events',
				'singular_name' => 'Event'
			),
			'public' => true,
      		'show_in_nav_menus' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'events' ),
			'hierarchical' => false,
			'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail' ),
			'show_in_rest' => true
		) );

		// Add meta boxes to the edit page
		add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );

		// Save the data when updating a Exhibition.
		add_action( 'save_post', array( &$this, 'save_post' ) );
	}

	public function add_meta_boxes()
	{
        add_meta_box( 'event_type', 'Event Type', array(&$this, 'event_type'), 'baxter_event', 'side', 'default' );
		add_meta_box( 'location', 'Location', array(&$this, 'location'), 'baxter_event', 'side', 'default' );
		add_meta_box( 'curator', 'Curator', array(&$this, 'curator'), 'baxter_event', 'side', 'default' );
		add_meta_box( 'dates', 'Dates', array(&$this, 'dates'), 'baxter_event', 'side', 'default' );
		add_meta_box( 'opening', 'Opening Reception', array(&$this, 'opening'), 'baxter_event', 'side', 'default' );
		add_meta_box( 'details', 'Details', array(&$this, 'details'), 'baxter_event', 'side', 'default' );
    }
    
    public function event_type($post)
	{
        $custom = get_post_custom( $post->ID );
		$event_type = '';
		if ( isset( $custom['event_type'] ) ) $event_type = $custom['event_type'][0];
		?>
        <div class="control-group">
		    <div class="controls">
                <select name="event_type">
                    <option value="exhibition" <?php if ($event_type == 'exhibition') echo 'selected'; ?>>Exhibition</option>
                    <option value="coffee_talk" <?php if ($event_type == 'coffee_talk') echo 'selected'; ?>>Coffee Talk</option>
                    <option value="fundraiser" <?php if ($event_type == 'fundraiser') echo 'selected'; ?>>Fundraiser</option>
                    <option value="book_fair" <?php if ($event_type == 'book_fair') echo 'selected'; ?>>Zine and Photo Book Fair</option>
                    <option value="juried_competition" <?php if ($event_type == 'juried_competition') echo 'selected'; ?>>Juried Competition</option>
                    <option value="critique_group" <?php if ($event_type == 'critique_group') echo 'selected'; ?>>Critique Group</option>
                    <option value="conversation" <?php if ($event_type == 'conversation') echo 'selected'; ?>>Conversation</option>
                </select>
            </div>
        </div>
		<?php
    }
    
    public function location($post)
	{
		$custom = get_post_custom( $post->ID );
		$location = '';
		if ( isset( $custom['location'] ) ) $location = $custom['location'][0];
		?>
        <div class="control-group">
		    <div class="controls">
                <select name="location">
					<option value="" <?php if ($location == '') echo 'selected'; ?>>No location</option>
                    <option value="project" <?php if ($location == 'project') echo 'selected'; ?>>Project</option>
                    <option value="gallery" <?php if ($location == 'gallery') echo 'selected'; ?>>Gallery</option>
                </select>
            </div>
        </div>
		<?php
    }
    
    public function curator($post)
	{
		$custom = get_post_custom( $post->ID );
		$curator = '';
		if ( isset( $custom['curator'] ) ) $curator = $custom['curator'][0];
		?>
        <div class="control-group">
  		    <div class="controls">
  		        <input type="text" name="curator" value="<?php echo $curator; ?>">
  		    </div>
        </div>
		<?php
	}

	public function dates($post)
	{
        $custom = get_post_custom( $post->ID );
        
		$start_date = '';
		if ( isset( $custom['start_date'] ) ) $start_date = $custom['start_date'][0];
		?>
        <div class="control-group">
            <label for="start_date">Start date</label>
  		    <div class="controls">
  		        <input type="text" name="start_date" id="start_date" value="<?php echo $start_date; ?>">
  		    </div>
        </div>
		<?php

        $end_date = '';
        if ( isset( $custom['end_date'] ) ) $end_date = $custom['end_date'][0];
        ?>
        <div class="control-group">
            <label for="end_date">End date</label>
            <div class="controls">
                <input type="text" name="end_date" id="end_date" value="<?php echo $end_date; ?>">
            </div>
        </div>
		<?php
		
		$hours = '';
		if ( isset( $custom['hours'] ) ) $hours = $custom['hours'][0];
		?>
        <div class="control-group">
            <label for="hours">Hours</label>
  		    <div class="controls">
  		        <input type="text" name="hours" id="hours" value="<?php echo $hours; ?>">
  		    </div>
        </div>
		<?php
    }

    public function opening($post)
	{
		$custom = get_post_custom( $post->ID );
		$opening = '';
		if ( isset( $custom['opening'] ) ) $opening = $custom['opening'][0];
		?>
        <div class="control-group">
  		    <div class="controls">
  		        <input type="text" name="opening" value="<?php echo $opening; ?>">
  		    </div>
        </div>
		<?php
	}

	public function details($post)
	{
		$custom = get_post_custom( $post->ID );

		$artist = '';
		if ( isset( $custom['artist'] ) ) $artist = $custom['artist'][0];
		?>
        <div class="control-group">
			<label for="artist">Artist</label>
  		    <div class="controls">
  		        <input type="text" name="artist" id="artist" value="<?php echo $artist; ?>">
  		    </div>
        </div>
		<?php
		$speakers = '';
		if ( isset( $custom['speakers'] ) ) $artist = $custom['speakers'][0];
		?>
		<div class="control-group">
			<label for="speakers">Speakers (Only for Conversations)</label>
  		    <div class="controls">
				<textarea type="text" name="speakers" id="speakers" rows="4" cols="25"><?php echo $speakers; ?></textarea>
  		    </div>
        </div>

		<?php

		$medium = '';
		if ( isset( $custom['medium'] ) ) $medium = $custom['medium'][0];
		?>
        <div class="control-group">
			<label for="medium">Medium</label>
  		    <div class="controls">
  		        <input type="text" name="medium" id="medium" value="<?php echo $medium; ?>">
  		    </div>
        </div>
		<?php

		$year = '';
		if ( isset( $custom['year'] ) ) $year = $custom['year'][0];
		?>
		<div class="control-group">
			<label for="year">Year</label>
			<div class="controls">
				<input type="text" name="year" id="year" value="<?php echo $year; ?>">
			</div>
		</div>
		<?php

		$notes = '';
		if ( isset( $custom['notes'] ) ) $notes = $custom['notes'][0];
		?>
		<div class="control-group">
			<label for="notes">Notes</label>
			<div class="controls">
				<textarea name="notes" id="notes"><?php echo wp_specialchars_decode($notes); ?></textarea>
			</div>
		</div>
		<?php
	}

	public function save_post( $post_id )
	{
		if ( isset( $_POST['event_type'] ) ) update_post_meta($post_id, 'event_type', $_POST['event_type']);
		if ( isset( $_POST['location'] ) ) update_post_meta($post_id, 'location', $_POST['location']);
		if ( isset( $_POST['curator'] ) ) update_post_meta($post_id, 'curator', $_POST['curator']);
		if ( isset( $_POST['start_date'] ) ) update_post_meta($post_id, 'start_date', $_POST['start_date']);
		if ( isset( $_POST['end_date'] ) ) update_post_meta($post_id, 'end_date', $_POST['end_date']);
		if ( isset( $_POST['hours'] ) ) update_post_meta($post_id, 'hours', $_POST['hours']);
		if ( isset( $_POST['opening'] ) ) update_post_meta($post_id, 'opening', $_POST['opening']);
		if ( isset( $_POST['artist'] ) ) update_post_meta($post_id, 'artist', $_POST['artist']);
		if ( isset( $_POST['speakers'] ) ) update_post_meta($post_id, 'speakers', $_POST['speakers']);
		if ( isset( $_POST['medium'] ) ) update_post_meta($post_id, 'medium', $_POST['medium']);
		if ( isset( $_POST['year'] ) ) update_post_meta($post_id, 'year', $_POST['year']);
		if ( isset( $_POST['notes'] ) ) update_post_meta($post_id, 'notes', esc_html( $_POST['notes'] ));
	}

}


add_action( 'init', 'load_event' );
function load_event()
{
  $event = new Event();
}
