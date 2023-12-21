<?php get_header(); ?>

<?php
include_once 'programs-filter.php';
$schedule = '';
if (isset($_GET['schedule'])) $schedule = $_GET['schedule'];
$filtered = ($schedule != '');
?>

<div class="gallery-form" id="articles-form">
  <div class="gallery-form-inner">
    <select id="schedule">
      <option value="">All News</option>
      <option value="fundraisers" <?php if ($schedule == 'fundraisers') echo 'selected'; ?>>Fundraisers</option>
      <option value="community news" <?php if ($schedule == 'community news') echo 'selected'; ?>>Community News</option>
      <option value="press" <?php if ($schedule == 'press') echo 'selected'; ?>>Press</option>
      <option value="residents" <?php if ($schedule == 'residents') echo 'selected'; ?>>Residents</option>
      <option value="board members" <?php if ($schedule == 'board members') echo 'selected'; ?>>Board Members</option>
      <option value="baxter st at ccny" <?php if ($schedule == 'baxter st at ccny') echo 'selected'; ?>>Baxter ST AT CCNY</option>
    </select>
  </div><!-- .gallery-form-inner -->
</div><!-- .gallery-form -->

<div class="">
  <?php if (!$filtered) { ?>
    <!-- nothing into filter -->
    <div>
      <?php if (is_active_sidebar('baxter_articles_slider')) : ?>
        <?php dynamic_sidebar('baxter_articles_slider'); ?>
      <?php endif; ?>
      <?php
      $upcoming_exhibition_args = array(
        'post_type' => 'post',
        'tax_query' => array(
          array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array('post-format-video'),
            'operator' => 'NOT IN'
          ),
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $programs_filter,
            'operator' => 'NOT IN'
          )
        ),
        'orderby' => 'date',
        'order' => 'DESC',
        // 'offset' => $offset,
        'numberposts' => -1,
        'posts_per_page' => 2,
      );
      $upcoming_query = new WP_Query($upcoming_exhibition_args);
      if ($upcoming_query->have_posts()) :
        while ($upcoming_query->have_posts()) : $upcoming_query->the_post();
          get_template_part('wide', get_post_type()); //DOS PSOT MAS RECEINTES
        endwhile;
      endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>

    <div class="thumbs thumbs-grey thumbs--exhibitions">
      <div class="thumbs-inner">
        <h1 class="font-medium">News</h1>
        <ul id="content-loop">

          <?php
          $past_exhibition_args = array(
            'post_type' => 'post',
            'tax_query' => array(
              array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array('post-format-video'),
                'operator' => 'NOT IN'
              ),
              array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $programs_filter,
                'operator' => 'NOT IN'
              )
            ),
            'orderby' => 'date',
            'order' => 'DESC',
            // 'offset' => $offset,
            'numberposts' => -1,
            'posts_per_page' => 9,
            'paged' => $paged
          );

          $past_query = new WP_Query($past_exhibition_args);

          if ($past_query->have_posts()) :
            while ($past_query->have_posts()) : $past_query->the_post();
              get_template_part('content', get_post_type());
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
          'query' => json_encode($past_query->query)
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

  <?php } else { // filtered 
  ?>
    <div id="content-loop">
      <?php

      if ($schedule == 'residents') {
        print_r($schedule);
        $terms = get_terms('category', array('name__like' => 'residents'));

if (!empty($terms)) {
    $category_slugs = array();
    
    foreach ($terms as $term) {
        $category_slugs[] = $term->slug;
    }

    $past_exhibition_args = array(
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array('post-format-video'),
                'operator' => 'NOT IN'
            ),
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category_slugs,
                'operator' => 'IN'  // Utiliza 'IN' para incluir categorías en la consulta
            )
        ),
        'orderby' => 'date',
        'order' => 'DESC',
        'numberposts' => -1,
        'posts_per_page' => 9,
        'paged' => $paged
    );}
      } else {

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // HARCODED
       
        $past_exhibition_args = array(
          'post_type' => 'post',
          'tax_query' => array(
            array(
              'taxonomy' => 'post_format',
              'field' => 'slug',
              'terms' => array('post-format-video'),
              'operator' => 'NOT IN'
            ),
          ),
          'category_name' => $schedule, // Filtra por la categoría "fundraisers"
          'orderby' => 'date',
          'order' => 'DESC',
          'numberposts' => -1,
          'posts_per_page' => 9,
          'paged' => $paged
        );
      }
      $past_query = new WP_Query($past_exhibition_args);


      if ($past_query->have_posts()) :
        while ($past_query->have_posts()) : $past_query->the_post();
          get_template_part('wide', get_post_type());
        endwhile;
      else :
        if ($schedule == 'fundraisers' || $schedule == 'press' || $schedule == 'community news' || $schedule == 'board members' || $schedule == 'baxter st at ccny' || $schedule == 'residents') {
      ?>
          <div class="no-results-upcoming">
            <div class="no-results-copy">
              <div class="no-results-title">We are in the process of finalizing the details for our next new.</div>
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
        'query' => json_encode($the_query->query)
      )
    );
    ?>
    <div class="load-more" data-content="wide">
      <?php next_posts_link('Load More Exhibitions', $the_query->max_num_pages); ?>
    </div>
    <?php wp_reset_postdata(); ?>


  <?php } // filtered 
  ?>

</div><!-- . -->

<?php get_footer(); ?>