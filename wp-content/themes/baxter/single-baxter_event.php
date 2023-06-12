<?php get_header(); ?>


<div class="single-exhibition-page">

  <?php
    if (have_posts()) :
      while (have_posts()) : the_post(); ?>


        <?php
          $credits = array();
          $curator = get_post_meta( $post->ID, 'curator', true );
          $artist = get_post_meta( $post->ID, 'artist', true );
		  $speakers = get_post_meta( $post->ID, 'speakers', true );
          if ($artist) array_push($credits, $artist);
          $location = get_post_meta($post->ID, 'location', true);
          $opening = get_post_meta( $post->ID, 'opening', true );
          $medium = get_post_meta($post->ID, 'medium', true);
          if ($medium) array_push($credits, '<em>'.$medium.'</em>');
          $year = get_post_meta($post->ID, 'year', true);
          if ($year) array_push($credits, $year);
          $notes = get_post_meta($post->ID, 'notes', true);

          $start_date = get_post_meta( $post->ID, 'start_date', true );
          $start_date_time = DateTime::createFromFormat('Y-m-d', $start_date);

          $end_date = get_post_meta( $post->ID, 'end_date', true );
          $end_date_time = DateTime::createFromFormat('Y-m-d', $end_date);

          $custom = get_post_custom( $post->ID );
          if ( isset( $custom['baxter_featured_image_2'] ) && $custom['baxter_featured_image_2'][0]) {
            $background_image = $custom['baxter_featured_image_2'][0];
          } else {
            $background_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
          }
          if ( ! $background_image) {
            $background_image = get_template_directory_uri() . '/images/blank.png';
          }

          $event_type = get_post_meta($post->ID, 'event_type', true);
        ?>
        <section class="hero hero-home hero--center" style="background-image: url('<?php echo $background_image; ?>')">
          <div class="hero-overlay">
          </div>
        </section><!-- .hero .hero-home -->

        

        <div class="photo-credits">
          <div class="photo-credits__wrapper font-eyebrow"><?php echo implode(', ', $credits); ?></div>
        </div>

      	<div class="left-right">
          <div class="left-right-inner">

            <div class="left-right-right mobile single">f
			  <h2 class="post-eyebrow font-medium font-eyebrow"><?php echo baxter_eyebrow($post); ?></h2>
              <h1 class="post-title"><?php the_title(); ?></h1>
			  <?php if ($event_type != 'conversation') { ?>
				<h2 class="post-author font-medium"><?php echo $artist; ?></h2>
			  <?php } ?>
              <?php if ($location) { ?>
                <h6>Location:</h6>
                <div>
                  <?php if ($location == 'project') {
                    echo '128 Baxter Street, NYC';
                  } else {
                    echo '126 Baxter Street, NYC';
                  } ?>
                </div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($curator) { ?>
                <h6>Curated by:</h6>
                <div><?php echo $curator; ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($start_date_time && $end_date_time) { ?>
                <?php if ($event_type == 'exhibition') { ?>
                  <h6>Exhibition Dates:</h6>
                <?php } else { ?>
                  <h6>Dates:</h6>
                <?php } ?>
                <div><?php echo $start_date_time->format('F j, Y'); ?> - <?php echo $end_date_time->format('F j, Y'); ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } else if ($start_date_time) { ?>
                <?php if ($event_type == 'exhibition') { ?>
                  <h6>Exhibition Date:</h6>
                <?php } else { ?>
                  <h6>Date:</h6>
                <?php } ?>
                <div><?php echo $start_date_time->format('F j, Y'); ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($opening) { ?>
                <h6>Opening Reception:</h6>
                <div><?php echo $opening; ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($artist) { ?>
                <h6>Artist:</h6>
                <div><?php echo $artist; ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
			  <?php if ($speakers && $event_type=='conversation') { ?>
                <h6>Speakers:</h6>
                <div class="conversation-speakers"><?php echo $speakers; ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($notes) { ?>
                <div><?php echo $notes; ?></div>
              <?php } ?>
            </div>

            <div class="left-right-left">
			  <?php echo '<h2 class="post-eyebrow font-medium font-eyebrow '.$event_type.'">'.baxter_eyebrow($post).'</h2>';?>
              <h1 class="post-title"><?php the_title(); ?></h1>
			  <?php if ($event_type != 'conversation') { ?>
				<h2 class="post-author font-medium"><?php echo $artist; ?></h2>
			  <?php } ?>

              <?php the_content(); ?>
            </div>

            <div class="left-right-right desktop">
              <?php if ($location) { ?>
                <h6>Location:</h6>
                <div>
                  <?php if ($location == 'project') {
                    echo '128 Baxter Street, NYC';
                  } else {
                    echo '126 Baxter Street, NYC';
                  } ?>
                  </div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($curator) { ?>
                <h6>Curated by:</h6>
                <div><?php echo $curator; ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($start_date_time && $end_date_time) { ?>
                <?php if ($event_type == 'exhibition') { ?>
                  <h6>Exhibition Dates:</h6>
                <?php } else { ?>
                  <h6>Dates:</h6>
                <?php } ?>
                <div><?php echo $start_date_time->format('F j, Y'); ?> - <?php echo $end_date_time->format('F j, Y'); ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } else if ($start_date_time) { ?>
                <?php if ($event_type == 'exhibition') { ?>
                  <h6>Exhibition Date:</h6>
                <?php } else { ?>
                  <h6>Date:</h6>
                <?php } ?>
                <div><?php echo $start_date_time->format('F j, Y'); ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($opening) { ?>
                <h6>Opening Reception:</h6>
                <div><?php echo $opening; ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($artist) { ?>
                <h6>Artist:</h6>
                <div><?php echo $artist; ?></div>
              <?php } ?>
			  <?php if ($speakers && $event_type=='conversation') { ?>
                <h6>Speakers:</h6>
                <div class="conversation-speakers"><?php echo $speakers; ?></div>
                <div class="breaker-header-row">
                  <hr>
                </div>
              <?php } ?>
              <?php if ($notes) { ?>
                <div><?php echo wp_specialchars_decode($notes); ?></div>
              <?php } ?>
            </div>

          </div><!-- .left-right-inner -->
        </div><!-- .left-right -->


      <?php endwhile;
    endif;
  ?>

</div><!-- . -->



<?php get_footer(); ?>
