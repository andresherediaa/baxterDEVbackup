<?php get_header(); ?>

<?php
$schedule = '';
// $location = '';
// $exhibition_year = '';
$type = '';
if (isset($_GET['schedule'])) $schedule = $_GET['schedule'];
// if (isset($_GET['location'])) $location = $_GET['location'];
// if (isset($_GET['exhibition_year'])) $exhibition_year = $_GET['exhibition_year'];
if (isset($_GET['type'])) $type = $_GET['type'];
// $filtered = ($schedule != '' || $location != '' || $exhibition_year != '' || $type != '');
$filtered = ($schedule != '' || $type != '');
?>

<div class="gallery-form calendar-form">
  <div class="gallery-form-inner">

    <select id="type">
        <option value="">All Events</option>
        <option value="coffee_talk" <?php if ($type == 'coffee_talk') echo 'selected'; ?>>Coffee Talk</option>
        <option value="conversation" <?php if ($type == 'conversation') echo 'selected'; ?>>Conversation</option>
        <option value="critique_group" <?php if ($type == 'critique_group') echo 'selected'; ?>>Critique Group</option>
        <option value="exhibition" <?php if ($type == 'exhibition') echo 'selected'; ?>>Exhibition</option>
        <option value="fundraiser" <?php if ($type == 'fundraiser') echo 'selected'; ?>>Fundraiser</option>
        <option value="juried_competition" <?php if ($type == 'juried_competition') echo 'selected'; ?>>Juried Competition</option>
        <option value="book_fair" <?php if ($type == 'book_fair') echo 'selected'; ?>>Zine and Photo Book Fair</option>
    </select>

    <select id="schedule">
      <option value="">Schedule</option>
      <option value="past" <?php if ($schedule == 'past') echo 'selected'; ?>>Past</option>
      <option value="current" <?php if ($schedule == 'current') echo 'selected'; ?>>Current</option>
      <option value="upcoming" <?php if ($schedule == 'upcoming') echo 'selected'; ?>>Upcoming</option>
    </select>

    <!--
    <select id="location">
      <option value="">All Locations</option>
      <option value="gallery" <?php if ($location == 'gallery') echo 'selected'; ?>>Gallery Space</option>
      <option value="project" <?php if ($location == 'project') echo 'selected'; ?>>Project Space</option>
    </select>

    <select id="exhibition_year">
      <option value="">Years</option>
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

  <?php if ( is_active_sidebar( 'baxter_primary_events_slider' ) ) : ?>
    <?php dynamic_sidebar( 'baxter_primary_events_slider' ); ?>
  <?php endif; ?>

  <div id="content-loop">

  <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $upcoming_exhibition_args = array(
      'post_type' => 'baxter_event',
      'meta_key' => 'start_date',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'numberposts' => -1,
      'posts_per_page' => 4,
      'paged' => $paged
    );
    // $upcoming_exhibitions = get_posts($upcoming_exhibition_args);
    $the_query = new WP_Query( $upcoming_exhibition_args ); 

    // foreach ($upcoming_exhibitions as $upcoming_exhibition) {
    if ( $the_query->have_posts() ) : 
      while ( $the_query->have_posts() ) : $the_query->the_post(); 
        get_template_part( 'wide', get_post_type() );
      endwhile;
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
      <?php next_posts_link('Load More Events', $the_query->max_num_pages); ?>
    </div>
    <?php wp_reset_postdata(); ?>

<?php } else { // if (!$filtered) ?>

  <div id="content-loop">
  <?php

  $meta_query = array();

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
  } else if ($schedule == 'upcoming') { // upcoming
    array_push($meta_query, array(
      'key' => 'start_date',
      'value' => date('Y-m-d'),
      'compare' => '>'
    ));
  }

  // if ($location == 'gallery') {
  //   array_push($meta_query, array(
  //     'key' => 'location',
  //     'value' => 'gallery',
  //     'compare' => '='
  //   ));
  // } else if ($location == 'project') {
  //   array_push($meta_query, array(
  //     'key' => 'location',
  //     'value' => 'project',
  //     'compare' => '='
  //   ));
  // }

  // if ($exhibition_year != '') {
  //   array_push($meta_query, array(
  //     'key' => 'start_date',
  //     'value' => $exhibition_year . '-01-01',
  //     'compare' => '>='
  //   ));
  //   array_push($meta_query, array(
  //     'key' => 'start_date',
  //     'value' => $exhibition_year . '-12-31',
  //     'compare' => '<='
  //   ));
  // }

  if ($type != '') {
    array_push($meta_query, array(
      'key' => 'event_type',
      'value' => $type,
      'compare' => '='
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
    'posts_per_page' => 4,
    'paged' => $paged
  );
  $filtered_exhibitions = get_posts($filter_args);

  $the_query = new WP_Query( $filter_args ); 
  if ( $the_query->have_posts() ) : 
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
      get_template_part( 'wide', get_post_type() );
    endwhile; ?>
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
      <?php next_posts_link('Load More Events', $the_query->max_num_pages); ?>
    </div>
  <?php else: ?>
    <div class="content">
      <h2>No results found</h2>
      <p>Please filter by different criteria to view events.</p>
    </div>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>
<?php } // filtered ?>

</div><!-- . -->

<?php get_footer(); ?>
