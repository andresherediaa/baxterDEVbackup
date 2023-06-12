<?php get_header(); ?>

<?php 
$schedule = '';
$location = '';
$exhibition_year = '';
if (isset($_GET['schedule'])) $schedule = $_GET['schedule']; 
if (isset($_GET['location'])) $location = $_GET['location']; 
if (isset($_GET['exhibition_year'])) $exhibition_year = $_GET['exhibition_year']; 
$filtered = ($schedule != '' || $location != '' || $exhibition_year != '');

echo "Valor de \$schedule: ";
print_r($schedule); // O var_dump($schedule);
?>

<div class="gallery-form">
  <div class="gallery-form-inner">
    <select id="schedule">
      <option value="">All Exhibitions</option>
      <option value="past" <?php if ($schedule == 'past') echo 'selected'; ?>>Past</option>
      <option value="current" <?php if ($schedule == 'current') echo 'selected'; ?>>Current</option>
      <option value="upcoming" <?php if ($schedule == 'upcoming') echo 'selected'; ?>>Upcoming</option>
    </select>

    <!--
    <select id="location">
      <option value="">Location</option>
      <option value="gallery" <?php if ($location == 'gallery') echo 'selected'; ?>>Gallery Space</option>
      <option value="project" <?php if ($location == 'project') echo 'selected'; ?>>Project Space</option>
    </select>

    <select id="exhibition_year">
      <option value="">Year</option>
        <?php
          $a = "2009";
          $b = date("Y");
          for($i=$a; $i<=$b; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php if ($exhibition_year == $i) echo 'selected'; ?>><?php echo $i; ?></option>
          <?php }
        ?>
    </select>
    -->

  </div><!-- .gallery-form-inner -->
</div><!-- .gallery-form -->

<div class="">

<?php if (!$filtered) { ?>

  <div>
    <?php if ( is_active_sidebar( 'baxter_exhibitions_slider' ) ) : ?>
      <?php dynamic_sidebar( 'baxter_exhibitions_slider' ); ?>
    <?php endif; ?>

    <?php
    $upcoming_exhibition_args = array(
      'post_type' => 'baxter_event',
      'meta_query' => array(
          array(
              'key' => 'event_type',
              'value' => 'exhibition',
              'compare' => '='
          ),
      ),
      'meta_key' => 'start_date',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'numberposts' => 2,
      'paged' => 1
    );
    $upcoming_query = new WP_Query( $upcoming_exhibition_args ); 
    if ( $upcoming_query->have_posts() ) : 
      while ( $upcoming_query->have_posts() ) : $upcoming_query->the_post(); 
        get_template_part( 'wide', get_post_type() );
      endwhile;
    endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>

  <div class="thumbs thumbs-grey thumbs--exhibitions">
    <div class="thumbs-inner">
      <h1 class="font-medium">Past Exhibitions</h1>
      <ul id="content-loop">

        <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $past_exhibition_args = array(
            'post_type' => 'baxter_event',
            'meta_query' => array(
                array(
                    'key' => 'event_type',
                    'value' => 'exhibition',
                    'compare' => '='
                ),
                array(
                    'key' => 'end_date',
                    'value' => date('Y-m-d'),
                    'compare' => '<'
                )
            ),
            'meta_key' => 'start_date',
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'numberposts' => -1,
            'posts_per_page' => 9,
            'paged' => $paged
          );

          $past_query = new WP_Query( $past_exhibition_args ); 
          if ( $past_query->have_posts() ) : 
            while ( $past_query->have_posts() ) : $past_query->the_post(); 
              get_template_part( 'content', get_post_type() );
            endwhile;
          endif;
        ?>
      </ul>
    </div><!-- .thumbs-inner -->

    <?php
  wp_localize_script(
    'main',
    'baxter_pagination',
    array(
      'paged' => $paged + 1,
      'max_num_pages' => $past_query->max_num_pages,
      'query' => json_encode( $past_query->query )
    )
  );
  ?>

  <div class="load-more" data-content="content">
    <?php 
    next_posts_link('Load More Exhibitions', $past_query->max_num_pages); 
    ?>
  </div>
  
  </div><!-- .thumbs -->

  
  <?php wp_reset_postdata(); ?>

<?php } else { // filtered ?>

  <div id="content-loop">

  <?php

  $meta_query = array(
    array(
        'key' => 'event_type',
        'value' => 'exhibition',
        'compare' => '='
    )
  );

  if ($schedule == 'past') {
    array_push($meta_query, array(
      'key' => 'end_date',
      'value' => date('Y-m-d'),
      'compare' => '<'
    ));
  } else if ($schedule == 'current') {
    array_push($meta_query, array(
      'key' => 'start_date',
      'value' => date('Y-m-d'),
      'compare' => '<='
    ));
    array_push($meta_query, array(
        'key' => 'end_date',
        'value' => date('Y-m-d'),
        'compare' => '>='
    ));
  } else if ($schedule == 'upcoming') {
    array_push($meta_query, array(
      'key' => 'start_date',
      'value' => date('Y-m-d'),
      'compare' => '>'
    ));
  }

  if ($location == 'gallery') {
    array_push($meta_query, array(
      'key' => 'location',
      'value' => 'gallery',
      'compare' => '='
    ));
  } else if ($location == 'project') {
    array_push($meta_query, array(
      'key' => 'location',
      'value' => 'project',
      'compare' => '='
    ));
  }

  if ($exhibition_year != '') {
    array_push($meta_query, array(
      'key' => 'start_date',
      'value' => $exhibition_year . '-01-01',
      'compare' => '>='
    ));
    array_push($meta_query, array(
      'key' => 'start_date',
      'value' => $exhibition_year . '-12-31',
      'compare' => '<='
    ));
  }

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $filter_args = array(
    'post_type' => 'baxter_event',
    'meta_query' => $meta_query,
    'meta_key' => 'start_date',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'numberposts' => -1,
    'posts_per_page' => 9,
    'paged' => $paged
  );
  $the_query = new WP_Query( $filter_args ); 
  if ( $the_query->have_posts() ) : 
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
      get_template_part( 'wide', get_post_type() );
    endwhile;
  else :
	if ($schedule == 'upcoming') {
	?>
	<div class="no-results-upcoming">
      <div class="no-results-copy">
	    <div class="no-results-title">We are in the process of finalizing the details for our next exhibition.</div>
	  	<div class="no-results-legend">
	       Make sure to subscribe to our newsletter to
		  stay up to date on upcoming shows!
	    </div>
	    <div class="no-results-button">
		  <a href="http://eepurl.com/cQLTuL" class="font-medium subscribe-button">SUBSCRIBE</a>	 
	    </div>
	  </div>
	  <div class="no-results-img">
		<img src="<?php echo wp_get_attachment_image_src(22357, 'medium_large')[0]; ?>">
	  </div>
	</div>
	<?php }
	if ($schedule == 'current') {
	?>
	<div class="no-results-upcoming">
	  <div class="no-results-copy">
		<div class="no-results-title">We're currently between exhibitions.</div>
	    <div class="no-results-legend">
	      Make sure to subscribe to our newsletter to stay up to date on
		  upcoming shows!
	    </div>
	    <div class="no-results-button">
		  <a href="http://eepurl.com/cQLTuL" class="font-medium subscribe-button">SUBSCRIBE</a>	 
	    </div>
	  </div>
	  <div class="no-results-img">
		<img src="<?php echo wp_get_attachment_image_src(22357, 'medium_large')[0]; ?>">
	  </div>
	</div>
	<?php }
  endif;
  ?>
</div>
  <?php
    wp_localize_script(
      'main',
      'baxter_pagination',
      array(
        'paged' => $paged + 1,
        'max_num_pages' => $the_query->max_num_pages,
        'query' => json_encode( $the_query->query )
      )
    );
  ?>
  <div class="load-more" data-content="wide">
    <?php next_posts_link('Load More Exhibitions', $the_query->max_num_pages); ?>
  </div>
<?php wp_reset_postdata(); ?>


<?php } // filtered ?>

</div><!-- . -->

<?php get_footer(); ?>
